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

    $('table#data').hide();

    var $previousHolder;
    var $draggee;

    function resetHolders() {
        $('.draggee').each(function(){
            var $holder = $(this).parent();
            $(this).data('holder', $holder );
        });
    }
    
    function handleDrops($draggee, $holder) {
        if ( $holder.is('.person') ) {
            // set select to new person
            if ( $holder.parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.person').index( $holder );
                $('#data select.person').eq(i).val( $draggee.text() ).change();

                $holder.parent().addClass('person_selected');
            }
            // set previous holder to nill
            if ( $previousHolder.parent().parent().is('#players')  ) {
                var i = $('#players .dropbox.person').index( $previousHolder );
                $('#data select.person').eq(i).val('---').change();
                $previousHolder.parent().removeClass('person_selected');
            }
            
        } else if ( $holder.is('.avatar') ) {
            if ( $holder.parents('article').parent().is('#players')  ) {
                
                // set select to new character
                var i = $('#players .dropbox.avatar').index( $holder );
                var character = $draggee.find('label').text();
                $('#data select.character').eq(i).val( character ).change();
                
                var vehicleClass = characterClass[character];
                $holder.siblings('select.vehicle.' + vehicleClass).show().change();
                
                $holder.parent().addClass('character_selected');
            }
            // set previous holder to nill
            if ( $previousHolder.parents('article').parent().is('#players')  ) {
                var i = $('#players .dropbox.avatar').index( $previousHolder );
                $('#data select.character').eq(i).val('---').change();
                $previousHolder.siblings('select.vehicle').hide().change();
                
                $previousHolder.parent().removeClass('character_selected vehicle_selected');
            }
            
        }
        
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
            $('#data tr.transmission td').eq(i).children('input').removeAttr('checked');
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
        debug('validating form');
		var submitDisabled = $('#next').attr('disabled');
        var completeCount = $('article.person_selected.character_selected.transmission_selected').length;
        var incompleteCount = $('article.person_selected, article.character_selected').not('.person_selected.character_selected.transmission_selected').length;
        // debug('completeCount ' + completeCount, 'incompleteCount ' + incompleteCount, 'submitDisabled '+ submitDisabled);
        if (completeCount > 1 && incompleteCount == 0 && submitDisabled) {
            $('#next').removeAttr('disabled');
        } else if ( (completeCount <= 1 || incompleteCount != 0) && !submitDisabled  ) {
            $('#next').attr('disabled', 'disabled');
        }
        
    }

    $('.dropbox').droppable({
        hoverClass: 'drophover',
        drop: function() {
            handleDrops($draggee, $(this));
        }
    });
    $('.dropbox.person').droppable('option', 'accept', '.person');
    $('.dropbox.avatar').droppable('option', 'accept', '.avatar');


    // disable original holders for the draggables
    $('#character_pool .dropbox, #people .dropbox').droppable('disable');
    
    
    // fake drops for refreshes on startup
    $('#data select.person').each(function(){
        if ( $(this).val() != '---') {
            var selOpt = $(this).find(':selected');
            var idx = $(this).find('option').index( selOpt ) - 1 ;
            // var j = $('table .race').index( $(this).parents('.race') );
            var i = $('#data select.person').index(this);
            // debug('person ' + idx);
            var $draggee = $('#people .person.draggee').eq(idx);
            var $holder = $('#players .person.dropbox').eq(i);
            
            $previousHolder = $draggee.data('holder');
            handleDrops($draggee, $holder);
        }
    });
    // fake drops for refreshes on startup
    $('#data select.character').each(function(){
        if ( $(this).val() != '---') {
            var selOpt = $(this).find(':selected');
            var idx = $(this).find('option').index( selOpt ) - 1 ;
            var i = $('#data select.character').index(this);
            // debug('person ' + idx);
            var $draggee = $('#character_pool .avatar.draggee').eq(idx);
            var $holder = $('#players .avatar.dropbox').eq(i);
            
            $previousHolder = $draggee.data('holder');
            handleDrops($draggee, $holder);
        }
    });
    
    // fake click transmission selection on startup
    $('#data input:radio:checked').each(function(){
        var i = $('tr.transmission td').index( $(this).parent() );
        var $player = $('#players .player').eq(i);
        if ( $player.children('.transmission').is(':not(.disabled)') ) {
            $player.addClass('transmission_selected');
        }
    });

    // disable next on startup
    $('#next').attr('disabled', 'disabled');

    // validate form on start up
    validateForm();

    $('#players select.vehicle').change(function(){
        var i = $('#players article').index( $(this).parent() );
        $(this).parents('.player').addClass('vehicle_selected');
        var vehicle = $(this).val();
        $('#data select.vehicle').eq(i).val(vehicle);
    });

    $('#players .transmission input').click(function(){
        var i = $('#players article').index( $(this).parents('article') );
        var mode = $(this).val();

        $('#data input[value="'+mode+'"]').eq(i).click();
        $(this).parents('article').addClass('transmission_selected');
        validateForm();
    });


    $('#reset').click(function(){
        resetHolders();
        $('.draggee').animate({left: -1, top: -1})
        $('#character_pool .dropbox, #people .dropbox').droppable('disable');
        $('#players .dropbox').droppable('enable');
        $('#data select').val('---');
        $('#players select.vehicle').hide();
        $('#players article').removeClass('person_selected character_selected vehicle_selected transmission_selected')
        $('#players .transmission').addClass('disabled')
            .children('input').attr('disabled', 'disabled');
        $('.transmission input').removeAttr('checked');
        $('#next').attr('disabled', 'disabled');
    });

    


});