<?php
    include('_base/includes/config.php');

    if (isset($_POST))

    include('_base/includes/templates/html_head.php');
    
?>

    <title>Post array</title>
    

</head>
<body>
    <div id="wrap">
        <h1>Post array</h1>

        <?php
        if ($_POST) {
            echo '<pre>';
            echo htmlspecialchars(print_r($_POST, true));
            echo '</pre>';
        }
        ?>

        <form action="post_array.php" method="post">
            <?php for ($i=0; $i < 3; $i++): ?>
                <select name="characters[]">
                    <?php foreach ($characters as $character): ?>
                        <option><?= $character ?></option>
                    <?php endforeach ?>
                </select>    
            <?php endfor; ?>
            <button>Submit</button>
        </form>
    
    </div>
    
</body>
</html>