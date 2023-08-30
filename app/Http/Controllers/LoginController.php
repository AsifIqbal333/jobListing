<?php

namespace App\Http\Controllers;
use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function handleLogin(loginRequest $request){
      
      dd($request->all());
    
    }
}
