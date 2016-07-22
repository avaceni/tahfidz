<?php
foreach ($model_comment as $comment_each) {
    ?>
    <li>
        <div class="comment-detail">
            <p class="meta"><span class="user"><?php echo $comment_each->name ?></span><span class="date"><?php echo Utility::getDateFormat($comment_each->created_date) ?></span></p>
            <p class="comment-text"><?php echo $comment_each->comment ?></p>
        </div>
    </li>
    <?php
}
?>        