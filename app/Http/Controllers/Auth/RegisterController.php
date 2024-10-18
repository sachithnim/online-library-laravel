<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request){

        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|lowercase|email|max:255',
            'password' => 'required|min:8|confirmed'
        ]); 

        $user = User::create($credentials);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }
}
