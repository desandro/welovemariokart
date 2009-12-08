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
    
    var meterSpeed = 1500;
    var switchSpeed = 500;
    var playerY = 70;

    var roundRacesW = $('#round_races').width();
    var sliderW = $('#round_races .slider').width();
    var scrollX = ( sliderW - roundRacesW ) / (raceCount-1);
    debug('roundRacesW' + roundRacesW, 'sliderW ' + sliderW, 'scrollX ' + scrollX );

    debug('playerCount', playerCount);
    debug('raceCount', raceCount);


    // get the values we need to render the canvases
    var playerPoints = [];
    var playerPlaces = [];

    for (i=1; i <= playerCount; i++) {
        playerPoints[i] = [];
        playerPlaces[i] = [];
        for (j=1; j <= raceCount; j++ ) {
            var points = $('#graph .player:eq('+(i-1)+') meter.race:eq('+(j-1)+')')
                            .attr('value');
            var place = $('#output tr:eq('+(i+1)+') td:eq('+(j+2)+')').text();
            points = parseInt(points);
            place = parseInt(place);
            playerPoints[i][j] = points;
            playerPlaces[i][j] = place;
			// debug(points);
        }
        // debug(playerPlaces[i]);
    }
    

    // render the bezier curves
    function drawCanvas() {
		var curvesCanvas = document.getElementById("curves");
		if (curvesCanvas.getContext) {
			var ctx = curvesCanvas.getContext("2d");
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
                var points, hue,
                    x1, y2, x2, y2, cp2x, cp2y, 
                    x3, y3, cp3x, cp3y, x4, y4;
                
                hue = (360 / raceCount) * j;
                hue = parseInt(hue);
                ctx.strokeStyle = $('meter.race').eq(j-1).css('border-right-color');

                player1points = playerPoints[1][j] * pixelAdjust;

                x1 = x[1] + player1points;
                y1 = 0;

                x2 = x1;
                y2 = meterH;

                x[1] += player1points;


                ctx.beginPath();
                    ctx.moveTo(x1,y1);
                    ctx.lineTo(x2,y2);

                    for (i=2; i <= playerCount; i++) {

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

                        // ctx.lineTo(x2,y2);
                        ctx.bezierCurveTo(cp2x, cp2y, cp3x, cp3y, x3, y3);  
                        ctx.lineTo(x4,y4);

                        x[i] += points;
                    }

                    ctx.stroke();
                ctx.closePath();

            }

        }

		var racesCanvas = document.getElementById("round_races_curves");
		if (racesCanvas.getContext) {
			var ctx = racesCanvas.getContext("2d");
			// begin canvas code
            
             var avatarW = $('#round_races .avatar').outerWidth();
             var marginX = $('#round_races .race').outerWidth(true) - avatarW;
             var handleX = marginX * .5;
             var sizeY = 26;

             ctx.translate(0,-sizeY);

             /**/
 		    for (i=1; i <= playerCount; i++) {
                 var points, hue,
                     x1, y2, x2, y2, cp2x, cp2y, 
                     x3, y3, cp3x, cp3y, x4, y4;
 		        
                 hue = (360 / playerCount) * i;
                 hue = parseInt(hue);
                 ctx.fillStyle = $('#graph .player:eq('+(i-1)+') progress.round').css('background-color');
                 debug(ctx.fillStyle);
                 
                 x1 = 0;
                 y1 = playerPlaces[i][1]*sizeY;
                 x2 = avatarW;
                 y2 = y1;


                 ctx.beginPath();
                     ctx.moveTo(x1, y1);
                     ctx.lineTo(x2, y2);

                     for(j=2; j<= raceCount; j++) {

                         x2 = avatarW*(j-1) + marginX*(j-2);
                         y2 = playerPlaces[i][j-1]*sizeY;
                         cp2x = x2  + handleX;
                         cp2y = y2;

                         x3 = x2 + marginX;
                         y3 = playerPlaces[i][j]*sizeY;
                         cp3x = x3 - handleX;
                         cp3y = y3;

                         x4 = x3 + avatarW;
                         y4 = y3;

                         ctx.bezierCurveTo(cp2x, cp2y, cp3x, cp3y, x3, y3);
                         ctx.lineTo(x4, y4);
                     }
                     
                     x1 = x4;
                     y1 = y4 + (sizeY-1);
                     x2 = x1 - avatarW;
                     y2 = y1;
                     ctx.lineTo(x1,y1);
                     ctx.lineTo(x2,y2);
                     ctx.save();
                         ctx.translate(0,  sizeY-1 );

                         for(j=raceCount-1; j>= 1; j--) {


                             x4 = avatarW*(j-1) + marginX*(j-1);
                             y4 = playerPlaces[i][j]*sizeY;
                         
                             x3 = x4 + avatarW;
                             y3 = y4;
                             cp3x = x3 + handleX;
                             cp3y = y3;


                             x2 = x3 + marginX;
                             y2 = playerPlaces[i][j+1]*sizeY;
                             cp2x = x2 - handleX;
                             cp2y = y2;

                             ctx.bezierCurveTo(cp2x, cp2y, cp3x, cp3y, x3, y3);
                             ctx.lineTo(x4, y4);
                         }
                     ctx.restore();

                     
                     ctx.fill();
                 ctx.closePath;
     	    }
     	    /**/

        }


    }



    drawCanvas();


    // graph animation functions


    $('#graph').after('<button id="animate_round">Animate Round</button>');

    function getRank(s, currentScores) {
        var scores = [];
        var ranks = [];

        for ( ii=0; ii < currentScores.length; ii++) {
            scores[ii] = {
                score: currentScores[ii],
                ident: ii
            };
        }

        scores.sort(function(a,b){return b.score - a.score});

        for ( ii=0; ii < scores.length; ii++) {
            var identI = scores[ii].ident;
            ranks[identI] = ii;
        }
        
        return ranks[s];
        
    }
    


    $('#animate_round:enabled').click(function(){
        var ajaxing = false;

        $('#graph .player .total').text('0');
        $(this).attr('disabled', 'disable');

        var progressX = [];
        var scores = [];
        var pointCount = [];
        var k = [];
		var ranks = [];
		var previousRanks = [];
        for (var i=0; i < playerCount; i++) {
            progressX[i] = 0;
            scores[i] = 0;
            previousRanks[i] = i;
        }

   		var j = 1;


        $('#curves').fadeOut();
        $('#round_races .race').fadeTo('normal', .15);
        $('#graph .player progress.round').animate({ width: 0 }, 'normal', 'swing', function(){
            if( !ajaxing ) {
        		animateRace();
            }
            ajaxing = true;
        });

        function finishSortRank() {
		    $('#graph .player')
    		    // wait before resorting to original order
    		    .animate({opacity: 1}, 1500)
    		    .each(function(iii){
                    // resort to orginal order
    		        $(this).animate({top: iii*playerY}, switchSpeed, 'swing'
    		            , function(){
    		                if (iii == 0 ) { 
                		        // fade in graph curves and all races
    		                    $('#curves').fadeIn();
                                $('#round_races .race').fadeTo('normal', 1);
    		                    debug('animation complete'); 
                    		    $('#animate_round').removeAttr('disabled');
                    		    ajaxing = false;
    		                }
    		        });
    		    })
		    ;
        }

        function animateSortRank(i, player) {
            
            // ranks[i] = getRank(i, points);
            var rank = getRank(i, scores);
            debug(i, 'rank: ' + rank, 'score: ' +  scores[i] );
            
            /**/
            player.animate({top: rank*playerY}, switchSpeed, 'swing')
            .animate({opacity: 1}, 250, 'linear',
             function(){
                 // debug(i);
                // if this is the last player
                 $('#graph meter.race.selected').removeClass('selected');
                if(i == playerCount-1) {

                    if ( j >= raceCount) {
					    // animation is complete
                        finishSortRank();


                    } else {
                        // do another race animation
                        j++;
                        debug(j);
                        animateRace();
                    }
                }                            
            });
            /**/
        }

        function movePlayers() {
            $('#graph .player').each(function(i){

                var addPoints =  playerPoints[i+1][j];

				var roundMeter = $(this).children('progress.round');
				var roundTotal = $(this).children('.total');


				for(var p=0; p < addPoints; p++ ) {
                    roundTotal.animate({opacity: 1}, 50, 'linear', function(){
                        scores[i] ++;
                        $(this).text( scores[i] );
                    });
				}

                progressX[i] += addPoints * pixelAdjust;
                roundMeter.children('meter.race').eq(j-1).addClass('selected');
                roundMeter.animate({ width: progressX[i] + 2 }, meterSpeed, 'swing'
                    , function() {
                        var player = $(this).parents('.player');
                        animateSortRank(i, player);

                    } 
                );	
            });
        }

        function hiliteRace() {
            if( j > 1 ) {
                $('#round_races .race').eq(j-2).fadeTo('normal', .15);
            }
            $('#round_races').animate({ scrollLeft: scrollX * (j-1) });
            $('#round_races .race').eq(j-1).fadeTo('normal', 1, 
                function() {
                    
                    movePlayers();
                }
            );
            // movePlayers();
            
        }

        function animateRace() {

            hiliteRace();
		}


    });


    // highlight race on graph
    $('#round_races .race').hover(function(){
        var raceJ = $('#round_races .race').index(this);
        $('#graph .player').each(function(){
            $(this).find('meter.race').eq(raceJ).addClass('selected');
        });
    }, function(){
        $('#graph meter.race.selected').removeClass('selected');
    });

})
