<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show All Listings
    public function index(){
        $data = [
            'listings'  =>  Listing::latest()->filter(request(['tag','search']))->paginate(4)
        ];
        return view('listings.index', $data);
    }
    
    //Show Listing
    public function show(Listing $listing){
        $data = ['listing' => $listing];
        return view('listings.show', $data);
    }

    //Show Create form
    public function create(){
        return view('listings.create');
    }

    //Store Listing
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
        $user = User::find(auth()->id()); 
        $user->listings()->create($formFields);
        // $query = DB::getQueryLog();
        // dd($query);
        return redirect('/')->with('message', 'Listing created Successfully!');
    }

    //Show Edit Form
    public function edit(Listing $listing){
        //dd($listing->description);
        $data = ['listing' => $listing];
        return view('listings.edit', $data);
    }
    
    //Update Listing
    public function update(Request $request,Listing $listing){
        
        $formFields = $request->validate([
            'title'         =>  'required',
            'company'       =>  'required',
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
        $listing->update($formFields);
        // $query = DB::getQueryLog();
        // dd($query);
        return redirect(route('listings.manage'))->with('message', 'Listing updated Successfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing){
        $listing->delete();
        return back()->with('message', 'Listing deleted Successfully!');

    }

    //Manage Listings
    public function manage(){
        $user = User::find(auth()->id());
        $data = ['listings' => $user->listings];
        return view('listings.manage', $data);
    }


}
