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
    	}
    	
    	$strengths = DB::table('strength_workouts')->where('user_id', $bio->user_id)->get();
    	$endurances = DB::table('endurance_workouts')->where('user_id', $bio->user_id)->get();
    	$balances = DB::table('balance_workouts')->where('user_id', $bio->user_id)->get();
    	$flexibilities = DB::table('flexibility_workouts')->where('user_id', $bio->user_id)->get();
    	$notes = DB::table('training_notes')->where('user_id', $bio->user_id)->get();
    	
    	$data = array(
    		'bio' => $bio,
    		'endurances' => $endurances,
    		'balances' => $balances,
    		'flexibilities' => $flexibilities,
    		'strengths' => $strengths,
    		'notes'=> $notes
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
		    			if ($average > 1)
		    				$average = 1;
		    			
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
    		$mph = ((($workout->event_time)*60)/$workout->distance)/60;
    		$volGoal= 0;
    		$goals = DB::table('endurance_goals')->where('user_id', Auth::user()->id)->get();
    		foreach ($goals as $goal) {
    			// only do if names match each other
    			if ($goal->name == $workout->name) {
    				if ($goal->percent < 1.00) {
    					//print_r((($goal->event_time*60)/$goal->distance)/60);print_r(" : ");print_r($goal->distance);die();
    					$mphGoal = (($goal->event_time*60)/$goal->distance)/60;
    					$average = $mph/ $mphGoal;//print_r($average);die();
    					if ($average > 1)
    						$average = 1;
    					
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
    					if ($average > 1)
    						$average = 1;
    					
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
    					if ($average > 1)
    						$average = 1;
    					
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
        $strengths = DB::table('strength_workouts')->where('user_id', $bio->user_id)->get();
        $endurances = DB::table('endurance_workouts')->where('user_id', $bio->user_id)->get();
        $balances = DB::table('balance_workouts')->where('user_id', $bio->user_id)->get();
        $flexibilities = DB::table('flexibility_workouts')->where('user_id', $bio->user_id)->get();
        $notes = DB::table('training_notes')->where('user_id', $bio->user_id)->get();
        
        $data = array(
        		'bio' => $bio,
        		'endurances' => $endurances,
        		'balances' => $balances,
        		'flexibilities' => $flexibilities,
        		'strengths' => $strengths,
        		'notes'=> $notes
        );
        return view('pages.athlete-calendar')->with($data);
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