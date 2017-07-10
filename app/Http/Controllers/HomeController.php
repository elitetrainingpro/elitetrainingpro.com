<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\AthleteToCoach;

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
            if ($bio->identity == 'Coach') {

                // get list of athletes that the coach has.
                $athleteToCoaches = DB::table('athlete_to_coaches')->where('coach_id', $bio->user_id)->get();

                //declare an array to sotre athlete's bio information
                $athletes = array();

                // Get all the athlete's bio information and Athlete's Name, connected status
                foreach ($athleteToCoaches as $athleteToCoach){
                    $athlete = DB::table('users')
                    ->join('bios', 'bios.user_id', '=', 'users.id')
                    ->join('athlete_to_coaches', 'athlete_to_coaches.athlete_id', '=', 'users.id')->where('athlete_to_coaches.coach_id', $athleteToCoach->coach_id)
                    ->where('users.id', $athleteToCoach->athlete_id)->get();

                    array_push($athletes, $athlete); 
                }

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

    public function connectRequest(Request $request)
    {
        
        // validate the data
        $this->validate($request, array(
            'email' => 'required',
            ));

        // Get current user's login info
        $bio = DB::table('bios')->where('email', Auth::user()->email)->first();

        // Accepting the athlete
        if($request->has('accept_submit')) 
        {
            // Athlete Id
            $athleteId = DB::table('users')->where('email', $request->email)->first();

            // gets both Athlete and Coach
            $data = array(
                'athlete_id' => $athleteId->id,
                'coach_id'=> $bio->id
                );

            // Updates the Still connected only where Athlete and Coach
            $connected = DB::table('athlete_to_coaches')
            ->where($data)
            ->update(['still_connected' => 1]);

            return redirect()->back();
        } else {        // Deleting connection
            if ($bio->identity != NULL) {
                if ($bio->identity == 'Coach') {   // DELETING ATHLETE FOR COACH
                 // Getting Athlete Id
                    $athleteId = DB::table('users')->where('email', $request->email)->first();

                // check for match
                    $athlete2Coach = DB::table('athlete_to_coaches')->where([['coach_id', $bio->user_id], ['athlete_id', $athleteId->id]])->first();

                // if coach and athlete are matched together then update still_connected and Delete Connection
                    if ($athlete2Coach){
                        AthleteToCoach::where([['coach_id', $bio->user_id], ['athlete_id', $athleteId->id]])->delete();
                    }

                    return redirect()->back();
                }   else {                  // DELETING COACH FOR ATHLETE
     
                    $coachId = DB::table('users')->where('email', $request->email)->first();

                    $athlete2Coach = DB::table('athlete_to_coaches')->where([['athlete_id', $bio->user_id], ['coach_id', $coachId->id]])->first();

                    if ($athlete2Coach){
                      AthleteToCoach::where([['athlete_id', $bio->user_id], ['coach_id', $coachId->id]])->delete();
                    }
                    return redirect()->back();
                }

            } else{
                return view('pages.athletes-home')->with('bio', $bio);
            }
        }
    }
}
