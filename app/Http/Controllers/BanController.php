<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BanController extends Controller
{
    public function index()
    {

        $bans = Ban::paginate(10);
        return view('admin.bans.index', compact('bans'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.bans.create');
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


        Ban::create([
            'image' => $mainUrl,
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

        return redirect()->route('bans.index')->with('message','Ban added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ban $ban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ban $ban)
    {

        return view('admin.bans.edit', compact('ban'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Ban $ban)
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
            $ban->image = $mainUrl;
        }


        $ban->update( [
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

        return redirect()->back()->with('message','Ban updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ban $ban)
    {
//        dd($ban);
        $ban->delete();

        return redirect()->route('bans.index')->with('message', 'Ban deleted successfully');

    }
}
