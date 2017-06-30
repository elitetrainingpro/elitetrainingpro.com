@extends('layouts.calendar')

@section('strength')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Workout Name:') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('weight', 'Weight:') }}
        {{ Form::number('weight', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('reps', 'Reps:') }}
		{{ Form::number('reps', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('sets', 'Sets:') }}
		{{ Form::number('sets', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('date', 'Date:') }}
		<br/>
		{{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'date', 'readonly' => 'true']) }}<br/><br/>
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_strength', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('endurance')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Workout Name:') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('distance', 'Distance (miles):') }}
        {{ Form::number('distance', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('event_time', 'Time (minutes):') }}
		{{ Form::number('event_time', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('date', 'Date:') }}
		<br/>
		{{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'date', 'readonly' => 'true']) }}<br/><br/>
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_endurance', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('flexibility')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Workout Name:') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('time', 'Time (In minutes):') }}
		{{ Form::number('time', 'null', ['class' => 'form-control', 'required' => '']) }}
		{{ Form::label('sets', 'Sets:') }}
		{{ Form::number('sets', 'null', ['class' => 'form-control', 'required' => '']) }}
		{{ Form::label('date', 'Date:') }}
		<br>
		{{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'date', 'readonly' => 'true']) }}
		<br><br>
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_flexibility', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('balance')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Workout Name:') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('time', 'Time (In minutes):') }}
		{{ Form::number('time', 'null', ['class' => 'form-control', 'required' => '']) }}
		{{ Form::label('sets', 'Sets:') }}
		{{ Form::number('sets', 'null', ['class' => 'form-control', 'required' => '']) }}
		{{ Form::label('date', 'Date:') }}
		<br>
		{{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'date', 'readonly' => 'true']) }}
		<br><br>
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_balance', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('trainingNotes')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Title:') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('notes', 'Enter Your Training Notes:') }}
		{{ Form::textarea('notes', null, ['class' => 'form-control']) }}<br/>
		{{ Form::label('date', 'Date:') }}
		<br/>
		{{ Form::date('date', \Carbon\Carbon::now()) }}<br/><br/>
		
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_training_notes', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection