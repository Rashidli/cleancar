<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    public function index()
    {

        $visions = Vision::all();
        return view('admin.visions.index', compact('visions'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.visions.create');
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

        Vision::create([
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

        return redirect()->route('visions.index')->with('message','Vision added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Vision $vision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vision $vision)
    {

        return view('admin.visions.edit', compact('vision'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Vision $vision)
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
                $vision->image = $mainUrl;
            }
        }


        $vision->update( [
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

        return redirect()->back()->with('message','Vision updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vision $vision)
    {
//        dd($vision);
        $vision->delete();

        return redirect()->route('visions.index')->with('message', 'Vision deleted successfully');

    }
}
