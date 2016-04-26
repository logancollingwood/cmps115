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
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/community">Community<span class="sr-only"></span></a></li>

                <!-- DROPDOWN FOR GRAPHS -->
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Champion Graphs <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/champhigh-wins">Highest Win Rate</a></li>
                            <li><a href="/champlow-wins">Lowest Win Rate</a></li>
                            <li><a href="/items">Popular Items and Builds</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/metachamps">Meta Champions</a></li>
                            <li><a href="/champbans">Champion Bans</a></li>
                        </ul>
                </li>
                <li><a id="playerProfile" href="/about">About</a></li>
                <!-- Streams and popular streams -->
                <li class ="dropdown">
                    <a href="/streams" class="dropdown-toggle" data-toggle="dropdown" role="button">Streams<span class="caret"></span></a>
                       <ul class="dropdown-menu">
                       <!-- To Do, we can either link to Twitch for now or /streams-->
                        <li><a href="/streams">Popular Streams</a></li>
                        <li role="separator" class="text">  <a><u>Quick Links</u></a></li>
                        <li><a href="https://www.twitch.tv/imaqtpie">Imaqtpie</a></li>
                        <li><a href="https://www.twitch.tv/c9sneaky">C9Sneaky</a></li>
                        <li><a href="https://www.twitch.tv/tsm_doublelift">Doublelift</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="https://www.twitch.tv/riotgames">Riot Games</a></li>
                       </ul>
                </li>
                </ul>
                </div>     
                <form>
                <div class="input-group">
                    <input id="username" type="text" class="form-control" placeholder="Search by Username...">  
                <select id="region">
                <option value"NA">North America </option>
                <option value"EUNE">Europe Nordic & East</option>
                <option value"EUW">Europe West </option>
                <option value"JP">Japan</option>
                <option value"BR">Brazil</option>
                <option value"KR">Korea</option>
                <option value"LAN">Latin America North</option>
                <option value"LAS">Latin America South</option>
                <option value"OCE">Oceanic</option>
                <option value"RU">Russia</option>
                <option value"TR">Turkey</option>
                </select>
                    <span class="input-group-btn">
                        <a id="search" href="#"><button class="btn btn-default" type="button">Go!</button></a>
                    </span>
             </form>
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
