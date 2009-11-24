<?php

    $characters = array('Baby Mario', 'Baby Peach', 'Toad', 'Koopa Troopa', 'Baby Luigi', 'Baby Daisy', 'Toadette', 'Dry Bones', 'Mario', 'Luigi', 'Peach', 'Yoshi', 'Daisy', 'Birdo', 'Bowser Jr.', 'Diddy Kong', 'Wario', 'Waluigi', 'Donkey Kong', 'Bowser', 'Funky Kong', 'King Boo', 'Rosalina', 'Dry Bowser');
    
    $people = array('Martin', 'Alex', 'Dan', 'Lauren', 'Dave', 'Mike', 'Doris');
    
    $courses = array('Luigi Circuit', 'Moo Moo Meadows', 'Mushroom Gorge', 'Toads Factory', 'Mario Circuit', 'Coconut Mall', 'DKs Snowboard Cross', 'Warios Gold Mine', 'Daisy Circuit', 'Koopa Cape', 'Maple Treeway', 'Grumble Volcano', 'Dry Dry Ruins', 'Moonview Highway', 'Bowsers Castle', 'Rainbow Road', 'GCN Peach Beach', 'DS Yoshi Falls', 'SNES Ghost Valley 2', 'N64 Mario Raceway', 'N64 Sherbet Land', 'GBA Shy Guy Beach', 'DS Delfino Square', 'GCN Waluigi Stadium', 'DS Desert Hills', 'GBA Bowser Castle 3', 'N64 DKs Jungle Parkway', 'GCN Mario Circuit', 'SNES Mario Circuit 3', 'DS Peach Gardens', 'GCN DK Mountain', 'N64 Bowsers Castle');

    $vehicles = array('Standard Kart Small', 'Baby Booster', 'Concerto', 'Rally Romper', 'Blue Falcon', 'Cheep Charger', 'Standard Kart Medium', 'Nostalgia 1', 'Wild Wing', 'Turbo Blooper', 'Royal Racer', 'B Dasher Mk 2', 'Standard Kart Large', 'Offroader', 'Flame Flyer', 'Piranha Prowler', 'Dragonetti', 'Aero Glider', 'Standard Bike Small', 'Bullet Bike', 'Nano Bike', 'Quacker', 'Magikruiser', 'Torpedo', 'Standard Bike Medium', 'Mach Bike', 'Bon Bon', 'Rapide', 'Dolphin Dasher', 'Nitrocycle', 'Standard Bike Large', 'Bowser Bike', 'Wario Bike', 'Twinkle Star', 'Phantom', 'Torpedo');

    $placePoints = array(15,12,10,8,7,6,5,4,3,2,1);

    function radioInputs( $legend, $id, $items ) {
        include('_base/includes/templates/radio_inputs.php');
    }

    function selectOptions($playerID,  $items, $class1, $class2) {
        include('_base/includes/templates/select_options.php');
    }


?>