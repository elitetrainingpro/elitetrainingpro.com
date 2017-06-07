@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
@endsection

@section('navlinks')
	<li><a href="athletes"><i class="fa fa-home fa"></i>Athletes</a></li>
    <li><a href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
    <li><a href="notifications"><i class="fa fa-bolt fa"></i>Notifications</a></li>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1>This is the home page.</h1>
		</div>
	</div>
</div>
@endsection
