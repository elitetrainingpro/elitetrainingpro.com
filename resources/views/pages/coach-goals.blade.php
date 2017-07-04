@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/goals.css') }}"></link>
@endsection

@section('navlinks')
    <li><a href="home"><i class="fa fa-home fa"></i>Athletes</a></li>
@endsection

@section('scripts')
    {!! Charts::assets() !!}
@endsection

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 text-center">
    	<h2>{{ $athlete->name }}'s Goals</h2>
    	{!! Form::open(['route' => 'coachcalendar.store', 'data-parsley-validate' => '', 'files' => true]) !!}
			{{ Form::hidden('email',  $athlete->email) }}
			{{ Form::submit('View Calendar', ['class' => 'btn btn-primary']) }}
		{!! Form::close() !!}
    </div>
    @foreach($charts as $chart)
    	<div class="col-md-4">
    		{!! $chart->render() !!}
    	</div>
	@endforeach
    </div>
    
</div>
@endsection