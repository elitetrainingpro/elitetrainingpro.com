@extends('layouts.default')

@section('title', '| Find Trainer')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/findTrainer.css') }}"></link>
@endsection

@section('navlinks')
    <li><a href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
	<li><a href="goals"><i class="fa fa-home fa"></i>Goals</a></li>
    <li><a href="schedule"><i class="fa fa-map fa"></i>Schedule</a></li>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1>This is the Find Trainer page.</h1>
			<input type="text" name="search" placeholder="Search..">
		</div>
	</div>
</div>
@endsection