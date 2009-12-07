<?php
    include('_base/includes/config.php');
    include('_base/includes/templates/html_head.php');
    
    $allVehicles = array();
    $allVehicles['Small Karts'] = array('Standard Kart S', 'Booster Seat', 'Mini Beast', 'Cheep Charger', 'Tiny Titan', 'Blue Falcon');
    $allVehicles['Small Bikes'] = array('Standard Bike S', 'Bullet Bike', 'Bit Bike', 'Quacker', 'Magikruiser', 'Jet Bubble');
    $allVehicles['Medium Karts'] = array('Standard Kart M', 'Classic Dragster', 'Wild Wing', 'Super Blooper', 'Daytripper', 'Sprinter');
    $allVehicles['Medium Bikes'] = array('Standard Bike M', 'Mach Bike', 'Sugarscoot', 'Zip Zip', 'Sneakster', 'Dolphin Dasher');
    $allVehicles['Large Karts'] = array('Standard Kart L', 'Offroader', 'Flame Flyer', 'Piranha Prowler', 'Jetsetter', 'Honeycoupe');
    $allVehicles['Large Bikes'] = array('Standard Bike L', 'Flame Runner', 'Wario Bike', 'Shooting Star', 'Spear', 'Phantom');
    
    
?>

    <style type="text/css" media="screen">
        ul {
            margin-left: 20px;
            margin-bottom: 20px;
        }
        
        ul li {
            list-style: disc;
        }
    </style>

    <title>vehicles</title>
    

</head>
<body>
    <div id="wrap">
 
    <?php foreach ($allVehicles as $vehicleClass => $vehicles): ?>
        <p><strong><?= $vehicleClass ?></strong></p>
        <ul>
            <?php foreach ($vehicles as $vehicle): ?>
                <li><?= $vehicle ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

    <select>
        <?php foreach ($allVehicles as $vehicleClass => $vehicles): ?>
            <optgroup label="<?= $vehicleClass ?>">
            <?php foreach ($vehicles as $vehicle): ?>
                <option value="<?= $vehicle ?>"><?= $vehicle ?></option>
            <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?> 
    </select>


    
    </div>
    
</body>
</html>