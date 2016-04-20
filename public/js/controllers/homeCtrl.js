// public/js/controllers/MainCtrl.js
angular.module('HomeCtrl', []).controller('HomeController', function($scope, $location, $routeParams) {
    
    $scope.tagline = 'Up to date player and match stats';  
     
    $('#username').unbind('keyup').bind('keyup', function(e) {

        //console.log('keyup detected')
        var username = $('#username').val();
        $('#search').attr('href', '/player/' + username);

        // on enter 
        var code = e.keyCode || e.which;
        if(code == 13) { 
            e.preventDefault();
            $('#username').val('');
            $location.url('/player/' + username);
            $scope.$apply();
        }
    });

    $('#search').click(function() {
        $('#username').val('');
    });
});