<?php
    include('_base/includes/config.php');
    include('_base/includes/templates/html_head.php');
?>



    <title>Character Select</title>
    
<style type="text/css" media="screen">

#wrap {
    position: relative;
}

h1 {
    margin-bottom: 40px;
}

#character_pool {
    width: 256px;
    margin-right: 120px;
    float: left;
}

#character_pool .place_holder {
    float: left;
    margin: 0 20px 20px 0;
}

.place_holder {
    width: 40px;
    height: 40px;
    border: 1px solid #CCC;
    background: #F4F4F4;
}
.place_holder.drophover {
    background: #FFF;
    border-color: #AAA;
    -moz-box-shadow: 0 0 15px hsla(240,100%,80%,.4);
    -webkit-box-shadow: 0 0 15px hsla(240,100%,80%,.4);
}

.place_holder .avatar {
    position: relative;
    top: -1px;
    left: -1px;
}

.avatar.character {
    background: #FFF;
}

.avatar.character:hover {
    cursor: move;
}

.avatar.character.ui-draggable-dragging {
    -moz-box-shadow: 0 3px 6px hsla(0,0%,0%,.1);
    -webkit-box-shadow: 0 3px 6px hsla(0,0%,0%,.1);
    
}

#players {
    width: 100px;
    float: left;
}

#players .place_holder {
    margin-bottom: 60px;
}

</style>

    <script type="text/javascript" src="_base/js/jquery-ui-1.7.2.dragdrop.min.js" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $(function(){
            // console wrapper
        	function debug(){
        	    window.console && console.log.call(console,arguments);
        	}

            var $previousHolder;
            var $draggee;

            $('.avatar.character')
                .each(function(){
                    var $holder = $(this).parent();
                    $(this).data('holder', $holder );
                    // debug( $(this).data('holder') );
                })
                .draggable({ 
                    revert: 'invalid',
                    zIndex: 100,
                    // snap: '.place_holder:not(.ui-droppable-disabled)', 
                    // snapMode: 'inner',
                    // snapTolerance: 10,
                    start: function() {
                        $draggee = $(this);
                        $previousHolder = $(this).data('holder');
                    }
                })
            ;

            
            $('.place_holder').droppable({
                hoverClass: 'drophover',
                drop: function() {
                    $(this).droppable('disable');
                    
                
                    //line up draggee into holder 100%
                    var x1 = parseInt( $draggee.css('left') );
                    var y1 = parseInt( $draggee.css('top') );
                    var x2 = $draggee.offset().left;
                    var y2 = $draggee.offset().top;
                    var x3 = $(this).offset().left;
                    var y3 = $(this).offset().top;
                    
                    // debug( x2, y2, x3, y3 );
                    
                    var x4 = parseInt( x1 + (x3-x2) );
                    var y4 = parseInt( y1 + (y3-y2) );
                    
                    $draggee.animate({ left: x4, top: y4 }, 'fast');
                    
                    
                    // debug($draggee);
                    $draggee.data('holder', $(this) );
                    
                    
                    
                    $previousHolder.droppable('enable');
                }
            });

            $('#character_pool .place_holder').droppable('disable');
            

            $('#reset').click(function(){
                $('.avatar.character').animate({left: -1, top: -1});
                $('#character_pool .place_holder').each(function(){
                    $(this).droppable('disable');
                });
                $('#players .place_holder').each(function(){
                    $(this).droppable('enable');
                });
            });

        });
    </script>

</head>
<body>

    
    <div id="wrap">
        <h1>Character Select</h1>
        
        <div id="character_pool">
            <?php foreach ($characters as $character):?>
                <div id="holder_<?= cleanURL($character) ?>" class=" place_holder ">
                    <div class="avatar character <?= cleanURL($character) ?>">
                        <div><img src="_base/img/character_avatars.png" alt="<?= $player->character ?>" /></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="players">
            <div id="holder_player1" class="place_holder open"></div>
            <div id="holder_player2" class="place_holder open"></div>
            <div id="holder_player3" class="place_holder open"></div>
            <div id="holder_player4" class="place_holder open"></div>                                    
        </div>

        <button id="reset" disabled="disabled">Reset</button>
        
    </div> <!-- /#wrap -->

    
</body>
</html>