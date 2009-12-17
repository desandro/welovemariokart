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
    
    $raceCount = intval($_POST['race_count']);
    
    
    $playerCount = 0;
    $validPlayerIDs[] = '';
    for ($i=1; $i <= 4; $i++) { 
        if ( $_POST['names'][$i] != '---' ) { 
            $playerCount++;
            $validPlayerIDs[] = $i;
        }
    }

    $players = array();
    for ($i=1; $i <= $playerCount; $i++) {
        $id = $validPlayerIDs[$i];
        $player = new Player;
        
        $player->name = $_POST['names'][$id];
        $player->character = $_POST['characters'][$id];
        $player->vehicle = $_POST['vehicles'][$id];
        $player->transmission = $_POST['transmissions'][$id];
        
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
        <?php include('_base/includes/templates/header.php'); ?>
        
        <h1>Select Places</h1>
        
        <section id="round_races">
            
            <div class="slider" style="width: <?= (262*$raceCount+20) ?>px">
                
                <?php for ($j=1; $j <= $raceCount; $j++): ?>
                    <article class="race race<?= $j ?> ">
                        <p>Race <?= $j ?></p>
                        <p>
                            <select class="course">
                                <option value="---">---</option>
                                <?php foreach ($allCourses as $cup => $courses): ?>
                                    <optgroup label="<?= $cup ?> Cup">
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?= $course ?>"><?= $course ?></option>
                                    <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </p>
                        <ul>
                            <?php foreach ($players as $player): ?>
                                <li class="player drop">
                                    <dl class="identity drag">
                                    
                                        <dt class="name"><?= $player->name ?></dt>
                                        <dd class="avatar character <?= cleanURL($player->character) ?>">
                                            <div><img src="_base/img/character_avatars.png" alt="<?= $player->character ?>" /></div>
                                        </dd>
                                        <dd class="points">+0</dd>
                                        <dd class="score">0</dd>
                                    </dl>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <ol>
                            <?php for ($k=1; $k <= 12; $k++): ?>
                                <li class="drop"><h4><?= $k ?></h4></li>
                            <?php endfor; ?>
                        </ol>
                    </article>
                <?php endfor; ?>
                
            </div><!-- .slider -->

        </section>
        
        <input type="hidden" name="race_count" value="<?= $raceCount ?>" id="race_count" />
        <input type="hidden" name="player_count" value="<?= $playerCount ?>" id="player_count" />
        

        <form action="view_round.php" method="post">
            <input type="submit" name="view_round" value="View Round" id="view_round" />
            
            <table id="data">
                <tr>
                    <th scope="row">Player Count</th>
                    <td colspan="<?= $playerCount+1 ?>">
                        <?= $playerCount ?>
                        <input type="hidden" name="player_count" value="<?= $playerCount ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Race Count</th>
                    <td colspan="<?= $playerCount+1 ?>">
                        <?= $raceCount  ?>
                        <input type="hidden" name="race_count" value="<?= $raceCount ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Players</th>
                    <td></td>
                    <?php $i = 1; foreach ($players as $player): ?>
                        <td>
                            <?= $player->name ?>
                            <input type="hidden" name="names[<?= $i ?>]" value="<?= $player->name ?>"  />
                        </td>
                    <?php $i++; endforeach; ?>
                </tr>
                <tr>
                    <th scope="row">Characters</th>
                    <td></td>
                    <?php $i = 1; foreach ($players as $player): ?>
                        <td>
                            <?= $player->character ?>
                            <input type="hidden" name="characters[<?= $i ?>]" value="<?= $player->character ?>"  />
                        </td>
                    <?php $i++; endforeach; ?>
                </tr>
                <tr>
                    <th scope="row">Vehicles</th>
                    <td></td>
                    <?php $i = 1; foreach ($players as $player): ?>
                        <td>
                            <?= $player->vehicle ?>
                            <input type="hidden" name="vehicles[<?= $i ?>]" value="<?= $player->vehicle ?>"  />
                        </td>
                    <?php $i++; endforeach; ?>
                </tr>
                <tr>
                    <th scope="row">Transmission</th>
                    <td></td>
                    <?php $i = 1; foreach ($players as $player): ?>
                        <td>
                            <?= $player->transmission ?>
                            <input type="hidden" name="transmissions[<?= $i ?>]" value="<?= $player->transmission ?>"  />
                        </td>
                    <?php $i++; endforeach; ?>
                </tr>

                <?php for ($j=1; $j <= $raceCount; $j++): 
            
                ?>
                    <tr class="race">
                        <th scope="row">Race <?= $j ?></th>
                        <td>
                            <?php $id = 'course_' . $j; ?>
                            <select name="courses[<?= $j ?>]" class="course">
                                <option value="---">---</option>
                                <?php foreach ($allCourses as $cup => $courses): ?>
                                    <optgroup label="<?= $cup ?> Cup">
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?= $course ?>"><?= $course ?></option>
                                    <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <?php  for ($i=1; $i <= $playerCount; $i++): ?>
                            <td>
                                <select name="places[<?= $i ?>][<?= $j ?>]" class="place">
                                    <option value="---">---</option>
                                    <?php for ($k=1; $k <= 12; $k++): ?>
                                        <option value="<?= $k ?>"><?= $k ?></option>
                                    <?php endfor ?>
                                </select>                                
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>

            
            </table>


        </form>

    </div> <!-- /#wrap -->

    
</body>
</html>