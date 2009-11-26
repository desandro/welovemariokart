var placePoints = [15,12,10,8,7,6,5,4,3,2,1,0]




$(function(){

	// console log wrapper.
	function debug(){
	    window.console && console.log.call(console,arguments);
	}

    var raceCount = $('#player_1 meter.race').length;
    var playerCount = $('#graph .player').length;
    var roundMax = raceCount * 15;

    debug('playerCount', playerCount);
    debug('raceCount', raceCount);

    var playerPoints = [];
    var table = $('<table />');
    for (i=1; i <= playerCount; i++) {
        row = $('<tr />');
        cells = '';
        playerPoints[i] = [];
        for (j=1; j <= raceCount; j++ ) {
            // var place = Math.ceil( Math.random() * 12);
            var points = $('#graph .player:eq('+(i-1)+') meter.race:eq('+(j-1)+')')
                            .attr('value');
            // place = parseInt(place);
            // var points = placePoints[place-1];
            // debug( points );
            cells += '<td>'+points+'</td>';
            playerPoints[i][j] = points;
        }
        row.append( cells );
        
        table.append(row);
    }
    
    // append table of point values
    // var table = $('body').append( table );

    function drawCanvas() {
		var canvas = document.getElementById("curves");
		if (canvas.getContext) {
			var ctx = canvas.getContext("2d");
			// begin canvas code

            var meterH = 20;
            var marginY = 52;
            var handleY = marginY * .5;
            var pixelAdjust = 600 / roundMax;

            var x = [];


            ctx.lineWidth = 2;
            ctx.globalAlpha = .3;

            for (i=1; i <= playerCount; i++) {
                x[i] = 2;
            }

            for ( j=1; j <= raceCount; j++) {
                var hue = (360 / raceCount) * j;
                hue = parseInt(hue);
                // ctx.strokeStyle = 'hsla('+hue+',100%, 50%, .8)';
                // ctx.strokeStyle = '#DDD';
                ctx.strokeStyle = $('meter.race:eq('+(j-1)+')').css('border-right-color');
                // debug( ctx.strokeStyle );

                var player1points = playerPoints[1][j] * pixelAdjust;

                var x1 = x[1] + player1points;
                var y1 = 0;

                x[1] += player1points;


                ctx.beginPath();
                    ctx.moveTo(x1,y1);

                    for (i=2; i <= playerCount; i++) {
                        var points, x2, y2, cp2x, cp2y, 
                            x3, y3, cp3x, cp3y, x4, y4;

                        points = playerPoints[i][j] * pixelAdjust;

                        x2 = x[i-1];
                        y2 = meterH * (i-1) + marginY*(i-2);

                        cp2x = x2;
                        cp2y = y2 + handleY;
                        
                        x3 = x[i] + points;
                        y3 = y2 + marginY;

                        cp3x = x3;
                        cp3y = y3 - handleY;

                        x4 = x3;
                        y4 = y3 + meterH;

                        ctx.lineTo(x2,y2);
                        ctx.bezierCurveTo(cp2x, cp2y, cp3x, cp3y, x3, y3);  
                        ctx.lineTo(x4,y4);

                        x[i] += points;
                    }

                    ctx.stroke();
                ctx.closePath();

            }



		}
	}



    drawCanvas();
})
