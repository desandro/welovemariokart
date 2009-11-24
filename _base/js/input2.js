var placePoints = [15,12,10,8,7,6,5,4,3,2,1,0];

$(function(){
    
    $('tr:eq(0)').append('<th>Total</th>');
    $('tr:gt(0)').append('<td class="total" />');
    
    
    
    // select exclusivity
    $('select').not('.vehicle').change(function(){  

        var classes = $(this).attr('class');
        classes = classes.replace(' ', '.');

        var selOpt = $(this).find(':selected');
        var selIdx = $(this).find('option').index( selOpt );

        // console.log( classes );

        var otherSelects = $('select.' + classes).not(this);

        // console.log( otherSelects );
        
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

        // $('select.' + selectClass).not(this)

    });
    
    
    // tally player total
    $('select.race').change(function(){
        var tr = $(this).parents('tr');
        var selVal = parseInt( $(this).val() );

        var playerTotal = 0;
        tr.find('select.race').each(function(){
            if( $(this).val() != '---' ) {
                var selVal = parseInt( $(this).val() );
                // console.log (selVal);
                playerTotal += placePoints[selVal-1];
            }
            
            // console.log( check  );
        })

        tr.children('.total').text( playerTotal );

        // console.log( placePoints[selVal-1] );
    });

    
    
})