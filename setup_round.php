<?php
    include('_base/includes/config.php');
    include('_base/includes/templates/html_head.php');
?>


    <title>Setup Round</title>


    <script type="text/javascript" src="_base/js/jquery-ui-1.7.2.dragdrop.min.js" charset="utf-8"></script>

    <script type="text/javascript" src="_base/js/setup_round.js" charset="utf-8"></script>

</head>
<body class="setup_round museo">

    
    <div id="wrap">
        
        <?php include('_base/includes/templates/header.php'); ?>

        <h1>Setup Round</h1>

        <section id="people">
            <?php foreach ($people as $person): ?>
                <div id="holder_<?= $person ?>" class="person dropbox">
                    <div class="person draggee"><strong><?= $person ?></strong></div>
                </div>
            <?php endforeach; ?>
        </section>
    
        <section id="players">
            <?php for ($i=1; $i <= 4; $i++): ?>
                <article id="player<?= $i ?>" class="player">
                    <div class="person dropbox"></div>
                    <div class="avatar dropbox"></div>
                    <?php $weights = array('Light', 'Medium', 'Heavy'); 
                    foreach ($weights as $weight):
                    ?>
                        <select class="vehicle <?= cleanURL($weight) ?>" >
                            <optgroup label="<?= $weight ?> Karts">
                                <?php foreach ($allVehicles[$weight.' Karts'] as $vehicle): ?>
                                    <option value="<?= $vehicle ?>"><?= $vehicle ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="<?= $weight ?> Bikes">
                                <?php foreach ($allVehicles[$weight.' Bikes'] as $vehicle): ?>
                                    <option value="<?= $vehicle ?>"><?= $vehicle ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    <?php endforeach; ?>
                    <div class="transmission disabled">
                        <?php $id = 'transmission' . $i; ?>
                        <input type="radio" name="<?= $id ?>" value="auto" id="<?= $id ?>_auto" disabled="disabled" />
                        <label for="<?= $id ?>_auto">A</label>
                        <input type="radio" name="<?= $id ?>" value="manual" id="<?= $id ?>_manual" disabled="disabled" />
                        <label for="<?= $id ?>_manual">M</label>
                    </div>
                </article>
            <?php endfor; ?>
        </section>

        <section id="character_pool">
            <?php foreach ($characters as $character):?>
                <div id="holder_<?= cleanURL($character) ?>" class="dropbox avatar">
                    <div class="avatar character draggee <?= cleanURL($character) ?>">
                        <div><img src="_base/img/character_avatars.png" alt="<?= $character ?>" /></div>
                        <label><?= $character ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </section>
        
        
        <form id="setup" action="select_places.php" method="post">
            <?php radioInputs('Number of Races', 'race_count', array(2,3,4,5,8,10,12,16,32), 10 ); ?>
            <input type="submit" name="submit" value="Next" id="next" />
            
            <table id="data">
                <tr class="player">
                    <th scope="row">Player</th>
                    <?php for ($i=1; $i <= 8; $i++): ?>
                        <td>
                            <select name="names[<?= $i ?>]" class="person">
                                <option value="---">---</option>
                                <?php foreach ($people as $person): ?>
                                    <option value="<?= $person ?>"><?= $person ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    <?php endfor; ?>
                </tr>
                <tr class="character">
                    <th scope="row">Character</th>
                    <?php for ($i=1; $i <= 8; $i++): ?>
                        <td>
                            <select  name="characters[<?= $i ?>]" class="character">
                                <option value="---">---</option>
                                <?php foreach ($characters as $character): ?>
                                    <option value="<?= $character ?>"><?= $character ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    <?php endfor; ?>                
                </tr>
                <tr class="vehicle">
                    <th scope="row">Vehicle</th>
                    <?php for ($i=1; $i <= 8; $i++): ?>
                        <td>
                            <select name="vehicles[<?= $i ?>]" class="vehicle">
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
                <tr class="transmission">
                    <th scope="row">Transmission</th>
                    <?php for ($i=1; $i <= 8; $i++): ?>
                        <td>
                            <?php $id = 'player' . $i . '_transmission'; ?>
                            <input type="radio" name="transmissions[<?= $i ?>]" value="auto"  />
                            <label for="<?= $id ?>_auto">Auto</label>
                            <input type="radio" name="transmissions[<?= $i ?>]" value="manual" />
                            <label for="<?= $id ?>_manual">Manual</label>
                        
                        </td>
                    <?php endfor; ?>                
                </tr>
            </table>
        </form>
        
        <button id="reset">Reset</button>

    </div> <!-- /#wrap -->

    
</body>
</html>