<div>
    <label><?= $legend ?></label>
    <ul>
        <?php foreach ($items as $item): 
            $itemID = $id . '_' . $item;
        ?>
            <li>
                <input type="radio" value="<?= $item ?>" id="<?= $itemID ?>" name="<?= $id ?>"/>
                <label for="<?= $itemID ?>"><?= $item ?></label>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
