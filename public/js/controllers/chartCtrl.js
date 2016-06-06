angular.module('ChartCtrl', []).controller('ChartController', function($scope, DataFactory) {
    $scope.dataset = [
       { label: 'Abulia', count: 10 }, 
       { label: 'Betelgeuse', count: 20 },
       { label: 'Cantaloupe', count: 30 },
       { label: 'Dijkstra', count: 40 }
     ];  

    $scope.player = { promise: DataFactory.getPlayer('NA', 'xuaqua')};
    getPlayer();

    function getPlayer() {
    	DataFactory.getPlayer('NA', 'xuaqua')
    		.then(function (response) {
    			console.log('successful http get request from chart controller');
                if (response.data.status != 200) {
                    // API error'd not-found, etc
                    console.log('Player lookup failed');
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
});
