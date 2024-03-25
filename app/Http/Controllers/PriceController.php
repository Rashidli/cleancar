<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::all();
        return view('admin.prices.index', compact('prices'));
    }

    public function store(Request $req)
    {
        $price = new Price();

        $price->price = $req->price;

        $price->save();
        return redirect()->route('price');
    }

    public function edit($id)
    {
        $price = Price::where('id',$id)->firstOrFail();
        return view('admin.prices.edit', compact('price'));
    }

    public function update(Request $req, $id)
    {

        $price = Price::where('id',$id)->firstOrFail();

        $price->price = $req->price;
        $price->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $price = Price::findOrFail($id);

        $price->delete();

        return redirect()->route('price');
    }
}
