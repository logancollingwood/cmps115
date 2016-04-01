<!--

CMPS 115 eSports

-->

<!com html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>eSports</title>

	<!-- contains minified Twitter Bootstrap -->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans|Quicksand|Advent+Pro|Roboto:400,300' rel='stylesheet' type='text/css'>
	<!-- new fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato|Work+Sans|Roboto' rel='stylesheet' type='text/css'>
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	
	<link rel='shortcut icon' href="{{ asset('/img/assets/favicon.ico') }}">
		
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	@if (Auth::check()) 
		<nav class="navbar navbar-default navbar-fixed-top hidden-xs hidden-md">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
	@endif
	
	<div class="container" id="content">
		<div class="row">
			<div class="col-sm-2 col-md-2" id="sidebar">
				<div id="sidebarBrand" style="display: none;">
					<h1> <a href="{{ url('/') }}"> esp </a> </h1>
				</div>
				<ul>
					<li class="{{ Request::path() == '/' ? 'active' : ''}}"><a href="{{ url('/') }}">Home</a></li>
					<li class="{{ strpos(Request::path(), 'techs') === 0 ? 'active' : ''}}">
						<a href="{{url('/techs/')}}" data-target="#techs">Techniques</a>
					</li>
					<li class="{{ strpos(Request::path(), 'chars') === 0 ? 'active' : ''}}"><a href="{{ url('/chars') }}">Characters</a></li>
					<!-- <li class="{{ strpos(Request::path(), 'guides') === 0 ? 'active' : ''}}"><a href="{{ url('/guides') }}">Guides</a></li> -->
					<li class="{{ strpos(Request::path(), 'vods') === 0 ? 'active' : ''}}"><a href="{{ url('/vods') }}">Videos</a></li>

					<li class="hidden-xs {{ strpos(Request::path(), 'groups') === 0 ? 'active' : ''}}"><a href="{{ url('/groups') }}">Groups</a></li>

					<li class="two-column">
						<a class="hidden-xs border-right {{ strpos(Request::path(), 'submit') === 0 ? 'active' : ''}}"href="{{ url('/submit') }}">Submit</a>
						<a class="hidden-xs {{ strpos(Request::path(), 'api') === 0 ? 'active' : ''}}" href="{{ url('/api/doc') }}">API</a>
					</li>
					

					<li class="hidden-sm hidden-md hidden-lg">
						<a><i class="fa fa-list fa-1x"></i></a>
        			</li>

				</ul>
			</div>
			<div class="col-sm-10 col-md-10 m-scene" id="main">
				@yield('content')
				<footer>
						<div class="row">
							<div class="col-xs-3 col-sm-6">
								 <i class="fa fa-heart-o hvr-pop heart"></i><a href="/about"> tsl</a>
							</div>
							<div class="col-xs-9 col-sm-6">
								<ul>
									<li>
										<a href="/about">about</a>
									</li>
									<li>
										<a href="/donate">support</a>
									</li>
									<li>
										<a href="mailto:smashlounge@gmail.com"><i class="fa fa-envelope fa"></i></a>
									</li>
									<li>
										<a href="https://www.twitter.com/thesmashlounge"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="https://www.facebook.com/smashlounge"><i class="fa fa-facebook"></i></a>
									</li>
								</ul>
							</div>
						</div>
				</footer>
			</div>
		</div>
	</div>
	
	<!-- Scripts -->
	<!-- Latest compiled and minified jQuery -->
	<script   src="https://code.jquery.com/jquery-2.2.2.min.js" 
		integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="   
		crossorigin="anonymous">
	</script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
		integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" 
		crossorigin="anonymous">
	</script>
	
	<!-- application minified js -->
	<script src="{{ asset('/js/compiled/app.js') }}"></script>
	

	

	@yield('includes')
	
	<!-- Google Analytics -->
	<script>
	  

	</script>
</body>
</html>
