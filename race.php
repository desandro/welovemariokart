<?php
    include('_base/includes/config.php');

    $raceCount = intval($_POST['race_count']);
    $playerCount = intval($_POST['player_count']);

    $roundMax = $raceCount * 15;

    $raceCourse = array();
    $racePeople = array();
    $raceCharacters = array();
    $raceVehicles = array();
    $roundTotal = array();
    

    for ($i=1; $i < $raceCount + 1; $i++) { 
        $raceCourse[$i] = $_POST['course_' . $i];
    }

    for ($i=1; $i <= $playerCount; $i++) { 
        $racePeople[$i] = $_POST['player' . $i . '_person'];
        $raceCharacters[$i] = $_POST['player' . $i . '_character'];
        $raceVehicles[$i] = $_POST['player' . $i . '_vehicle'];
        $roundTotal[$i] = 0;
        
        $racePlace[$i] = array();
        for ($j=1; $j <= $raceCount; $j++) { 
            $place = $_POST['player' . $i . '_place_race' . $j];
            $racePlace[$i][$j] = $place;
            $racePoints[$i][$j] = $placePoints[ intval($place)-1 ];
            $roundTotal[$i] += $racePoints[$i][$j];
        }
    }


    include('_base/includes/templates/html_head.php');
?>

    <title>race</title>
    

</head>
<body class="race">
    
    <h1>race</h1>
    
    <section id="viz">
        <header>
            <p class="min">0</p>
            <p class="max"><?= $roundMax ?></p>
        </header>
        
        <?php for($i=1; $i < $playerCount +1; $i++): ?>
            <div id="player_<?= $i ?>" class="player">
                <div class="identity">
                    <span class="avatar"><?= $raceCharacters[$i] ?></span>
                    <em class="name"><?= $racePeople[$i] ?></em>
                </div>
                <meter class="round" min="0" max="<?= $roundMax ?>">
                    <?= $roundTotal[$i] ?>
                    <?php for ($j=1; $j <= $raceCount; $j++): ?>
                        <meter class="race" min="0" max="15">
                            <?= $racePoints[$i][$j] ?>
                        </meter>
                    <?php endfor; ?>
                </meter>
            </div>
        <?php endfor; ?>
        
    </section>

    
    <section>    
        <p>Race count: <?= $raceCount ?></p>        
        <p>Player count: <?= $playerCount ?></p>
    
    
        <table>
            <tr>
                <th>Player</th>
                <th>Character</th>
                <th>Vehicle</th>
                <?php for ($i=1; $i < $raceCount+1; $i++): ?>
                    <th>Race <?= $i ?></th>
                <?php endfor; ?>
                <th>Total</th>
            </tr>
            <tr id="courses">
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <?php for ($i=1; $i < $raceCount+1; $i++): ?>
                    <td>
                        <?= $raceCourse[$i] ?>
                    </td>
                <?php endfor; ?>
                <td></td>
            </tr>
    
            <?php for ($i=1; $i < $playerCount+1; $i++): 
            ?>
                <tr>
                    <td>
                       <?= $racePeople[$i] ?>
                    </td>
                    <td>
                       <?= $raceCharacters[$i] ?>
                    </td>
                    <td>
                       <?= $raceVehicles[$i] ?>
                    
                    </td>
                    <?php for ($j=1; $j < $raceCount+1; $j++): ?>
                        <td>
                            <?= $racePlace[$i][$j] ?>
                        
                        </td>
                    <?php endfor; ?>
                    <td>
                        <?= $roundTotal[$i] ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    
        <p>Maximum points for a round of <?= $raceCount ?>: <?= $roundMax ?></p>
    </section>
    
</body>
</html>