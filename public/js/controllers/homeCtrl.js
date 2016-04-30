// public/js/controllers/MainCtrl.js
angular.module('HomeCtrl', []).controller('HomeController', function($scope, $location, $routeParams) {
    
    $scope.tagline = 'Up to date player and match stats';  
     
    $('#username').unbind('keyup').bind('keyup', function(e) {

        // on enter 
        var code = e.keyCode || e.which;
        if(code == 13) { 
            e.preventDefault();
            search();
        }
    });

    function search() {
        var username = $('#username').val();
        console.log(username);
        $location.url('/player/' + username);
        $scope.$apply();
    }

    $('#search').click(function() {
        search();
    });
});