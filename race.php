<?php
    include('_base/includes/config.php');

    $raceCount = intval($_POST['race_count']);
    $playerCount = intval($_POST['player_count']);

    $raceCourse = array();
    $racePeople = array();
    $raceCharacters = array();
    $raceVehicles = array();
    

    for ($i=1; $i < $raceCount + 1; $i++) { 
        $raceCourse[$i] = $_POST['course_' . $i];
    }

    for ($i=1; $i < $playerCount +1; $i++) { 
        $racePeople[$i] = $_POST['player' . $i . '_person'];
        $raceCharacters[$i] = $_POST['player' . $i . '_character'];
        $raceVehicles[$i] = $_POST['player' . $i . '_vehicle'];
        
        $raceResults[$i] = array();
        for ($j=1; $j < $raceCount+1; $j++) { 
            $raceResults[$i][$j] = $_POST['player' . $i . '_race' . $j];
        }
    }


    include('_base/includes/templates/html_head.php');
?>

    <title>race</title>
    

</head>
<body class="input1_page">
    
    <h1>race</h1>
    
        <p>Race count: <?= $raceCount ?></p>        
        <p>Player count: <?= $playerCount ?></p>
        
        
        <table>
            <tr>
                <th>Player</th>
                <th>Character</th>
                <th>Vehicle</th>
                <?php for ($i=0; $i < $raceCount; $i++): ?>
                    <th>Race <?= $i+1 ?></th>
                <?php endfor; ?>
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
                            <?= $raceResults[$i][$j] ?>
                            
                        </td>
                    <?php endfor; ?>
                    
                </tr>
            <?php endfor; ?>
        </table>
        
    
</body>
</html>