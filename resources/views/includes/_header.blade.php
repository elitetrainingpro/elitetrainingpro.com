<div class="navbar grad">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-6 icon">
					<h4 class="icon-style"><img src="{{ URL::asset('assets/images/elitetrainingpro.png') }}" alt="No image found" height="50px" width="50px">
					Elite Training Pro</h4>
				</div>
				<div class="col-sm-6 nav">
					<h4 class="icon-style">@if( Auth::check() )
						{{ Auth::user()->name }}
						@endif
						<div class="dropdown">
							<img class="dropdown-toggle" type="button" data-toggle="dropdown" src="{{ URL::asset('assets/images/Hamburger_icon.png') }}" alt="No image found" height="50px" width="50px">
							<ul class="dropdown-menu">
								@yield('navlinks')
								<li>
									<a href="href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"">
										Logout <span class="glyphicon glyphicon-log-out"></span>
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</div>
					</h4>
				</div>
			</div>
		</div>
	</div>
</div>