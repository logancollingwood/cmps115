angular.module('DataFactory', []).factory('DataFactory', ['$http', function($http) {

    var urlBase = '/api/player/na/';
    var urlBaseChampion = '/api/champion/';
    var DataFactory = {};

   DataFactory.getPlayer = function (name) {
        return $http.get(urlBase + name);
	}
	
	DataFactory.getChampion = function (name) {
        return $http.get(urlBaseChampion + name);
	}

	return DataFactory;
}]);
