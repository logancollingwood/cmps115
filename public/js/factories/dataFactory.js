angular.module('DataFactory', []).factory('DataFactory', ['$http', function($http) {

    var urlBase = '/api/player/na/';
    var urlBaseChampion = '/api/champion/';
    var DataFactory = {};

   DataFactory.getPlayer = function (name) {
        return $http.get(urlBase + name);
	}
	
	DataFactory.getChampion = function (id) {
        return $http.get(urlBaseChampion + id);
	}

    DataFactory.filterPlayer = function(object) {
        var filtered = jQuery.extend({}, object)
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

	return DataFactory;
}]);
