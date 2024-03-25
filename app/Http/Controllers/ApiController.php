<?php

namespace App\Http\Controllers;

use App\Http\Resources\BanResource;
use App\Http\Resources\CarResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\EmployeeWashingResource;
use App\Http\Resources\FaqResource;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PackageResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SingleWashingResource;
use App\Http\Resources\SingleWashingServiceResource;
use App\Http\Resources\TermResource;
use App\Http\Resources\WashingResource;
use App\Http\Resources\WashingServiceResource;
use App\Http\Resources\WordResource;
use App\Models\Ban;
use App\Models\Car;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Language;
use App\Models\Offer;
use App\Models\Package;
use App\Models\Region;
use App\Models\Service;
use App\Models\Term;
use App\Models\Washing;
use App\Models\WashingService;
use App\Models\Word;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class ApiController extends Controller
{

    public function washing_change_status(Request $request)
    {

        try {

            $washing = Washing::findOrFail($request->id);
            $washing->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status changed successfully.',
                'errors' => null,
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function packages()
    {
        try {

            return response()->json([
                'success' => true,
                'data' => ['packages' => PackageResource::collection(Package::all())],
                'message' => 'Packages fetched successfully.',
                'errors' => null,
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getCustomerOffers()
    {
        try {

            return response()->json([
                'success' => true,
                'data' => ['offers' => OfferResource::collection(Offer::where('is_active', true)->where('type', 1)->orderBy('id','desc')->get())],
                'message' => 'Offers fetched successfully.',
                'errors' => null,
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

    }
    public function getEmployeeOffers()
    {
        try {

            return response()->json([
                'success' => true,
                'data' => ['offers' => OfferResource::collection(Offer::where('is_active', true)->where('type', 2)->orderBy('id','desc')->get())],
                'message' => 'Offers fetched successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getCustomerTerm()
    {
        try {

            return response()->json([
                'success' => true,
                'data' => ['terms' => TermResource::collection(Term::where('type', 1)->get())],
                'message' => 'Customer terms fetched successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

    }

    public function getEmployeeTerm()
    {
        try {

            return response()->json([
                'success' => true,
                'data' => ['terms' => TermResource::collection(Term::where('type', 2)->get())],
                'message' => 'Employee terms fetched successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getBans()
    {
        try {
            return response()->json([
                'success' => true,
                'data' => ['bans' => BanResource::collection(
                    Ban::orderByTranslation('title')->get()
                )],
                'message' => 'Bans fetched successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }



    public function getServices(){
        try {

            return response()->json([
                'success' => true,
                'data' => ['services' => ServiceResource::collection(Service::orderByTranslation('title')->get())],
                'message' => 'Services fetched successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getWashingServices(Request $request)
    {
        $washing_id = $request->washing_id;
        $ban_id = $request->ban_id;
        $_date = $request->date;
        try {
            $washings  = Washing::select('washings.id','washings.washing_name','washings.address','washings.lat', 'washings.lon')->where('washings.status', true)->get();
            $cars = CarResource::collection(Car::where('user_id', auth()->user()->id)->get());
            $result = null;
            $services = null;

            if (isset($_date)) {
                $this->validateDate($_date);

                $work_times = DB::table('washings')->select('start_date', 'end_date')->where('id', $washing_id)->first();
                $washing = Washing::find($washing_id);

                $intervals = CarbonInterval::minutes($washing->interval)->toPeriod($work_times->start_date, $work_times->end_date);

                $_times = [];
                foreach ($intervals as $date) {
                    $_times[] = $date->format('H:i');
                }

                $currentTime = now()->format('H:i');
                $times = DB::table('reservations')
                    ->where('washing_id', $washing_id)
                    ->where('day', $_date)
                    ->pluck('time')->toArray();

                $result = [];

                foreach ($_times as $time) {
                    $is_reserved = in_array($time, $times);
                    $is_past_time = ($_date == now()->format('d.m.Y') && $currentTime >= $time);

                    $result[] = [
                        'time' => $time,
                        'is_reserved' => $is_reserved || $is_past_time,
                    ];
                }
            }

            if (isset($ban_id)) {
                $washing = Washing::find($washing_id);
                $washing_services = $washing->services()->wherePivot('ban_id', $ban_id)->get();
                $services = WashingServiceResource::collection($washing_services);
            }

            return response()->json(['success' => true, 'data' => ['washings' => $washings, 'cars' => $cars,'times' => $result, 'services' => $services], 'message' => 'Data fetched successfully']);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function store_comment(Request $request)
    {

        try {
            $request->validate([
                'reservation_id' => 'required',
            ]);

            $comment = new Comment();
            $comment->reservation_id = $request->reservation_id;
            $comment->comment = $request->comment;
            $comment->rating = $request->rating;
            $comment->save();

            return response()->json([
                'success' => true,
                'data' => ['comment' => $comment],
                'message' => 'Comment created successfully.',
                'errors' => null,
            ], 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

    }

    public function getAllWashings(Request $request)
    {
        try {
            $lat = $request->header('lat');
            $lon = $request->header('lon');

            $city_id = $request->city_id;
            $region_id = $request->region_id;
            $village_id = $request->village_id;
            $service_id = $request->service_id;
            $text = $request->text;

            $query = Washing::select(
                'washings.id',
                'washings.status',
                'washings.washing_name',
                'washings.address',
                'washings.phone',
                'washings.start_date',
                'washings.end_date',
                'washings.description',
                'washings.lat',
                'washings.lon',
                DB::raw('(SELECT COALESCE(ROUND((5 + SUM(comments.rating)) / (COUNT(comments.rating) + 1), 1), 5) FROM comments
                INNER JOIN reservations ON comments.reservation_id = reservations.id
                WHERE reservations.washing_id = washings.id) as average_rating'),
                DB::raw('(SELECT image FROM washing_images
                WHERE washing_id = washings.id
                ORDER BY id ASC
                LIMIT 1) as main_image')
            );

            if ($lat && $lon) {
                $query->addSelect(DB::raw(
                    'ROUND(6371 * 2 * ASIN(SQRT(POWER(SIN(('.$lat.' - washings.lat) * PI() / 180 / 2), 2) + COS('.$lat.' * PI() / 180) * COS(washings.lat * PI() / 180) * POWER(SIN(('.$lon.' - washings.lon) * PI() / 180 / 2), 2))), 2) AS distance'
                ));
                $query->orderBy('distance');
            } else {
                $query->orderByDesc('washings.id');
            }

            $query->where('washings.status', true);

            if ($city_id) {
                $query->where('washings.city_id', $city_id);
            }

            if ($village_id) {
                $query->where('washings.village_id', $village_id);
            }

            if ($region_id) {
                $query->where('washings.region_id', $region_id);
            }

            if ($text) {
                $query->where('washings.washing_name', 'LIKE', '%' . $text . '%');
            }

            if ($service_id) {
                $query->whereHas('services', function ($q) use ($service_id) {
                    $q->where('service_id', $service_id);
                });
            }

            $washings = $query->get();

            $washings->each(function ($washing) {
                $washing->groupedServices = collect($washing->services->groupBy(function ($service) {
                    $banId = $service->pivot->ban_id;
                    $banTitle = Ban::find($banId)->translations->firstWhere('locale', app()->getLocale())->title;
                    return $banTitle ?: $banId;
                }));
            });

            return response()->json([
                'success' => true,
                'data' => ['washings' => WashingResource::collection($washings)],
                'message' => 'Washings retrieved successfully.',
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function getEmployeeWashings()
    {
        try {
            $washings = Washing::with('services', 'images', 'packages')->where('user_id', auth()->user()->id)->get();

            $washings->each(function ($washing) {
                $lastPackage = $washing->packages->last();
                if(count($washing->packages)){
                    if($lastPackage->pivot->is_payed){
                        $washing->payment_status  = true;
                    }else{
                        $washing->payment_status  = false;
                    }

                }else{
                    $washing->payment_status  = false;
                }

                $washing->groupedServices = collect($washing->services->groupBy(function ($service) {
                    return $service->pivot->ban_id;
                }));
            });

            return response()->json([
                'success' => true,
                'data' => ['washings' => EmployeeWashingResource::collection($washings)],
                'message' => 'Washing retrieved successfully.',
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function customerFaqs()
    {


        try {

            $faqs = Faq::where('type', 1)->get();

            return response()->json([
                'success' => true,
                'data' => ['faqs' => FaqResource::collection($faqs)],
                'message' => 'Faqs retrieved successfully.',
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function employeeFaqs()
    {

        try {

            $faqs = Faq::where('type', 2)->get();

            return response()->json([
                'success' => true,
                'data' => ['faqs' => FaqResource::collection($faqs)],
                'message' => 'Faqs retrieved successfully.',
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getLanguages()
    {
        try {
            $languages = Language::all();

            return response()->json([
                'success' => true,
                'data' => ['languages' => LanguageResource::collection($languages)],
                'message' => 'Languages retrieved successfully.',
            ]);
        }catch (\Exception $e) {
            return $this->errorResponse($e);
        }

    }

    public function getContacts()
    {
        try {
            $contacts = Contact::all();

            return response()->json([
                'success' => true,
                'data' => ['contacts' => ContactResource::collection($contacts)],
                'message' => 'Contacts retrieved successfully.',
            ]);
        }catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getRegions()
    {

        try {
            $cities = Region::with('regions.villages')
                ->where('parent_id',null)
                ->where('type',\App\Enums\Region::CITY)
                ->orderByTranslation('title')
                ->get();

            return response()->json([
                'success' => true,
                'data' => ['regions' => $cities],
                'message' => 'Regions retrieved successfully.',
            ]);

        }catch (\Exception $e) {
            return $this->errorResponse($e);
        }

    }

    public function getCustomerWords()
    {
        try {
            $locale = app()->getLocale();
            $words = Word::where('type', 1)->get();

            $translations = [];
            foreach ($words as $word) {
                $key = str_replace('customer.' , '', $word->key);
                $translations[$key] = $word->translate($locale)->title;
            }

            return response()->json([
                'success' => true,
                'data' => ['words' => ['customer' => $translations]],
                'message' => 'Words retrieved successfully.',
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    public function getEmployeeWords()
    {

        try {
            $locale = app()->getLocale();
            $words = Word::where('type', 2)->get();

            $translations = [];
            foreach ($words as $word) {
                $key = str_replace('employee.' , '', $word->key);
                $translations[$key] = $word->translate($locale)->title;
            }

            return response()->json([
                'success' => true,
                'data' => ['words' => ['employee' => $translations]],
                'message' => 'Words retrieved successfully.',
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
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

    private function validateDate($date)
    {
        $yesterday = now()->subDay();
        $validator = Validator::make(['_date' => $date], [
            '_date' => ['date_format:d.m.Y', 'after:' . $yesterday->format('d.m.Y')],
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }


}
