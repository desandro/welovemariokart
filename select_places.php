<?php
    include('_base/includes/config.php');
    
    unset($allCourses);

    $allCourses['Mushroom'] = array('Luigi Circuit', 'Moo Moo Meadows', 'Mushroom Gorge', 'Toads Factory');
    $allCourses['Flower'] = array('Mario Circuit', 'Coconut Mall', 'DK Summit', 'Warios Gold Mine');
    $allCourses['Star'] = array('Daisy Circuit', 'Koopa Cape', 'Maple Treeway', 'Grumble Volcano');
    $allCourses['Special'] = array('Dry Dry Ruins', 'Moonview Highway', 'Bowsers Castle', 'Rainbow Road');
    $allCourses['Shell'] = array('GCN Peach Beach', 'DS Yoshi Falls', 'SNES Ghost Valley 2', 'N64 Mario Raceway');
    $allCourses['Banana'] = array('N64 Sherbet Land', 'GBA Shy Guy Beach', 'DS Delfino Square', 'GCN Waluigi Stadium');
    $allCourses['Leaf'] = array('DS Desert Hills', 'GBA Bowser Castle 3', 'N64 DKs Jungle Parkway', 'GCN Mario Circuit');
    $allCourses['Lightning'] = array('SNES Mario Circuit 3', 'DS Peach Gardens', 'GCN DK Mountain', 'N64 Bowsers Castle');
    

    $playerCount = 0;
    $validPlayerIDs[] = '';
    for ($i=1; $i <= 4; $i++) { 
        if ( $_POST['player'.$i.'_person'] != '---' ) { 
            $playerCount++;
            $validPlayerIDs[] = $i;
        }
    }

    $players = array();
    for ($i=1; $i <= $playerCount; $i++) {
        $id = $validPlayerIDs[$i];
        $player = new Player;
        
        $player->name = $_POST['player' . $id . '_person'];
        $player->character = $_POST['player' . $id . '_character'];
        $player->vehicle = $_POST['player' . $id . '_vehicle'];
        $player->transmission = $_POST['player' . $id . '_transmission'];
        
        $players[$i] = $player;
    }

    include('_base/includes/templates/html_head.php');
?>


    <title>Select Places</title>


    <script type="text/javascript" src="_base/js/jquery-ui-1.7.2.dragdrop.min.js" charset="utf-8"></script>

    <script type="text/javascript" src="_base/js/select_places.js" charset="utf-8"></script>

</head>
<body class="select_places">

    
    <div id="wrap">
        <h1>Select Places</h1>
        
        <ul id="courses_list">
            <?php foreach ($allCourses as $cup => $courses): ?>
                <li>
                    <h3><?= $cup ?> Cup</h3>
                    <ul>
                        <?php foreach ($courses as $course): ?>
                            <li class="<?= cleanURL($course) ?>"><span><?= $course ?></span></li>
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <p>Player count: <?= $playerCount ?></p>

        <ul>
            <?php foreach ($validPlayerIDs as $id): ?>
                <li><?= $id ?></li>
            <?php endforeach; ?>
        </ul>

        <table>
            <tr>
                <th scope="row">Players</th>
                <td></td>
                <?php foreach ($players as $player): ?>
                    <td><?= $player->name ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th scope="row">Characters</th>
                <td></td>
                <?php foreach ($players as $player): ?>
                    <td><?= $player->character ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th scope="row">Vehicles</th>
                <td></td>
                <?php foreach ($players as $player): ?>
                    <td><?= $player->vehicle ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th scope="row">Transmission</th>
                <td></td>
                <?php foreach ($players as $player): ?>
                    <td><?= $player->transmission ?></td>
                <?php endforeach; ?>
            </tr>
            
        </table>

    </div> <!-- /#wrap -->

    
</body>
</html>