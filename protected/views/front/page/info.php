<div class="body" id="info">
    <div class="container">
        <div class="wrapper-content">
            <div class="content">
                <div class="schedule-box">
                    <h4>Kajian Rutin</h4>
                    <ul id="schedule-detail" class="form-format text">
                        <?php foreach ($currentRoutines as $currentRoutine) { ?>
                            <li>
                                <label><?php echo $currentRoutine->getEvery(); ?></label>
                                <div class="data">
                                    <ul>
                                        <li>
                                            <p class="content-info"><?php echo $currentRoutine->getProgram(); ?></p>
                                            <p class="meta"><span class="time"><?php echo $currentRoutine->getTimeStart() ?> - <?php echo $currentRoutine->getTimeEnd() ?></span><span>bersama</span><a href="" class="author">Ust. Syatori Abdurrouf</a></p>
                                            <p class="content-info place"><?php echo $currentRoutine->getPlace(); ?> | <?php echo $currentRoutine->getContactPerson(); ?></p>
                                            <p class="content-info detail"><?php echo $currentRoutine->getAddress(); ?></p>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="button-box">
                        <a href="<?php echo Yii::app()->createUrl("front/page/infokajianrutin") ?>" class="button basic">Selengkapnya</a>
                    </div>
                </div>
                <input type="hidden" id="new_event_last_offset" value="1">
                <div class="content-list-box" id="event-list">
                    <?php foreach ($model_event as $event) { ?>
                        <div class="box-list">
                            <div class="box-list-wrap">
                                <div class="box-list-detail">
                                    <a href="<?php echo Yii::app()->createUrl("front/page/detailinfo", array('id' => $event->id, 'event' => str_replace(" ", "-", $event->getEvent()))) ?>" title="<?php echo $event->getEvent(); ?>">
                                        <img src="<?php echo $event->getImageUrl(); ?>" alt="<?php echo $event->getEvent(); ?>">
                                    </a>
                                </div>
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailinfo", array('id' => $event->id, 'event' => str_replace(" ", "-", $event->getEvent()))) ?>" class="info-title"><?php echo $event->getEvent(); ?></a>
                                <p class="meta"><span class="date"><?php echo $event->getDate(); ?></span><a href="<?php echo Yii::app()->createUrl("front/page/detailinfo", array('id' => $event->id, 'event' => str_replace(" ", "-", $event->getEvent()))) ?>" class="comment"><?php echo $event->getTotalComment(); ?></a></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="button-box loader">
                    <a href="javascript:void(0);" class="button medium" id="event-more">Load More</a>
                    <span class="loader"></span>
                </div>
            </div>
            <div class="sidebar">
                <div class="widget-box magazine">
                    <h4>Swaraikadi Magazine</h4>
                    <?php
                    foreach ($magazine as $content) {
                        ?>
                        <a class="image-box various fancybox.iframe" href="<?php echo Yii::app()->createUrl("front/page/magazine"); ?>">
                            <img src="<?php echo Yii::app()->baseUrl . $content->cover_image ?>" alt="#">
                        </a>
                        <?php
                        break;
                    }
                    ?>
                    <ul>
                        <?php
                        foreach ($magazine as $content) {
                            ?>
                            <li><a href="<?php echo Yii::app()->baseUrl . $content->url ?>" onclick="return countDownload(<?php echo $content->id ?>);"><?php echo $content->title ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>

                    <div class="button-box">
                        <a href="<?php echo Yii::app()->createUrl("front/page/download"); ?>" class="button medium">Arsip</a>
                    </div>
                </div>
                <?php /*
                <div class="widget-box donate">
                    <h4>Rekening Donasi</h4>
                    <div class="donate-detail">
                        <img src="<?php echo Yii::app()->baseUrl . $bank->bank_logo ?>">
                        <b><?php echo $bank->bank_name ?></b>
                        <span><i>No. Rek.</i><strong><?php echo $bank->account_number ?></strong></span>
                        <b>a/n <?php echo $bank->account_name ?></b>
                    </div>
                </div>
                */?>
                <div class="widget-box fanpage">
                    <div class="fb-like-box" data-href="https://www.facebook.com/swaraikadi" data-width="100%" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
                </div>
            </div>
        </div>
    </div>
</div>