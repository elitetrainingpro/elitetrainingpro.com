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
    	$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
    	// Create Strength Goal Charts
     	$goals = DB::table('strength_goals')->where('user_id', Auth::user()->id)->get();
 		
 		$charts = array();
 		foreach ($goals as $goal) {
 				$average = $goal->percent * 100;
 			  	$chart = Charts::create('percentage', 'justgage')
 				   	->title($goal->name)
 			    	->elementLabel('Strength Goal')
 			     	->values([$average,0,100])
 			     	->responsive(false)
 			     	->height(300)
 			     	->width(0);
 			  	array_push($charts, $chart);
 		}
 		
 		// Create Endurance Goal Charts
 		$goals = DB::table('endurance_goals')->where('user_id', Auth::user()->id)->get();
 		foreach ($goals as $goal) {
 			$average = $goal->percent * 100;
 			$chart = Charts::create('percentage', 'justgage')
 			->title($goal->name)
 			->elementLabel('Endurance Goal')
 			->values([$average,0,100])
 			->responsive(false)
 			->height(300)
 			->width(0);
 			array_push($charts, $chart);
 		}
 		
 		// Create Balance Goal Charts
 		$goals = DB::table('balance_goals')->where('user_id', Auth::user()->id)->get();
 		foreach ($goals as $goal) {
 			$average = $goal->percent * 100;
 			$chart = Charts::create('percentage', 'justgage')
 			->title($goal->name)
 			->elementLabel('Balance Goal')
 			->values([$average,0,100])
 			->responsive(false)
 			->height(300)
 			->width(0);
 			array_push($charts, $chart);
 		}
 		
 		// Create Flexibility Goal Charts
 		$goals = DB::table('flexibility_goals')->where('user_id', Auth::user()->id)->get();
 		foreach ($goals as $goal) {
 			$average = $goal->percent * 100;
 			$chart = Charts::create('percentage', 'justgage')
 			->title($goal->name)
 			->elementLabel('Flexibility Goal')
 			->values([$average,0,100])
 			->responsive(false)
 			->height(300)
 			->width(0);
 			array_push($charts, $chart);
 		}
		
 		$data = array(
 				'bio' => $bio,
 				'charts' => $charts,
 		);
 		return view('pages.goals')->with($data);
     	//return view('pages.goals', ['charts' => $charts]);
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
    		$workout->percent = 0;
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
    		$workout->percent = 0;
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
    		$workout->percent = 0;
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
    		$workout->percent = 0;
    		$workout->save();
    	}
    	
    	// Create Strength Goal Charts
    	$goals = DB::table('strength_goals')->where('user_id', Auth::user()->id)->get();
    	
    	$charts = array();
    	foreach ($goals as $goal) {
    		$average = $goal->percent * 100;
    		$chart = Charts::create('percentage', 'justgage')
    		->title($goal->name)
    		->elementLabel('Strength Goal')
    		->values([$average,0,100])
    		->responsive(false)
    		->height(300)
    		->width(0);
    		array_push($charts, $chart);
    	}
    	
    	// Create Endurance Goal Charts
    	$goals = DB::table('endurance_goals')->where('user_id', Auth::user()->id)->get();
    	foreach ($goals as $goal) {
    		$average = $goal->percent * 100;
    		$chart = Charts::create('percentage', 'justgage')
    		->title($goal->name)
    		->elementLabel('Endurance Goal')
    		->values([$average,0,100])
    		->responsive(false)
    		->height(300)
    		->width(0);
    		array_push($charts, $chart);
    	}
    	
    	// Create Balance Goal Charts
    	$goals = DB::table('balance_goals')->where('user_id', Auth::user()->id)->get();
    	foreach ($goals as $goal) {
    		$average = $goal->percent * 100;
    		$chart = Charts::create('percentage', 'justgage')
    		->title($goal->name)
    		->elementLabel('Balance Goal')
    		->values([$average,0,100])
    		->responsive(false)
    		->height(300)
    		->width(0);
    		array_push($charts, $chart);
    	}
    	
    	// Create Flexibility Goal Charts
    	$goals = DB::table('flexibility_goals')->where('user_id', Auth::user()->id)->get();
    	foreach ($goals as $goal) {
    		$average = $goal->percent * 100;
    		$chart = Charts::create('percentage', 'justgage')
    		->title($goal->name)
    		->elementLabel('Flexibility Goal')
    		->values([$average,0,100])
    		->responsive(false)
    		->height(300)
    		->width(0);
    		array_push($charts, $chart);
    	}
    	
    	return view('pages.goals', ['charts' => $charts]);
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
