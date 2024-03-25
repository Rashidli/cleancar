<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Washing;
use App\Models\WashingPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function payment_page()
    {


        return view('front.payment_page');

    }


    public function callback(Request $request)
    {

        try {


            $data = $request->all();
            Log::info('Received JSON data: ' . json_encode($data));
            $package = WashingPayment::where('order_id',$data['ORDER'])->first();

            if (!$package) {
                Log::error('Package not found');
                return response()->json(['error' => 'Package not found'], 404);
            }
            $package->response = json_encode($data);

            $requiredKeys = ['RRN', 'ACTION', 'MASKED_CARD', 'RC'];
            if (array_key_exists($requiredKeys[0], $data) && array_key_exists($requiredKeys[1], $data) &&
                array_key_exists($requiredKeys[2], $data) && array_key_exists($requiredKeys[3], $data)) {

                $package->rrn = $data['RRN'];
                $package->action = (int)$data['ACTION'];
                $package->masked_card = $data['MASKED_CARD'];
                $package->rc = (int)$data['RC'];

                $package->is_payed = ($data['ACTION'] === '0' && $data['RC'] === '00');

                $package->save();
            } else {
                Log::error('Missing required keys in JSON data');
                return response()->json(['error' => 'Missing required keys in JSON data'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error processing callback: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred during callback processing'], 500);
        }

        return response()->json(['success' => true]);
    }





}
