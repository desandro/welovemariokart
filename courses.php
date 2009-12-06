<?php
    include('_base/includes/config.php');
    include('_base/includes/templates/html_head.php');
    
    $courseColors = array();
    
    $courseColors['Luigi Circuit'] = '#3C5';
    $courseColors['Moo Moo Meadows'] = '#AA5';
    $courseColors['Mushroom Gorge'] = '#F22';
    $courseColors['Toads Factory'] = '#D6D';
    $courseColors['Mario Circuit'] = '#E11';
    $courseColors['Coconut Mall'] = '#A8A';
    $courseColors['DKs Snowboard Cross'] = '#EEE';
    $courseColors['Warios Gold Mine'] = '#EE2';
    $courseColors['Daisy Circuit'] = '#F93';
    $courseColors['Koopa Cape'] = '#789';
    $courseColors['Maple Treeway'] = '#C94';
    $courseColors['Grumble Volcano'] = '#C82';
    $courseColors['Dry Dry Ruins'] = '#EC6';
    $courseColors['Moonview Highway'] = '#343';
    $courseColors['Bowsers Castle'] = '#116';
    $courseColors['Rainbow Road'] = '#000';
    $courseColors['GCN Peach Beach'] = '#66E';
    $courseColors['DS Yoshi Falls'] = '#2D2';
    $courseColors['SNES Ghost Valley 2'] = '#442';
    $courseColors['N64 Mario Raceway'] = '#C22';
    $courseColors['N64 Sherbet Land'] = '#DDE';
    $courseColors['GBA Shy Guy Beach'] = '#EE8';
    $courseColors['DS Delfino Square'] = '#AAC';
    $courseColors['GCN Waluigi Stadium'] = '#963';
    $courseColors['DS Desert Hills'] = '#FDB';
    $courseColors['GBA Bowser Castle 3'] = '#F63';
    $courseColors['N64 DKs Jungle Parkway'] = '#FD3';
    $courseColors['GCN Mario Circuit'] = '#292';
    $courseColors['SNES Mario Circuit 3'] = '#EE2';
    $courseColors['DS Peach Gardens'] = '#8A8';
    $courseColors['GCN DK Mountain'] = '#8AA';
    $courseColors['N64 Bowsers Castle'] = '#33A';
    
?>

    <style type="text/css" media="screen">

        h3 {
            padding: 3px 4px;
            color: #FFF ;
        }


        hr { clear: both; }

        <?php foreach ($allCourses as $course): ?>
            meter.race.<?= cleanURL($course) ?> { border-color: <?= $courseColors[$course] ?>; }
            #round_races .race.<?= cleanURL($course) ?> h3 { background-color: <?= $courseColors[$course] ?>; }
        <?php endforeach; ?>

        #round_races .race.dks_snowboard_cross h3,
        #round_races .race.warios_gold_mine h3,
        #round_races .race.n64_sherbet_land h3,
        #round_races .race.gba_shy_guy_beach h3,
        #round_races .race.n64_dks_jungle_parkway h3,
        #round_races .race.snes_mario_circuit_3 h3 { 
            color: #111; 
        }

    </style>

    <title>courses</title>
    

</head>
<body>
    <div id="wrap">
        <section id="round_races">
            <?php foreach ($allCourses as $course): ?>
                <div class="race <?= cleanURL($course) ?>">
                    <h3><strong><?= $course ?></strong></h3>
                </div>
            

            <?php endforeach; ?>        
        </section>

        <hr />

        <?php foreach ($allCourses as $course): ?>
            #graph meter.race.<?= cleanURL($course) ?> { border-color: <?= $courseColors[$course] ?>; }<br />
            #graph meter.race.<?= cleanURL($course) ?>.selected,<br />
            #graph meter.race.<?= cleanURL($course) ?>:hover,<br />
            #round_races .race.<?= cleanURL($course) ?> h3 { background-color: <?= $courseColors[$course] ?>; }<br />
        <?php endforeach; ?>
    
        <hr />
    
 
    
    </div>
    
</body>
</html>