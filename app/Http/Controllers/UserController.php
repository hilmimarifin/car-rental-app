<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    function getUser() {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    function edit(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'driver_license' => 'required',
        ]);
        
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'driver_license' => $request->driver_license,
        ]);

        return redirect('/');
    }
}
