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

class CoachGoalController extends Controller
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
    	// validate the data
    	$this->validate($request, array(
    			'email' => 'required',
    	));
    	
    	$bio = DB::table('bios')->where('email', $request->email)->first();
    	
    	// Create Strength Goal Charts
    	$goals = DB::table('strength_goals')->where('user_id', $bio->user_id)->get();
    	//print_r($goals);die();
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
    	$goals = DB::table('endurance_goals')->where('user_id', $bio->user_id)->get();
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
    	$goals = DB::table('balance_goals')->where('user_id', $bio->user_id)->get();
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
    	$goals = DB::table('flexibility_goals')->where('user_id', $bio->user_id)->get();
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
    	
    	$athlete = DB::table('users')->where('email', $request->email)->first();
    	// data
    	$data = array(
    			'athlete' => $athlete,
    			'charts' =>  $charts
    	);
    	
    	return view('pages.coach-goals')->with($data);
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