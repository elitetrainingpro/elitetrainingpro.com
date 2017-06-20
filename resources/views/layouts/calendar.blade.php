@extends('layouts.default')

@section('title', '| Calendar')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
@endsection

@section('scripts')
	<script src="{{ URL::asset('assets/js/calendar.js') }}"></script>
@endsection

@section('navlinks')
    <li><a class="active" href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
	<li><a href="goals"><i class="fa fa-home fa"></i>Goals</a></li>
    <li><a href="schedule"><i class="fa fa-map fa"></i>Schedule</a></li>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="dropdown">
				<button class="btn btn-black">Logs</button>
				<div class="dropdown-content" style="left:0;">
					<a href="#">Training</a>
					<a href="#">Notes</a>
				</div>
			</div>
			<button class="btn btn-default" data-toggle="modal" data-target="#addTraining"> + Training </button>
			<button class="btn btn-default" data-toggle="modal" data-target="#addNote"> + Note</button>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<h1>Calendar</h1>
		</div>
	</div>

	<!-- Training Modal -->
	<div class="modal fade" id="addTraining" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Training</h4>
				</div>
				<!--Training Tabs -->
				<ul class="nav nav-tabs" id="tabContent">
					<li class="active"><a href="#strength" data-toggle="tab">Strength</a></li>
					<li><a href="#endurance" data-toggle="tab">Endruance</a></li>
					<li><a href="#flexibility" data-toggle="tab">Flexibility</a></li>
					<li><a href="#balance" data-toggle="tab">Balance</a><li>
				</ul>
				<div class="modal-body">
					<div class="tab-content">
						<!-- Strength Tab in Modal-->
						<div class="tab-pane active" id="strength">
							@yield('strength')
						</div>
						<!-- Endruance Tab in Modal-->
						<div class="tab-pane" id="endurance">
							@yield('endurance')
						</div>
						<!-- Flexibility Tab in Modal-->
						<div class="tab-pane" id="flexibility">
							@yield('flexibility')
						</div>
						<!-- Balance Tab in Modal-->
						<div class="tab-pane" id="balance">
							@yield('balance')
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div> 
		</div>
	</div>

	<!-- Note Modal -->
	<div class="modal fade" id="addNote" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Note</h4>
				</div>
				<!--Notes Tabs -->
				<ul class="nav nav-tabs" id="tabContent">
					<li class="active"><a href="#training" data-toggle="tab">Training</a></li>
					<li><a href="#nutrition" data-toggle="tab">Nutrition</a></li>
					<li><a href="#medical" data-toggle="tab">Medical</a><li>
				</ul>
				<div class="modal-body">
					<div class="tab-content">
						<!-- Training Tab in Modal-->
						<div class="tab-pane active" id="training">
							@yield('trainingNotes')
						</div>
						<!-- Nutrition Tab in Modal-->
						<div class="tab-pane" id="nutrition">
							@yield('nutritionNotes')
						</div>
						<!-- Medical Tab in Modal-->
						<div class="tab-pane" id="medical">
							@yield('medicalNotes')
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div> 
		</div>
	</div>
</div>

<!-- Calendar Modal -->
<div id="cal">
	<div class="header">
		<span class="left button" id="prev"> &lang; </span>
		<span class="month-year" id="label">May 2017</span>
		<span class="right button" id="next"> &rang;</span>
	</div>
	<table id="days">
		<tr>
			<td>Sun</td>
			<td>Mon</td>
			<td>Tue</td>
			<td>Wed</td>
			<td>Thr</td>
			<td>Fri</td>
			<td>Sat</td>
		</tr>
	</table>
	<div id="cal-frame">
		<table class="curr">
			<tr><td class="nil"></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
			<tr><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td class="today">12</td><td>13</td></tr>
			<tr><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td></tr>
			<tr><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td></tr>
			<tr><td>28</td><td>29</td><td>30</td><td>31</td><td class="nil"></td><td class="nil"></td><td class="nil"></td></tr>
		</table>
	</div>
</div>
<script>
	$(document).ready(function(){
		var cal = CALENDAR();
		cal.init();
	});
</script>
@endsection