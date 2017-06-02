<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function getIndex() {
	
	}
	
	public function getAthletes() {
		return view('pages.athletes');
	}
	
	public function getCalendar() {
		return view('pages.athlete-calendar');
	}
	
	public function getNotifications() {
		return view('pages.notifications');
	}
}