<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\FlexibilityWorkout;
use App\BalanceWorkout;
use App\StrengthWorkout;
use App\EnduranceWorkout;
use App\TrainingNote;
use Image;
use Purifier;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
    	return view('pages.athlete-calendar')->with('bio', $bio);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
    	return view('pages.athlete-calendar')->with('bio', $bio);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// Determine what form is being submitted.
    	if ($request->has('submit_strength')) {
    		
    		// validate the data
    		$this->validate($request, array(
    				'name' => 'required|max:191',
    				'weight' => 'required',
    				'reps' => 'required',
    				'sets' => 'required',
    				'date' => 'required'
    		));
    		
    		//store in the Strenght Workout table
    		$workout = new StrengthWorkout;
    		$workout->user_id = Auth::user()->id;
    		$workout->name = $request->name;
    		$workout->weight = $request->weight;
    		$workout->reps = $request->reps;
    		$workout->sets = $request->sets;
    		$workout->date = $request->date;
    		$workout->save();
    		
    		$newVol = $workout->weight * $workout->reps * $workout->sets;
    		$volGoal= 0;
    		$goals = DB::table('strength_goals')->where('user_id', Auth::user()->id)->get();
    		//print_r($goals);die();
    		foreach ($goals as $goal) {
    			// only do if names match each other
    			if ($goal->name == $workout->name) {
    				if ($goal->percent < 1.00) {
		    			$volGoal = $goal->weight * $goal->reps * $goal->sets;
		    			//print_r($newVol); print_r(" ");print_r($volGoal); print_r(" ");
		    			$average = $newVol / $volGoal;
		    			
		    			// where user_id => Auth::user-id and where created_at => date & time
		    			$data = array(
		    					'user_id' => Auth::user()->id,
		    					'created_at' => $goal->created_at
		    			);
		    			
		    			DB::table('strength_goals')
		    			->where($data)
		    			->update(['percent' => $average]);
    				}
    			}
    			//print_r($average);die();
    			//     		${'weight' . $number} = $workout->weight;
    			//     		${'reps' . $number} = $workout->reps;
    			//     		${'sets' . $number} = $workout->sets;
    		}
    	} else if ($request->has('submit_endurance')) {
    		// validate the data
    		$this->validate($request, array(
    				'name' => 'required|max:191',
    				'distance' => 'required',
    				'event_time' => 'required',
    				'date' => 'required'
    		));
    		
    		//store in the Endurance Workout table
    		$workout = new EnduranceWorkout;
    		$workout->user_id = Auth::user()->id;
    		$workout->name = $request->name;
    		$workout->distance = $request->distance;
    		$workout->event_time= $request->event_time;
    		$workout->date = $request->date;
    		$workout->save();
    		
    		
    		
    	}else if ($request->has('submit_flexibility')) {
    		$this->validate($request, array(
    				'name' => 'required|max:191',
    				'time' => 'required',
    				'sets' => 'required',
    				'date' => 'required'
    		));
    		
    		$workout = new FlexibilityWorkout;
    		$workout->user_id = Auth::user()->id;
    		$workout->name = $request->name;
    		$workout->time = $request->time;
    		$workout->sets= $request->sets;
    		$workout->date = $request->date;
    		$workout->save();
    		
    	}else if ($request->has('submit_balance')) {
    		$this->validate($request, array(
    				'name' => 'required|max:191',
    				'time' => 'required',
    				'sets' => 'required',
    				'date' => 'required'
    		));
    		
    		//store in the Endurance Workout table
    		$workout = new BalanceWorkout;
    		$workout->user_id = Auth::user()->id;
    		$workout->name = $request->name;
    		$workout->time = $request->time;
    		$workout->sets= $request->sets;
    		$workout->date = $request->date;
    		$workout->save();
    	}else if ($request->has('submit_training_notes')) {

            // validate the data
            $this->validate($request, array(
                    'name' => 'required|max:191',
                    'notes' => 'required',
                    'date' => 'required'
            ));
         
            //store in the Training Notes table
            $note = new TrainingNote;
            $note->user_id = Auth::user()->id;
            $note->name= $request->name;
            $note->notes = $request->notes;
            $note->date = $request->date;
            $note->save();

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
