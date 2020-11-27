<h2><?= $title; ?></h2>

<?php echo validation_errors() ?>

<?php echo form_open('questions/update'); ?>
<input type="hidden" name="id" value="<?php echo $question['id']; ?>">
<div class="form-group">
    <label>Question</label>
    <input type="text" class="form-control" name="question" placeholder="<?php echo $question['question']; ?>">
</div>
<div class="form-group">
    <label>anwser</label>
    <input type="text" class="form-control" name="anwser" placeholder="<?php echo $anwsers['anwser']; ?>">
</div>
<div class="form-group green-border-focus">
        <label>Dummy anwser</label>
        <!-- <textarea rows="3"><?php echo $anwsers['dummy_anwser'] ?></textarea> -->
        <input type="text" class="form-control" name="dummy-anwser" value="<?php echo $anwsers['dummy_anwser']; ?>"placeholder="<?php echo $anwsers['dummy_anwser']; ?>">
</div>
<div class="form-group">
    <label>Dummy anwser 2</label>
    <input type="text" class="form-control" name="dummy-anwser2" placeholder="<?php echo $anwsers['dummy_anwser2']; ?>">
</div>
<div class="form-group">
    <label>Dummy anwser 3</label>
    <input type="text" class="form-control" name="dummy-anwser3" placeholder="<?php echo $anwsers['dummy_anwser3']; ?>">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>
<button type="cancel" class="btn btn-warning" onclick="location.href = href='<?php echo site_url('/questions/browse'); ?>'">Cancel</button>