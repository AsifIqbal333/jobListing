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

    //User Logout      
    public function logout(Request $request){
        auth()->logout();
        //invalidate user session 
        $request->session()->invalidate();
        //re-generate csrf token
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out!');

    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email'         =>  ['required'],
            'password'      =>  ['required'],
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}



