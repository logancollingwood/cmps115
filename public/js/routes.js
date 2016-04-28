// public/js/appRoutes.js
    angular.module('routes', []).config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {

    $routeProvider

        // home page
        .when('/', {
            templateUrl: 'views/home.html',
            controller: 'HomeController'
        })

        // player profile page that will use the PlayerProfileController
        .when('/player/:name', {
            templateUrl: 'views/player.html',
            controller: 'PlayerController',
            reloadOnSearch: false
        })

        // About page
        .when('/about', {
            templateUrl: 'views/about.html',
            controller: 'HomeController',
        })
        .when('/yourstats', {
            templateUrl: 'views/playerstats.html',
            controller: 'HomeController',
        })
        .otherwise({
            templateUrl: 'views/404.html',
            controller: 'HomeController'
        });

    $locationProvider.html5Mode(true);

}]);