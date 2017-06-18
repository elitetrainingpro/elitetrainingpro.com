@extends('layouts.calendar')

@section('strength')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Workout Name') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('weight', 'Weight') }}
        {{ Form::number('weight', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('reps', 'Reps') }}
		{{ Form::number('reps', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('sets', 'Sets') }}
		{{ Form::number('sets', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('date', 'Date') }}
		{{ Form::date('date', \Carbon\Carbon::now()) }}<br/>
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_strength', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('endurance')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Workout Name') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('distance', 'Distance (miles)') }}
        {{ Form::number('distance', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('event_time', 'Time (minutes)') }}
		{{ Form::number('event_time', 'null', ['class' => 'form-control', 'required', 'step'=>'any']) }}
		{{ Form::label('date', 'Date') }}
		{{ Form::date('date', \Carbon\Carbon::now()) }}<br/>
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_endurance', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('flexability')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('Something', 'Something') }}
		
	{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_flexability', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('balance')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('Something', 'Something') }}
		
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_balance', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('notes')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('Something', 'Something') }}
		
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_notes', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection