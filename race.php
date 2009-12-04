<?php
    include('_base/includes/config.php');

    $raceCount = intval($_POST['race_count']);
    $playerCount = intval($_POST['player_count']);

    $roundMax = $raceCount * 15;

    $raceCourses = array();

    for ($i=1; $i < $raceCount + 1; $i++) { 
        $raceCourses[$i] = $_POST['course_' . $i];
    }

    function pixelWidth($var) {
        global $roundMax;
        $width = ( $var / $roundMax ) * 600;
        $width = intval($width);
        return $width;
    }

    class Player {
        public $name;
        public $character;
        public $vehicle;
        public $places = array();
        public $points;
        public $total = 0;
        public $id;
    }

    // get data for each player
    $players = array();
    for ($i=1; $i <= $playerCount; $i++) {
        $player = new Player;
        
        $player->id = $i;
        $player->name = $_POST['player' . $i . '_person'];
        $player->character = $_POST['player' . $i . '_character'];
        $player->vehicle = $_POST['player' . $i . '_vehicle'];

        for ($j=1; $j <= $raceCount; $j++) { 
            $place = $_POST['player' . $i . '_place_race' . $j];
            $player->places[$j] = $place;
            $point = $placePoints[ intval($place)-1 ];
            $player->points[$j] = $point;
            $player->total += $point;
        }
        
        
        $players[$i] = $player;
    }

    $racePlaces = array();
    for ($j=1; $j <= $raceCount; $j++) { 
        $racePlaces[$j] = array();
    }
    
    
    
    

    include('_base/includes/templates/html_head.php');
?>

    <script type="text/javascript" src="_base/js/race2.js" charset="utf-8"></script>

    <title>race</title>
    

</head>
<body class="race">
    <div id="wrap">    
        <h1>race</h1>
    
        <section id="graph">
            <div class="graph_lines">
                <label class="zero">0</label>
                <?php for ($i=1; $i <= 6; $i++): 
                    $lineValue = ($roundMax / 6) * $i;
                ?>
                    <div><label><?= $lineValue ?></label></div>
                <?php endfor; ?>
            </div>
        
        	<canvas id="curves" width="600" height="300"></canvas>
        
            <?php foreach( $players as $player): 
                $roundW = ($player->total / $roundMax) * 600;
                $roundW = intval($roundW);
        
            ?>
                <div id="player_<?= $player->id ?>" class="player">
                    <p class="total"><?= $player->total ?></p>
                    <meter class="round" value="<?= $player->total ?>" min="0" max="<?= $roundMax ?>" style="width: <?= pixelWidth($player->total)+2 ?>px;">
                        <?php 
                            $x = 0;
                            for ($j=1; $j <= $raceCount; $j++): 
                                $w = pixelWidth($player->points[$j]);
                                $points = $player->points[$j];
                        ?>
                            <meter class="race race<?= $j ?> <?= cleanURL($raceCourses[$j]) ?>" value="<?= $points ?>" min="0" max="15" style="width: <?= $w ?>px; left: <?= $x ?>px;">
                                <?= $points ?>
                            </meter>
                        <?php 
                            $x += $w; 
                            endfor; 
                        ?>
                    </meter>
                    <figure class="identity">
                        <dd class="name"><?= $player->name ?></dd>
                        <dt class="avatar <?= cleanURL($player->character) ?>"><?= $player->character ?></dt>
                    </figure>

                </div>
            <?php endforeach; ?>
        
        </section>

    
        <section>    
            <p>Race count: <?= $raceCount ?></p>        
            <p>Player count: <?= $playerCount ?></p>
    
    
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
                    <?php foreach($raceCourses as $course): ?>
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
    
            <p>Maximum points for a round of <?= $raceCount ?>: <?= $roundMax ?></p>
        </section>

    </div> <!-- /#wrap -->
    
</body>
</html>