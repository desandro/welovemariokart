var placePoints = [15,12,10,8,7,6,5,4,3,2,1,0];


$(function(){
    
	// console log wrapper.
	function debug(){
	    window.console && console.log.call(console,arguments);
	}


    $('tr:eq(0)').append('<th>Total</th>');
    $('tr:gt(0)').append('<td class="total" />');
    
    
    // select exclusivity
    $('select').not('.vehicle').change(function(){  

        var classes = $(this).attr('class');
        classes = classes.replace(' ', '.');

        var selOpt = $(this).find(':selected');
        var selIdx = $(this).find('option').index( selOpt );

        // debug( classes );

        var otherSelects = $('select.' + classes).not(this);

        // debug( otherSelects );
        
        var prevSelIdx = $(this).data('prevSelIdx');
        if ( prevSelIdx != undefined ) {
            otherSelects.each(function(){
                $(this).find('option:eq('+prevSelIdx+')').removeAttr('disabled');
            });                
        }

        if( selIdx > 0 ) {
            otherSelects.each(function(){
                $(this).find('option:eq('+selIdx+')').attr('disabled', 'disabled');
            });            
        }
        
        
        $(this).data('prevSelIdx', selIdx);


    });
    
    function updatePlayerTotal(row) {
        var playerTotal = 0;
		row.find('td:visible select.place').each(function(){
            if( $(this).val() != '---' ) {
                var selVal = parseInt( $(this).val() );
                // debug (selVal);
                playerTotal += placePoints[selVal-1];
            }
            
        })

        row.children('.total').text( playerTotal );
	}

    // tally player total
    $('select.place').change(function(){

        var row = $(this).parents('tr');
		updatePlayerTotal( row );

    });
    
    // change race_entry table dynamically
    $('#race_setup input[name="race_count"]').change(function(){
        var raceCount = parseInt( $(this).val() );
        debug('raceCount', raceCount );
        $('tr').each(function(){
            $(this).children(':gt('+(raceCount+2)+'):not(:last)').hide();
            $(this).children(':lt('+(raceCount+3)+'):hidden').show();
        })
        $('#race_entry input[name="race_count"]').val( raceCount );

		$('tr:gt(1):visible').each(function(){
			updatePlayerTotal( $(this) );
		});
    });

    // change race_entry table dynamically
    $('#race_setup input[name="player_count"]').change(function(){
        var playerCount = parseInt( $(this).val() );
        debug('playerCount', playerCount );
        $('tr:gt('+(playerCount+1)+'):visible').hide();
        $('tr:lt('+(playerCount+2)+'):hidden').show();
    });

    // initiate change so table is properly sized on window.load
    $('#race_setup input:checked').change();

    // hide revise round button
    $('#revise_round').attr('disabled', 'disabled').hide();
    

	$('select, input[type="radio"]').change(function(){
		var validateSelects = true;
		var submitDisabled = $('#submit_round').attr('disabled');
	
		$('td:visible select').each(function(){
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
		
	});
		// check it on startup
	$('select').eq(0).change();

    
})