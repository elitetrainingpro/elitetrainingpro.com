@extends('layouts.default')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="dropdown">
				<button class="btn btn-black">Logs</button>
				<div class="dropdown-content" style="left:0;">
					<a href="#">Training</a>
					<a href="#">Notes</a>
				</div>
			</div>
			<button class="btn btn-default" data-toggle="modal" data-target="#addTraining"> + Training </button>
			<button class="btn btn-default" data-toggle="modal" data-target="#addNote"> + Note</button>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<h1>Calendar</h1>
		</div>
	</div>

	<!-- Training Modal -->
	<div class="modal fade" id="addTraining" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Training</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
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
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div> 
		</div>
	</div>
</div>
@endsection