<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PagesController extends Controller
{
	public function getIndex() {
	
	}
	
	public function getAthletes() {
		$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
		return view('pages.athletes')->with('bio', $bio);
	}
	
	public function getCoachCalendar() {
		$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
		return view('pages.coach-calendar')->with('bio', $bio);
	}
	
	public function getNotifications() {
		$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
		return view('pages.notifications')->with('bio', $bio);
	}
	
	public function getAthleteCalendar() {
		$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
		return view('pages.athlete-calendar')->with('bio', $bio);
	}
	
	public function getGoals() {
		$bio = DB::table('bios')->where('email', Auth::user()->email)->first();
		return view('pages.goals')->with('bio', $bio);
	}
}