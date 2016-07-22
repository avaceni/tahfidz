<?php
foreach ($newest_more as $content) {
    $cn = 0;
    foreach ($content['comment'] as $comment) {
        $cn++;
    }
    ?>
    <div class="article-list">
        <div class="article-image">
            <div class="image-box">
                <img src="<?php echo Yii::app()->baseUrl . $content->image_list ?>" alt="">
                <a href="" class="comment"><?php echo $cn ?></a>
            </div>
        </div>
        <div class="intro">
            <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" title=""><?php echo $content->title ?></a>
            <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content->created_time) ?></span></p>
            <p class="intro-text"><?php echo $content->description ?></p>
        </div>
    </div>
    <?php
}
?>