<?php
    include('_base/includes/config.php');
    include('_base/includes/templates/html_head.php');
?>



    <title>Character Avatars</title>
    
    <style type="text/css" media="screen">
        body {
            width: 280px;
            padding: 40px;
        }

        .avatar.character {
            margin: 10px;
            float: left;
        }
        

    </style>

</head>
<body>
    
    <?php foreach ($characters as $character):?>
    
        <dt class="avatar character <?= cleanURL($character) ?>">
            <div><img src="_base/img/character_avatars.png" alt="<?= $character ?>" /></div>
        </dt>
    <?php endforeach; ?>
    
    <?php 
    foreach ($characters as $character):?>
        .avatar.character.<?= cleanURL($character) ?> div, <br />
    <?php endforeach; ?>
    
</body>
</html>