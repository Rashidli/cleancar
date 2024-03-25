<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class ServiceController extends Controller
{
    public function index()
    {

        $services = Service::all();
        return view('admin.services.index', compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.services.create');
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
            'image'=>'required',
        ]);

        $image  = $request->image;
        if(request()->hasFile('image')){
            $imageName = $image->hashName() . time() . "." . $image->extension();
            $url = "uploads/" . $imageName;

            if ($image->isValid()) {
                $resizeImage = Image::make($image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resizeImage->save($url);
            }

            $mainUrl = url('/') . '/' . $url;
        }

        $image_white  = $request->image_white;
        if(request()->hasFile('image_white')){
            $image_whiteName = $image_white->hashName() . time() . "." . $image_white->extension();
            $url = "uploads/" . $image_whiteName;

            if ($image_white->isValid()) {
                $resizeImage = Image::make($image_white)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resizeImage->save($url);
            }

            $mainWhiteUrl = url('/') . '/' . $url;
        }


        Service::create([
            'image' => $mainUrl,
            'image_white' => $mainWhiteUrl,

            'az' => [
                'title' => $request->az_title,
                'content' => $request->az_content,
                'slug' => Str::slug($request->az_title),
            ],
            'en' => [
                'title' => $request->en_title,
                'content' => $request->en_content,
                'slug' => Str::slug($request->en_title),
            ],
            'ru' => [
                'title' => $request->ru_title,
                'content' => $request->ru_content,
                'slug' => Str::slug($request->ru_title),
            ]
        ]);

        return redirect()->route('services.index')->with('message','Service added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {

        return view('admin.services.edit', compact('service'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Service $service)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
        ]);

        $image  = $request->image;
        if(request()->hasFile('image')){
            $imageName = $image->hashName() . time() . "." . $image->extension();
            $url = "uploads/" . $imageName;

            if ($image->isValid()) {
                $resizeImage = Image::make($image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resizeImage->save($url);
            }

            $mainUrl = url('/') . '/' . $url;
            $service->image = $mainUrl;
        }

        $image_white  = $request->image_white;
        if(request()->hasFile('image_white')){
            $image_whiteName = $image_white->hashName() . time() . "." . $image_white->extension();
            $url = "uploads/" . $image_whiteName;

            if ($image_white->isValid()) {
                $resizeImage = Image::make($image_white)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resizeImage->save($url);
            }

            $mainWhiteUrl = url('/') . '/' . $url;
            $service->image_white = $mainWhiteUrl;
        }

        $service->update( [

            'az' => [
                'title' => $request->az_title,
                'content' => $request->az_content,
            ],
            'en' => [
                'title' => $request->en_title,
                'content' => $request->en_content,
            ],
            'ru' => [
                'title' => $request->ru_title,
                'content' => $request->ru_content,
            ]

        ]);


        return redirect()->back()->with('message','Service updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
//        dd($service);
        $service->delete();

        return redirect()->route('services.index')->with('message', 'Service deleted successfully');

    }

}
