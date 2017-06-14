@extends('layouts.default')

@section('title', '| Bio')

@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/header.css') }}"></link>
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

@section('content')
<div class="container">
	<div class="row">
		{!! Form::open(['route' => 'bios.store', 'data-parsley-validate' => '', 'files' => true]) !!}
			{{ Form::label('image', 'Upload Image (Less than 2 MB):') }}
			{{ Form::file('image') }}
		    {{ Form::label('city', 'City') }}
		    {{ Form::text('city', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
		    
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
			], null, ['required']) }}<br/>
			{{ Form::label('bio', 'Bio') }}
			{{ Form::textarea('bio', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '191']) }}
			{{ Form::label('identity', 'Role') }}
			{{ Form::select('identity',[
			    'Identity' => [
			    				null => 'Please Select',
								'Athlete' => 'Athlete',
								'Coach' => 'Coach',
							],
			], null, ['required']) }}
			{{ Form::submit('Submit') }}
		{!! Form::close() !!}
	</div>
</div>
@endsection