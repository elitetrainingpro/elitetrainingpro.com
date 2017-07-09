<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\AthleteToCoach;

class FindTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
    	$findTrainers = DB::table('bios')
    					->join('users', function ($findTrainers) {
    						$findTrainers->on('bios.user_id', '=', 'users.id')
    						->where('bios.identity', 'Coach');
    					})
    					->paginate(5);
    					
    					$data = array(
    							'bio' => $bio,
    							'findTrainers' => $findTrainers,
    					);
    					
    	return view('pages.findTrainer')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('pages.findTrainer');
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
    			'email' => 'required',
    	));
    	
    	// Get current sure login info.
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
    	
    	// get the coach's information that the trainer clicked on
    	$coachId = DB::table('users')->where('email', $request->email)->first();
    	
    	// check athlete to coaches table to see if athlete and coach are already matched together
    	$athlete2Coach = DB::table('athlete_to_coaches')->where([['athlete_id', $bio->user_id], ['coach_id', $coachId->id]])->first();
    	
    	// if coach and athlete are not matched together then match them together
    	if (!$athlete2Coach)
    	{
    		$workout = new AthleteToCoach;
    		$workout->athlete_id = Auth::user()->id;
    		$workout->coach_id = $coachId->id;
    		$workout->still_connected = 0;
    		$workout->save();
    	}


        //SEND COACH INFO
            if ($bio->identity == 'Athlete'){
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

    	// return to the athlete's home page
    	return view('pages.athletes-home')->with('bio', $bio);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    	
    
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
    
    public function search_code(Request $request)
    {   
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
    	$Search = $request->search_code;
    	$findTrainers = DB::table('users')
    	->join('bios', function ($findTrainers) use ($Search) {
    		$findTrainers->on('users.id', '=', 'bios.user_id')
    		->where('users.name', 'like', "%$Search%");
    	})
    	->paginate(5);
    	$data = array(
    			'bio' => $bio,
    			'findTrainers' => $findTrainers,
    	);
    	
    	return view('pages.findTrainer')->with($data);
    	//return view('pages.findTrainer')->with('findTrainers', $findTrainers);
    }
}
