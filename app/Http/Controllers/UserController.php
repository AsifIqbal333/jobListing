<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show create form
    public function create(){
        return view('users.register');
    }

    //Store User
    public function store(Request $request){
        //dd($request);
        $formFields = $request->validate([
            'name'          =>  ['required','min:3'],
            'email'         =>  ['required',Rule::unique('users','email')],
            'password'      =>  ['required','confirmed','min:3'],
        ]);

        //Has the password
        $formFields['password'] = bcrypt($formFields['password']);
        
        $user = User::create($formFields);
        
        //User auto login 
        auth()->login($user);
    

        //DB::enableQueryLog();
        // $query = DB::getQueryLog();
        // dd($query);
        return redirect('/')->with('message', 'User created and logged in!');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    //invalidate user session and re-generate csrf token
}

