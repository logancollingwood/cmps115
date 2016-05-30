// public/js/controllers/StreamCtrl.js
angular.module('StreamCtrl', []).controller('StreamController', function($scope, $location, $routeParams) {
    
    $scope.tagline = 'break down your gameplay';  
    $scope.stream = $routeParams.streamname;
    console.log($scope.stream);
    
});