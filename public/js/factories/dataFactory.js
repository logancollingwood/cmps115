angular.module('DataFactory', []).factory('DataFactory', ['$http', function($http) {

    var urlBase = '/api/player/';
    var urlBaseChampion = '/api/champion/';
    var urlBaseMatch = '/api/match/';
    var DataFactory = {};

   DataFactory.getPlayer = function (region, name) {
        // /api/player/region/name
        return $http.get(urlBase + region + '/' + name);
	}
	
	DataFactory.getChampion = function (id) {
        return $http.get(urlBaseChampion + id);
	}

    DataFactory.getMatch = function (region, id) {
        return $http.get(urlBaseMatch + region + '/' + id);
    }

    DataFactory.filterPlayer = function(object) {
        var filtered = jQuery.extend({}, object);
        var timestamp = filtered.payload.playerData.updated_at;
        timestamp = new Date(timestamp).toLocaleString();

        var recentMatches = filtered.payload.recentMatches;
        for (var i = 0; i < recentMatches.length; i++) {
            
            switch (recentMatches[i]["lane"]) {
                case "BOTTOM": 
                    recentMatches[i]["lane"] = "Bot";
                    break;
                case "TOP": 
                    recentMatches[i]["lane"] = "Top";
                    break;
                case "JUNGLE": 
                    recentMatches[i]["lane"] = "Jungle";
                    break;
            }

            switch (recentMatches[i]["role"]) {
                case "DUO_SUPPORT": 
                    recentMatches[i]["role"] = "Support";
                    break;
                case "DUO_CARRY": 
                    recentMatches[i]["role"] = "ADC";
                    break;
                case "SOLO": 
                    recentMatches[i]["role"] = "Solo";
                    break;
                case "NONE": 
                    recentMatches[i]["role"] = "n/a";
                    break;
            }

            switch (recentMatches[i]["won"]) {
                case "0":
                    recentMatches[i]["won"] = 0;
                    break;
                case "1":
                    recentMatches[i]["won"] = 1;
                    break;
            }

            switch (recentMatches[i]["first_blood"]) {
                case "0":
                    recentMatches[i]["first_blood"] = 0;
                    break;
                case "1":
                    recentMatches[i]["first_blood"] = 1;
                    break;
            }

        }
        return filtered;
    }

    DataFactory.filterMatch = function(object) {
        var filtered = jQuery.extend({}, object);
        object = object.payload; 

        switch (object.map) {
            case "11":
                filtered.payload.map = 'Summoners Rift';
                break;
        }

        switch (object.queueType) {
            case "RANKED_SOLO_5x5":
                filtered.payload.queueType = "Solo Queue";
                break;
        }

        //Strips "SEASON" from "SEASON2016", leaving "2016"
        filtered.payload.season = object.season.replace(/\D/g,'');

        var teams = {   "one": { 
                            "players": [], 
                            "won": false
                        },
                        "two": { 
                            "players": [], 
                            "won": false
                        }
                    };
        for (var i = 0; i < object.player_match.length; i++) {
            var player = object.player_match[i];
            switch (player.team) {
                case "0": 
                    if (player.won == "1") {
                        teams.one.won = true;
                    }
                    teams.one.players.push(player);
                    break;
                case "1":
                    if (player.won == "1") {
                        teams.two.won = true;
                    }
                    teams.two.players.push(player);
                    break;
            }
        }
        filtered.payload.teamInfo = teams;

        //currently broken
        filtered.payload.matchStartTime = timeConverter(object.serverTime);
        
        console.log(filtered);
        return filtered;
    }














    function timeConverter(UNIX_timestamp){
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
        return time;
    }
	return DataFactory;
}]);
