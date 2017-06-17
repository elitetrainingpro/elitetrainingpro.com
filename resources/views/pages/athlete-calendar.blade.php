@extends('layouts.calendar')

@section('strength')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('Something', 'Something') }}
		
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_strength', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection

@section('endurance')
	{!! Form::open(['route' => 'athletecalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('Something', 'Something') }}
		
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