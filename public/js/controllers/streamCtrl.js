// public/js/controllers/StreamCtrl.js
angular.module('StreamCtrl', []).controller('StreamController', function($scope, $location, $routeParams) {
    
    $scope.tagline = 'break down your gameplay';  
    $scope.stream = $routeParams.streamname;
    var channels = [
        'riotgames',
        'voyboy',
        'tsm_doublelift',
        'imaqtpie',
        'Picoca',
        'loltyler1',
        'IMT_WildTurtle',
        'IMT_Adrian',
        'Shiphtur',
        'SirhcEz'
    ];
    function getChannelInfo() {
        channels.forEach(function (channel) {
            function makeURL(type, name) {
                return 'https://api.twitch.tv/kraken/' + type + '/' + name + '?callback=?';
            }
            ;
            $.getJSON(makeURL('streams', channel), function (data) {
                var game, status;
                if (data.stream === null) {
                    game = 'Offline';
                    status = 'offline';
                } else if (data.stream === undefined) {
                    game = 'Account Closed';
                    status = 'offline';
                } else {
                    game = data.stream.game;
                    status = 'online';
                }
                ;
                $.getJSON(makeURL('channels', channel), function (data) {
                    var logo = data.logo != null ? data.logo : 'http://dummyimage.com/50x50/ecf0e7/5c5457.jpg&text=0x3F', name = data.display_name != null ? data.display_name : channel, description = status === 'online' ? ': ' + data.status : '';
                    html = '<div class="row ' + status + '"><div class="col-xs-2 col-sm-1" id="icon"><img src="' + logo + '" class="logo"></div><div class="col-xs-10 col-sm-3" id="name"><a href="' + data.url + '" target="_blank">' + name + '</a></div><div class="col-xs-10 col-sm-8" id="streaming">' + game + '<span class="hidden-xs">' + description + '</span></div></div>';
                    status === 'online' ? $('#display').prepend(html) : $('#display').append(html);
                });
            });
        });
    }
    ;
    $(document).ready(function () {
        getChannelInfo();
        $('.selector').click(function () {
            $('.selector').removeClass('active');
            $(this).addClass('active');
            var status = $(this).attr('id');
            if (status === 'all') {
                $('.online, .offline').removeClass('hidden');
            } else if (status === 'online') {
                $('.online').removeClass('hidden');
                $('.offline').addClass('hidden');
            } else {
                $('.offline').removeClass('hidden');
                $('.online').addClass('hidden');
            }
        });
    });
         
});