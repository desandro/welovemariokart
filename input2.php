<?php
    include('_base/includes/config.php');

    $raceCount = intval($_POST['race_count']);
    $playerCount = intval($_POST['player_count']);


    include('_base/includes/templates/html_head.php');
?>

    <title>input2</title>
    

</head>
<body class="input1_page">
    
    <h1>input2</h1>
    
    <form action="race.php" method="post">

        
        <p>Race count: <?= $raceCount ?></p>        
        <p>Player count: <?= $playerCount ?></p>
        
        <input type="hidden" name="race_count" value="<?= $raceCount ?>" />
        <input type="hidden" name="player_count" value="<?= $playerCount ?>" />
        
        <table>
            <tr>
                <th>Player</th>
                <th>Character</th>
                <th>Vehicle</th>
                <?php for ($i=1; $i < $raceCount+1; $i++): ?>
                    <th>Race <?= $i ?></th>
                <?php endfor; ?>
            </tr>
            <tr id="courses">
                <td></td>
                <td></td>
                <td></td>                
   
                <?php for ($i=1; $i < $raceCount+1; $i++): ?>
                    <td>
                        <?php include('_base/includes/templates/select_courses.php'); ?>
                    </td>
                <?php endfor; ?>
            </tr>
        
            <?php for ($i=1; $i < $playerCount +1; $i++): 
            ?>
                <tr>
                    <td>
                        <?php selectOptions($i, 'person', $people); ?>
                    </td>
                    <td>
                        <?php selectOptions($i, 'character', $characters); ?>

                    </td>
                    <td>
                        <?php selectOptions($i, 'vehicle', $vehicles ); ?>
                    </td>
                    <?php for ($j=1; $j < $raceCount+1; $j++): ?>
                        <td>
                            <?php selectOptions($i, 'race' . $j, array(1,2,3,4,5,6,7,8,9,10,11,12) ); ?>
                        </td>
                    <?php endfor; ?>
                    
                </tr>
            <?php endfor; ?>
        </table>
        
        <input type="submit" name="submit" value="Submit" id="submit" />
        
        
    </form>
    
</body>
</html>