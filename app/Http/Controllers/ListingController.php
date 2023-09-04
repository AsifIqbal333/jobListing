<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    //show create form
    public function create(){
        return view('listings.create');
    }

    //show create form
    public function store(Request $request){
        $formFields = $request->validate([
            'title'         =>  'required',
            'company'       =>  ['required',Rule::unique('listings','company')],
            'location'      =>  'required',
            'website'       =>  'required',
            'email'         =>  ['required','email'],
            'tags'          =>  'required',
            'description'   =>  'required' 
        ]);

        Listing::create($formFields);
        return redirect('/')->with('message', 'Listing created Successfully!');
    }

}
