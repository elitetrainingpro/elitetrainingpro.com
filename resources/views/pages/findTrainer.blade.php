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
			<form action="search_code" method="post">
			<input type="text" name="search_code" placeholder="Search...">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
			<input type="submit" name="Submit" value="search">
			</form><br><br>
		</div>
	</div>
	<div class="row">
	<div class="col-md-8">	
	@foreach($findTrainers as $findTrainer)
	<div class="panel panel-default">
    <div class="panel-heading"><h3><img src="{{ URL::asset('assets/avatars/uploads/' . $findTrainer->image) }}" alt="No image found" height="75px" width="75px" style="border-radius:50%"> {{ $findTrainer->name }} <button>+</button></h3></div>
    <div class="panel-body">{{ $findTrainer->city }}, {{ $findTrainer->state }} {{ $findTrainer->email }} <br> {{ substr(strip_tags($findTrainer->bio),0, 300) }}{{ strlen(strip_tags($findTrainer->bio)) > 150 ? "..." : ""}}</div>
  </div>
	@endforeach
	</div>
	</div>
	<?php echo $findTrainers->render(); ?>
</div>
@endsection