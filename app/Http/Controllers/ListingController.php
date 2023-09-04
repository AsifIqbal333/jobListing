<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index(){
        $data = [
            'listings'  =>  Listing::latest()->filter(request(['tag','search']))->paginate(4)
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

        if($request->hasFile('logo')){
            //dd($request->file('logo'));    
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        
        //DB::enableQueryLog();
        Listing::create($formFields);
        // $query = DB::getQueryLog();
        // dd($query);
        return redirect('/')->with('message', 'Listing created Successfully!');
    }

}
