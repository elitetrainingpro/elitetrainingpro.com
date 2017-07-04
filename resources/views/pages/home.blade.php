@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/homepage.css') }}"></link>
@endsection

@section('navlinks')
	<li><a href="athletes"><i class="fa fa-home fa"></i>Athletes</a></li>
    <li><a href="coachcalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
    <li><a href="notifications"><i class="fa fa-bolt fa"></i>Notifications</a></li>
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
			<div id="athlete">
				@if(count($athletes)>=1)
					<h3>Your Athletes</h3>
					
					<?php $index = sizeof($athletes)-count($athletes); ?>
					@foreach($athletes as $athlete)
						<div id="Profile">
			    			<div id="Lefts">
			      				<div id="Photo"> <img src="{{ URL::asset('assets/avatars/uploads/' . $athlete[$index]->image) }}" alt="No image found" height="80px" width="80px"> </div><br/>
			      				<!-- Have to index +1 because merged two together -->
			      				<div>{{ $athlete[$index+1]->name }}</div>
			   				 </div>

			   				 <div id="Infos">
								<!-- Have to index by the size of the array and offset by the count -->
								<p><span> {{ $athlete[$index]->email }} </span></p>
								<p><span> {{ $athlete[$index]->city }}, {{ $athlete[$index]->state }} </span></p>
								<p> <span> {{ substr(strip_tags($athlete[$index]->bio),0, 300) }}{{ strlen(strip_tags($bio->bio)) > 150 ? "..." : "" }} </span></p>
							</div>
							<div style="clear:both"></div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
