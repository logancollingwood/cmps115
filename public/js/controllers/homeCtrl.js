// public/js/controllers/MainCtrl.js
angular.module('HomeCtrl', []).controller('HomeController', function($scope, $location, $routeParams) {
    
    $scope.tagline = 'Up to date player and match stats';  
     
    $('input.username').unbind('keyup').bind('keyup', function(e) {
        var username = $('input.username').val();
        var region = $('#region-dropdown').attr('name');
        $('#search').attr('href', '/player/' + region + '/' + username);
        console.log('redirecting to...' + '/player/' + region + '/' + username)
        // on enter 
        var code = e.keyCode || e.which;
        if(code == 13) { 
            e.preventDefault();
            search();
        }
    });

    function search() {
        var username = $('#username').val();
        var region = $('#region-dropdown').attr('name');
        console.log('redirecting to...' + '/player/' + region + '/' + username)
        $location.url('/player/' + region + '/' + username);
        $scope.$apply();
    }

    $('#search').click(function() {
        search();
    });

    
});