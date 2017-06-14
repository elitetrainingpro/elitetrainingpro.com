<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Bio;
use Image;
use Purifier;

class BioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bio');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.bio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
        	'city' => 'required|max:191',
        	'state' => 'required',
        	'bio' => 'required|max:191',
        	'identity' => 'required',
        	'image' => 'sometimes|image'
        ));
        
        // store in the database
        $bio = new Bio;
        $bio->user_id = Auth::user()->id;
        $bio->email = Auth::user()->email;
        $bio->city = $request->city;
        $bio->state = $request->state;
        $bio->bio = Purifier::clean($request->bio);
        $bio->identity = $request->identity;

        if ($request->hasFile('image')) {
        	$image = $request->file('image');
        	$filename = time() . '.' . $image->getClientOriginalExtension();
        	$location = public_path('assets/avatars/' . $filename);
        	Image::make($image)->resize(800, 400)->save($location);
        	
        	$bio->image = $filename;
        }
        else {
        	return view('pages.bio');
        }
        
        $bio->save();
        
        // redirect to another page
        if ($bio->identity != NULL) {
	    	if ($bio->identity == 'Coach'){
	    		return view('pages.home');
	    	} else {
	    		return view('pages.athletes-home');
	    	}
	    }else { // If identity is null then go to bio page (This should never ever happen)
	    	return view('pages.bio');
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}