// public/js/controllers/NerdCtrl.js
angular.module('MatchCtrl', []).controller('MatchController', function($scope, DataFactory, $http, $routeParams, $location) {
    
    $scope.tagline = 'Match Breakdown';
    $('.panel-default').addClass('hide');

    // loading spinner
    $('.fa-spinner').show().addClass('fa-spin');

    // if $scope.player exists and $routeParams.name matches $scope.player.name don't make http call
    $("#loadingIndicator").show();
    $("#errorIndicator").hide();
    getMatch();

    function getMatch() {
    	DataFactory.getMatch($routeParams.region, $routeParams.matchid)
    		.then(function (response) {
    			console.log('successful http get request');
                console.log(response.data);
                if (response.data.status != 200) {
                    // API error'd not-found, etc
                    console.log('Player lookup failed for region: ' + $routeParams.region + ", name:" + $routeParams.name);
                    $('#loadingIndicator').hide(); 
                    $("#errorIndicator").show();
                    return;
                }
                
                
				$scope.match = DataFactory.filterMatch(response.data);

                // hacky delay since angular takes a while to bind {{ m.champion }}'s
                setTimeout($scope.init, 500);
                
                $("#loadingIndicator").hide();
				$('.panel-default').removeClass('hide');
    		}, function (error) {
    			console.log('failed http get request');
				$('.fa-spinner').hide().removeClass('fa-spin');	
    		});
    }

    $scope.init = function() {
        console.log("pulling champions");
        $(".championpic").each(function(index) {
            var baseUrl = "http://ddragon.leagueoflegends.com/cdn/6.8.1/img/profileicon/";

            var championId = $(this).data("champion");
            var refThis = $(this);
            DataFactory.getChampion(championId)
                .then(function(response) {

                    var imgHref = response.data.image;
                    var image = "<img src='" + imgHref + "'>";
                    refThis.html(image);
                }, function (error) {
                    console.log("error");
                    console.log(error);
                });
        });
    }
});
