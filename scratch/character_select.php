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
    -moz-box-shadow: inset 0 2px 4px hsla(0,0%,0%,.15);
}

.drophover {
    background: #FFF;
    border-color: #AAA;
    -moz-box-shadow:
        0 0 15px hsla(240,100%,70%,.6),
        inset 0 2px 4px hsla(0,0%,0%,.12)
    ;
    -webkit-box-shadow: 0 0 15px hsla(240,100%,70%,.6);
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
    -moz-box-shadow: 0 4px 5px hsla(0,0%,0%,.2);
    -webkit-box-shadow: 0 4px 5px hsla(0,0%,0%,.2);
    
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

        <button id="reset" >Reset</button>
        
    </div> <!-- /#wrap -->

    
</body>
</html>