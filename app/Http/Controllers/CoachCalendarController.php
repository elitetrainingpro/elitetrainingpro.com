<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\TrainingNote;
use Auth;

class CoachCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if(!Auth::check()){
    		print_r("asdfsaf");
    		return redirect('login');
    	}
    	
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();

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
    	$bio= DB::table('bios')->where('email', Auth::user()->email)->first();
    	$athlete = DB::table('users')->where('email', $request->email)->first();
    	
    	if ($request->has('submit_training_notes')) {
    		// validate the data
    		$this->validate($request, array(
    				'name' => 'required|max:191',
    				'notes' => 'required',
    				'date' => 'required'
    		));
    		//store in the Training Notes table
    		$note = new TrainingNote;
    		$note->user_id = $athlete->id;
    		$note->name= $request->name;
    		$note->notes = $request->notes;
    		$note->date = $request->date;
    		$note->save();
    	}
    	
    	// validate the data
    	$this->validate($request, array(
    			'email' => 'required',
    	));
    	
    	$date = date('Y-m');
    	$year = date('Y');
    	$month = date('m');
    	
    	$strengths = DB::table('strength_workouts')->where('user_id', $athlete->id)->get();
    	$endurances = DB::table('endurance_workouts')->where('user_id', $athlete->id)->get();
    	$balances = DB::table('balance_workouts')->where('user_id', $athlete->id)->get();
    	$flexibilities = DB::table('flexibility_workouts')->where('user_id', $athlete->id)->get();
    	$notes = DB::table('training_notes')->where('user_id', $athlete->id)->get();
    	
    	$data = array(
    			'bio' => $bio,
    			'athlete' => $athlete,
    			'endurances' => $endurances,
    			'balances' => $balances,
    			'flexibilities' => $flexibilities,
    			'strengths' => $strengths,
    			'notes'=> $notes
    	);
    	return view('pages.coach-calendar')->with($data);
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
