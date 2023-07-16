<?php
//Alert::toast('success', 'success');

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Verta;
use App\Models\code_model;
use App\Models\users_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\helper\helper;

class login_register_controller extends Controller
{
    public function index()
    {

        return view('login');
    }

    public function login_register(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|max:255|digits:11',
        ]);
        $v1 = new verta();
        $phone = $request->phone;
        $token = helper::hash("TASK_" . time() . $phone);
        users_model::where('phone', $phone)->where('active', false)->delete();
        code_model::where('phone', $phone)->delete();
        if (count($data=users_model::where('phone', $phone)->get())) {

            $code_user = rand(11111, 99999);
            $code = new code_model();
            $code->phone = $phone;
            $code->code = $code_user;
            $code->time = $v1->formatGregorian('Y-m-d H:i:s');
            $code->save();
            session(['phone_client'=>$phone,'code_user'=>$code_user]);
            return redirect()->route('code');
        } else {
            $code_user = rand(11111, 99999);
            $data = new users_model();
            $data->name = "";
            $data->phone = $phone;
            $data->password = "";
            $data->level = 1;
            $data->token = $token;
            $data->grade = "";
            $data->active = false;
            $data->remember_token = "";
            $data->image_access = "";
            $data->save();
            $code = new code_model();
            $code->phone = $phone;
            $code->code = $code_user;
            $code->time = $v1->formatGregorian('Y-m-d H:i:s');;
            $code->save();
            session(['token' => $token, 'code_user' => $code_user]);
            return redirect()->route('register');
        }


    }

    public function register()
    {
        if (session()->has('token') && count($data = users_model::find_user_with_token(session('token'))) > 0) {
            return view('register');
        } else {
            session()->forget('token');
        }
    }

    public function save_data_user(Request $request)
    {
        $data = users_model::find_user_with_token(session('token'));
        $code = code_model::where('phone',$data[0]['phone'])->get()[0];
        $v2 = verta($code['time']);
        if ($v2->diffMinutes() < 5) {
            if (session()->has('code_user') && session()->has('token') && count($data) > 0) {
                if ($request->code == $code['code']) {
                    if ($request->level == 1) {
                        users_model::where('token', session('token'))->update([
                            'name' => $request->name,
                            'password' => $request->password,
                            'level' => 1,
                            'active' => true,
                            'image_access' => "",
                        ]);
                        Alert::toast('success register.hello client', 'success');
                        Auth::loginUsingId($data[0]['id']);
                        return redirect()->route('index');

                    } elseif ($request->level == 0) {
                        users_model::where('token', session('token'))->update([
                            'name' => $request->name,
                            'password' => $request->password,
                            'level' => 0,
                            'grade' => "",
                            'active' => true,
                            'image_access' => "",
                        ]);
                        Alert::toast('success register. you/r grade is b.', 'success');
                        Auth::loginUsingId($data[0]['id']);
                        return redirect()->route('index');
                    } else {
                        Alert::toast('error', 'error');
                        return redirect()->route('index');
                    }

                } else {
                    Alert::toast('incorrect code', 'error');
                    return redirect()->route('register');
                }

            } else {
                Alert::toast('error', 'error');
                return redirect()->route('index');
            }
        } else {
            Alert::toast('time expire.', 'error');
            return redirect()->route('index');
        }
    }
}
