<h2><?php echo $question['question']; ?></h2>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<ul class="anwsers">
    <li class="anwser-a" onclick="saveAnswer(<?php echo $question['id']; ?>,<?php echo $anwsers['answer']; ?>,'<?php echo $slug; ?>')">
        <?php echo $anwsers['answer']; ?>
    </li>
    <li class="anwser-b" onclick="saveAnswer(<?php echo $question['id']; ?>,<?php echo $anwsers['dummy_answer']; ?>,'<?php echo $slug; ?>')">
        <?php echo $anwsers['dummy_answer']; ?> 
    </li>
    <li class="anwser-c" onclick="saveAnswer(<?php echo $question['id']; ?>,<?php echo $anwsers['dummy_answer2']; ?>,'<?php echo $slug; ?>')">
         <?php echo $anwsers['dummy_answer2']; ?>
    </li>
    <li class="anwser-d" onclick="saveAnswer(<?php echo $question['id']; ?>,<?php echo $anwsers['dummy_answer3']; ?>,'<?php echo $slug; ?>')">
        <?php echo $anwsers['dummy_answer3']; ?>
    </li>
</ul>