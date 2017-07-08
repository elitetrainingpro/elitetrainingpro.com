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
    	if(!Auth::check()){
    		return redirect('login');
    	}
    	
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
    	
    	if ($bio == null) {
    		return view('pages.bio');
    	}
    	if ($bio->identity == 'Coach') {
    		// get list of athletes that the coach has.
    		$athleteToCoaches = DB::table('athlete_to_coaches')->where('coach_id', $bio->user_id)->get();
    		
    		//declare an array to sotre athlete's bio information
    		$athletes = array();
    		
    		// Get all the athlete's bio information and Athlete's Name
    		foreach ($athleteToCoaches as $athleteToCoach){
    			//getting Athlete Bio
    			$athleteBio = DB::table('bios')->where('user_id', $athleteToCoach->athlete_id)->get();
    			// Getting Athlete's Name
    			$athleteName = DB::table('users')->where('id', $athleteToCoach->athlete_id)->get();
    			// Merging them into one
    			$athlete = $athleteBio->merge($athleteName);
    			array_push($athletes, $athlete);
    		}
    		// data
    		$data = array(
    				'bio' => $bio,
    				'athletes' => $athletes
    		);
    		
    		return redirect('home')->with($data);
    	} else if ($bio->identity == 'Athlete') {
    		// get the coach for the athlete.
    		$coachToAthletes = DB::table('athlete_to_coaches')->where('athlete_id', $bio->user_id)->get();
    		
    		$coaches = array();
    		
    		foreach($coachToAthletes as $coachToAthlete){
    			//getting Athlete Bio
    			$coachBio = DB::table('bios')->where('user_id', $coachToAthlete->coach_id)->get();
    			// Getting Athlete's Name
    			$coachName = DB::table('users')->where('id', $coachToAthlete->coach_id)->get();
    			// Merging them into one
    			$coach = $coachBio->merge($coachName);
    			array_push($coaches, $coach);
    		}
    		
    		// data
    		$data = array(
    				'bio' => $bio,
    				'coaches' => $coaches
    		);
    		return redirect('athletes-home')->with($data);
    	} else {
    		return view('pages.bio');
    	}
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'image' => 'sometimes|image|max:2000'
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
            $location = public_path('assets/avatars/uploads/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            
            $bio->image = $filename;
        }
        else {
            die('Else before array');
            return view('pages.bio');
        }
        
        $bio->save();
        
        if ($bio->identity != NULL) {
            if ($bio->identity == 'Coach'){

                $athletes = (object)array();
                $data = array(
                    'bio' => $bio,
                    'athletes' => $athletes
                );
                return redirect('home')->with($data);
            } else {
                $coaches = (object)array();
                $data = array(
                    'bio' => $bio,
                    'coaches' => $coaches
                );
                return redirect('athletes-home')->with($data);
            }
        }else { // If identity is null then go to bio page (This should never ever happen)
            die('After If statement');
            return view('pages.bio');
        }
        //return redirect()->route('bios.show', $bio->id);
        // redirect to another page
        
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