<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
       
        //return DB::table('posts')->get();
        return Post::all();
        //Passing blogs variable to the compact method, so that
        //it would be accessible in the view
        //returning the home view
        //return view('home',compact('blogs'));
    }

    public function(){
        return view('welcome')
    }




}
