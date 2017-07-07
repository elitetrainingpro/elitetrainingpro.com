@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/goals.css') }}"></link>
@endsection

@section('navlinks')
    <li><a href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
	<li><a class="active" href="goals"><i class="fa fa-home fa"></i>Goals</a></li>
@endsection

@section('scripts')
    {!! Charts::assets() !!}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
			<button class="btn btn-primary" data-toggle="modal" data-target="#addGoal"> + Goal </button>
        </div>
        <div class="col-md-12 text-center">
			<h1>Your Goals</h1>
			<p style="color:red">Previous workouts will not count towards newly created goals.</p>
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
								<h3>Strength</h3>
								{!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
									{{ Form::label('goal_type', 'Goal Type:') }}
								  	{{ Form::select('goal_type',[
									    'Goal Type' => [
									    				null => 'Please Select',
														'Weekly' => 'Weekly',
														'Monthly' => 'Monthly',
														'Seasonal' => 'Seasonal',
													],
									], null, ['required']) }}<br>
									{{ Form::label('name', 'Workout Name:') }}
									{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
									{{ Form::label('weight', 'Weight:') }}
							        {{ Form::number('weight', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
									{{ Form::label('reps', 'Reps:') }}
									{{ Form::number('reps', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
									{{ Form::label('sets', 'Sets:') }}
									{{ Form::number('sets', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
									{{ Form::label('date', 'Goal Set Date:') }}
									<br>
									{{ Form::date('date', \Carbon\Carbon::now()) }}<br/><br/>
									{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_strength', 'class' => 'btn btn-success')) }}
								{!! Form::close() !!}
							</div>
							<!-- Endruance Tab in Modal-->
							<div class="tab-pane" id="endurance">
								<h3>Endurance</h3>
								{!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
								  	{{ Form::label('goal_type', 'Goal Type:') }}
								  	{{ Form::select('goal_type',[
									    'Goal Type' => [
									    				null => 'Please Select',
														'Weekly' => 'Weekly',
														'Monthly' => 'Monthly',
														'Seasonal' => 'Seasonal',
													],
									], null, ['required']) }}<br>
									{{ Form::label('name', 'Workout Name:') }}
									{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
									{{ Form::label('distance', 'Distance (miles):') }}
							        {{ Form::number('distance', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
									{{ Form::label('event_time', 'Time (minutes):') }}
									{{ Form::number('event_time', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
									{{ Form::label('date', 'Goal Set Date:') }}
									<br>
									{{ Form::date('date', \Carbon\Carbon::now()) }}<br/><br/>
									{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_endurance', 'class' => 'btn btn-success')) }}
								{!! Form::close() !!}
							</div>
							<!-- Flexibility Tab in Modal-->
							<div class="tab-pane" id="flexibility">
								<h3>Flexibility</h3>
								{!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
									{{ Form::label('goal_type', 'Goal Type:') }}
								  	{{ Form::select('goal_type',[
									    'Goal Type' => [
									    				null => 'Please Select',
														'Weekly' => 'Weekly',
														'Monthly' => 'Monthly',
														'Seasonal' => 'Seasonal',
													],
									], null, ['required']) }}<br>
									{{ Form::label('name', 'Workout Name:') }}
									{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
									{{ Form::label('time', 'Time (In minutes):') }}
									{{ Form::number('time', 'null', ['class' => 'form-control', 'required' => '']) }}
									{{ Form::label('sets', 'Sets:') }}
									{{ Form::number('sets', 'null', ['class' => 'form-control', 'required' => '']) }}
									{{ Form::label('date', 'Goal Set Date:') }}
									<br>
									{{ Form::date('date', \Carbon\Carbon::now()) }}
									<br><br>
									{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_flexibility', 'class' => 'btn btn-success')) }}
								{!! Form::close() !!}
							</div>
							<!-- Balance Tab in Modal-->
							<div class="tab-pane" id="balance">
								<h3>Balance</h3>
								{!! Form::open(['route' => 'goals.store', 'data-parsley-validate' => '', 'files' => true]) !!}<br>
									{{ Form::label('goal_type', 'Goal Type:') }}
								  	{{ Form::select('goal_type',[
									    'Goal Type' => [
									    				null => 'Please Select',
														'weekly' => 'Weekly',
														'monthly' => 'Monthly',
														'seasonal' => 'Seasonal',
													],
									], null, ['required']) }}<br>
									{{ Form::label('name', 'Workout Name:') }}
									{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
									{{ Form::label('time', 'Time (In minutes):') }}
									{{ Form::number('time', 'null', ['class' => 'form-control', 'required' => '']) }}
									{{ Form::label('sets', 'Sets:') }}
									{{ Form::number('sets', 'null', ['class' => 'form-control', 'required' => '']) }}
									{{ Form::label('date', 'Goal Set Date:') }}
									<br>
									{{ Form::date('date', \Carbon\Carbon::now()) }}
									<br><br>
									{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_balance', 'class' => 'btn btn-success')) }}
								{!! Form::close() !!}
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
    <div class="row">
    @foreach($charts as $chart)
    	<div class="col-md-3">
    		{!! $chart->render() !!}
    	</div>
	@endforeach
    </div>
    
</div>
@endsection