<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function create() { 
        return view('users.register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed']
        ]);
        
        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        $user->sendEmailVerificationNotification();
        // $user['hash'] = Str::uuid();
        // Mail::to($user->email)->send(new VerifyEmail($user));
        if( $request->is('api/*')){
            return response()->json($user);
        } else {
            auth()->login($user);
            return redirect('/posts');
        }
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if( $request->is('api/*')){
           return response()->json(['message' => 'Logged out successfully'], 200);
        } else {
           return redirect('/')->with('message', 'Logged out');
        }
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        
        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/posts')->with('message', 'You are logged in');
        }
        
        return back();
    }
}
