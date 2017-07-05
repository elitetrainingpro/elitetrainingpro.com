@extends('layouts.coach_cal', ['variable' => $strengths])

@section('trainingNotes')
	{!! Form::open(['route' => 'coachcalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('name', 'Title:') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		{{ Form::label('notes', 'Enter Your Training Notes:') }}
		{{ Form::textarea('notes', null, ['class' => 'form-control']) }}<br/>
		{{ Form::label('date', 'Date:') }}
		<br/>
		{{ Form::date('date', \Carbon\Carbon::now()) }}<br/><br/>
		{{ Form::hidden('email',  $bio->email) }}
		
		{{ Form::submit( 'Submit', array('type' => 'submit', 'name' => 'submit_training_notes', 'class' => 'btn btn-success')) }}
	{!! Form::close() !!}
@endsection