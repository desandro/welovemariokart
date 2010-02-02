<?php

    ini_set('display_errors', 'On');

    $characters = array('Baby Mario', 'Baby Luigi', 'Baby Peach', 'Baby Daisy', 'Toad', 'Toadette', 'Koopa Troopa',  'Dry Bones', 'Mario', 'Luigi', 'Peach', 'Daisy', 'Yoshi',  'Birdo',  'Diddy Kong', 'Bowser Jr.', 'Wario', 'Waluigi', 'Donkey Kong', 'Bowser',  'King Boo', 'Rosalina', 'Funky Kong', 'Dry Bowser');
    
    $people = array('Martin', 'Alex', 'Dan', 'Lauren', 'Dave', 'Mike', 'Doris', 'Brandon');
    
    $allCourses = array('Luigi Circuit', 'Moo Moo Meadows', 'Mushroom Gorge', 'Toads Factory', 'Mario Circuit', 'Coconut Mall', 'DKs Snowboard Cross', 'Warios Gold Mine', 'Daisy Circuit', 'Koopa Cape', 'Maple Treeway', 'Grumble Volcano', 'Dry Dry Ruins', 'Moonview Highway', 'Bowsers Castle', 'Rainbow Road', 'GCN Peach Beach', 'DS Yoshi Falls', 'SNES Ghost Valley 2', 'N64 Mario Raceway', 'N64 Sherbet Land', 'GBA Shy Guy Beach', 'DS Delfino Square', 'GCN Waluigi Stadium', 'DS Desert Hills', 'GBA Bowser Castle 3', 'N64 DKs Jungle Parkway', 'GCN Mario Circuit', 'SNES Mario Circuit 3', 'DS Peach Gardens', 'GCN DK Mountain', 'N64 Bowsers Castle');

    $allVehicles = array();
    $allVehicles['Light Karts'] = array('Standard Kart S', 'Booster Seat', 'Mini Beast', 'Cheep Charger', 'Tiny Titan', 'Blue Falcon');
    $allVehicles['Light Bikes'] = array('Standard Bike S', 'Bullet Bike', 'Bit Bike', 'Quacker', 'Magikruiser', 'Jet Bubble');
    $allVehicles['Medium Karts'] = array('Standard Kart M', 'Classic Dragster', 'Wild Wing', 'Super Blooper', 'Daytripper', 'Sprinter');
    $allVehicles['Medium Bikes'] = array('Standard Bike M', 'Mach Bike', 'Sugarscoot', 'Zip Zip', 'Sneakster', 'Dolphin Dasher');
    $allVehicles['Heavy Karts'] = array('Standard Kart L', 'Offroader', 'Flame Flyer', 'Piranha Prowler', 'Jetsetter', 'Honeycoupe');
    $allVehicles['Heavy Bikes'] = array('Standard Bike L', 'Flame Runner', 'Wario Bike', 'Shooting Star', 'Spear', 'Phantom');

    $placePoints = array(15,12,10,8,7,6,5,4,3,2,1,0);
    $placePositions = array();
    for ($i=0; $i < 16; $i++) { 
        $placePositions[$i] = 'th';
    }
    $placePositions[1] = 'st';
    $placePositions[2] = 'nd';
    $placePositions[3] = 'rd';

    class Player {
        public $name;
        public $character;
        public $vehicle;
        public $transmission;
        public $places = array();
        public $points = array();
        public $scores = array();
        public $total = 0;
    }

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