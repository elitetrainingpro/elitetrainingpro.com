@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
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
			<h1>This is the athlete's home page.</h1>
			<img src="{{ URL::asset('assets/avatars/' . $bio->image) }}" alt="No image found" height="50px" width="50px">
			
		</div>
	</div>
</div>
@endsection
