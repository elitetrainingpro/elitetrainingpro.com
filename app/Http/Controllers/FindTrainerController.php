<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FindTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$findTrainers = DB::table('bios')
    					->join('users', function ($findTrainers) {
    						$findTrainers->on('bios.user_id', '=', 'users.id')
    						->where('bios.identity', 'Coach');
    					})
    					->paginate(5);
    	return view('pages.findTrainer')->with('findTrainers', $findTrainers);
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
    	return view('pages.findTrainer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return view('pages.findTrainer');
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
    	$Search = $request->search_code;
    	$findTrainers = DB::table('users')
    	->join('bios', function ($findTrainers) use ($Search) {
    		$findTrainers->on('users.id', '=', 'bios.user_id')
    		->where('users.name', 'like', "%$Search%");
    	})
    	->paginate(5);
    	return view('pages.findTrainer')->with('findTrainers', $findTrainers);
    }
}
