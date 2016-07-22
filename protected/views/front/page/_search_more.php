<?php
foreach ($search_result as $value) {
    ?>
    <li>
        <div>
            <h3>
                <a href="<?php echo Yii::app()->createUrl($value['url']) ?>"><?php echo $value['title'] ?></a>
            </h3>
            <div>
                <cite><?php echo Yii::app()->createAbsoluteUrl($value['url']) ?></cite>                                        
            </div>
            <p><?php echo $value['description'] ?></p>
            <div class="author">
                <?php echo $value['author'] . ' | ' . $value['created_time'] ?>
            </div>
        </div>
    </li>                                   
    <?php
}
?>
