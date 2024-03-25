<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class HeroController extends Controller
{
    public function index()
    {

        $heroes = Hero::all();
        return view('admin.heroes.index', compact('heroes'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.heroes.create');
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
            'az_text'=>'required',
            'en_text'=>'required',
            'ru_text'=>'required',
        ]);

        if(request()->hasFile('image')){

            $image = request()->image;

            $imagename = $image->hashname().time().".".$image->extension();
            $url = "/uploads/".$imagename;

            if($image->isValid()){
                $image->move('uploads',$url);
            }
            $mainUrl = url('/') . '/' . $url;
        }

        Hero::create([
            'image' => $mainUrl,

            'az'=>[
                'title'=>$request->az_title,
                'content'=>$request->az_content,
                'text'=>$request->az_text
            ],
            'en'=>[
                'title'=>$request->en_title,
                'content'=>$request->en_content,
                'text'=>$request->en_text
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'content'=>$request->ru_content,
                'text'=>$request->ru_text
            ]
        ]);

        return redirect()->route('heroes.index')->with('message','Hero added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {

        return view('admin.heroes.edit', compact('hero'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Hero $hero)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_content'=>'required',
            'en_content'=>'required',
            'ru_content'=>'required',
            'az_text'=>'required',
            'en_text'=>'required',
            'ru_text'=>'required',
        ]);

        if($request->image){
            $image = request()->image;

            $imagename = $image->hashname().time().".".$image->extension();
            $url = "/uploads/".$imagename;
            $mainUrl = url('/') . '/' . $url;
            if($image->isValid()){
                $image->move('uploads',$url);
                $hero->image = $mainUrl;
            }
        }


        $hero->update( [
            'az'=>[
                'title'=>$request->az_title,
                'content'=>$request->az_content,
                'text'=>$request->az_text
            ],
            'en'=>[
                'title'=>$request->en_title,
                'content'=>$request->en_content,
                'text'=>$request->en_text
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'content'=>$request->ru_content,
                'text'=>$request->ru_text
            ]
        ]);

        return redirect()->back()->with('message','Hero updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
//        dd($hero);
        $hero->delete();

        return redirect()->route('heroes.index')->with('message', 'Hero deleted successfully');

    }
}
