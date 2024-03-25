<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FaqController extends Controller
{
    public function index()
    {

        $faqs = Faq::all();
        return view('admin.faqs.index', compact('faqs'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.faqs.create');
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
            'type' => 'required',
        ]);



        Faq::create([
            'type' => $request->type,
            'az'=>[
                'title'=>$request->az_title,
                'content'=>$request->az_content,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'content'=>$request->en_content,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'content'=>$request->ru_content,
            ]
        ]);

        return redirect()->route('faqs.index')->with('message','Faq added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {

        return view('admin.faqs.edit', compact('faq'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Faq $faq)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_content'=>'required',
            'en_content'=>'required',
            'ru_content'=>'required',
            'type' => 'required'
        ]);



        $faq->update( [
            'type' => $request->type,
            'az'=>[
                'title'=>$request->az_title,
                'content'=>$request->az_content,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'content'=>$request->en_content,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'content'=>$request->ru_content,
            ]

        ]);

        return redirect()->back()->with('message','Faq updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {

        $faq->delete();

        return redirect()->route('faqs.index')->with('message', 'Faq deleted successfully');

    }
}
