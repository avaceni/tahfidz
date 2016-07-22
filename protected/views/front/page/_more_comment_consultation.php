<?php foreach ($consultations as $consultation) { ?>
    <li>
        <div class="comment-detail">
            <p class="meta"><span class="user"><?php echo $comment->getName(); ?></span><span class="date"><?php echo $comment->getCreatedDate(); ?></span></p>
            <p class="comment-text"><?php echo $comment->getComment(); ?></p>
        </div>
    </li>
<?php } ?>
