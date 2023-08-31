<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //show all listings
    public function index(){
        $data = [
            'listings'  =>  Listing::latest()->filter(request(['tag','search']))->get()
        ];
        return view('listings.index', $data);
    }
    
    //show single listing
    public function show(Listing $listing){
        $data = ['listing' => $listing];
        return view('listings.show', $data);
    }
}
