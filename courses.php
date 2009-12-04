<?php
    include('_base/includes/config.php');
    include('_base/includes/templates/html_head.php');
?>



    <title>courses</title>
    

</head>
<body>
    
    <?php foreach ($courses as $course): ?>
        <meter class="race <?= cleanURL($course) ?>">
            <?= $course ?>
        </meter>
    <?php endforeach; ?>


    <?php foreach ($courses as $course): ?>
        meter.race.<?= cleanURL($course) ?> { border-color: #000; }<br />
    <?php endforeach; ?>
    
</body>
</html>