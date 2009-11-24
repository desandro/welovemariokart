$(function(){
    
    $('select').not('.vehicle').change(function(){  

        var selectClass = $(this).attr('class');

        var selOpt = $(this).find(':selected');
        var selIdx = $(this).find('option').index( selOpt );

        console.log( selIdx );

        var otherSelects = $('select.' + selectClass).not(this);

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
    

    
    
})