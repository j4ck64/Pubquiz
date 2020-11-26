<h2><?= $title; ?></h2>

<?php echo validation_errors() ?>

<?php echo form_open('questions/insert'); ?>
<div class="form-group">
    <label>Question</label>
    <input type="text" class="form-control" name="question" placeholder="Enter Question">
</div>
<div class="form-group">
    <label>Answer</label>
    <input type="text" class="form-control" name="anwser" placeholder="Enter Anwser">
</div>
<div class="form-group green-border-focus">
        <label>Dummy Answer</label>
        <!-- <textarea rows="3"></textarea> -->
        <input type="text" class="form-control" name="dummy-anwser" placeholder="Enter Dummy Anwser">
</div>
<div class="form-group">
    <label>Dummy Answer 2</label>
    <input type="text" class="form-control" name="dummy-anwser2" placeholder="Enter Second Dummy Anwser">
</div>
<div class="form-group">
    <label>Dummy Answer 3</label>
    <input type="text" class="form-control" name="dummy-anwser3" placeholder="Enter Third Dummy Anwser">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>
<button type="cancel" class="btn btn-warning" onclick="location.href = href='<?php echo site_url('/questions/browse'); ?>'">Cancel</button>