var lightCharacters = ['Baby Mario', 'Baby Luigi', 'Baby Peach', 'Baby Daisy', 'Toad', 'Toadette', 'Koopa Troopa',  'Dry Bones'];
var mediumCharacters = ['Mario', 'Luigi', 'Peach', 'Daisy', 'Yoshi',  'Birdo',  'Diddy Kong', 'Bowser Jr.'];
var heavyCharacters = ['Wario', 'Waluigi', 'Donkey Kong', 'Bowser',  'King Boo', 'Rosalina', 'Funky Kong', 'Dry Bowser'];

var characterClass = [];
for(i=0; i<8; i++) {
    characterClass[ lightCharacters[i] ] = 'light';
    characterClass[ mediumCharacters[i] ] = 'medium';
    characterClass[ heavyCharacters[i] ] = 'heavy';
}

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


        //enable transmission selection
        if ( $holder.parents('article').parent().is('#players') 
            && $holder.siblings('.ui-droppable-disabled').length < 1 ) 
        {        
            // debug('enable transmisison selection');
            $holder
                .siblings('.transmission')
                    .removeClass('disabled')
                    .children('input').removeAttr('disabled');

            
        }

        //disable transmission selection
        if ( $previousHolder.parents('article').parent().is('#players') 
            && $previousHolder.siblings('.ui-droppable-disabled').length < 1 ) 
        {        
            // debug('disabled transmisison selection');
            $previousHolder.siblings('.transmission')
                .addClass('disabled')
                .children('input').attr('disabled', 'disabled').removeAttr('checked');

            $previousHolder.parents('article').removeClass('transmission_selected');

            // remove selection from table as well
            var i = $('#players article').index( $previousHolder.parent() );
            $('table tr.transmission td').eq(i).children('input').removeAttr('checked');
        }

        
        validateForm();
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

    // checking logic
    function validateForm() {
        // debug('validating form');
        var completePlayerCount = $('article.person_selected.character_selected.transmission_selected').length;
        var incompletePlayerCount = $('article.person_selected, article.character_selected').not('.person_selected.character_selected.transmission_selected').length;
        debug('completePlayerCount ' + completePlayerCount, 'incompletePlayerCount ' + incompletePlayerCount);
        
        
    }


    $('.dropbox.person').droppable({
        hoverClass: 'drophover',
        accept: '.person',
        drop: function() {

            // set select to new person
            if ( $(this).parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.person').index( this );
                $('table select.person').eq(i).val( $draggee.text() ).change();

                $(this).parent().addClass('person_selected');
            }
            // set previous holder to nill
            if ( $previousHolder.parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.person').index( $previousHolder );
                $('table select.person').eq(i).val( '---' ).change();
                $previousHolder.parent().removeClass('person_selected');
            }

            handleDrops($draggee, $(this));
        }
    });


    $('.dropbox.avatar').droppable({
        hoverClass: 'drophover',
        accept: '.avatar',
        drop: function() {

            if ( $(this).parents('article').parent().is('#players')  ) {
                
                // set select to new character
                var i = $('#players .dropbox.avatar').index( this );
                var character = $draggee.find('label').text();
                $('table select.character').eq(i).val( character ).change();
                
                var vehicleClass = characterClass[character];
                $(this).siblings('select.vehicle.' + vehicleClass).show().change();
                
                $(this).parent().addClass('character_selected');
            }
            // set previous holder to nill
            if ( $previousHolder.parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.avatar').index( $previousHolder );
                $('table select.character').eq(i).val('---').change();
                $previousHolder.siblings('select.vehicle').hide().change();
                
                $previousHolder.parent().removeClass('character_selected vehicle_selected');
            }
            
            
            handleDrops($draggee, $(this));
        }
    });


    $('#character_pool .dropbox, #people .dropbox').droppable('disable');
    

    $('#players select.vehicle').change(function(){
        var i = $('#players article').index( $(this).parent() );
        $(this).parents('.player').addClass('vehicle_selected');
        var vehicle = $(this).val();
        $('table select.vehicle').eq(i).val(vehicle);
    })

    $('#players .transmission input').change(function(){
        var i = $('#players article').index( $(this).parents('article') );
        var mode = $(this).val();
        // debug( mode );

        $('table input[value="'+mode+'"]').eq(i).click();
        
        $(this).parents('article').addClass('transmission_selected');
        
        validateForm();
    })


    $('#reset').click(function(){
        resetHolders();
        $('.draggee').animate({left: -1, top: -1})
        $('#character_pool .dropbox, #people .dropbox').droppable('disable');
        $('#players .dropbox').droppable('enable');
        $('table select').val('---');
        $('#players select.vehicle').hide();
        $('#players article').removeClass('person_selected character_selected vehicle_selected transmission_selected')
        $('#players .transmission').addClass('disabled')
            .children('input').attr('disabled', 'disabled');
        $('input[type="radio"]').removeAttr('checked');
    });

    
    $('#next').attr('disabled', 'disabled');



    /*
    // checking logic
    function validateForm() {
		var validateSelects = true;
		var submitDisabled = $('#next').attr('disabled');
		
		var ready = 0;
		var unready = 0
		
		for (i=0; i < 4; i++) {
		    var playerVal = $('table .player td').eq(i).children('select').val();
		    var characterVal = $('table .character td').eq(i).children('select').val();
            if ( playerVal != '---' || characterVal != '---') {
                debug('validating column ' + i);
            }
		}

		$('table select').each(function(){
			if( $(this).val() == '---' ) {
				// debug('invalid selects', this );
				validateSelects = false;
				return false;
			}
		})

		if ( !validateSelects && !submitDisabled ) {
			$('#submit_round').attr('disabled', 'disabled');
		} else if ( validateSelects && submitDisabled  ) {
			$('#submit_round').removeAttr('disabled');
		}
        
    }


    $('table select').change(function(){
	    validateForm()
    });

    $('table input[type="radio"]').click(function(){
        debug('changed radio');
    });    
		*/

});