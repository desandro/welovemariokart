<?php

    ini_set('display_errors', 'On');

    $characters = array('Baby Mario', 'Baby Luigi', 'Baby Peach', 'Baby Daisy', 'Toad', 'Toadette', 'Koopa Troopa',  'Dry Bones', 'Mario', 'Luigi', 'Peach', 'Daisy', 'Yoshi',  'Birdo',  'Diddy Kong', 'Bowser Jr.', 'Wario', 'Waluigi', 'Donkey Kong', 'Bowser',  'King Boo', 'Rosalina', 'Funky Kong', 'Dry Bowser');
    
    $people = array('Martin', 'Alex', 'Dan', 'Lauren', 'Dave', 'Mike', 'Doris');
    
    $allCourses = array('Luigi Circuit', 'Moo Moo Meadows', 'Mushroom Gorge', 'Toads Factory', 'Mario Circuit', 'Coconut Mall', 'DKs Snowboard Cross', 'Warios Gold Mine', 'Daisy Circuit', 'Koopa Cape', 'Maple Treeway', 'Grumble Volcano', 'Dry Dry Ruins', 'Moonview Highway', 'Bowsers Castle', 'Rainbow Road', 'GCN Peach Beach', 'DS Yoshi Falls', 'SNES Ghost Valley 2', 'N64 Mario Raceway', 'N64 Sherbet Land', 'GBA Shy Guy Beach', 'DS Delfino Square', 'GCN Waluigi Stadium', 'DS Desert Hills', 'GBA Bowser Castle 3', 'N64 DKs Jungle Parkway', 'GCN Mario Circuit', 'SNES Mario Circuit 3', 'DS Peach Gardens', 'GCN DK Mountain', 'N64 Bowsers Castle');

    $vehicles = array('Standard Kart Small', 'Baby Booster', 'Concerto', 'Rally Romper', 'Blue Falcon', 'Cheep Charger', 'Standard Kart Medium', 'Nostalgia 1', 'Wild Wing', 'Turbo Blooper', 'Royal Racer', 'B Dasher Mk 2', 'Standard Kart Large', 'Offroader', 'Flame Flyer', 'Piranha Prowler', 'Dragonetti', 'Aero Glider', 'Standard Bike Small', 'Bullet Bike', 'Nano Bike', 'Quacker', 'Magikruiser', 'Torpedo', 'Standard Bike Medium', 'Mach Bike', 'Bon Bon', 'Rapide', 'Dolphin Dasher', 'Nitrocycle', 'Standard Bike Large', 'Bowser Bike', 'Wario Bike', 'Twinkle Star', 'Phantom', 'Torpedo');

    $placePoints = array(15,12,10,8,7,6,5,4,3,2,1,0);
    $placePositions = array();
    for ($i=0; $i < 16; $i++) { 
        $placePositions[$i] = 'th';
    }
    $placePositions[1] = 'st';
    $placePositions[2] = 'nd';
    $placePositions[3] = 'rd';

	function cleanURL($str) {
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '_', $clean);
		return $clean;
	}

    function radioInputs( $legend, $id, $items, $variable ) {
        include('_base/includes/templates/radio_inputs.php');
    }

    function selectOptions($playerID,  $items, $class1, $class2) {
        include('_base/includes/templates/select_options.php');
    }


?>