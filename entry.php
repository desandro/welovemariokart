<?php
    include('_base/includes/config.php');

    /** /
    if ( isset($_POST['race_count']) ) {
        $raceCount = intval($raceCountPosted);
    } else {
    }

    if ( isset($_POST['player_count']) ) {
        $playerCount = intval($playerCountPosted);
    } else {
    }
    /**/
    
        $raceCount = 10;
        $playerCount = 4;

    include('_base/includes/templates/html_head.php');
?>

    <title>Round Entry</title>
    
    <script type="text/javascript" src="_base/js/entry.js" charset="utf-8"></script>

</head>
<body class="entry">
    
    <div id="wrap">    
        <h1>Round Entry</h1>
    
        <form id="race_setup" action="entry.php" method="post">
        
            <?php 
                radioInputs('Number of Races', 'race_count', array(1,3,4,8,10), $raceCount  ); 
                radioInputs('Number of Players', 'player_count', array(2,3,4), $playerCount ); 
            ?>

            <input type="submit" name="revise_round" value="Revise Round" id="revise_round" />
        
        </form>


        <form id="race_entry" action="round.php" method="post">

            <input type="hidden" name="race_count" value="<?= $raceCount ?>" />
            <input type="hidden" name="player_count" value="<?= $playerCount ?>" />
        
        
            <table>
                <tr>
                    <th scope="row">Player</th>
                    <td></td>
                    <?php for ($i=1; $i <= 4; $i++): ?>
                        <td>
                            <?php selectOptions($i, $people, 'person', ''); ?>
                        </td>
                    <?php endfor; ?>
                </tr>
                <tr>
                    <th scope="row">Character</th>
                    <td></td>
                    <?php for ($i=1; $i <= 4; $i++): ?>
                        <td>
                            <?php selectOptions($i,  $characters, 'character', ''); ?>
                        </td>
                    <?php endfor; ?>                
                </tr>
                <tr>
                    <th scope="row">Vehicle</th>
                    <td></td>
                    <?php for ($i=1; $i <= 4; $i++): ?>
                        <td>
                            <?php $id = 'player' . $i . '_vehicle'; ?>
                            <select name="<?= $id ?>" id="<?= $id ?>" class="vehicle">
                                <option value="---">---</option>
                                <?php foreach ($allVehicles as $vehicleClass => $vehicles): ?>
                                    <optgroup label="<?= $vehicleClass ?>">
                                    <?php foreach ($vehicles as $vehicle): ?>
                                        <option value="<?= $vehicle ?>"><?= $vehicle ?></option>
                                    <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    <?php endfor; ?>                
                </tr>
                <?php for ($j=1; $j <= 10; $j++): ?>
                    <tr class="race">
                        <th scope="row">Race <?= $j ?></th>
                        <td>
                            <?php $id = 'course_' . $j; ?>
                            <select name="<?= $id ?>" id="<?= $id ?>" class="course">
                                <option value="---">---</option>
                                <?php foreach ($allCourses as $course): ?>
                                    <option value="<?= $course ?>"><?= $course ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <?php for ($i=1; $i <= 4; $i++): ?>
                            <td>
                                <?php selectOptions($i, array(1,2,3,4,5,6,7,8,9,10,11,12), 'place_race' . $j, 'place' ); ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>

            </table>

        
            <input type="submit" name="submit_round" value="Submit Round" id="submit_round" />
        
        
        </form>

    </div>
    
</body>
</html>