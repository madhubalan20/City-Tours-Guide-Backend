<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;


class LogoutController extends Controller
{
    public function logoutpage(Request $request)
    {
        $user = Auth::user();

        Auth::guard()->logout();
        Session::flush();

        return redirect('/');
    }

    
    public function key()
    {
        Artisan::call("key:generate");
        return redirect()->route('settings.appcontrol');

    }
}
