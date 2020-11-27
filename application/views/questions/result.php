<table class="results">
    <thead>
        <tr>
            <th>question</th>
            <th>your anwser</th>
            <th>correct anwser</th>
            <th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question) : ?>
            <tr>
                <td><?php echo $question->question ?></td>
                <td><?php echo $question->user_anwser ?></td>
                <td><?php echo $question->anwser ?></td>
                <phpif if($question->question == $question->user_anwser) endif?> {
                    <td>✅</td>}else{
                    <td>❎</td>
                    }


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>