angular.module('LiveMatchCtrl', []).controller('LiveMatchController', function($scope, DataFactory, $http, $routeParams, $location) {

getMatch();
function getMatch(){
    console.log($routeParams.playerid);
    console.log()
        	DataFactory.getLiveMatch($routeParams.region, $routeParams.playerid)
    		.then(function (response) {
    			console.log('successful http get request');
                console.log(response.data);
                $scope.match = response.data;
    		}, function (error) {
    			console.log('failed http get request');
    		});
}

});
