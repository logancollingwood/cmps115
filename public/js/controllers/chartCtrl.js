angular.module('ChartCtrl', []).controller('ChartController', ['$scope', function($scope) {
    $scope.dataset = [
       { label: 'Abulia', count: 10 }, 
       { label: 'Betelgeuse', count: 20 },
       { label: 'Cantaloupe', count: 30 },
       { label: 'Dijkstra', count: 40 }
     ];  
}]);