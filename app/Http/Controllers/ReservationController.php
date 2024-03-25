<?php

namespace App\Http\Controllers;

use App\Enum\Status;
use App\Http\Resources\ReservationResource;
use App\Models\Car;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use App\Models\Washing;
use App\Utils\EmployeeNotification;
use App\Utils\Notification;
use App\Utils\CustomerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReservationController extends Controller
{

    private $customerNotification;
    private $employeeNotification;

    public function __construct(CustomerNotification $customerNotification, EmployeeNotification $employeeNotification)
    {
        $this->customerNotification = $customerNotification;
        $this->employeeNotification = $employeeNotification;
    }

    public function store(Request $req)
    {
        DB::beginTransaction();
        try {
            $reservation = new Reservation();

            $reservation->user_id = auth()->user()->id;
            $reservation->washing_id = $req->washing_id;
            $reservation->service_id = $req->service_id;
            $reservation->car_id = $req->car_id;
            $reservation->day = $req->day;
            $reservation->time = $req->time;
            $reservation->price = $req->price;

            $washing = Washing::find($req->washing_id);

            if (!$washing) {
                throw new \Exception('Washing not found', 404);
            }

            $reservation->reservation_washing = $washing->user_id;

            $reservation->save();

            $reservationStatus = new ReservationStatus([
                'reservation_id' => $reservation->id,
                'user_id' => auth()->user()->id,
                'user_type' => auth()->user()->type,
                'status' => Status::APPROVED,
            ]);

            $reservationStatus->save();

            $username = auth()->user()->name;
            $tel = auth()->user()->phone;
            $userCars = auth()->user()->cars;
            $selectedCar = $userCars->where('id', $req->car_id)->first();

            if ($selectedCar) {
                $reservation->car_id = $req->car_id;
                $car_number = $selectedCar->car_number;
            } else {
                throw new \Exception('Car not found for the given car_id', 404);
            }

            $day = $req->day;
            $time = $req->time;

            DB::commit();

            $user_phone = $washing->user->phone;
            $topic = 'employee' . $user_phone;
//            $topic = 'employee' . '994506356447';
            $title =  'Yeni reservasiya';
            $body = 'Yeni reservasiya.';

            $this->employeeNotification->sendNotification($topic, $title, $body);
            return response()->json([
                'success' => true,
                'data' => ['reservation' => new ReservationResource($reservation)],
                'message' => 'Successfully added',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e);
        }
    }

    public function customerChangeStatus(Request $request)
    {
        DB::beginTransaction();
        try {

            $reservationStatus = new ReservationStatus([
                'reservation_id' => $request->reservation_id,
                'user_id' => auth()->user()->id,
                'user_type' => auth()->user()->type,
                'status' => $request->status,
            ]);

            $reservation = Reservation::findOrFail($request->reservation_id);
            $reservationStatus->save();

            $user_phone = $reservation->washing->user->phone;
            $topic = 'employee' . $user_phone;
//            $topic = 'employee' . '994506356447';
            $title = ($request->status == Status::CANCELLED) ? 'Reservasiya ləğv olundu' : 'Reservasiya tamamlandı';
            $body = 'Your reservation status has been updated.';


            $this->employeeNotification->sendNotification($topic, $title, $body);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Successfully updated',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e);
        }
    }

    public function employeeChangeStatus(Request $request){
        DB::beginTransaction();
        try {

            $reservationStatus = new ReservationStatus([
                'reservation_id' => $request->reservation_id,
                'user_id' => auth()->user()->id,
                'user_type' => auth()->user()->type,
                'status' => $request->status,
            ]);

            $reservation  = Reservation::findOrFail($request->reservation_id);
            $branch = $reservation->washing->washing_name;
            $service = $reservation->service->title;
            $reservationStatus->save();

            $user_phone = $reservation->user->phone;
            $topic = 'customer' . $user_phone;

//            $topic = 'customer' . '994506356447';
            $title = ($request->status == Status::CANCELLED) ? 'Reservasiya ləğv olundu' : 'Reservasiya tamamlandı';
            $body = 'Your reservation status has been updated.';
            if($request->status == Status::CANCELLED){
                $jsonPayload = null;
            }else{
                $jsonPayload = json_encode([
                    'reservation_id' => $request->reservation_id,
                    'branch' => $branch,
                    'service' => $service,
                    'type' => 'rating',
                ]);
            }


            $this->customerNotification->sendNotification($topic, $title, $body, $jsonPayload);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Successfully updated',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e);
        }
    }


    // show reservations for users
    public function show($id)
    {

        try {
            $reservation = Reservation::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => ['reservation' => new ReservationResource($reservation)],
                'message' => 'Successfully fetched',
            ]);

        }catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e);
        }

    }

    // show reservations for washings


    public function showEmployeeReservations()
    {
        try {
//            $user_id = auth()->user()->id;
            $user_id = auth()->user()->id;

            $reservations = Reservation::orderBy('day','desc')->orderBy('time','desc')->where('reservation_washing', $user_id)->with('reservation_statuses')->get();

            $active = collect();
            $history = collect();

            foreach ($reservations as $reservation){
                if(in_array($reservation->reservation_statuses->last()?->status,[Status::APPROVED, Status::UNKNOWN])){
                    $active->add($reservation);
                }elseif(in_array($reservation->reservation_statuses->last()?->status,[Status::CANCELLED, Status::COMPLETED])){
                    $history->add($reservation);
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'reservations' => [
                        'active' => ReservationResource::collection($active),
                        'history' => ReservationResource::collection($history),
                    ]
                ],
                'message' => 'Successfully fetched',
            ]);
        } catch (\Exception $e) {

            return $this->errorResponse($e);
        }
    }




    // show reservations for users



    public function showReservations()
    {
        try {
            $user_id = auth()->user()->id;

            $reservations = Reservation::orderBy('day','desc')->orderBy('time','desc')->where('user_id', $user_id)->with('reservation_statuses')->get();

            $active = collect();
            $history = collect();

            foreach ($reservations as $reservation){
                if(in_array($reservation->reservation_statuses->last()?->status,[Status::APPROVED])){
                    $active->add($reservation);
                }elseif(in_array($reservation->reservation_statuses->last()?->status,[Status::CANCELLED, Status::COMPLETED, Status::UNKNOWN])){
                    $history->add($reservation);
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'reservations' => [
                        'active' => ReservationResource::collection($active),
                        'history' => ReservationResource::collection($history),
                    ]
                ],
                'message' => 'Successfully fetched',
            ]);

        } catch (\Exception $e) {

            return $this->errorResponse($e);
        }
    }


    public function index()
    {
        $reservations = Reservation::with('reservation_statuses','washing','user')->orderBy('id','desc')->get();
        return view('admin.reservations.index', compact('reservations'));

    }


    public function updateCustomerReservation(Request $req, $id)
    {

        DB::beginTransaction();
        try{
            $reservation = Reservation::findOrFail($id);

            $reservation->washing_id = $req->washing_id;
            $reservation->service_id = $req->service_id;
            $reservation->car_id = $req->car_id;
            $reservation->day = $req->day;
            $reservation->time = $req->time;
            $reservation->price = $req->price;

            $reservation->save();
            $washing = Washing::find($req->washing_id);
            $user_phone = $washing->user->phone;
            $topic = 'employee' . $user_phone;
//            $topic = 'employee' . '994506356447';
            $title =  'Reservasiya deyisdirildi';
            $body = 'Reservasiya deyisdirildi.';

            $this->employeeNotification->sendNotification($topic, $title, $body);

//            $lastStatus = ReservationStatus::where('reservation_id', $reservation->id)
//                ->orderBy('created_at', 'desc')
//                ->first();
//
//            if (!$lastStatus || $lastStatus->status != $req->status) {
//                $reservationStatus = new ReservationStatus([
//                    'reservation_id' => $reservation->id,
//                    'user_id' => auth()->user()->id,
//                    'user_type' => auth()->user()->type,
//                    'status' => $req->status,
//                ]);
//
//                $reservationStatus->save();
//
//            }

//            $washing = Washing::with('user.fcmTokens')->where('id', $req->washing_id)->first();
//
//            $tokens = $washing->user->fcmTokens->pluck('fcm_token')->toArray();
//
//            $username = auth()->user()->name;
//
//            $selectedCar = Car::where('id', $req->car_id)->first();
//
//            if ($selectedCar) {
//                $reservation->car_id = $req->car_id;
//                $car_number = $selectedCar->car_number;
//            } else {
//                throw new \Exception('Car not found for the given car_id', 404);
//            }
//
//            $day = $req->day;
//            $time = $req->time;
//
//            if ($req->status != Status::COMPLETED) {
//                $tokens = array_unique($tokens);
//                if (count($tokens)) {
//                    if ($req->status == Status::APPROVED) {
//                        $message = 'Sifariş yeniləndi';
//                    } elseif ($req->status == Status::CANCELLED) {
//                        $message = 'Sifariş ləğv edildi';
//                    }
//
//                    $this->notification->send($message, "{$username} / {$car_number} / {$day} / {$time}", $tokens);
//                }
//
//               $tel = auth()->user()->phone;
//               $number = $washing->phone;
//               if ($req->status == Status::APPROVED) {
//                   $message = 'Sifariş yeniləndi' . ' / ' . $username  . ' / ' . $tel . ' / ' . $car_number . ' / ' . $req->time . ' / ' . $req->day;
//               } elseif ($req->status == Status::CANCELLED) {
//                   $message = 'Sifariş ləğv edildi' . ' / ' . $username  . ' / ' . $tel . ' / ' . $car_number . ' / ' . $req->time . ' / ' . $req->day;
//               }
//
//               $send_sms = new SendSms();
//               $send_sms->send_sms($message, $number);
//            }

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => ['reservation' => new ReservationResource($reservation)],
                'message' => 'Successfully updated',
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e);
        }

    }

//    for cronejob
    public function changeStatus()
    {
//        $current_time = Carbon::now();
//        $reservations = Reservation::whereHas('reservation_statuses', function ($query) {
//            $query->where('status', 1);
//        })
//            ->with('reservation_statuses','user')
//            ->where('day','=',Carbon::today()->format('d.m.Y'))
//            ->whereTime('time', '<=', $current_time->format('H:i'))
//            ->has('reservation_statuses', '=', 1)
//            ->get();
//
//        foreach ($reservations as $reservation){
//            $reservation->reservation_statuses()->create([
//                'reservation_id' =>$reservation->id,
//                'user_id' =>$reservation->user->id,
//                'user_type' =>$reservation->user->type,
//                'status' => 4
//            ]);
//        }

    }


    private function errorResponse(\Exception $e)
    {
        $statusCode = $this->getStatusCodeFromException($e);

        return response()->json([
            'success' => false,
            'data' => null,
            'message' => $e->getMessage(),
            'errors' => ['code' => $statusCode, 'message' => $e->getMessage()],
        ], $statusCode);
    }

    private function getStatusCodeFromException(\Exception $e)
    {
        return method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
    }



}
