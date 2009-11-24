<?php $id = 'course_' . $i; ?>
<select name="<?= $id ?>" id="<?= $id ?>" class="course">
    <option>&mdash;</option>
    <?php foreach ($courses as $course): ?>
        <option value="<?= $item ?>"><?= $course ?></option>
    <?php endforeach; ?>
</select>
