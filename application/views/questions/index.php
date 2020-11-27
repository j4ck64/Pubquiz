<h2><?php echo $question['question']; ?></h2>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<ul class="anwsers">
    <li class="anwser-a" onclick="saveanwser(<?php echo $question['id']; ?>,'<?php echo $anwsers['anwser']; ?>','<?php echo $question['slug']; ?>')">
        <?php echo $anwsers['anwser']; ?>
    </li>
    <li class="anwser-b" onclick="saveanwser(<?php echo $question['id']; ?>,'<?php echo $anwsers['dummy_anwser']; ?>','<?php echo $question['slug']; ?>')">
        <?php echo $anwsers['dummy_anwser']; ?>
    </li>
    <li class="anwser-c" onclick="saveanwser(<?php echo $question['id']; ?>,'<?php echo $anwsers['dummy_anwser2']; ?>','<?php echo $question['slug']; ?>')">
        <?php echo $anwsers['dummy_anwser2']; ?>
    </li>
    <li class="anwser-d" onclick="saveanwser(<?php echo $question['id']; ?>,'<?php echo $anwsers['dummy_anwser3']; ?>','<?php echo $question['slug']; ?>')">
        <?php echo $anwsers['dummy_anwser3']; ?>
    </li>
</ul>