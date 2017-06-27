<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Charts;
use App\FlexibilityGoal;
use App\BalanceGoal;
use App\StrengthGoal;
use App\EnduranceGoal;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	// Set the Strength
    	$workouts = DB::table('strength_workouts')->where('user_id', Auth::user()->id)->get();
    	$goals = DB::table('strength_goals')->where([['user_id', Auth::user()->id],['goal_type', 'Weekly']])->get();
    	//$goals = DB::table('strength_goals')->where('user_id', Auth::user()->id)->get();
    	print_r($goals);die();
//     	$number = $num = 0;
//     	foreach ($workouts as $workout) {
    		
//     		${'name' . $number} = $workout->name;
//     		${'weight' . $number} = $workout->weight;
//     		${'reps' . $number} = $workout->reps;
//     		${'sets' . $number} = $workout->sets;
//     		${'volume'. $number} = ${'weight' . $number} * ${'reps' . $number} * ${'sets' . $number};
//     		print_r(" Workokut:");print_r(${'name' . $number}); print_r(" ");
//     		$number++;
    		
//     		foreach ($goals as $goal) {
    			
//     			${'nameGoal' . $num} = $goal->name;
//     			${'weightGoal' . $num} = $goal->weight;
//     			${'repsGoal' . $num} = $goal->reps;
//     			${'setsGoal' . $num} = $goal->sets;
//     			${'volumeGoal'. $num} = ${'weightGoal' . $num} * ${'repsGoal' . $num} * ${'setsGoal' . $num};
//     			print_r(" Goal:");print_r(${'nameGoal' . $num});print_r(" ");
//     			$num++;
    			
    			
    			
//     		}
    		
    		
//     	}
//     	die();
//     	$name = $workouts->name;
//     	$weight = $workouts->weight;
//     	$reps = $workouts->reps;
//     	$sets = $workouts->sets;
    	
//     	$nameGoal = $goals->name;
//     	$weightGoal= $goals->weight;
//     	$repsGoal= $goals->reps;
//     	$setsGoal= $goals->sets;
    	
//     	$volume = $weight * $reps * $sets;
//     	$volumeGoal = $weightGoal* $repsGoal* $setsGoal;
//     	$average = ($volume/$volumeGoal) * 100;
    	
    	// Set the Endurance
    	
    	// Set the Flexibility
    	
    	// Set the Balance
    	$chart = Charts::create('percentage', 'justgage')
    	->title("Goal")
    	->elementLabel('Percentage')
    	->values([76,0,100])
    	->responsive(false)
    	->height(300)
    	->width(0);
    	return view('pages.goals', ['chart' => $chart]);
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
    	if ($request->has('submit_strength')) {
    		
    		// validate the data
    		$this->validate($request, array(
    				'goal_type' => 'required',
    				'name' => 'required|max:191',
    				'weight' => 'required',
    				'reps' => 'required',
    				'sets' => 'required',
    				'date' => 'required'
    		));
    		
    		//store in the Strenght Workout table
    		$workout = new StrengthGoal;
    		$workout->user_id = Auth::user()->id;
    		$workout->goal_type = $request->goal_type;
    		$workout->name = $request->name;
    		$workout->weight = $request->weight;
    		$workout->reps = $request->reps;
    		$workout->sets = $request->sets;
    		$workout->date = $request->date;
    		$workout->save();
    		
    	} else if ($request->has('submit_endurance')) {
    		// validate the data
    		$this->validate($request, array(
    				'goal_type' => 'required',
    				'name' => 'required|max:191',
    				'distance' => 'required',
    				'event_time' => 'required',
    				'date' => 'required'
    		));
    		
    		//store in the Endurance Workout table
    		$workout = new EnduranceGoal;
    		$workout->user_id = Auth::user()->id;
    		$workout->goal_type = $request->goal_type;
    		$workout->name = $request->name;
    		$workout->distance = $request->distance;
    		$workout->event_time= $request->event_time;
    		$workout->date = $request->date;
    		$workout->save();
    		
    	}else if ($request->has('submit_flexibility')) {
    		$this->validate($request, array(
    				'goal_type' => 'required',
    				'name' => 'required|max:191',
    				'time' => 'required',
    				'sets' => 'required',
    				'date' => 'required'
    		));
    		
    		$workout = new FlexibilityGoal;
    		$workout->user_id = Auth::user()->id;
    		$workout->goal_type = $request->goal_type;
    		$workout->name = $request->name;
    		$workout->time = $request->time;
    		$workout->sets= $request->sets;
    		$workout->date = $request->date;
    		$workout->save();
    		
    	}else if ($request->has('submit_balance')) {
    		$this->validate($request, array(
    				'goal_type' => 'required',
    				'name' => 'required|max:191',
    				'time' => 'required',
    				'sets' => 'required',
    				'date' => 'required'
    		));
    		
    		//store in the Endurance Workout table
    		$workout = new BalanceGoal;
    		$workout->user_id = Auth::user()->id;
    		$workout->goal_type = $request->goal_type;
    		$workout->name = $request->name;
    		$workout->time = $request->time;
    		$workout->sets= $request->sets;
    		$workout->date = $request->date;
    		$workout->save();
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
