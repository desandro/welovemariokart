<?php $id = 'player' . $playerID . '_' . $class; ?>
<select name="<?= $id ?>" id="<?= $id ?>" class="<?= $class ?>">
    <option>&mdash;</option>
    <?php foreach ($items as $item): ?>
        <option><?= $item ?></option>
    <?php endforeach; ?>
</select>
