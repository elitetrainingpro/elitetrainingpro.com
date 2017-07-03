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
use App\Event;
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
    	//$mytime = Carbon\Carbon::now();
    	$date = date('Y-m');
    	$year = date('Y');
    	$month = date('m');
    	//print_r(Auth::user()->id);die();
    	$strengths = DB::table('strength_workouts')->where('user_id', Auth::user()->id)->get();
    	//$strength = DB::table('strength_workouts')->whereYear('date', '=', $year)
//     	->whereMonth('date', '=', $month)
//     	->get();
// 		$events = array();
// 		foreach($strengths as $strength){
// 			$event = new StrengthWorkout();
// 			$event->user_id = $strength->user_id;
// 			$event->name = $strength->name;
// 			$event->weight = $strength->weight;
// 			$event->reps = $strength->reps;
// 			$event->sets = $strength->sets;
// 			$event->date = $strength->date;
// 			$event->save();
// 			array_push($events, $event);
// 		}
    	$data = array(
    		'bio' => $bio,
    		'strengths' => $strengths
    	);
    	return view('pages.athlete-calendar')->with($data);
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
    		
    		// Calculate the percentage of the percentage
    		$newVol = $workout->weight * $workout->reps * $workout->sets;
    		$volGoal= 0;
    		$goals = DB::table('strength_goals')->where('user_id', Auth::user()->id)->get();
    		
    		// check to see if current goal percent database is < than the new percent
    		foreach ($goals as $goal) {
    			// only do if names match each other
    			if ($goal->name == $workout->name) {
    				if ($goal->percent < 1.00) {
		    			$volGoal = $goal->weight * $goal->reps * $goal->sets;
		    			$average = $newVol / $volGoal;
		    			if ($goal->percent < $average) {
		    				$data = array(
		    						'user_id' => Auth::user()->id,
		    						'created_at' => $goal->created_at
		    				);
		    				// store the percentage in the database
		    				DB::table('strength_goals')
		    				->where($data)
		    				->update(['percent' => $average]);
		    			}
    				}
    			}
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
    		
    		// Calculate the percentage of the percentage
    		$mph = $workout->distance/($workout->event_time/60);
    		$volGoal= 0;
    		$goals = DB::table('endurance_goals')->where('user_id', Auth::user()->id)->get();
    		foreach ($goals as $goal) {
    			// only do if names match each other
    			if ($goal->name == $workout->name) {
    				if ($goal->percent < 1.00) {
    					$mphGoal = $goal->distance/($goal->event_time/60);
    					$average = $mph/ $mphGoal;
    					if ($goal->percent < $average) {
    						$data = array(
    								'user_id' => Auth::user()->id,
    								'created_at' => $goal->created_at
    						);
    						// store the percentage in the database
    						DB::table('endurance_goals')
    						->where($data)
    						->update(['percent' => $average]);
    					}
    				}
    			}
    		}
    		
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
    		
    		// Calculate the percentage of the percentage
    		$newVol= $workout->sets/($workout->time/60);
    		$volGoal= 0;
    		$goals = DB::table('flexibility_goals')->where('user_id', Auth::user()->id)->get();
    		foreach ($goals as $goal) {
    			// only do if names match each other
    			if ($goal->name == $workout->name) {
    				if ($goal->percent < 1.00) {
    					$volGoal = $goal->sets/($goal->time/60);
    					$average = $newVol / $volGoal;
    					if ($goal->percent < $average) {
    						$data = array(
    								'user_id' => Auth::user()->id,
    								'created_at' => $goal->created_at
    						);
    						// store the percentage in the database
    						DB::table('flexibility_goals')
    						->where($data)
    						->update(['percent' => $average]);
    					}
    				}
    			}
    		}
    		
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
    		
    		// Calculate the percentage of the percentage
    		$newVol = $workout->sets/($workout->time/60);
    		$volGoal= 0;
    		$goals = DB::table('balance_goals')->where('user_id', Auth::user()->id)->get();
    		foreach ($goals as $goal) {
    			// only do if names match each other
    			if ($goal->name == $workout->name) {
    				if ($goal->percent < 1.00) {
    					$volGoal = $goal->sets/($goal->time/60);
    					$average = $newVol / $volGoal;
    					if ($goal->percent < $average) {
    						$data = array(
    								'user_id' => Auth::user()->id,
    								'created_at' => $goal->created_at
    						);
    						// store the percentage in the database
    						DB::table('balance_goals')
    						->where($data)
    						->update(['percent' => $average]);
    					}
    				}
    			}
    		}
    		
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
        $bio = DB::table('bios')->where('email', Auth::user()->email)->first();
        return view('pages.athlete-calendar')->with('bio', $bio);
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
