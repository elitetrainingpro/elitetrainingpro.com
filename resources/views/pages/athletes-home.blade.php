@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/homepage.css') }}"></link>
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
			<h1>Welcome {{ Auth::user()->name }}</h1>

			<div id="ProfilePage">
			    <div id="LeftCol">
			        <div id="Photo"> <img src="{{ URL::asset('assets/avatars/uploads/' . $bio->image) }}" alt="No image found" height="200px" width="200px"> </div>
			    </div>

			    <div id="Info">
			       <p>
		        		<strong>Role</strong>
		        		<span>{{ $bio->identity }}</span>
		        	</p>
			        <p>
			            <strong>Email:</strong>
						<span>{{ $bio->email }}</span>
					</p>
					<p>
						<strong>City, State:</strong>
						<span>{{ $bio->city }}, {{ $bio->state }}</span>
					</p>
					<p>
						<strong>About Me:</strong>
						<span>{{ substr(strip_tags($bio->bio),0, 300) }}{{ strlen(strip_tags($bio->bio)) > 150 ? "..." : ""}}</span>
			        </p>
			    </div>
			    <!-- Elements inside ProfilePage have floats -->
			    <div style="clear:both"></div>
			</div>
			
			<div id="trainer">
				<a class="btn btn-primary" href="findtrainer">Find Trainer</a>
			</div>
		</div>
	</div>
</div>
@endsection
