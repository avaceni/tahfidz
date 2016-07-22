<?php foreach($consultations as $consultation){?>
<div class="box-list">
    <div class="box-list-wrap">
        <a href="<?php echo Yii::app()->createUrl("front/page/kategorikonsultasi") ?>" class="category"><?php echo $consultation->category->getCategory() ?></a>
        <div class="box-list-detail">
            <p class="meta"><span class="date"><?php echo $consultation->getCreatedTime(); ?></span><a href="" class="comment">14</a></p>
            <p class="content">
                <?php echo Utility::shortText($consultation->getQuestion()) ?>
            </p>
            <div class="button-box">
                <a href="<?php echo Yii::app()->createUrl("front/page/detailkonsultasi") ?>" class="button more orange">Selengkapnya</a>
            </div>
        </div>
        <div class="author-box table">
            <div class="image-box column"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/profile.jpg"></div>
            <div class="author-detail column">
                <span>dijawab oleh</span>
                <a href=""><?php echo $consultation->answeredBy->getFullName() ?></a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
