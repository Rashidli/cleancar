<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index()
    {

        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.blogs.create');
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

        Blog::create([
            'image' => $mainUrl,

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

        return redirect()->route('blogs.index')->with('message','Blog added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {

        return view('admin.blogs.edit', compact('blog'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Blog $blog)
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
                $blog->image = $mainUrl;
            }
        }


        $blog->update( [
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

        return redirect()->back()->with('message','Blog updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
//        dd($blog);
        $blog->delete();

        return redirect()->route('blogs.index')->with('message', 'Blog deleted successfully');

    }
}
