<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class exit_account extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect()->route('index');
    }
}
