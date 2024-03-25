<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Washing;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TimeController extends Controller
{
    public function index($washing_id, $_date)
    {
        try {

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
                ->select('reservations.time')
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

            return response()->json(['success' => true, 'data' => ['times' =>$result], 'message' => 'Times fetched successfully']);
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
            '_date' => ['required', 'date_format:d.m.Y', 'after:' . $yesterday->format('d.m.Y')],
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }


}
