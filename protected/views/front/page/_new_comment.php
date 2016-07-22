<li>
    <div class="comment-detail">
        <p class="meta"><span class="user"><?php echo $comment['name']; ?></span><span class="date"><?php echo Utility::getDateFormat(date('Y-m-d H:i:s'));?></span></p>
        <p class="comment-text"><?php echo $comment['comment']; ?></p>
    </div>
</li>