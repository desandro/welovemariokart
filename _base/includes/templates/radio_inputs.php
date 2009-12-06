<fieldset>
    <label><?= $legend ?></label>
    <ul>
        <?php foreach ($items as $item): 
            $itemID = $id . '_' . $item;
        ?>
            <li>
                <input type="radio" value="<?= $item ?>" id="<?= $itemID ?>" name="<?= $id ?>" <?php if( $item == $variable) {echo 'checked="checked"';} ?>  />
                <label for="<?= $itemID ?>"><?= $item ?></label>
            </li>
        <?php endforeach; ?>
        
    </ul>
</fieldset>
