<?php
    
    include('_base/includes/config.php');


    include('_base/includes/templates/html_head.php');
?>

    <title>input</title>
    
</head>
<body class="input1_page">
    
    <h1>input1</h1>
    
    <form action="entry.php" method="post">
        
        <?php 
            radioInputs('Number of Races', 'race_count', array(1,3,4,8,10) ); 
            radioInputs('Number of Players', 'player_count', array(2,3,4) ); 
        ?>

        <input type="submit" name="submit" value="Submit" id="submit" />
        

        
    </form>
    
</body>
</html>