<?php foreach ($events as $event) { ?>
    <div class="box-list">
        <div class="box-list-wrap">
            <div class="box-list-detail">
                <a href="<?php echo Yii::app()->createUrl("front/page/detailinfo", array('id' => $event->id, 'event' => str_replace(" ", "-", $event->getEvent()))) ?>" title="<?php echo $event->getEvent(); ?>">
                    <img src="<?php echo $event->getImageUrl(); ?>" alt="<?php echo $event->getEvent(); ?>">
                </a>
            </div>
            <a href="<?php echo Yii::app()->createUrl("front/page/infokajianrutin", array('id' => $event->id, 'event' => str_replace(" ", "-", $event->getEvent()))) ?>" class="info-title"><?php echo $event->getEvent(); ?></a>
            <p class="meta"><span class="date"><?php echo $event->getDate(); ?></span><a href="" class="comment"><?php echo $event->getTotalComment(); ?></a></p>
        </div>
    </div>
<?php } ?>
