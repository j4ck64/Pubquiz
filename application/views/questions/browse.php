<h2><?= $title ?></h2>

<?php foreach ($questions as $question) : ?>
    <h3><?php echo $question['question']; ?></h3>
    <small class="question-date">Date Published : <?php echo $question['publish_date']; ?></small><br>

    <br><br>

    <button class="w3-circle"  onclick="location.href = href='<?php echo site_url('/questions/edit/'. $question['slug']); ?>'" >Edit</button>

    <p><a class="btn btn-primary" href="<?php echo site_url('/questions/edit/'. $question['slug']); ?>">Edit</a></p>
    <button type="submit" class="btn btn-primary" onclick="deleteRow(<?php echo $question['id'];?>,'<?php echo $question['slug'];?>')">
    Delete</button>
   
<?php endforeach; ?>

<button type="submit" class="btn btn-primary" onclick="location.href = href='<?php echo site_url('/questions/create'); ?>'">
    Create Question</button>