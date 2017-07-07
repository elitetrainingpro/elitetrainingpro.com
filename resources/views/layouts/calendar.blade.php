@extends('layouts.default')

@section('title', '| Calendar')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
	<link rel='stylesheet' href="{{ URL::asset('assets/fullcalendar/fullcalendar.css') }}" /> 
	<style>
	.nav {
		margin-right: 0px;
	}
	</style>
@endsection

@section('scripts')
	<script src="{{ URL::asset('assets/fullcalendar/lib/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/fullcalendar/lib/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/fullcalendar/fullcalendar.js') }}"></script>
@endsection

@section('navlinks')
    <li><a class="active" href="athletecalendar"><i class="fa fa-map fa"></i>Calendar</a></li>
	<li><a href="goals"><i class="fa fa-home fa"></i>Goals</a></li>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="dropdown">
				<div class="dropdown-content" style="left:0;">
					<a href="#">Training</a>
					<a href="#">Notes</a>
				</div>
			</div>
			<button class="btn btn-default" data-toggle="modal" data-target="#addNote"> + Note</button>
		</div>
	</div>

	<!-- Training Modal -->
	<div class="modal fade" id="addTraining" role="dialog" tabindex="-1">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Training</h4>
				</div>
				<!--Training Tabs -->
				<ul class="nav nav-tabs" id="tabContent">
					<li class="active"><a href="#strength" data-toggle="tab">Strength</a></li>
					<li><a href="#endurance" data-toggle="tab">Endruance</a></li>
					<li><a href="#flexibility" data-toggle="tab">Flexibility</a></li>
					<li><a href="#balance" data-toggle="tab">Balance</a><li>
				</ul>
				<div class="modal-body">
					<div class="tab-content">
						<!-- Strength Tab in Modal-->
						<div class="tab-pane active" id="strength">
							@yield('strength')
						</div>
						<!-- Endruance Tab in Modal-->
						<div class="tab-pane" id="endurance">
							@yield('endurance')
						</div>
						<!-- Flexibility Tab in Modal-->
						<div class="tab-pane" id="flexibility">
							@yield('flexibility')
						</div>
						<!-- Balance Tab in Modal-->
						<div class="tab-pane" id="balance">
							@yield('balance')
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div> 
		</div>
	</div>

	<!-- Note Modal -->
	<div class="modal fade" id="addNote" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Note</h4>
				</div>
				<!--Notes Tabs -->
				<ul class="nav nav-tabs" id="tabContent">
					<li class="active"><a href="#training" data-toggle="tab">Training</a></li>
					<li><a href="#nutrition" data-toggle="tab">Nutrition</a></li>
					<li><a href="#medical" data-toggle="tab">Medical</a><li>
				</ul>
				<div class="modal-body">
					<div class="tab-content">
						<!-- Training Tab in Modal-->
						<div class="tab-pane active" id="training">
							@yield('trainingNotes')
						</div>
						<!-- Nutrition Tab in Modal-->
						<div class="tab-pane" id="nutrition">
							@yield('nutritionNotes')
						</div>
						<!-- Medical Tab in Modal-->
						<div class="tab-pane" id="medical">
							@yield('medicalNotes')
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div> 
		</div>
	</div>
</div>

<div id="calendar"></div>

<script>
$(document).ready(function() {
    var BASEURL = "{{ url('/') }}";
    $('#calendar').fullCalendar({
    	eventLimit: true, // for all non-agenda views
        views: {
            agenda: {
                eventLimit: 6 // adjust to 6 only for agendaWeek/agendaDay
            }
        },
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        navLinks: true,
        displayEventTime: false,
        editable: false,
        selectable: true,
        selectHelper: true,
        select: function(date){
           date = moment(date.format());
           $('input.date').val(date.format('YYYY-MM-DD'));
           jQuery.noConflict();
           $('#addTraining').modal('toggle');
        },
        events: BASEURL + '/events',
        eventSources: [{
		    events: [ // put the array in the `events` property
		    	@foreach($strengths as $strength)		    	
		        {
		            title  : <?php echo json_encode($strength->name); ?>,
				    data   : {
					    identity: 'strength',
				    	weight: <?php echo json_encode($strength->weight); ?>,
						reps: <?php echo json_encode($strength->reps); ?>,
						sets: <?php echo json_encode($strength->sets); ?>
				    },
		            start  : <?php echo json_encode($strength->date); ?>
		        },
		        @endforeach
		        @foreach($endurances as $endurance)		    	
		        {
		            title  : <?php echo json_encode($endurance->name); ?>,
				    data   : {
				    	identity: 'endurance',
				    	distance: <?php echo json_encode($endurance->distance); ?>,
						event_time: <?php echo json_encode($endurance->event_time); ?>
				    },
		            start  : <?php echo json_encode($endurance->date); ?>
		        },
		        @endforeach
		        @foreach($flexibilities as $flexibility)		    	
		        {
		            title  : <?php echo json_encode($flexibility->name); ?>,
				    data   : {
				    	identity: 'flexibility',
				    	time: <?php echo json_encode($flexibility->time); ?>,
						sets: <?php echo json_encode($flexibility->sets); ?>
				    },
		            start  : <?php echo json_encode($flexibility->date); ?>
		        },
		        @endforeach
		        @foreach($balances as $balance)		    	
		        {
		            title  : <?php echo json_encode($balance->name); ?>,
				    data   : {
				    	identity: 'flexibility',
				    	time: <?php echo json_encode($balance->time); ?>,
						sets: <?php echo json_encode($balance->sets); ?>
				    },
		            start  : <?php echo json_encode($balance->date); ?>
		        },
		        @endforeach
		        @foreach($notes as $note)		    	
		        {
		            title  : <?php echo json_encode($note->name); ?>,
				    data   : {
				    	identity: 'notes',
				    	notes: <?php echo json_encode($note->notes); ?>,
				    },
		            start  : <?php echo json_encode($note->date); ?>
		        },
		        @endforeach
		        
		    ],
		    color: '#127c96',     // an option!
		    textColor: '#efefef' // an option!
		}],
		
	    eventClick: function(event) {
		    if (event.data.identity == 'strength') {
		        alert('Workout: ' + event.title + '\n' + 'Weight: ' + event.data.weight + '\n' + 'Reps: ' + event.data.reps + '\n' + 'Sets: ' + event.data.sets);
			} else if (event.data.identity == 'endurance') {
		        alert('Workout: ' + event.title + '\n' + 'Distance: ' + event.data.distance + '\n' + 'Event Time: ' + event.data.event_time + '\n');
			} else if (event.data.identity == 'flexibility') {
		        alert('Workout: ' + event.title + '\n' + 'Time: ' + event.data.time + '\n' + 'Sets: ' + event.data.sets + '\n');
			} else if (event.data.identity == 'flexibility') {
		        alert('Workout: ' + event.title + '\n' + 'Time: ' + event.data.time + '\n' + 'Sets: ' + event.data.sets + '\n');
			} else if (event.data.identity == 'notes') {
		        alert('Title: ' + event.title + '\n' + 'Note: ' + event.data.notes + '\n');
			}

	    }
	});
});
</script>
@endsection