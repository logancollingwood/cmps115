angular.module('DataFactory', []).factory('DataFactory', ['$http', function($http) {

    var urlBase = '/api/player/na/';
    var DataFactory = {};

    DataFactory.getPlayer = function (name) {
        return $http.get(urlBase + name);
	}

	return DataFactory;
}]);