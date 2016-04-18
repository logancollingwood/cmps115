// public/js/controllers/NerdCtrl.js
angular.module('PlayerCtrl', []).controller('PlayerController', function($scope, $http, $routeParams) {

    $scope.tagline = 'Most Recent Stats';

    // hide tables until json is retrieved
    $('.panel-default').addClass('hide');

    // loading spinner
    $('.fa-spinner').show().addClass('fa-spin');

	$http.get('api/player/na/' + $routeParams.name).
		success(function(data, status, headers, config) {
			console.log('successful ajax request')
			$scope.player = data;
			$('.fa-spinner').hide().removeClass('fa-spin');
			$('.panel-default').removeClass('hide');
		}).
		error(function(data, status, headers, config) {
		  // log error
		  console.log('failed ajax request');
		  $('.fa-spinner').hide().removeClass('fa-spin');
		});


});