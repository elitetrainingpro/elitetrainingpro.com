@extends('layouts.default')

@section('title', '| Notifications')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
@endsection

@section('navlinks')
	<li><a href="athletes"><i class="fa fa-home fa"></i>Athletes</a></li>
    <li><a href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
    <li><a class="active" href="notifications"><i class="fa fa-bolt fa"></i>Notifications</a></li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Notifications</div>

                <div class="panel-body">
                    You are on the notifications page!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection