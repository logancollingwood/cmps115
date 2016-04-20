@extends('app')

@section('content')

	<script type="text/javascript">
		var mydate= new Date()
		var theyear=mydate.getFullYear()
		var themonth=mydate.getMonth()+1
		var thetoday=mydate.getDate()
		document.write("Today's date is: ")
		document.write(themonth+"/"+thetoday+"/"+theyear)
		var thetime=mydate.toLocaleTimeString()
		document.write(" Time: ")
		document.write(thetime)
	</script>
<html>
	<!--Here starts the searchbox code-->
	<form name="summonerSearch" method="get" action="/player/na/">
		<div>
       <input type="text" id="summoner"class = "form-control" placeholder="Enter Summoner name" required/>
       </div>
       <!--region-->
       <select id='region'>
       <option value"NA">North America
       <option value"EUNE">Europe Nordic & East
       <option value"EUW">Europe West
       <option value"JP">Japan
       <option value"BR">Brazil
       <option value"KR">Korea
       <option value"LAN">Latin America North
       <option value"LAS">Latin America South
       <option value"OCE">Oceanic
       <option value"RU">Russia
       <option value"TR">Turkey
       </select>
       <!--Search button submit-->
       <input value = "Search" type = "submit" class = "btn btn-primary"/>
	</form>

	<!--Here ends the searchbox code-->

	<!--This is the code for summoner-->

	<p>Summoner's name: </p>
	<p>Summoner's ID: </p>
	<p>Region: </p>
	<p>Win ratio: </p>
	<p>Total champion kills: </p>
	<p>Total wins: </p>
	<p>Total assists: </p>
	<p>Total neutral Minions kills: </p>
	<p>Total turrets destroyed: </p>
	<body>
        <div id="banner">
            <h1 id="sitetitle">LoLStats</h1>
            <div style="clear: both;"></div>
        </div>
		<div id="root">
            <div class="leftcol">
                <div id="sets"></div>
            </div>
            <div id="middlegroup">
                <div id="setviewer"></div>
                <div id="helptext">
                    <h2>How do I use it?</h2>
                    <p>
                        Simply enter your username in the link as
                    </p>
                    <b>/player/{region}/{playerName}</b>
                </div>
            </div>
		<p></p>
		</div>
		<div id="footer">LoLStats isn't endorsed by Riot Games and doesn't reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.</div>
	</body>
</html>

@endsection