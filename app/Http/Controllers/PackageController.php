<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {

        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_duration'=>'required',
            'en_duration'=>'required',
            'ru_duration'=>'required',
            'price' => 'required',
        ]);


        Package::create([
            'price' => $request->price,
            'az'=>[
                'title'=>$request->az_title,
                'duration'=>$request->az_duration,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'duration'=>$request->en_duration,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'duration'=>$request->ru_duration,
            ]
        ]);

        return redirect()->route('packages.index')->with('message','Package added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {

        return view('admin.packages.edit', compact('package'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Package $package)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_duration'=>'required',
            'en_duration'=>'required',
            'ru_duration'=>'required',
            'price' => 'required'
        ]);

        $package->update( [
            'price' => $request->price,
            'az'=>[
                'title'=>$request->az_title,
                'duration'=>$request->az_duration,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'duration'=>$request->en_duration,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'duration'=>$request->ru_duration,
            ]

        ]);

        return redirect()->back()->with('message','Package updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {

        $package->delete();

        return redirect()->route('packages.index')->with('message', 'Package deleted successfully');

    }
}
