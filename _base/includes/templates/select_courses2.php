<?php $id = 'course_' . $j; ?>
<select name="<?= $id ?>" id="<?= $id ?>" class="course">
    <option value="---">---</option>
    <?php foreach ($allCourses as $course): ?>
        <option value="<?= $course ?>"><?= $course ?></option>
    <?php endforeach; ?>
</select>
