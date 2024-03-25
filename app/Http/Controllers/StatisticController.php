<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {

        $statistics = Statistic::all();
        return view('admin.statistics.index', compact('statistics'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.statistics.create');
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



        Statistic::create([
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

        return redirect()->route('statistics.index')->with('message','Statistic added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Statistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statistic $statistic)
    {

        return view('admin.statistics.edit', compact('statistic'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Statistic $statistic)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_content'=>'required',
            'en_content'=>'required',
            'ru_content'=>'required',
        ]);



        $statistic->update( [
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

        return redirect()->back()->with('message','Statistic updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {

        $statistic->delete();

        return redirect()->route('statistics.index')->with('message', 'Statistic deleted successfully');

    }
}
