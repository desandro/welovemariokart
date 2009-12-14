var placePoints = [15,12,10,8,7,6,5,4,3,2,1,0];

$(function(){

    // console wrapper
	function debug(){
	    window.console && console.log.call(console,arguments);
	}

    var $draggee, $previousHolder;
    
    function handleDrops($draggee, $holder) {
        $holder.droppable('disable');
        $previousHolder.droppable('enable');
        $draggee.data('holder', $holder );        

        //line up draggee into holder 100%
        var
            x1 = parseInt( $draggee.css('left') ),
            y1 = parseInt( $draggee.css('top') ),
            x2 = $draggee.offset().left,
            y2 = $draggee.offset().top,
            x3 = $holder.offset().left,
            y3 = $holder.offset().top,
        
            x4 = parseInt( x1 + (x3-x2) ) -1,
            y4 = parseInt( y1 + (y3-y2) )
        ;
        $draggee.animate({ left: x4, top: y4 }, 130);


        var j = $('#round_races article').index( $holder.parents('article') );
        var i = $('#round_races article:eq('+j+') dl').index($draggee);

        if ( $holder.parent().is('ol') ) {
            $holder.addClass('player');
            
            debug(i);
            var place = $('#round_races article:eq('+j+') ol li').index($holder);
            var points = placePoints[place];
            $draggee.find('.points').text('+' + points);
            
            $('table .race:eq('+j+') select.place:eq('+i+')').val( (place+1) );
        } else {
            $draggee.find('.points').text('+0');
            $('table .race:eq('+j+') select.place:eq('+i+')').val('---');
        }
        
        if ($previousHolder.parent().is('ol') ) {
            $previousHolder.removeClass('player');
        }
    }
    
    
    $('.drag').each(function(){
        var $holder = $(this).parent();
        $(this).data('holder', $holder );
    });
    
    $('#round_races article').each(function(i){
        var raceID = 'race' + i;
        $(this).find('.drag').draggable({
            revert: 'invalid',
            scope: raceID,
            zIndex: 200,
            scroll: false,
            start: function() {
                $draggee = $(this);
                $previousHolder = $(this).data('holder');
            }
        });

        $(this).find('.drop').droppable({
            hoverClass: 'drophover',
            scope: raceID,
            drop: function() {
                handleDrops($draggee, $(this));
            }
        })

    });
    
    $('ul .drop').droppable('disable');
    

})