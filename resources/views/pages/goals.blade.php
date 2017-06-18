@extends('layouts.default')

@section('title', '| Home')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/goals.css') }}"></link>
@endsection

@section('navlinks')
    <li><a href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
	<li><a class="active" href="goals"><i class="fa fa-home fa"></i>Goals</a></li>
    <li><a href="schedule"><i class="fa fa-map fa"></i>Schedule</a></li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="dropdown">
				<div class="dropdown-content" style="left:0;">
					<a href="#">Training</a>
					<a href="#">Notes</a>
				</div>
			</div>
			<button class="btn btn-default" data-toggle="modal" data-target="#addGoal"> + Goal </button>
        </div>
        <!-- Add Goal Modal -->
		<div class="modal fade" id="addGoal" role="dialog">
			<div class="modal-dialog">
	
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Goal</h4>
					</div>
					<div class="modal-body">
						<div class="tab">
						  <button class="tablinks" onclick="openCity(event, 'Endurance')" id="defaultOpen">Endurance</button>
						  <button class="tablinks" onclick="openCity(event, 'Flexibility')">Flexibility</button>
						  <button class="tablinks" onclick="openCity(event, 'Strength')">Strength</button>
						  <button class="tablinks" onclick="openCity(event, 'Balance')">Balance</button>
						</div>
						
						<div id="Endurance" class="tabcontent">
						  <span onclick="this.parentElement.style.display='none'" class="topright">x</span>
						  <h3>Endurance</h3>
						  <p>Endurance</p>
						</div>
						
						<div id="Flexibility" class="tabcontent">
						  <span onclick="this.parentElement.style.display='none'" class="topright">x</span>
						  <h3>Flexibility</h3>
						  <p>Flexibility</p> 
						</div>
						
						<div id="Strength" class="tabcontent">
						  <span onclick="this.parentElement.style.display='none'" class="topright">x</span>
						  <h3>Strength</h3>
						  <p>Strength</p>
						</div>
						
						<div id="Balance" class="tabcontent">
						  <span onclick="this.parentElement.style.display='none'" class="topright">x</span>
						  <h3>Balance</h3>
						  <p>Balance</p>
						</div>
						
						<script>
							function openCity(evt, cityName) {
							    var i, tabcontent, tablinks;
							    tabcontent = document.getElementsByClassName("tabcontent");
							    for (i = 0; i < tabcontent.length; i++) {
							        tabcontent[i].style.display = "none";
							    }
							    tablinks = document.getElementsByClassName("tablinks");
							    for (i = 0; i < tablinks.length; i++) {
							        tablinks[i].className = tablinks[i].className.replace(" active", "");
							    }
							    document.getElementById(cityName).style.display = "block";
							    evt.currentTarget.className += " active";
							}
							
							// Get the element with id="defaultOpen" and click on it
							document.getElementById("defaultOpen").click();
						</script>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div> 
			</div>
		</div>
    </div>
</div>
@endsection