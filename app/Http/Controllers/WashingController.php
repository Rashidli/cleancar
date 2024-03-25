<?php

namespace App\Http\Controllers;

use App\Http\Resources\WashingPaymentResource;
use App\Http\Resources\WashingResource;
use App\Models\Ban;
use App\Models\Region;
use App\Models\Service;
use App\Models\User;
use App\Models\Washing;
use App\Models\WashingImage;
use App\Models\WashingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

//use Intervention\Image\Facades\Image;

class WashingController extends Controller
{


    public function index()
    {
        $washings = Washing::with('user')->get();

        $services = Service::all();
        return view('admin.washings.index', compact('washings', 'services'));
    }

// washings list for washing owners

    public function show()
    {
        $lat = 40.425400;
        $lon = 49.838960;

        $washings = Washing::select(
            'id',
            'washing_name',
            'lat',
            'lon',
            DB::raw(
                '6371 * 2 * ASIN(SQRT(
                POWER(SIN(('.$lat.' - lat) * PI() / 180 / 2), 2) +
                COS('.$lat.' * PI() / 180) * COS(lat * PI() / 180) *
                POWER(SIN(('.$lon.' - lon) * PI() / 180 / 2), 2)
            )) AS distance'
            )
        )
            ->orderBy('distance')
            ->get();
       return response()->json($washings);
    }




    public function edit($id)
    {
        $services = Service::all();
        $washing = Washing::where('id',$id)->with('services')->firstOrFail();
        $bans = Ban::all();
        $regions = Region::where('type', \App\Enums\Region::REGION)->get();
        $villages = Region::where('type', \App\Enums\Region::VILLAGE)->get();
        $cities = Region::where([['type', \App\Enums\Region::CITY],['parent_id', null]])->get();
        return view('admin.washings.edit', compact('washing','services','bans','cities','regions','villages'));
    }

    public function update_admin_washing(Request $req,$id)
    {

        $washing = Washing::where('id',$id)->with('user','images')->firstOrFail();

        $washing->washing_name = $req->washing_name;
        $washing->address = $req->address;
        $washing->start_date = $req->start_date;
        $washing->end_date = $req->end_date;
        $washing->status = $req->status;
        $washing->phone = $req->phone;
        $washing->interval = $req->interval;
        $washing->city_id = $req->city_id;
        $washing->region_id = $req->region_id;
        $washing->village_id = $req->village_id;

        $washing->description = $req->description;

        if (request()->hasFile('image')) {
            $images = request()->file('image');

            foreach ($images as $image) {
                $imageName = Str::uuid() . "." . $image->extension();
                $url = "uploads/" . $imageName;

                if($image->isValid()){
                    $image->move('uploads',$url);
                }

                $mainUrl = url('/') . '/' . $url;

                $washingImage = new WashingImage(['image' => $mainUrl]);
                $washing->images()->save($washingImage);
            }
        }

        WashingService::where('washing_id',$washing->id)->delete();

        $washingServices = $req->washing_services;

        if ($washingServices === null) {
            $washing->services()->detach();
        } else {
            foreach ($washingServices as $washingService) {
                $serviceId = $washingService['service_id'];
                $banId = $washingService['ban_id'];
                $price = $washingService['price'];

                if (!$washing->services->contains($serviceId)) {
                    $washing->services()->attach($serviceId, [
                        'ban_id' => $banId,
                        'price' => $price,
                    ]);
                }
            }
        }




        $washing->save();

//        $data = $req->service_ids;
//
//        WashingService::where('washing_id',$washing->id)->delete();
//
//        $services_list = [];
//        foreach ($data as $service_id){
//            $services_list[] = ['washing_id' => $washing->id,'service_id' => $service_id];
//        }
//
//        WashingService::insert($services_list);





        return redirect()->back();

    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $userId = auth()->id();
            $washing = new Washing();
            $washing->user_id = $userId;
            $washing->washing_name = $request->washing_name;
            $washing->address = $request->address;
            $washing->start_date = $request->start_date;
            $washing->end_date = $request->end_date;
            $washing->phone = $request->phone;
            $washing->description = $request->description;
            $washing->lat = $request->lat;
            $washing->lon = $request->lon;
            $washing->save();

            $files = $request->images;

            if ($files) {
                foreach ($files as $item) {
                    // Access the 'img' property to get the MultipartFile object
                    $file = $item['img'];

                    if ($file->isValid()) {
                        // Generate a unique image name using UUID
                        $imageName = Str::uuid() . "." . $file->getClientOriginalExtension();
                        // Move the uploaded file to the desired location
                        $file->move('uploads', $imageName);
                        // Construct the URL for the saved image
                        $mainUrl = url('/') . '/uploads/' . $imageName;

                        // Insert the image URL into the database
                        DB::table('washing_images')->insert([
                            'image' => $mainUrl,
                            'washing_id' => $washing->id,
                        ]);
                    }
                }
            }




            $washingData = $request->washing_services;
            foreach ($washingData as $data) {
                $banId = $data['ban_id'];
                foreach ($data['services'] as $service) {
                    if (isset($service['service_id'], $service['price'])) {
                        $serviceId = $service['service_id'];
                        $price = $service['price'];
                        $washing->services()->attach($serviceId, [
                            'ban_id' => $banId,
                            'price' => $price,
                        ]);
                    } else {
                        Log::error("Invalid washing service data: " . json_encode($service));
                    }
                }
            }
            $washing->groupedServices = collect($washing->services->groupBy(function ($service) {
                return $service->pivot->ban_id;
            }));

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => ['washing' => new WashingResource($washing)],
                'message' => 'Washing created successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing washing: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create washing.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $washing = Washing::with('services', 'images')->findOrFail($request->id);

            $washing->washing_name = $request->washing_name;
            $washing->address = $request->address;
            $washing->start_date = $request->start_date;
            $washing->end_date = $request->end_date;
            $washing->phone = $request->phone;
            $washing->description = $request->description;
            $washing->lat = $request->lat;
            $washing->lon = $request->lon;
            $washing->status = $request->status;

            DB::table('washing_images')->where('washing_id', $washing->id)->delete();

            $files = $request->images;

            if ($files) {
                foreach ($files as $item) {
                    // Access the 'img' property to get the MultipartFile object
                    $file = $item['img'];

                    if ($file->isValid()) {
                        // Generate a unique image name using UUID
                        $imageName = Str::uuid() . "." . $file->getClientOriginalExtension();
                        // Move the uploaded file to the desired location
                        $file->move('uploads', $imageName);
                        // Construct the URL for the saved image
                        $mainUrl = url('/') . '/uploads/' . $imageName;

                        // Insert the image URL into the database
                        DB::table('washing_images')->insert([
                            'image' => $mainUrl,
                            'washing_id' => $washing->id,
                        ]);
                    }
                }
            }

            DB::table('washing_services')->where('washing_id', $washing->id)->delete();

            $washingData = $request->washing_services;

            foreach ($washingData as $data) {
                $banId = $data['ban_id'];
                foreach ($data['services'] as $service) {
                    if (isset($service['service_id'], $service['price'])) {
                        $serviceId = $service['service_id'];
                        $price = $service['price'];
                        $washing->services()->attach($serviceId, [
                            'ban_id' => $banId,
                            'price' => $price,
                        ]);
                    } else {
                        Log::error("Invalid washing service data: " . json_encode($service));
                    }
                }
            }


            $washing->save();

            $washing->groupedServices = collect($washing->services->groupBy(function ($service) {
                return $service->pivot->ban_id;
            }));

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => ['washing' => new WashingResource($washing)],
                'message' => 'Washing updated successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating washing: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update washing.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


//            $washing->services()->detach();
//
//            $washingData = $request->washing_services;
//
//            foreach ($washingData as $data) {
//                $banId = $data['ban_id'];
//                foreach ($data['services'] as $service) {
//                    if (isset($service['service_id'], $service['price'])) {
//                        $serviceId = $service['service_id'];
//                        $price = $service['price'];
//                        $washing->services()->attach($serviceId, [
//                            'ban_id' => $banId,
//                            'price' => $price,
//                        ]);
//                    } else {
//                        Log::error("Invalid washing service data: " . json_encode($service));
//                    }
//                }
//            }


//            $washingData = json_decode($request->washing_services, true);
//
//            if ($washingData !== null) {
//                foreach ($washingData as $data) {
//                    $banId = $data['ban_id'];
//                    foreach ($data['services'] as $service) {
//                        if (isset($service['service_id'], $service['price'])) {
//                            $serviceId = $service['service_id'];
//                            $price = $service['price'];
//                            $washing->services()->attach($serviceId, [
//                                'ban_id' => $banId,
//                                'price' => $price,
//                            ]);
//                        } else {
//                            Log::error("Invalid washing service data: " . json_encode($service));
//                        }
//                    }
//                }
//            } else {
//                Log::error("Failed to decode JSON string.");
//            }


    public function new_update(Request $req)
    {

        $washing = Washing::where('id', $req->id)->firstOrFail();

        $washing->payment_status = $req->payment_status;
        $washing->payment_time = date("Y-m-d");

        $washing->save();

        $response['message'] = 'successfully updated';
        $response['status'] = 200;

        return response()->json($response);


    }



    public function delete($id)
    {
        $washing = Washing::findOrFail($id);

        if( File::exists($washing->image)){
            File::delete($washing->image);
        }

        $washing->delete();

        $response['message'] = 'successfully deleted';
        $response['status'] = 200;

        return response()->json($response);
    }

    public function destroy($id)
    {

        $image = WashingImage::find($id);

        if ($image) {

            $image->delete();

            return response()->json(['message' => 'Image deleted successfully']);
        } else {
            return response()->json(['message' => 'Image not found'], 404);
        }
    }

    public function store_payment(Request $request)
    {
        DB::beginTransaction();
        try {
            $washingId = $request->washing_id;
            $packageId = $request->package_id;

            $washing = Washing::findOrFail($washingId);
            $washing->packages()->attach($packageId);


            DB::commit();

            return response()->json([
                'success' => true,
                'data' => ['url' => 'https://cleancar.az/payment_page?washing_id=' . $washingId . '&package_id=' . $packageId],
                'message' => 'Successfully added',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e);
        }
    }

    public function payment_history()
    {
        try {

            $user = User::with('washings.packages.translations','washings')->find(auth()->user()->id);

            $washingPackages = [];

            foreach ($user->washings as $washing) {
                foreach ($washing->packages as $package) {
                    if ($package->pivot->is_payed) {
                        $translatedTitle = $package->translations->firstWhere('locale', app()->getLocale())->title;
                        $washingPackages[] = [
                            'washing_name' => $washing->washing_name,
                            'package_name' => $translatedTitle,
                            'price' => $package->price,
                            'date' => $package->updated_at->format('Y-m-d')
                        ];
                    }
                }
            }

            return response()->json([
                'success' => true,
                'data' => ['packages' => $washingPackages],
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

}
