@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/goals.css') }}"></link>
@endsection

@section('navlinks')
    <li><a href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
	<li><a class="active" href="goals"><i class="fa fa-home fa"></i>Goals</a></li>
    <li><a href="schedule"><i class="fa fa-map fa"></i>Schedule</a></li>
@endsection

@section('scripts')
    {!! Charts::assets() !!}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="dropdown">
				<div class="dropdown-content" style="left:0;">
					<a href="#">Training</a>
					<a href="#">Notes</a>
				</div>
			</div>
			<button class="btn btn-default" data-toggle="modal" data-target="#addGoal"> + Goal </button>
        </div>
        <!-- Add Goal Modal -->
		<div class="modal fade" id="addGoal" role="dialog">
			<div class="modal-dialog">
	
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Goal</h4>
					</div>
					<div class="modal-body">
						<div class="tab">
						  <button class="tablinks" onclick="openCity(event, 'Endurance')" id="defaultOpen">Endurance</button>
						  <button class="tablinks" onclick="openCity(event, 'Flexibility')">Flexibility</button>
						  <button class="tablinks" onclick="openCity(event, 'Strength')">Strength</button>
						  <button class="tablinks" onclick="openCity(event, 'Balance')">Balance</button>
						</div>
						
						<div id="Endurance" class="tabcontent">
						  <h3>Endurance</h3>
						  <hr>
						  {!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
						  	{{ Form::label('goal_type', 'Goal Type:') }}
						  	{{ Form::select('goal_type',[
							    'Goal Type' => [
							    				null => 'Please Select',
												'Weekly' => 'Weekly',
												'Monthly' => 'Monthly',
												'Seasonal' => 'Seasonal',
											],
							], null, ['required']) }}
							{{ Form::label('name', 'Workout Name:') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
							{{ Form::label('distance', 'Distance (miles):') }}
					        {{ Form::number('distance', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
							{{ Form::label('event_time', 'Time (minutes):') }}
							{{ Form::number('event_time', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
							{{ Form::label('date', 'Date:') }}
							<br>
							{{ Form::date('date', \Carbon\Carbon::now()) }}<br/><br/>
							{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_endurance', 'class' => 'btn btn-success')) }}
						{!! Form::close() !!}
						</div>
						
						<div id="Flexibility" class="tabcontent">
						  <h3>Flexibility</h3>
						  <hr>
						  {!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
							{{ Form::label('goal_type', 'Goal Type:') }}
						  	{{ Form::select('goal_type',[
							    'Goal Type' => [
							    				null => 'Please Select',
												'Weekly' => 'Weekly',
												'Monthly' => 'Monthly',
												'Seasonal' => 'Seasonal',
											],
							], null, ['required']) }}
							{{ Form::label('name', 'Workout Name:') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
							{{ Form::label('time', 'Time (In minutes):') }}
							{{ Form::number('time', 'null', ['class' => 'form-control', 'required' => '']) }}
							{{ Form::label('sets', 'Sets:') }}
							{{ Form::number('sets', 'null', ['class' => 'form-control', 'required' => '']) }}
							{{ Form::label('date', 'Date:') }}
							<br>
							{{ Form::date('date', \Carbon\Carbon::now()) }}
							<br><br>
							{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_flexibility', 'class' => 'btn btn-success')) }}
						{!! Form::close() !!}
						</div>
						
						<div id="Strength" class="tabcontent">
						  <h3>Strength</h3>
						  <hr>
						  {!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
							{{ Form::label('goal_type', 'Goal Type:') }}
						  	{{ Form::select('goal_type',[
							    'Goal Type' => [
							    				null => 'Please Select',
												'Weekly' => 'Weekly',
												'Monthly' => 'Monthly',
												'Seasonal' => 'Seasonal',
											],
							], null, ['required']) }}
							{{ Form::label('name', 'Workout Name:') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
							{{ Form::label('weight', 'Weight:') }}
					        {{ Form::number('weight', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
							{{ Form::label('reps', 'Reps:') }}
							{{ Form::number('reps', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
							{{ Form::label('sets', 'Sets:') }}
							{{ Form::number('sets', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
							{{ Form::label('date', 'Date:') }}
							<br>
							{{ Form::date('date', \Carbon\Carbon::now()) }}<br/><br/>
							{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_strength', 'class' => 'btn btn-success')) }}
						{!! Form::close() !!}
						</div>
						
						<div id="Balance" class="tabcontent">
						  <h3>Balance</h3>
						  <hr>
						  {!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
							{{ Form::label('goal_type', 'Goal Type:') }}
						  	{{ Form::select('goal_type',[
							    'Goal Type' => [
							    				null => 'Please Select',
												'weekly' => 'Weekly',
												'monthly' => 'Monthly',
												'seasonal' => 'Seasonal',
											],
							], null, ['required']) }}
							{{ Form::label('name', 'Workout Name:') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
							{{ Form::label('time', 'Time (In minutes):') }}
							{{ Form::number('time', 'null', ['class' => 'form-control', 'required' => '']) }}
							{{ Form::label('sets', 'Sets:') }}
							{{ Form::number('sets', 'null', ['class' => 'form-control', 'required' => '']) }}
							{{ Form::label('date', 'Date:') }}
							<br>
							{{ Form::date('date', \Carbon\Carbon::now()) }}
							<br><br>
							{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_balance', 'class' => 'btn btn-success')) }}
						{!! Form::close() !!}
						</div>
						
						<script>
							function openCity(evt, cityName) {
							    var i, tabcontent, tablinks;
							    tabcontent = document.getElementsByClassName("tabcontent");
							    for (i = 0; i < tabcontent.length; i++) {
							        tabcontent[i].style.display = "none";
							    }
							    tablinks = document.getElementsByClassName("tablinks");
							    for (i = 0; i < tablinks.length; i++) {
							        tablinks[i].className = tablinks[i].className.replace(" active", "");
							    }
							    document.getElementById(cityName).style.display = "block";
							    evt.currentTarget.className += " active";
							}
							
							// Get the element with id="defaultOpen" and click on it
							document.getElementById("defaultOpen").click();
						</script>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div> 
			</div>
		</div>
		{!! $chart->render() !!}
    </div>
</div>
@endsection