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


        if ($bio->identity != NULL) {
            if ($bio->identity == 'Coach'){

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

                return view('pages.home')->with($data);
            } else {
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
                return view('pages.athletes-home')->with($data);
             
	    	}
        } else { // If identity is null then go to bio page (This should never ever happen)
        	return view('pages.bio');
        }
    }
}
