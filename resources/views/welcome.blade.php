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
      <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.js"></script>

      <script src="https://code.angularjs.org/1.5.3/angular-route.js"></script>
      <script src="{{ asset('/js/factories/dataFactory.js') }}"></script>
      <script src="{{ asset('/js/controllers/homeCtrl.js') }}"></script>
      <script src="{{ asset('/js/controllers/playerCtrl.js') }}"></script>
      <script src="{{ asset('/js/controllers/matchCtrl.js') }}"></script>
      <script src="{{ asset('/js/controllers/chartCtrl.js') }}"></script>
      <script src="{{ asset('/js/directives/chart.js') }}"></script>
      <script src="{{ asset('/js/routes.js') }}"></script>
      <script src="{{ asset('/js/app.js') }}"></script>
   </head>
   <body ng-app="myApp" ng-controller="HomeController">
      <nav class="navbar navbar-default navbar-fixed-top">
               <div class="navbar-header">
                  <a class="navbar-brand" href="/">LoLStats</a>
               </div>
               <!-- LINK TO OUR PAGES. ANGULAR HANDLES THE ROUTING HERE -->
               <div class="collapse navbar-collapse" id="navbar-collapse">
                  <ul class="nav navbar-nav">
                     <li><a href="/community">Community</a></li>
                     <!-- DROPDOWN FOR GRAPHS -->
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Champion Graphs <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="/yourstats">Your Stats Graphed</a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="/champhigh-wins">Highest Win Rate</a></li>
                           <li><a href="/champlow-wins">Lowest Win Rate</a></li>
                           <li><a href="/items">Popular Items and Builds</a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="/metachamps">Meta Champions</a></li>
                           <li><a href="/champbans">Champion Bans</a></li>
                        </ul>
                     </li>
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
                     <li><a id="playerProfile" href="/about">About</a></li>
                  </ul>
                  <div class="col-sm-5 col-md-5 pull-right">
                     <div id="searchInput" class="input-group">
                           <input id="username" type="text" class="form-control" aria-label="Search by Username..." placeholder="Search by Username..."> 
                           <div class="input-group-btn">
                              <select id="region" class="dropdown-menu dropdown-menu-right">
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
                              <ul class="dropdown-menu dropdown-menu-right">
                                 <li><a href="#">NA</a></li>
                                 <li><a href="#">EU</a></li>
                                 <li><a href="#">EUW</a></li>
                                 <li><a href="#">Japan</a></li>
                                 <li><a href="#">Brazil</a></li>
                                 <li><a href="#">Korea</a></li>
                                 <li><a href="#">LAN</a></li>
                                 <li><a href="#">LAS</a></li>
                                 <li><a href="#">OCE</a></li>
                                 <li><a href="#">RUS</a></li>
                                 <li><a href="#">TUR</a></li>
                              </ul>
                              <button id="search" type="button" class="btn btn-default">SEARCH</button> <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> 
                           </div>
                        </div>
                     </div>
               </div>
               

            </nav>
      <div class="container">
         <!-- HEADER -->
         
         <!-- ANGULAR DYNAMIC CONTENT -->
         <div ng-view></div>
      </div>
   </body>
   <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
   
   <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.6/socket.io.min.js"></script>  
<!--    <script>  
      var socket = io.connect("http://localhost");
      
      socket.on("connect", function () {  
         console.log("Connected!");
      });
   </script>  -->
   <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
</html>