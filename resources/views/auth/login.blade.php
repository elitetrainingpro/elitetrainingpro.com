@extends('layouts.app')

@section('stylesheets')
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/homie.css') }}" rel="stylesheet">
@endsection

@section('scripits')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('navbar')
	<nav class="navbar navbar-default navbar-static-top">
	    <div class="container">
	        <div class="navbar-header">
	
	            <!-- Collapsed Hamburger -->
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
	                <span class="sr-only">Toggle Navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	
	            <!-- Branding Image -->
	            <a class="navbar-brand" href="{{ url('/') }}">
	                {{ config('app.name', 'Elite Training Pro') }}
	            </a>
	        </div>
	
	        <div class="collapse navbar-collapse" id="app-navbar-collapse">
	            <!-- Left Side Of Navbar -->
	            <ul class="nav navbar-nav">
	                &nbsp;
	            </ul>
	
	            <!-- Right Side Of Navbar -->
	            <ul class="nav navbar-nav navbar-right">
	                <!-- Authentication Links -->
	                @if (Auth::guest())
	                <li><a data-toggle="modal" data-target="#login" href="#login">Login</a></li>
	                <li><a data-toggle="modal" data-target="#create" href="#create">Register</a></li>
	                @else
	                <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                        {{ Auth::user()->name }}<span class="caret"></span>
	                    </a>
	
	                    <ul class="dropdown-menu" role="menu">
	                        <li>
	                            <a href="{{ route('logout') }}"
	                                onclick="event.preventDefault();
	                                document.getElementById('logout-form').submit();">
	                                Logout
	                            </a>
	
	                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                {{ csrf_field() }}
	                            </form>
	                        </li>
	                    </ul>
	                </li>
	                @endif
	            </ul>
	        </div>
	    </div>
	</nav>
@endsection

@section('content')
<!-- Login Stuff Begins-->
<div class="modal fade" id="login" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">Login</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="POST"
					action="{{ route('login') }}">
					{{ csrf_field() }}

					<div
						class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email" class="col-md-4 control-label">E-Mail Address</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> 
								@if($errors->has('email')) 
								<span class="help-block">
									<strong>{{$errors->first('email') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div
						class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="col-md-4 control-label">Password</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control"
								name="password" required> @if ($errors->has('password')) <span
								class="help-block"> <strong>{{ $errors->first('password') }}</strong>
							</span> @endif
						</div>
					</div>

<!-- 					<div class="form-group"> -->
<!-- 						<div class="col-md-6 col-md-offset-4"> -->
<!-- 							<div class="checkbox"> -->
<!-- 								<label> <input type="checkbox" name="remember"{{ old('remember') ? 'checked' : '' }}> -->
<!-- 									Remember Me -->
<!-- 								</label> -->
<!-- 							</div> -->
<!-- 						</div> -->
<!-- 					</div> -->

					<div class="form-group">
						<div class="col-md-8 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Login</button>
<!-- 							<a class="btn btn-link" href="{{ route('password.request') }}"> -->
<!-- 								Forgot Your Password? </a> -->
								<a class="btn btn-link" id="member">Not a member?</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Login Stuff Ends-->

<div class="modal fade" id="create" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">Register</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="POST"
					action="{{ route('register') }}">
					{{ csrf_field() }}
					<div
						class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="col-md-4 control-label">Name</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus> 
							@if($errors->has('name')) 
								<span class="help-block"> 
									<strong>{{$errors->first('name') }}</strong>
								</span> 
							@endif
						</div>
					</div>
					<div
						class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email" class="col-md-4 control-label">E-Mail Address</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control" name="email"
								value="{{ old('email') }}" required> @if ($errors->has('email'))
							<span class="help-block"> <strong>{{ $errors->first('email') }}</strong>
							</span> @endif
						</div>
					</div>

					<div
						class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="col-md-4 control-label">Password</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control"
								name="password" required> @if ($errors->has('password')) <span
								class="help-block"> <strong>{{ $errors->first('password') }}</strong>
							</span> @endif
						</div>
					</div>

					<div class="form-group">
						<label for="password-confirm" class="col-md-4 control-label">Confirm
							Password</label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control"
								name="password_confirmation" required>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Register</button>
							<a class="btn btn-link" id="already">Already a member?</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- <nav class="navbar navbar-default navbar-fixed-top"> -->
<!--   <div class="container"> -->
<!--     <div class="navbar-header"> -->
<!--       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> -->
<!--         <span class="icon-bar"></span> -->
<!--         <span class="icon-bar"></span> -->
<!--         <span class="icon-bar"></span>                         -->
<!--       </button> -->
<!--       <a class="navbar-brand" href="#myPage">Logo</a> -->
<!--     </div> -->
<!--     <div class="collapse navbar-collapse" id="myNavbar"> -->
<!--       <ul class="nav navbar-nav navbar-right"> -->
<!--         <li><a href="#about">ABOUT</a></li> -->
<!--         <li><a href="#services">SERVICES</a></li> -->
<!--         <li><a href="#portfolio">PORTFOLIO</a></li> -->
<!--         <li><a href="#pricing">PRICING</a></li> -->
<!--         <li><a href="#contact">CONTACT</a></li> -->
<!--       </ul> -->
<!--     </div> -->
<!--   </div> -->
<!-- </nav> -->

<!-- <div class="jumbotron text-center"> -->
<!--   <h1>Company</h1>  -->
<!--   <p>We specialize in blablabla</p> -->
<!-- </div> -->

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Elite Training Pro</h2>
      <p>
      	Elite Training Pro allows for athletes and trainers to connect in such way that it results in better 
      	communication and more efficient training. ETP allows for athletes to keep track of their daily activities, while giving
      	the trainer a central location to keep track of all their athletes, and provide a more efficent way for them to provide feedback
      	about an athlete's activities.
      </p>
      <p>
      	Athletes can set goals, keep track of their daily activities, and make notes for the trainer to see. Trainers are then able to
      	view all the athletes data, and provide feedback to the athlete. This will help to provide the best personalized training 
      	for the athlete, while providing a central location of all the athletes a trainer may have.
      </p>
    </div>
    <div class="col-sm-4">
      	<img src="{{ URL::asset('assets/images/etp.png') }}" alt="No image found" height="300px" width="300px">
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      	<img src="{{ URL::asset('assets/images/values.png') }}" alt="No image found" height="300px" width="300px">
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2>
      <h4><strong>MISSION:</strong> Our mission is to bridge the gap between the athlete and trainer, allowing the best possible training for the athlete.</h4><br>
      <p><strong>VISION:</strong>
      Our vision is to provide the tools to athletes and trainers that will provide the best training for the athlete, and make the job of the trainer to be more 
      efficient. We strive to see our athletes achieve their goals, and our products do just that.
      </p>
    </div>
  </div>
</div>

<!-- Container (Services Section) -->
<!-- <div id="services" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-off logo-small"></span>
      <h4>POWER</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>LOVE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>JOB DONE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h4>GREEN</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>CERTIFIED</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4 style="color:#303030;">HARD WORK</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
  </div>
</div> -->

<!-- Container (Portfolio Section) -->
<!-- <div id="portfolio" class="container-fluid text-center bg-grey">
  <h2>Portfolio</h2><br>
  <h4>What we have created</h4>
  <div class="row text-center slideanim">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="paris.jpg" alt="Paris" width="400" height="300">
        <p><strong>Paris</strong></p>
        <p>Yes, we built Paris</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="newyork.jpg" alt="New York" width="400" height="300">
        <p><strong>New York</strong></p>
        <p>We built New York</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="sanfran.jpg" alt="San Francisco" width="400" height="300">
        <p><strong>San Francisco</strong></p>
        <p>Yes, San Fran is ours</p>
      </div>
    </div>
  </div><br> -->
  
  <h2>What our customers say</h2>
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"This company is the best. I am so happy with the result!"<br><span>Michael Roe, Vice President, Comment Box</span></h4>
      </div>
      <div class="item">
        <h4>"One word... WOW!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
      </div>
      <div class="item">
        <h4>"Could I... BE any more happy with this company?"<br><span>Chandler Bing, Actor, FriendsAlot</span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Container (Pricing Section) -->
<!-- <div id="pricing" class="container-fluid"> -->
<!--   <div class="text-center"> -->
<!--     <h2>Pricing</h2> -->
<!--     <h4>Choose a payment plan that works for you</h4> -->
<!--   </div> -->
<!--   <div class="row slideanim"> -->
<!--     <div class="col-sm-4 col-xs-12"> -->
<!--       <div class="panel panel-default text-center"> -->
<!--         <div class="panel-heading"> -->
<!--           <h1>Basic</h1> -->
<!--         </div> -->
<!--         <div class="panel-body"> -->
<!--           <p><strong>20</strong> Lorem</p> -->
<!--           <p><strong>15</strong> Ipsum</p> -->
<!--           <p><strong>5</strong> Dolor</p> -->
<!--           <p><strong>2</strong> Sit</p> -->
<!--           <p><strong>Endless</strong> Amet</p> -->
<!--         </div> -->
<!--         <div class="panel-footer"> -->
<!--           <h3>$19</h3> -->
<!--           <h4>per month</h4> -->
<!--           <button class="btn btn-lg">Sign Up</button> -->
<!--         </div> -->
<!--       </div>       -->
<!--     </div>      -->
<!--     <div class="col-sm-4 col-xs-12"> -->
<!--       <div class="panel panel-default text-center"> -->
<!--         <div class="panel-heading"> -->
<!--           <h1>Pro</h1> -->
<!--         </div> -->
<!--         <div class="panel-body"> -->
<!--           <p><strong>50</strong> Lorem</p> -->
<!--           <p><strong>25</strong> Ipsum</p> -->
<!--           <p><strong>10</strong> Dolor</p> -->
<!--           <p><strong>5</strong> Sit</p> -->
<!--           <p><strong>Endless</strong> Amet</p> -->
<!--         </div> -->
<!--         <div class="panel-footer"> -->
<!--           <h3>$29</h3> -->
<!--           <h4>per month</h4> -->
<!--           <button class="btn btn-lg">Sign Up</button> -->
<!--         </div> -->
<!--       </div>       -->
<!--     </div>        -->
<!--     <div class="col-sm-4 col-xs-12"> -->
<!--       <div class="panel panel-default text-center"> -->
<!--         <div class="panel-heading"> -->
<!--           <h1>Premium</h1> -->
<!--         </div> -->
<!--         <div class="panel-body"> -->
<!--           <p><strong>100</strong> Lorem</p> -->
<!--           <p><strong>50</strong> Ipsum</p> -->
<!--           <p><strong>25</strong> Dolor</p> -->
<!--           <p><strong>10</strong> Sit</p> -->
<!--           <p><strong>Endless</strong> Amet</p> -->
<!--         </div> -->
<!--         <div class="panel-footer"> -->
<!--           <h3>$49</h3> -->
<!--           <h4>per month</h4> -->
<!--           <button class="btn btn-lg">Sign Up</button> -->
<!--         </div> -->
<!--       </div>       -->
<!--     </div>     -->
<!--   </div> -->
<!-- </div> -->

<!-- Container (Contact Section) -->
<!-- <div id="contact" class="container-fluid bg-grey"> -->
<!--   <h2 class="text-center">CONTACT</h2> -->
<!--   <div class="row"> -->
<!--     <div class="col-sm-5"> -->
<!--       <p>Contact us and we'll get back to you within 24 hours.</p> -->
<!--       <p><span class="glyphicon glyphicon-map-marker"></span> Chicago, US</p> -->
<!--       <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p> -->
<!--       <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p> -->
<!--     </div> -->
<!--     <div class="col-sm-7 slideanim"> -->
<!--       <div class="row"> -->
<!--         <div class="col-sm-6 form-group"> -->
<!--           <input class="form-control" id="name" name="name" placeholder="Name" type="text" required> -->
<!--         </div> -->
<!--         <div class="col-sm-6 form-group"> -->
<!--           <input class="form-control" id="email" name="email" placeholder="Email" type="email" required> -->
<!--         </div> -->
<!--       </div> -->
<!--       <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br> -->
<!--       <div class="row"> -->
<!--         <div class="col-sm-12 form-group"> -->
<!--           <button class="btn btn-default pull-right" type="submit">Send</button> -->
<!--         </div> -->
<!--       </div> -->
<!--     </div> -->
<!--   </div> -->
<!-- </div> -->

<script>
$(document).ready(function(){
    $("#member").click(function(){
        $("#create").modal();
        $('#login').modal('toggle');
    });$("#already").click(function(){
        $("#login").modal();
        $("#create").modal('toggle');
    });
});
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
@endsection
