<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ListingController extends Controller

{
    // Show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(6)

        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing

        ]);
    }

    //Show Create Form
    public function create() {
        return view('listings.create');
    }
 // Store Create Data
 public function store(Request $request)
 {
     // dd($request->all());
     // dd($request->file('image'));

     $formFields = $request->validate([
         // pass in the name of the table & the field that needs to be unique
         'name' => ['required', Rule::unique('listings', 'name')],
         'age' => 'required',
         'location' => 'required',
         'email' =>  ['required', 'email', Rule::unique('listings', 'email')], //FIXME must be formatted as an email
         'tags' => 'required',
         'description' => 'required'
     ]);

    if($request->hasFile('logo')) {
        $formFields['logo'] = $request->file('logo')->store ('logos', 'public');
    }

    Listing::create($formFields);

return redirect('/')->with('message', 'Listing created successfully!');
}


//Show Edit Form
public function edit(Listing $listing) {
    return view('listings.edit', ['listing' => $listing]);
}

 // Edit Update Listing Data
 public function update(Request $request, Listing $listing)
 {
     // Make sure logged in user is owner
     if ($listing->user_id != auth()->id()) {
         abort(403, 'Unauthorized Action');
     }

     $formFields = $request->validate([
         'name' => 'required',
         'age' => 'required',
         'location' => 'required',
         'email' =>  ['required', 'email'], // must be formatted as an email
         'tags' => 'required',
         'description' => 'required'
     ]);

    if($request->hasFile('logo')) {
        $formFields['logo'] = $request->file('logo')->store ('logos', 'public');
    }

    $listing->update($formFields);

    return back()->with('message', 'Listing updated successfully!');
}

//Delete Listing
public function destroy(Listing $listing) {
    $listing->delete();
    return redirect('/')->with('message', 'Listing Deleted Succesfully');

    }
}