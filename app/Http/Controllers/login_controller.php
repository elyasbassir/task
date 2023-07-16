<?php

namespace App\Http\Controllers;

use App\Models\code_model;
use App\Models\users_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class login_controller extends Controller
{

    public function code(){

        return view('code');
    }
    public function login(Request $request)
    {
        $data = users_model::where('phone',session()->get('phone_client'))->get();
        $code = code_model::where('phone', session()->get('phone_client'))->get()[0];
        $v2 = verta($code['time']);
        if ($v2->diffMinutes() < 5) {
            if (session()->has('code_user') && count($data) > 0) {
                if ($request->code == $code['code']) {
                    Auth::loginUsingId($data[0]['id']);
                    Alert::toast('you login', 'success');
                    return redirect()->route('index');
                }else{
                    Alert::toast('incorrect code', 'error');
                    return redirect()->back();
                }
            }


        }
    }
}
