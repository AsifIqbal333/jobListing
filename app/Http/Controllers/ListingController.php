<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //show all listings
    public function index(){
        //dd(request('tag'));
        $data = [
            'listings'  =>  Listing::latest()->get()
        ];
        return view('listings.index', $data);
    }
    
    //show single listing
    public function show(Listing $listing){
        $data = ['listing' => $listing];
        return view('listings.show', $data);
    }
}
