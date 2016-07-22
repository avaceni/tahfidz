<div class="body" id="info">
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="detail-info-box table">
                    <div class="image-box column">
                        <a href="<?php echo $model_event->getImageUrl(); ?>">
                            <img src="<?php echo $model_event->getImageUrl(); ?>" alt="#">
                        </a>
                        <span>Klik pada gambar untuk memperbesar</span>
                    </div>
                    <div class="detail-info column">
                        <h1><?php echo $model_event->getEvent(); ?></h1>
                        <p class="meta"><span class="date"><?php echo $model_event->getCreated(); ?></span><a class="comment" href=""><?php echo $model_event->getTotalComment(); ?></a></p>
                        <ul class="form-format text-field">
                            <li>
                                <label>Tanggal</label>
                                <div class="data"><?php echo $model_event->getDate(); ?></div>
                            </li>
                            <li>
                                <label>Jam</label>
                                <div class="data"><?php echo $model_event->getTime(); ?></div>
                            </li>
                            <li>
                                <label>Tempat</label>
                                <div class="data">
                                    <?php echo $model_event->getPlace(); ?>
                                </div>
                            </li>
                            <li>
                                <label>Fasilitas</label>
                                <div class="data"><?php echo $model_event->getFacilities(); ?></div>
                            </li>
                            <li>
                                <label>Keterangan</label>
                                <div class="data"><?php echo $model_event->getNote(); ?></div>
                            </li>
                            <li>
                                <label>CP</label>
                                <div class="data"><b><?php echo $model_event->getContactPerson(); ?></b></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="comment-box">
                    <div class="comment-header">
                        <a href="javascript:void(0);" class="button medium" id="comment">Komentar</a>
                    </div>
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div id="comment-notify" class="child-box successed">
                            <h6>Terimakasih</h6>
                            <p>Telah memberikan komentar dengan sopan<br/></p>
                        </div>
                    <?php } ?>
                    <div id="comment-form" class="child-box form-box"  style="display: <?php echo isset($_POST['Comment']) ? 'block' : 'none' ?>">
                        <?php // awal form?>
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'group-form',
                            'enableAjaxValidation' => true,
                        ));
                        ?>
                        <ul class="form-format">
                            <li>
                                <?php echo CHtml::activeLabelEx($model_comment, 'name'); ?>
                                <div class="data">
                                    <?php echo CHtml::activeTextField($model_comment, 'name'); ?>
                                    <?php echo CHtml::error($model_comment, 'name') ?>
                                </div>
                            </li>
                            <li>
                                <?php echo CHtml::activeLabelEx($model_comment, 'email'); ?>
                                <div class="data">
                                    <?php echo CHtml::activeTextField($model_comment, 'email', array('placeholder' => 'contoh: fulan@gmail.com')) ?>
                                    <?php echo CHtml::error($model_comment, 'email') ?>
                                </div>
                            </li>
                            <li>
                                <?php echo CHtml::activeLabelEx($model_comment, 'comment'); ?>
                                <div class="data">
                                    <?php echo CHtml::activeTextArea($model_comment, 'comment') ?>
                                    <?php echo CHtml::error($model_comment, 'comment') ?>
                                    <div class="button-box">
                                        <input type="submit" class="button big" value="Kirim">
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php $this->endWidget(); ?>
                        <?php // akhir form?>
                    </div>
                    <ul class="comment-list">
                        <?php foreach ($model_event->comments as $comment) { ?>
                            <li>
                                <div class="comment-detail">
                                    <p class="meta"><span class="user"><?php echo $comment->getName(); ?></span><span class="date"><?php echo $comment->getCreatedDate(); ?></span></p>
                                    <p class="comment-text"><?php echo $comment->getComment(); ?></p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="article-related-box">
                    <h4>Info Lainnya</h4>
                    <ul>
                        <?php foreach ($model_event->getRelatedEvent() as $event) { ?> 
                            <li>
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailinfo", array('id' => $event->id, 'event' => str_replace(" ", "-", $event->getEvent()))) ?>"><?php echo $event->getEvent(); ?></a>
                                <p class="meta"><span class="date"><?php echo $event->getDate(); ?></span><a href="<?php echo Yii::app()->createUrl("front/page/detailinfo", array('id' => $event->id, 'event' => str_replace(" ", "-", $event->getEvent()))) ?>" class="comment"><?php echo $event->getTotalComment(); ?></a></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>                
            </div>
            <div class="sidebar">
                <div class="widget-box magazine">
                    <h4>Swaraikadi Magazine</h4>
                    <?php
                    foreach ($magazine as $content) {
                        ?>
                       <a class="image-box" href="<?php echo Yii::app()->baseUrl . $content->url ?>" onclick="return countDownload(<?php echo $content->id ?>);">
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