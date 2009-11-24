<?php $id = 'player' . $playerID . '_' . $class1; ?>
<select name="<?= $id ?>" id="<?= $id ?>" class="<?= $class1 . ' ' . $class2 ?>">
    <option>&mdash;</option>
    <?php foreach ($items as $item): ?>
        <option value="<?= $item ?>"><?= $item ?></option>
    <?php endforeach; ?>
</select>
