<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();

		// Check to see if there was a row returned from the database.
    	if ($bio != NULL) {
    		// Check to see if the identity column is not null
	    	if ($bio->identity != NULL) {
	    		if ($bio->identity == 'Coach'){
	    			return view('pages.home')->with('bio', $bio);
	    		} else {
	    			return view('pages.athletes-home')->with('bio', $bio);
	    		}
	    	}else { // If identity is null then go to bio page (This should never ever happen)
	    		return view('pages.bio');
	    	}
        } else {
        	return view('pages.bio');
        }
    }
}
