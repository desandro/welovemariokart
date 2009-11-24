<?php
    include('_base/includes/config.php');

    $raceCountPosted = $_POST['race_count'];
    $playerCountPosted = $_POST['player_count'];

    if ( isset($raceCountPosted) ) {
        $raceCount = intval($raceCountPosted);
    } else {
        $raceCount = 10;
    }

    if ( isset($playerCountPosted) ) {
        $playerCount = intval($playerCountPosted);
    } else {
        $playerCount = 4;
    }


    include('_base/includes/templates/html_head.php');
?>

    <title>entry</title>
    
    <script type="text/javascript" src="_base/js/entry.js" charset="utf-8"></script>

</head>
<body class="input1_page">
    
    <h1>entry</h1>
    
    <form id="race_setup" action="entry.php" method="post">
        
        <?php 
            radioInputs('Number of Races', 'race_count', array(1,3,4,8,10), $raceCount  ); 
            radioInputs('Number of Players', 'player_count', array(2,3,4), $playerCount ); 
        ?>

        <input type="submit" name="revise_round" value="Revise Round" id="revise_round" />
        
    </form>


    <form id="race_entry" action="race.php" method="post">

        <input type="hidden" name="race_count" value="<?= $raceCount ?>" />
        <input type="hidden" name="player_count" value="<?= $playerCount ?>" />
        
        
        <table>
            <tr>
                <th>Player</th>
                <th>Character</th>
                <th>Vehicle</th>
                <?php for ($i=1; $i <= 10; $i++): ?>
                    <th <?php if ( $i > $raceCount ): ?>style="display: none;"<?php endif; ?> >Race <?= $i ?></th>
                <?php endfor; ?>
            </tr>
            <tr id="courses">
                <td></td>
                <td></td>
                <td></td>                
   
                <?php for ($i=1; $i <= 10; $i++): ?>
                    <td <?php if ( $i > $raceCount ): ?>style="display: none;"<?php endif; ?> >
                        <?php include('_base/includes/templates/select_courses.php'); ?>
                    </td>
                <?php endfor; ?>
            </tr>
        
            <?php for ($i=1; $i <= 4; $i++): 
            ?>
                <tr id="player<?= $i ?>"  <?php if ( $i > $playerCount ): ?>style="display: none;"<?php endif; ?>>
                    <td>
                        <?php selectOptions($i, $people, 'person'); ?>
                    </td>
                    <td>
                        <?php selectOptions($i,  $characters, 'character'); ?>

                    </td>
                    <td>
                        <?php selectOptions($i, $vehicles, 'vehicle'); ?>
                    </td>
                    <?php for ($j=1; $j <= 10; $j++): ?>
                        <td <?php if ( $j > $raceCount ): ?>style="display: none;"<?php endif; ?> >
                            <?php selectOptions($i, array(1,2,3,4,5,6,7,8,9,10,11,12), 'race' . $j, 'race' ); ?>
                        </td>
                    <?php endfor; ?>
                    
                </tr>
            <?php endfor; ?>
        </table>
        
        <input type="submit" name="submit" value="Submit" id="submit" />
        
        
    </form>
    
</body>
</html>