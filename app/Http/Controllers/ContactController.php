<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ContactController extends Controller
{
    public function index()
    {

        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.contacts.create');
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
            'text' => 'required',
            'link' => 'required',
            'image'=>'required',
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


        Contact::create([
            'image' => $mainUrl,
            'text' => $request->text,
            'link' => $request->link,
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

        return redirect()->route('contacts.index')->with('message','Contact added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {

        return view('admin.contacts.edit', compact('contact'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Contact $contact)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'text' => 'required',
            'link' => 'required',

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
            $contact->image = $mainUrl;
        }


        $contact->update( [
            'text' => $request->text,
            'link' => $request->link,

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

        return redirect()->back()->with('message','Contact updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
//        dd($contact);
        $contact->delete();

        return redirect()->route('contacts.index')->with('message', 'Contact deleted successfully');

    }
}
