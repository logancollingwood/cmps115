// public/js/controllers/MainCtrl.js
angular.module('HomeCtrl', []).controller('HomeController', function($scope, $location, $routeParams) {
    
    $scope.tagline = 'break down your gameplay';  
     
    $('input.username').unbind('keyup').bind('keyup', function(e) {
        var username = $(this).val();
        var region = $('#region-dropdown').attr('name');
        $('#search').attr('href', '/player/' + region + '/' + username);
        console.log('redirecting to...' + '/player/' + region + '/' + username)
        // on enter 
        var code = e.keyCode || e.which;
        if(code == 13) { 
            e.preventDefault();
            search(username);
        }
    });

    function navSearch(username) {
        
        var region = $('#region-dropdown').attr('name');
        console.log('redirecting to...' + '/player/' + region + '/' + username)
        $location.url('/player/' + region + '/' + username);
        $scope.$apply();
    }

    $('#homesearch').click(function() {
        var name = $('#navName').val();
        console.log("found  " + name);
        console.log(name);
        navSearch(name);
    });

    
});