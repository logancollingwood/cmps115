// public/js/controllers/NerdCtrl.js
angular.module('PlayerCtrl', []).controller('PlayerController', function($scope, DataFactory, $http, $routeParams, $location) {
    
    $scope.tagline = 'Most Recent Stats';
    $('.panel-default').addClass('hide');

    // loading spinner
    $('.fa-spinner').show().addClass('fa-spin');

    // if $scope.player exists and $routeParams.name matches $scope.player.name don't make http call
    $("#loadingIndicator").show();
    $("#errorIndicator").hide();
    getPlayer();

    function getPlayer() {
    	DataFactory.getPlayer($routeParams.region, $routeParams.name)
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
                
				$scope.player = DataFactory.filterPlayer(response.data);
				$scope.profileicon = "http://ddragon.leagueoflegends.com/cdn/6.8.1/img/profileicon/" + response.data.payload.playerData.id + ".png";

                // hacky delay since angular takes a while to bind {{ m.champion }}'s
                setTimeout($scope.init, 500);
                
                $("#loadingIndicator").hide();
				$('.panel-default').removeClass('hide');
    		}, function (error) {
    			console.log('failed http get request');
				$('.fa-spinner').hide().removeClass('fa-spin');	
    		});
    } 

    $('#username').unbind('keyup').bind('keyup', function(e) {

        //console.log('keyup detected')
        var username = $('#username').val();
        var region = $('#region-dropdown').attr('name');
        $('#search').attr('href', '/player/' + region + '/' + username);
        console.log('redirecting to...' + '/player/' + region + '/' + username)

        // on enter 
        var code = e.keyCode || e.which;
        if(code == 13) { 
            var username = $('#username').val();
            var region = $('#region-dropdown').attr('name');
            e.preventDefault();
            $('#username').val('');
            console.log('redirecting to...' + '/player/' + region + '/' + username)
            $location.url('/player/' + region + '/' + username);
            $scope.$apply();
        }
    });

    $scope.init = function() {
        console.log("pulling champions");
        $(".championpic").each(function(index) {
            var baseUrl = "http://ddragon.leagueoflegends.com/cdn/6.8.1/img/profileicon/";

            var championId = $(this).data("champion");
            var refThis = $(this);

            var imgHref = baseUrl + championId + ".png";
            var image = "<img src='" + imgHref + "'>";
            refThis.html(image);
            // DataFactory.getChampion(championId)
            //     .then(function(response) {

            //         var imgHref = response.data.image;
            //         var image = "<img src='" + imgHref + "'>";
            //         refThis.html(image);
            //     }, function (error) {
            //         console.log("error");
            //         console.log(error);
            //     });
        });

        console.log("pulling runes");
        $(".runepic").each(function(index) {
            var baseUrl = "http://ddragon.leagueoflegends.com/cdn/6.10.1/img/rune/";

            var runeId = $(this).data("rune");
            var refThis = $(this);
            
            DataFactory.getRune(runeId)
                .then(function(response) {
                    var imgHref = baseUrl + response.data.image.full;
                    var image = "<img src='" + imgHref + "'>";
                    var descr = "<p class='description'>" + response.data.description.split(" ")[0] + "<br>" + response.data.description.replace(response.data.description.split(" ")[0], '') + "</p>";
                    refThis.html(image + descr);
                }, function (error) {
                    console.log("error");
                    console.log(error);
                });
            
        });

        console.log("pulling masteries");
        $(".masterypic").each(function(index) {
            var baseUrl = "http://ddragon.leagueoflegends.com/cdn/6.9.1/img/mastery/";

            var masteryId = $(this).data("mastery");
            var refThis = $(this);
            
            var imgHref = baseUrl + masteryId + ".png";
            var image = "<img src='" + imgHref + "'>";
            refThis.html(image);
                
        });
    }

});
