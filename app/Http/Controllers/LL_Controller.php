<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Language_line;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class LL_Controller extends Controller
{
    public function index(){
        $lls = Language_line::all();
        return view('admin.translations.list',compact('lls'));
    }

    public function show()
    {
        $lls = Language_line::all()->pluck('text', 'key');
        return response()->json($lls);
    }

    public function edit($id){
        $ll = Language_line::find($id);
        return view('admin.translations.edit',compact('ll'));
    }

    public function store(Request $request){
        $ll = new Language_line();

        $ll->key = $request->key;
        $ll->text = $request->text;

        $ll->save();
        return redirect()->back();
    }

    public function update($id,Request $request){

        $ll =  Language_line::find($id);

        $ll->key = $request->key;
        $ll->text = $request->text;

        $ll->save();
        return redirect()->back();
    }

    public function delete($id){

    }
}
