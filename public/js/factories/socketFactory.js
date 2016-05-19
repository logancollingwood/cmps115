var socket = io();

socket.on('player', function(msg){
	console.log(msg);
});