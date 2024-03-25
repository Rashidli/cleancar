<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class LanguageController extends Controller
{

    public function index()
    {

        $languages = Language::all();
        return view('admin.languages.index', compact('languages'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'language' => 'required',
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


        Language::create([
            'image' => $mainUrl,
            'language' => $request->language,

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

        return redirect()->route('languages.index')->with('message','Language added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {

        return view('admin.languages.edit', compact('language'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Language $language)
    {

        $request->validate([
            'language' => 'required',
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
            $language->image = $mainUrl;
        }


        $language->update( [

            'language' => $request->language,
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

        return redirect()->back()->with('message','Language updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
//        dd($language);
        $language->delete();

        return redirect()->route('languages.index')->with('message', 'Language deleted successfully');

    }
}
