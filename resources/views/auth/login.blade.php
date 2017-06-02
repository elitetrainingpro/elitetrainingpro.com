@extends('layouts.app')

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

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<div class="checkbox">
								<label> <input type="checkbox" name="remember"{{ old('remember') ? 'checked' : '' }}>
									Remember Me
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Login</button>

							<a class="btn btn-link" href="{{ route('password.request') }}">
								Forgot Your Password? </a>
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
      <h2>About Company Page</h2><br>
      <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <br><button class="btn btn-default btn-lg">Get in Touch</button>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2><br>
      <h4><strong>MISSION:</strong> Our mission lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
      <p><strong>VISION:</strong> Our vision Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
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
</div>

<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">
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
  </div><br>
  
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

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Bootstrap Theme Made By <a href="https://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a></p>
</footer>

<script>
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
