$(function(){
    // console wrapper
	function debug(){
	    window.console && console.log.call(console,arguments);
	}

    var $previousHolder;
    var $draggee;

    function resetHolders() {
        $('.avatar.character').each(function(){
            var $holder = $(this).parent();
            $(this).data('holder', $holder );
        });
    }
    
    //line up draggee into holder 100%
    function alignDraggee($draggee, $holder) {
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

    $('.avatar.character').draggable({ 
        revert: 'invalid',
        zIndex: 100,
        start: function() {
            $draggee = $(this);
            $previousHolder = $(this).data('holder');
        }
    });

    
    $('.place_holder').droppable({
        hoverClass: 'drophover',
        drop: function() {
            alignDraggee($draggee, $(this));
            $(this).droppable('disable');
            $previousHolder.droppable('enable');
            $draggee.data('holder', $(this) );
        }
    });

    $('#character_pool .place_holder').droppable('disable');
    

    $('#reset').click(function(){
        resetHolders();
        $('.avatar.character').animate({left: -1, top: -1})
        $('#character_pool .place_holder').droppable('disable');
        $('#players .place_holder').droppable('enable');
    });

});