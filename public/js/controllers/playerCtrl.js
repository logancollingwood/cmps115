// public/js/controllers/NerdCtrl.js
angular.module('PlayerCtrl', []).controller('PlayerController', function($scope, DataFactory, $http, $routeParams, $location) {
    
    $scope.tagline = 'Most Recent Stats';
    $('.panel-default').addClass('hide');

    // loading spinner
    $('.fa-spinner').show().addClass('fa-spin');

    // if $scope.player exists and $routeParams.name matches $scope.player.name don't make http call

    getPlayer();

    function getPlayer() {
    	DataFactory.getPlayer($routeParams.name)
    		.then(function (response) {
    			console.log('successful http get request')
                console.log(response.data);
				$scope.player = filterData(response.data);
				$scope.profileicon = "http://ddragon.leagueoflegends.com/cdn/6.8.1/img/profileicon/" + response.data.payload.playerData.id + ".png";
				
                // hacky delay since angular takes a while to bind {{ m.champion }}'s
                setTimeout($scope.init, 500);
                
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

    $scope.init = function() {
        console.log("pulling champions");
        console.log("championLength = " + $(".championpic").length);
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

    // This takes our response data and applies some logic to clean output, ie
    // Instead of DUO_CARRY we just say ADC
    function filterData(object) {
        console.log(object);
        var filtered = object;
        var timestamp = filtered.payload.playerData.updated_at;
        timestamp = new Date(timestamp).toLocaleString();

        var recentMatches = filtered.payload.recentMatches;
        for (var i = 0; i < recentMatches.length; i++) {
            
            switch (recentMatches[i]["lane"]) {
                case "BOTTOM": 
                    recentMatches[i]["lane"] = "Bot";
                case "TOP": 
                    recentMatches[i]["lane"] = "Top";
                //case "JUNGLE": 
                    //recentMatches[i]["lane"] = "Jungle";
            }

            switch (recentMatches[i]["role"]) {
                case "DUO_SUPPORT": 
                    recentMatches[i]["role"] = "Support";
                case "DUO_CARRY": 
                    recentMatches[i]["role"] = "ADC";
                case "SOLO": 
                    recentMatches[i]["role"] = "Solo";
                //case "NONE": 
                    //recentMatches[i]["role"] = "n/a";
            }
        }
        console.log(filtered);
        return filtered;
    }

});
