<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="/">
        <title>LoLStats</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.js"></script>
        <script src="https://code.angularjs.org/1.5.3/angular-route.js"></script>
        <script src="{{ asset('/js/factories/dataFactory.js') }}"></script>
        <script src="{{ asset('/js/controllers/homeCtrl.js') }}"></script>
        <script src="{{ asset('/js/controllers/playerCtrl.js') }}"></script>
        <script src="{{ asset('/js/routes.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}"></script>

        <style>
            .input-group {
                width: 70%;
                padding-left: 30%;
            }
            .jumbotron p {
                font-weight: 400;
            }
            .sumName {
                margin: 2em 0;
                letter-spacing: 1em;
                text-transform: uppercase;
                font-size: 1em;
                padding-left: 1em;
            }
            .error {
                text-align: center;
            }
            .error-title {
                font-size: 72px;
                font-weight: 600;
                letter-spacing: .2em;
            }
            .error-subtitle {
                font-size: 20px;
            }
        </style>
    </head>
    <body ng-app="myApp" ng-controller="HomeController">
        <div class="container">

            <!-- HEADER -->
            <nav class="navbar navbar-inverse">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Home</a>
                </div>

                <!-- LINK TO OUR PAGES. ANGULAR HANDLES THE ROUTING HERE -->
                <ul class="nav navbar-nav">
                    <li><a id="playerProfile" href="/about">About</a></li>
                </ul>

                <div class="input-group">
                <input id="username" type="text" class="form-control" placeholder="Search by Username...">
                <span class="input-group-btn">
                <a id="search" href="#"><button class="btn btn-default" type="button">Go!</button></a>
                </span>
                </div><!-- /input-group -->
            </nav>

            <!-- ANGULAR DYNAMIC CONTENT -->
            <div ng-view></div>

        </div>
    </body>
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
    <script src="https://fb.me/react-0.14.8.min.js"></script>
    <script src="https://fb.me/react-dom-0.14.8.min.js"></script>
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <!-- Built React -->
    <script src="{{ asset('/js/build/build.min.js') }}"></script>
</html>
