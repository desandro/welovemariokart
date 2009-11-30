var placePoints = [15,12,10,8,7,6,5,4,3,2,1,0]




$(function(){

	// console log wrapper.
	function debug(){
	    window.console && console.log.call(console,arguments);
	}

    var raceCount = $('#player_1 meter.race').length;
    var playerCount = $('#graph .player').length;
    var roundMax = raceCount * 15;
    var pixelAdjust = 600 / roundMax;

    debug('playerCount', playerCount);
    debug('raceCount', raceCount);

    var playerPoints = [];
    for (i=1; i <= playerCount; i++) {
        playerPoints[i] = [];
        for (j=1; j <= raceCount; j++ ) {
            var points = $('#graph .player:eq('+(i-1)+') meter.race:eq('+(j-1)+')')
                            .attr('value');
			points = parseInt(points);
            playerPoints[i][j] = points;
			// debug(points);
        }
    }
    
    

    $('#graph').after('<button id="animate_graph">Animate Graph</button>');

    $('#animate_graph').click(function(){
        $('#graph .player meter.round').animate({ width: 0 });
        $('#curves').fadeOut();
        $('#graph .player .total').text('0');

        var progressX = [];
        var points = [];
        for (var i=0; i < playerCount; i++) {
            progressX[i] = 0;
            points[i] = 0;
        };


		var jcount = 0;
        for(j=1; j <= raceCount; j++) {
            $('#graph .player').each(function(i){
                var addPoints =  playerPoints[i+1][j];
				var roundMeter = $(this).children('meter.round');
				var roundTotal = $(this).children('.total');
                progressX[i] += addPoints * pixelAdjust;
                roundMeter.animate({ width: progressX[i]+2}, 1200, 'swing'
                    , function(){
						
						jcount ++;
						for(var p=0; p < addPoints; p++ ) {
		                    roundTotal.animate({opacity: 1}, 50, 'linear', function(){
		                        $(this).text( points[i] );
								debug('jcount: '+ jcount, 'player: ' + i, 'p: ' + p)
		                    });
						}

						
		                points[i] += addPoints;
                    }
                );	

				
				// debug(points[i]);
            });
        }

        $('#curves').animate({opacity: 1}, 1200 * raceCount).fadeIn();        

    })

    // render the bezier curves
    function drawCanvas() {
		var canvas = document.getElementById("curves");
		if (canvas.getContext) {
			var ctx = canvas.getContext("2d");
			// begin canvas code

            var meterH = 20;
            var marginY = 50;
            var handleY = marginY * .5;

            var x = [];


            ctx.lineWidth = 2;
            ctx.globalAlpha = .3;

            for (i=1; i <= playerCount; i++) {
                x[i] = 2;
            }

            for ( j=1; j <= raceCount; j++) {
                var hue = (360 / raceCount) * j;
                hue = parseInt(hue);
                ctx.strokeStyle = $('meter.race:eq('+(j-1)+')').css('border-right-color');

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
