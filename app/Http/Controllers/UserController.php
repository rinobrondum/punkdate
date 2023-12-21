<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Validation\Rule;

class UserController extends Controller
{
    //Show Register/Create Form
    public function create() {
       return view('users.register'); 
    }

    // Create/Store New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

         // Create User
         $user = User::create($formFields);

          // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }
}