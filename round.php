<?php
    include('_base/includes/config.php');

    $raceCount = intval($_POST['race_count']);
    $playerCount = intval($_POST['player_count']);

    $roundMax = $raceCount * 15;

    $roundCourses = array();

    for ($i=1; $i < $raceCount + 1; $i++) { 
        $roundCourses[$i] = $_POST['course_' . $i];
    }

    function pixelWidth($var) {
        global $roundMax;
        $width = ( $var / $roundMax ) * 600;
        $width = intval($width);
        return $width;
    }

    // get data for each player
    $players = array();
    for ($i=1; $i <= $playerCount; $i++) {
        $player = new Player;
        
        $player->name = $_POST['player' . $i . '_person'];
        $player->character = $_POST['player' . $i . '_character'];
        $player->vehicle = $_POST['player' . $i . '_vehicle'];

        for ($j=1; $j <= $raceCount; $j++) { 
            $place = $_POST['player' . $i . '_place_race' . $j];
            $player->places[$j] = $place;
            $point = $placePoints[ intval($place)-1 ];
            $player->points[$j] = $point;
            $player->total += $point;
            $player->scores[$j] = $player->total;
        }
        
        $players[$i] = $player;
    }

    // comparison function for sorting graph players
    function totalCompare($a, $b) {
        if ( $a->total == $b->total ) {
            return 0;
        }
        return ($a->total > $b->total ) ? -1 : 1;
    }


    usort($players, 'totalCompare');

    /*
    $graphPlayers = array();
    for ($i=1; $i <= $playerCount; $i++) {
        $graphPlayers
    }
    */
    


    $placePlayers = array();
    for ($j=1; $j <= $raceCount; $j++) { 
        $placePlayers[$j] = array();
        foreach ($players as $player) {
            $place = $player->places[$j];
            $placePlayers[$j][$place] = $player;
        }
    }
    
    

    

    include('_base/includes/templates/html_head.php');
?>

    <script type="text/javascript" src="_base/js/round.js" charset="utf-8"></script>

    <title>Round</title>
    

</head>
<body class="round">
    <div id="wrap"> 
           
        <h1>Round</h1>
    
        <section id="graph">
            <div class="graph_lines">
                <label class="zero">0</label>
                <?php for ($i=1; $i <= 6; $i++): 
                    $lineValue = ($roundMax / 6) * $i;
                ?>
                    <div><label><?= $lineValue ?></label></div>
                <?php endfor; ?>
            </div>
        
        	<canvas id="curves" width="600" height="260"></canvas>
        
            <?php $i = 1;
            foreach( $players as $player): 
                $roundW = ($player->total / $roundMax) * 600;
                $roundW = intval($roundW);
            ?>
                <div id="player_<?= $i ?>" class="player <?= cleanURL($player->character) ?>">
                    <p class="total"><?= $player->total ?></p>
                    <div class="round" value="<?= $player->total ?>" max="<?= $roundMax ?>" style="width: <?= pixelWidth($player->total)+2 ?>px;">
                        <?php 
                            $x = 0;
                            for ($j=1; $j <= $raceCount; $j++): 
                                $w = pixelWidth($player->points[$j]);
                                $points = $player->points[$j];
                                $place = $player->places[$j];
                        ?>
                            <meter class="race race<?= $j ?> <?= cleanURL($roundCourses[$j]) ?>" value="<?= $points ?>" min="0" max="15" style="width: <?= $w ?>px; left: <?= $x ?>px;">
                                <strong class="place">
                                    <?= $place  ?><span><?= $placePositions[$place] ?></span>
                                </strong>
                                <span class="points"><?= $points ?> points</span>
                            </meter>
                        <?php 
                            $x += $w; 
                            endfor; 
                        ?>
                    </div> <!-- .round -->
                    <dl class="identity">
                        <dt class="name"><?= $player->name ?></dt>
                        <dd class="avatar character <?= cleanURL($player->character) ?>">
                            <div><img src="_base/img/character_avatars.png" alt="<?= $player->character ?>" /></div>
                        </dd>
                    </dl>

                </div>
            <?php $i++; endforeach; ?>
        
        </section>

        

        <section id="round_races">

            <!-- <h2>Round Races</h2> -->
            
            <div class="slider" style="width: <?= (262*$raceCount+20) ?>px">
            	<canvas id="round_races_curves" width="<?= (262*$raceCount-51) ?>" height="312"></canvas>
                
                <?php for ($j=1; $j <= $raceCount; $j++): 
                    $course = $roundCourses[$j];
                ?>
                    <article class="race race<?= $j . ' ' . cleanURL($course) ?> ">
                        <h3>Race <?= $j ?> <strong><?= $course ?></strong></h3>
                        <ol>
                            <?php for ($k=1; $k <= 12; $k++): ?>
                                <?php if( isset($placePlayers[$j][$k])): 
                                    $player = $placePlayers[$j][$k];
                                ?>
                                    <li class="player">
                                        <h4><?= $k ?></h4>
                                        <dl class="identity">
                                        
                                            <dt class="name"><?= $player->name ?></dt>
                                            <dd class="avatar character <?= cleanURL($player->character) ?>">
                                                <div><img src="_base/img/character_avatars.png" alt="<?= $player->character ?>" /></div>
                                            </dd>
                                            <dd class="points">+<?= $player->points[$j] ?></dd>
                                            <dd class="score"><?= $player->scores[$j] ?></dd>
                                        </dl>
                                    </li>
                                <?php else: ?>
                                    <li><h4><?= $k ?></h4></li>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </ol>
                    </article>
                <?php endfor; ?>
                
            </div><!-- .slider -->

        </section>
        
    
        <section id="output">    

            <table>
                <tr>
                    <th>Player</th>
                    <th>Character</th>
                    <th>Vehicle</th>
                    <?php for ($i=1; $i <= $raceCount; $i++): ?>
                        <th>Race <?= $i ?></th>
                    <?php endfor; ?>
                    <th>Total</th>
                </tr>
                <tr id="courses">
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <?php foreach($roundCourses as $course): ?>
                        <td><?= $course ?></td>
                    <?php endforeach; ?>
                    <td></td>
                </tr>
    
                <?php foreach($players as $player): ?>
                    <tr>
                        <td><?= $player->name ?></td>
                        <td><?= $player->character ?></td>
                        <td><?= $player->vehicle ?></td>
                        <?php for ($j=1; $j < $raceCount+1; $j++): ?>
                            <td><?= $player->places[$j] ?></td>
                        <?php endfor; ?>
                        <td><?= $player->total ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
    
        </section>

    </div> <!-- /#wrap -->
    
</body>
</html>