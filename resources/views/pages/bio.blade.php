@extends('layouts.app')

@section('title', '| Bio')

@section('stylesheets')
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/homie.css') }}" rel="stylesheet">
@endsection

@section('scripts')
 {!! Html::script('assets/js/parsley.min.js') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=rmgyrwthrrr2h5weft0b1mllmieqrg3hmdrsg58sym44ure3"></script>
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'link',
        menubar: false
        });
    </script>
@endsection

@section('navbar')
	<nav class="navbar navbar-default navbar-static-top">
	    <div class="container">
	        <div class="navbar-header">
	            <!-- Branding Image -->
					<h4 class="icon-style"><img src="{{ URL::asset('assets/images/etp.png') }}" alt="No image found" height="45px" width="45px">
					<a class="icon-link" href="home">Elite Training Pro</a></h4>
	        </div>
	    </div>
	</nav>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8  col-md-offset-2">
			<h3>Tell Us About Yourself</h3>
			<hr>
				{!! Form::open(['route' => 'bios.store', 'data-parsley-validate' => '', 'files' => true]) !!}

				{{ Form::label('image', 'Upload Image (Less than 2 MB):') }}
				{{ Form::file('image') }} <br/>

				{{ Form::label('bio', 'Bio') }}
				{{ Form::textarea('bio', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }} <br/>

			    {{ Form::label('city', 'City') }}
			    {{ Form::text('city', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}<br/>
			    <div class="col-sm-6">
			    {{ Form::label('state', 'State') }}
			    {{ Form::select('state',[
				    'States' => [
				    				null => 'Please Select',
									'AL' => 'Alabama',
									'AK' => 'Alaska',
									'AZ' => 'Arizona',
									'AR' => 'Arkansas',
									'CA' => 'California',
									'CO' => 'Colorado',
									'CT' => 'Connecticut',
									'DE' => 'Delaware',
									'DC' => 'District Of Columbia',
									'FL' => 'Florida',
									'GA' => 'Georgia',
									'HI' => 'Hawaii',
									'ID' => 'Idaho',
									'IL' => 'Illinois',
									'IN' => 'Indiana',
									'IA' => 'Iowa',
									'KS' => 'Kansas',
									'KY' => 'Kentucky',
									'LA' => 'Louisiana',
									'ME' => 'Maine',
									'MD' => 'Maryland',
									'MA' => 'Massachusetts',
									'MI' => 'Michigan',
									'MN' => 'Minnesota',
									'MS' => 'Mississippi',
									'MO' => 'Missouri',
									'MT' => 'Montana',
									'NE' => 'Nebraska',
									'NV' => 'Nevada',
									'NH' => 'New Hampshire',
									'NJ' => 'New Jersey',
									'NM' => 'New Mexico',
									'NY' => 'New York',
									'NC' => 'North Carolina',
									'ND' => 'North Dakota',
									'OH' => 'Ohio',
									'OK' => 'Oklahoma',
									'OR' => 'Oregon',
									'PA' => 'Pennsylvania',
									'RI' => 'Rhode Island',
									'SC' => 'South Carolina',
									'SD' => 'South Dakota',
									'TN' => 'Tennessee',
									'TX' => 'Texas',
									'UT' => 'Utah',
									'VT' => 'Vermont',
									'VA' => 'Virginia',
									'WA' => 'Washington',
									'WV' => 'West Virginia',
									'WI' => 'Wisconsin',
									'WY' => 'Wyoming',
								],
				], null, ['required']) }}
				</div>
				
				<div class="col-sm-6"">
				{{ Form::label('identity', 'Role') }}
				{{ Form::select('identity',[
				    'Identity' => [
				    				null => 'Please Select',
									'Athlete' => 'Athlete',
									'Coach' => 'Trainer',
								],
				], null, ['required']) }}
				<br/><br/>
				</div>
				{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-lg btn-block']) }}
				<br/>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection