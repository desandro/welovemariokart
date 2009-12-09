<?php
    include('_base/includes/config.php');
    include('_base/includes/templates/html_head.php');
?>



    <title>Setup Round</title>
    
<style type="text/css" media="screen">







h1 {
    margin-bottom: 1.0em;
}

#character_pool {
    width: 336px;
    margin-right: 120px;
    float: left;
}

#character_pool .place_holder {
    float: left;
    margin: 0 40px 30px 0;
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

.avatar.character:hover,
.avatar.character label:hover {
    cursor: move;
}

.avatar.character.ui-draggable-dragging {
    -moz-box-shadow: 0 4px 5px hsla(0,0%,0%,.2);
    -webkit-box-shadow: 0 4px 5px hsla(0,0%,0%,.2);
    
}

.avatar.character label {
    position: absolute;
    left: -18px;
    top: 42px;
    width: 78px;
    text-align: center;
    font-size: 11px;
    font-weight: bold;
    color: #666;

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

    <script type="text/javascript" src="_base/js/setup_round.js" charset="utf-8"></script>

</head>
<body>

    
    <div id="wrap">
        <h1>Setup Round</h1>
        
        <div id="character_pool">
            <?php foreach ($characters as $character):?>
                <div id="holder_<?= cleanURL($character) ?>" class=" place_holder ">
                    <div class="avatar character <?= cleanURL($character) ?>">
                        <div><img src="_base/img/character_avatars.png" alt="<?= $player->character ?>" /></div>
                        <label><?= $character ?></label>
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