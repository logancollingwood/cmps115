// public/js/controllers/NerdCtrl.js
angular.module('PlayerCtrl', []).controller('PlayerController', function($scope, DataFactory, $http, $routeParams, $location) {

    $scope.tagline = 'Most Recent Stats';

    // hide tables until json is retrieved
    $('.panel-default').addClass('hide');

    // loading spinner
    $('.fa-spinner').show().addClass('fa-spin');

    // if $scope.player exists and $routeParams.name matches $scope.player.name don't make http call

    getPlayer();

    function getPlayer() {
    	DataFactory.getPlayer($routeParams.name)
    		.then(function (response) {
    			console.log('successful http get request')
				$scope.player = response.data;
				$('.fa-spinner').hide().removeClass('fa-spin');
				$('.panel-default').removeClass('hide');
    		}, function (error) {
    			console.log('failed http get request');
				$('.fa-spinner').hide().removeClass('fa-spin');	
    		});
    }
    
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
});