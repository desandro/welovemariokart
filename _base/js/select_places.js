var placePoints = [15,12,10,8,7,6,5,4,3,2,1,0];

$(function(){

    // console wrapper
	function debug(){
	    window.console && console.log.call(console,arguments);
	}

    var $draggee, $previousHolder;
    
    var playerCount = parseInt( $('#player_count').val() );
    var raceCount = parseInt( $('#race_count').val() );
    
    function updatePlayerScores(i) {
        var playerTotal = 0;
        $('table .race').each(function(j){
            var selectPlace = $(this).find('select.place:eq('+i+')');
            if( selectPlace.val() != '---' ) {
                var selVal = parseInt( selectPlace.val() );
                playerTotal += placePoints[selVal-1];
            }
            $('#round_races article:eq('+j+') dl:eq('+i+') .score').text(playerTotal);
        });
    }
    
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
            
            // debug(i);
            var place = $('#round_races article:eq('+j+') ol li').index($holder);
            var points = placePoints[place];
            $draggee.find('.points').text('+' + points);
            
            $('table .race:eq('+j+') select.place:eq('+i+')').val( (place+1) ).change();
        } else {
            $draggee.find('.points').text('+0');
            $('table .race:eq('+j+') select.place:eq('+i+')').val('---').change();
        }
        
        if ($previousHolder.parent().is('ol') ) {
            $previousHolder.removeClass('player');
        }
        
        updatePlayerScores(i);
    }
    

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
    
    // on startup set holders
    $('.drag').each(function(){
        var $holder = $(this).parent();
        $(this).data('holder', $holder );
    });

    // on startup, disable original holders
    $('ul .drop').droppable('disable');

    // on startup, fake drop characters if this is from a refresh
    $('table select.place').each(function(){
        if( $(this).val() != '---' ) {
            var selOpt = $(this).find(':selected');
            var place = $(this).find('option').index( selOpt );
            var j = $('table .race').index( $(this).parents('.race') );
            var i = $('table .race:eq('+j+') select.place').index(this);

            // debug('race '+(j+1), 'player '+(i+1),  'place ' + place);
            
            var $draggee = $('#round_races article:eq('+j+') dl:eq('+i+')');
            var $holder = $('#round_races article:eq('+j+') ol li:eq('+(place-1)+')');
            
            $previousHolder = $draggee.data('holder');
            // debug(j, i, $draggee);
            handleDrops($draggee, $holder);
            // $('#round_races article:eq('+j+') ul li:eq('+i+')').droppable('enable');
        }
    })


    
    // select exclusivity & matching with form.
    $('#round_races select.course').change(function(){  

        var selOpt = $(this).find(':selected');
        var selIdx = $(this).find('option').index( selOpt );

        var otherSelects = $('#round_races select.course').not(this);
        
        // enable previous selection if its defined
        var prevSelIdx = $(this).data('prevSelIdx');
        if ( prevSelIdx != undefined ) {
            otherSelects.each(function(){
                $(this).find('option:eq('+prevSelIdx+')').removeAttr('disabled');
            });                
        }
        $(this).data('prevSelIdx', selIdx);

        if( selIdx > 0 ) {
            otherSelects.each(function(){
                $(this).find('option:eq('+selIdx+')').attr('disabled', 'disabled');
            });            
        }

        // set select in form to correct one
        var j = $('#round_races select.course').index(this);
        $('table select.course:eq('+j+')').val( $(this).val() ).change();
    });



    function validateForm() {
        // $('table .race').each(function(j){
        //     // debug(j);
        // })
    }
    
    $('table select').change(function(){
        var j = $('table .race').index( $(this).parents('.race') );
        $(this).parents('.race').find('select').each(function(){
            debug( $(this) );
        });
        // debug(j);
        validateForm();
    })

});