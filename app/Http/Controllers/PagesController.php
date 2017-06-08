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
	
	public function getCoachCalendar() {
		return view('pages.coach-calendar');
	}
	
	public function getNotifications() {
		return view('pages.notifications');
	}
	
	public function getAthleteCalendar() {
		return view('pages.athlete-calendar');
	}
	
	public function getGoals() {
		return view('pages.goals');
	}
	
	public function getSchedules() {
		return view('pages.schedule');
	}
}