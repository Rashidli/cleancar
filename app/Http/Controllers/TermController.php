<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $terms = Term::all();
        return view('admin.terms.index', compact('terms'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.terms.create');
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
        ]);


        Term::create([
            'type' => $request->type,
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

        return redirect()->route('terms.index')->with('message','Term added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {

        return view('admin.terms.edit', compact('term'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Term $term)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_content'=>'required',
            'en_content'=>'required',
            'ru_content'=>'required',
        ]);


        $term->update( [
            'type' => $request->type,
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

        return redirect()->back()->with('message','Term updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
//        dd($term);
        $term->delete();

        return redirect()->route('terms.index')->with('message', 'Term deleted successfully');

    }
}
