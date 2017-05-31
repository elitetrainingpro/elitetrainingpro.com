<div class="navbar grad">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<img src="{{ URL::asset('assets/images/elitetrainingpro.png') }}" alt="No image found" height="50px" width="50px">
				<a class="icon-link" id="logo" href="/">Elite Training Pro</a>
			</div>
			<div class="col-sm-4 text-center">
				<h4 class="user-name">Trainer: 
					<span id="user_name">
						@if( Auth::check() )
						    {{ Auth::user()->name }}
						@endif
					</span>
					<a class="float-right" href="href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"">
						Logout <span class="glyphicon glyphicon-log-out"></span>
					</a>
				</h4>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
                </form>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<nav role="navigation" class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- Collection of nav links and other content for toggling -->
					<div id="navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a class="active" href="#"><i class="fa fa-home fa"></i>Athletes</a></li>
							<li><a href="#"><i class="fa fa-user fa"></i>Training Log</a></li>
							<li><a href="#"><i class="fa fa-map fa"></i>Calendar</a></li>
							<li><a href="#"><i class="fa fa-bolt fa"></i>Notifications</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                              

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
                    </ul>
                </div>