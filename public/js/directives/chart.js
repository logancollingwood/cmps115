angular.module('chart', []).directive('chart', function() {
  return {
    restrict: 'EA',
    scope: { promise: '=playerKills' },
    template:'<div id="pieChart" data="dataset" player-kills="player.promise"></div>',
    link: function(scope, elem, attrs) {
               
      scope.promise.success(function (data) {  

var pie = new d3pie("pieChart", {
  "header": {
    "title": {
      "text": "Career Kills Breakdown",
      "fontSize": 16,
      "font": "open sans"
    },
    "subtitle": {
      "color": "#999999",
      "fontSize": 10,
      "font": "open sans"
    },
    "titleSubtitlePadding": 12
  },
  "footer": {
    "color": "#999999",
    "fontSize": 11,
    "font": "open sans",
    "location": "bottom-center"
  },
  "size": {
    "canvasHeight": 289,
    "canvasWidth": 273,
    "pieOuterRadius": "50%"
  },
  "data": {
    "content": [
      {
        "label": "Champ",
        "value": parseInt(data.payload.playerData.totalChampionKills),
        "color": "#7e3838"
      },
      {
        "label": "Turrets",
        "value": parseInt(data.payload.playerData.turretsDestroyed),
        "color": "#387e45"
      },
      {
        "label": "Minions",
        "value": parseInt(data.payload.playerData.neutralMinionKills),
        "color": "#386a7e"
      }
    ]
  },
  "labels": {
    "outer": {
      "pieDistance": 0
    },
    "inner": {
      "hideWhenLessThanPercentage": 1
    },
    "mainLabel": {
      "color": "#000000",
      "font": "open sans",
      "fontSize": 14
    },
    "percentage": {
      "color": "#e1e1e1",
      "font": "open sans",
      "fontSize": 12,
      "decimalPlaces": 0
    },
    "value": {
      "color": "#e1e1e1",
      "font": "open sans",
      "fontSize": 16
    }
  },
  "effects": {
    "pullOutSegmentOnClick": {
      "effect": "linear",
      "speed": 400,
      "size": 8
    }
  }
});
});
    }
  }
});