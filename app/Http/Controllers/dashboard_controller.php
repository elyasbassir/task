<?php

namespace App\Http\Controllers;

use App\helper\helper;
use App\Models\users_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class dashboard_controller extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function image_upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $user = Auth::user();
        $imageName = helper::hash(time()) . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        File::delete(public_path('images/'.$user->image_access));
        users_model::where('id',$user->id)->update(['image_access'=>$imageName,'grade'=>'b']);
        Alert::toast('uploaded', 'success');
        return redirect()->route('dashboard');
    }
}
