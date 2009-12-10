$(function(){
    // console wrapper
	function debug(){
	    window.console && console.log.call(console,arguments);
	}

    var $previousHolder;
    var $draggee;

    function resetHolders() {
        $('.draggee').each(function(){
            var $holder = $(this).parent();
            $(this).data('holder', $holder );
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
        
            x4 = parseInt( x1 + (x3-x2) ),
            y4 = parseInt( y1 + (y3-y2) )
        ;
        $draggee.animate({ left: x4, top: y4 }, 130);

    }
    

    resetHolders();

    $('.draggee').draggable({ 
        // scope: 'characters',
        revert: 'invalid',
        zIndex: 200,
        start: function() {
            $draggee = $(this);
            $previousHolder = $(this).data('holder');
        }
    });


    $('.dropbox.person').droppable({
        hoverClass: 'drophover',
        accept: '.person',
        drop: function() {
            handleDrops($draggee, $(this));

            // set select to new person
            if ( $(this).parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.person').index( this );
                $('table select.person').eq(i).val( $draggee.text() );
            }
            // set previous holder to nill
            if ( $previousHolder.parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.person').index( $previousHolder );
                $('table select.person').eq(i).val( '---' );
            }
        }
    });


    $('.dropbox.avatar').droppable({
        hoverClass: 'drophover',
        accept: '.avatar',
        drop: function() {
            handleDrops($draggee, $(this));

            // set select to new character
            if ( $(this).parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.avatar').index( this );
                var character = $draggee.find('label').text();
                $('table select.character').eq(i).val( character );
            }
            // set previous holder to nill
            if ( $previousHolder.parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.avatar').index( $previousHolder );
                $('table select.character').eq(i).val('---');
            }
        }
    });


    $('#character_pool .dropbox, #people .dropbox').droppable('disable');
    

    $('#reset').click(function(){
        resetHolders();
        $('.draggee').animate({left: -1, top: -1})
        $('#character_pool .dropbox, #people .dropbox').droppable('disable');
        $('#players .dropbox').droppable('enable');
    });

});