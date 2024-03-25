<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

   /* City starts */

    public function show_city(){

        $cities = Region::with('regions')->where('parent_id',null)->where('type',\App\Enums\Region::CITY)->get();
        return view('admin.cities.index', compact('cities'));

    }

    public function store_city(Request $request)
    {
        Region::create([
            'type' => \App\Enums\Region::CITY,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]
        ]);
        return redirect()->back();

    }

    public function edit_city($id)
    {
        $city = Region::where('id',$id)->firstOrFail();
        return view('admin.cities.edit', compact('city'));
    }

    public function update_city($id, Request $request)
    {
        $city = Region::where('id',$id)->firstOrFail();
        $city->update([
            'type' => \App\Enums\Region::CITY,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]
        ]);
        return redirect()->back();
    }

    public function delete_city($id)
    {
        $city = Region::findOrFail($id);

        $city->delete();

        return redirect()->route('city');
    }

    /* City ends */

    /* Regions starts */


    public function show_region($id){
        $city = Region::where('id',$id)->firstOrFail();
        $regions = Region::with('regions')->where('parent_id',$id)->where('type',\App\Enums\Region::REGION)->get();
        return view('admin.regions.index', compact('regions','city'));

    }

    public function store_region(Request $request)
    {
        Region::create([
            'parent_id' => $request->parent_id,
            'type' => \App\Enums\Region::REGION,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]
        ]);
        return redirect()->back();

    }

    public function edit_region($id)
    {
        $region = Region::where('id',$id)->firstOrFail();
        return view('admin.regions.edit', compact('region'));
    }

    public function update_region($id, Request $request)
    {
        $region = Region::where('id',$id)->firstOrFail();
        $region->update([
            'type' => \App\Enums\Region::REGION,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]
        ]);

        return redirect()->back();
    }

    public function delete_region($id)
    {
        $region = Region::findOrFail($id);

        $region->delete();

        return redirect()->back();
    }

    /* Region ends */







    /* Villages starts */


    public function show_village($id){

        $region = Region::where('id',$id)->firstOrFail();
        $villages = Region::with('villages')->where('parent_id',$id)->where('type',\App\Enums\Region::VILLAGE)->get();
        return view('admin.villages.index', compact('villages','region'));

    }

    public function store_village(Request $request)
    {

        Region::create([
            'parent_id' => $request->parent_id,
            'type' => \App\Enums\Region::VILLAGE,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]
        ]);
        return redirect()->back();

    }

    public function edit_village($id)
    {
        $village = Region::where('id',$id)->firstOrFail();
        return view('admin.villages.edit', compact('village'));
    }

    public function update_village($id, Request $request)
    {
        $village = Region::where('id',$id)->firstOrFail();
        $village->update([
//            'parent_id' => $request->parent_id,
            'type' => \App\Enums\Region::VILLAGE,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]
        ]);

        return redirect()->back();
    }

    public function delete_village($id)
    {
        $village = Region::findOrFail($id);

        $village->delete();

        return redirect()->back();
    }


    /* Villages ends */

}
