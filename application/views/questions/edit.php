<h2><?= $title; ?></h2>

<?php echo validation_errors() ?>

<?php echo form_open('questions/update'); ?>
<input type="hidden" name="id" value="<?php echo $question['id']; ?>">
<div class="form-group">
    <label>Question</label>
    <input type="text" class="form-control" name="question" placeholder="<?php echo $question['question']; ?>">
</div>
<div class="form-group">
    <label>Answer</label>
    <input type="text" class="form-control" name="anwser" placeholder="<?php echo $anwsers['answer']; ?>">
</div>
<div class="form-group green-border-focus">
        <label>Dummy Answer</label>
        <!-- <textarea rows="3"><?php echo $anwsers['dummy_answer'] ?></textarea> -->
        <input type="text" class="form-control" name="dummy-anwser" placeholder="<?php echo $anwsers['dummy_answer']; ?>">
</div>
<div class="form-group">
    <label>Dummy Answer 2</label>
    <input type="text" class="form-control" name="dummy-anwser2" placeholder="<?php echo $anwsers['dummy_answer2']; ?>">
</div>
<div class="form-group">
    <label>Dummy Answer 3</label>
    <input type="text" class="form-control" name="dummy-anwser3" placeholder="<?php echo $anwsers['dummy_answer3']; ?>">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>
<button type="cancel" class="btn btn-warning" onclick="location.href = href='<?php echo site_url('/questions/browse'); ?>'">Cancel</button>