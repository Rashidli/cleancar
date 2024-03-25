<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function index()
    {

        $suggestions = Suggestion::all();
        return view('admin.suggestions.index', compact('suggestions'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.suggestions.create');
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
            'az_service'=>'required',
            'en_service'=>'required',
            'ru_service'=>'required',
            'az_ban'=>'required',
            'en_ban'=>'required',
            'ru_ban'=>'required',
            'price' => 'required',
            'branch' => 'required'
        ]);


        Suggestion::create([
            'price' => $request->price,
            'branch' => $request->branch,
            'az'=>[
                'title'=>$request->az_title,
                'service'=>$request->az_service,
                'ban'=>$request->az_ban,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'service'=>$request->en_service,
                'ban'=>$request->en_ban,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'service'=>$request->ru_service,
                'ban'=>$request->ru_ban,
            ]
        ]);

        return redirect()->route('suggestions.index')->with('message','Suggestion added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Suggestion $suggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suggestion $suggestion)
    {

        return view('admin.suggestions.edit', compact('suggestion'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Suggestion $suggestion)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_service'=>'required',
            'en_service'=>'required',
            'ru_service'=>'required',
            'az_ban'=>'required',
            'en_ban'=>'required',
            'ru_ban'=>'required',
            'price' => 'required',
            'branch' => 'required'
        ]);



        $suggestion->update( [
            'price' => $request->price,
            'branch' => $request->branch,
            'az'=>[
                'title'=>$request->az_title,
                'service'=>$request->az_service,
                'ban'=>$request->az_ban,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'service'=>$request->en_service,
                'ban'=>$request->en_ban,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'service'=>$request->ru_service,
                'ban'=>$request->ru_ban,
            ]

        ]);

        return redirect()->back()->with('message','Suggestion updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suggestion $suggestion)
    {

        $suggestion->delete();

        return redirect()->route('suggestions.index')->with('message', 'Suggestion deleted successfully');

    }
}
