<?php
    
    include('_base/includes/config.php');


    include('_base/includes/templates/html_head.php');
?>

    <title>input</title>
    
</head>
<body class="input1_page">
    
    <h1>input1</h1>
    
    <form action="input2.php" method="post">
        
        <!-- <p>
                 <label for="book">Name: </label>
                 <select name="book" id="book">
                     <option>The Outsider</option>
                     <option>The Rebel</option>
                     <option>The Plague</option>
                     <option>Animal Farm</option>
                     <option>Nineteen Eighty-Four</option>
                     <option>Down and Out in Paris and London</option>
                 </select>
             </p> -->
        
        
        <?php 
            radioInputs('Number of Races', 'race_count', array(1,3,4,8,10) ); 
            radioInputs('Number of Players', 'player_count', array(2,3,4) ); 
        ?>

        <input type="submit" name="submit" value="Submit" id="submit" />
        

        
    </form>
    
</body>
</html>