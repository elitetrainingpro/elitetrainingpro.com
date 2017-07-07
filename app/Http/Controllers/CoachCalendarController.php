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
    	//
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
