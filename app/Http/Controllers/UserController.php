<?php

namespace App\Http\Controllers;

use App\Models\FcmToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->where('type', 1)->get();
        return view('admin.profile', compact('users'));
    }

    public function show()
    {

        $users = User::with('cars')->where('type', 0)->get();
        return view('admin.users.index', compact('users'));

    }

    public function updateFcm(){
        $bearer = str_replace('Bearer ','',request()->header('Authorization'));
        $fcm_token = FcmToken::where('bearer',$bearer)->first();

        if(!$fcm_token){
            $fcm_token = new FcmToken();
            $fcm_token->bearer = $bearer;
        }

        $fcm_token->fcm_token = request()->fcm_token;
        $fcm_token->user_id = auth()->user()->id;
        $fcm_token->save();
        return response()->json(['success' => 'ok']);
    }

    public function update(Request $request, $id)
    {
        $user = User::where([['id', $id], ['type', 1]])->firstOrFail();


        if (User::where('email', $user->email)->exists()) {
            $checkuseremail = User::where('email', $user->email)->first();
            if ($checkuseremail->id == $user->id) {
                $user->email = request('email');
            }
        } else {
            $user->email = request('email');
        }


        if (request()->filled('password')) {

            $user->password = Hash::make(request('password'));

        }

        $user->name = request('name');
        $user->save();


        return redirect()->back();
    }


}
