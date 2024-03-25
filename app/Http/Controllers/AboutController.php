<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {

        $abouts = About::all();
        return view('admin.abouts.index', compact('abouts'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.abouts.create');
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
            'image'=>'required',
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

        About::create([
            'image' => $mainUrl,

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

        return redirect()->route('abouts.index')->with('message','About added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {

        return view('admin.abouts.edit', compact('about'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, About $about)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_content'=>'required',
            'en_content'=>'required',
            'ru_content'=>'required',
        ]);


        if($request->image){
            $image = request()->image;

            $imagename = $image->hashname().time().".".$image->extension();
            $url = "/uploads/".$imagename;
            $mainUrl = url('/') . '/' . $url;
            if($image->isValid()){
                $image->move('uploads',$url);
                $about->image = $mainUrl;
            }
        }


        $about->update( [
            'az'=>[
                'title'=>$request->az_title,
                'content'=>$request->az_content
            ],
            'en'=>[
                'title'=>$request->en_title,
                'content'=>$request->en_content
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'content'=>$request->ru_content
            ]
        ]);

        return redirect()->back()->with('message','About updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
//        dd($about);
        $about->delete();

        return redirect()->route('abouts.index')->with('message', 'About deleted successfully');

    }
}
