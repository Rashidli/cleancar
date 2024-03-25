<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $offers = Offer::all();
        return view('admin.offers.index', compact('offers'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.offers.create');
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
            'az_content'=>'required',
            'en_content'=>'required',
            'ru_content'=>'required',
            'az_percent'=>'required',
            'en_percent'=>'required',
            'ru_percent'=>'required',
        ]);

        $image = $request->file('image');
        if($image){
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


        Offer::create([
            'image' => $mainUrl,
            'type' => $request->type,
            'az'=>[
                'title'=>$request->az_title,
                'content'=>$request->az_content,
                'percent'=>$request->az_percent
            ],
            'en'=>[
                'title'=>$request->en_title,
                'content'=>$request->en_content,
                'percent'=>$request->en_percent
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'content'=>$request->ru_content,
                'percent'=>$request->ru_percent
            ]
        ]);

        return redirect()->route('offers.index')->with('message','Offer added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {

        return view('admin.offers.edit', compact('offer'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Offer $offer)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_content'=>'required',
            'en_content'=>'required',
            'ru_content'=>'required',
            'az_percent'=>'required',
            'en_percent'=>'required',
            'ru_percent'=>'required',
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
            $offer->image = $mainUrl;
        }


        $offer->update( [
            'type' => $request->type,
            'is_active'=> $request->is_active,

            'az'=>[
                'title'=>$request->az_title,
                'content'=>$request->az_content,
                'percent'=>$request->az_percent
            ],
            'en'=>[
                'title'=>$request->en_title,
                'content'=>$request->en_content,
                'percent'=>$request->en_percent
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'content'=>$request->ru_content,
                'percent'=>$request->ru_percent
            ]

        ]);

        return redirect()->back()->with('message','Offer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Offer $offer)
    {
//        dd($offer);
        $offer->delete();

        return redirect()->route('offers.index')->with('message', 'Offer deleted successfully');

    }
}
