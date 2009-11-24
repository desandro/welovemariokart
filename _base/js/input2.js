$(function(){
    
    $('tr:eq(0)').append('<th>Total</th>');
    $('tr:gt(0)').append('<td class="total" />');
    
    
    
    // select exclusivity
    $('select').not('.vehicle').change(function(){  

        var classes = $(this).attr('class');
        classes = classes.replace(' ', '.');

        var selOpt = $(this).find(':selected');
        var selIdx = $(this).find('option').index( selOpt );

        console.log( classes );

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
       // console.log( this );
    });

    
    
})