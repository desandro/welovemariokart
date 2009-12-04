<?php


    ini_set('display_errors', 'On');

    $finishes = array(4,1,7,10);
    // $places = array(5,1,2,3,8,1);
    
    for ($i=0; $i < count($finishes); $i++) { 
        $finish = $finishes[$i];
        $places[$finish] = $i;
    }

?>

<?php for ($i=1; $i <= 12; $i++): 
    if ( isset($places[$i])):
?>
        <strong><?= $i ?></strong><br />
    <?php else: ?>
        <?= $i ?><br />
    <?php endif; ?>
<?php endfor; ?>

<hr />
