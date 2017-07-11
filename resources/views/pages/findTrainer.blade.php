@extends('layouts.default')

@section('title', '| Find Trainer')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/findTrainer.css') }}"></link>
@endsection

@section('navlinks')
    <li><a href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
	<li><a href="goals"><i class="fa fa-home fa"></i>Goals</a></li>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center">
			<form action="search_code" method="post">
			<input type="text" name="search_code" placeholder="Search for a Trainer...">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
			<input type="submit" name="Submit" value="search" id="searchsubmit">
			</form><br><br>
		</div>
	</div>
	<div class="row">
	@foreach($findTrainers as $findTrainer)
	<div class="col-md-6">
	<div class="panel panel-default" style="height: 300px;">
    <div class="panel-heading"><h3><img src="{{ URL::asset('assets/avatars/uploads/' . $findTrainer->image) }}" alt="No image found" height="75px" width="75px" style="border-radius:50%"> {{ $findTrainer->name }} 
    <span style="float: right" >
    {!! Form::open(['route' => 'findtrainer.store', 'data-parsley-validate' => '', 'files' => true]) !!}
    	{{ Form::hidden('email',  $findTrainer->email) }}
    	{{ Form::submit('+', ['class' => 'btn btn-primary btn-radius']) }}
    {!! Form::close() !!}</span>
    </h3></div>
    <div class="panel-body"><b>Email:</b><br> {{ $findTrainer->email }} <br><b>Location:</b><br>{{ $findTrainer->city }}, {{ $findTrainer->state }} <br><b>Bio:</b><br> {{ substr(strip_tags($findTrainer->bio),0, 50) }}{{ strlen(strip_tags($findTrainer->bio)) > 50 ? '...' : ""}}</div>
  </div>
  </div>
	@endforeach
	</div>
	<?php echo $findTrainers->render(); ?>
</div>
@endsection