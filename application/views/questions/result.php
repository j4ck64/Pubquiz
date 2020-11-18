<table class="results">  
    <thead>
        <tr>
            <th>question</th>
            <th>your answer</th>
            <th>correct answer</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($questions as $question) : ?>
        <tr>
            <td><?php echo $question->question?></td>
            <td><?php echo $question->user_answer?></td>
            <td><?php echo $question->answer?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>