<div class="body" id="consultation">
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="consul-category-box">
                    <div class="consul-category-content table">
                        <div class="column image-box"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/profile.jpg"></div>
                        <div class="column category-detail">
                            <a href="#" class="category-title"><?php echo $category_model->getCategory(); ?></a>
                            <div class="author">
                                <span>bersama</span><a href=""><?php echo implode(', ', $category_model->getUstadzNames()) ?></a>
                            </div>
                            <p><?php echo $category_model->getDetail() ?></p>
                            <!--<a href="<?php //echo Yii::app()->createUrl("front/page/formkonsultasi") ?>" class="button medium">Konsultasi</a>-->
                        </div>
                    </div>
                </div>
                <?php if (Yii::app()->user->hasFlash('success')) { ?>
                    <div id="notify" class="main-form-box child-box successed">
                        <h2>Terima kasih</h2>
                        <p>Pertanyaan Anda telah berhasil disimpan.<br/>Pertanyaan yang telah dijawab akan diberitahukan melalui email yang Anda inputkan.</p>
                    </div>
                <?php } else if (Yii::app()->user->hasFlash('error')) { ?>
                    <div id="notify" class="main-form-box child-box failed">
                        <h2>Mohon Maaf</h2>
                        <p>Form Konsultasi tidak diisi dengan benar. Silahkan Perbaiki Kesalahan Tersebut.</p>
                    </div> 
                <?php } ?>
                <div id="ask-form" class="main-form-box child-box" style="display: block">
                    <!--<form>-->
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'group-form',
                        'enableAjaxValidation' => true,
                    ));
                    ?>
                    <ul class="form-format">
                        <li>
                            <?php echo CHtml::activeLabelEx($model, 'name'); ?>
                            <div class="data">
                                <?php echo CHtml::activeTextField($model, 'name'); ?>
                                <?php echo CHtml::error($model, 'name') ?>
                            </div>
                        </li>
                        <li>
                            <?php echo CHtml::activeLabelEx($model, 'email'); ?>
                            <div class="data">
                                <?php echo CHtml::activeTextField($model, 'email', array('placeholder' => 'contoh: fulan@gmail.com')) ?>
                                <?php echo CHtml::error($model, 'email') ?>
                            </div>
                        </li>
                        <li>
                            <?php echo CHtml::activeLabelEx($model, 'phone_number'); ?>
                            <div class="data">
                                <?php echo CHtml::activeTextField($model, 'phone_number', array('placeholder' => 'contoh: 08571234567')); ?>
                                <?php echo CHtml::error($model, 'phone_number') ?>
                            </div>
                        </li>
                        <!--<li>-->
                            <?php //echo CHtml::activeLabelEx($model, 'category_id'); ?>
                            <!--<div class="data">-->
                                <?php echo CHtml::activeHiddenField($model, 'category_id', array('value'=>  isset($_GET['cid'])?$_GET['cid']:null)) ?>
                                <?php //echo CHtml::error($model, 'category_id') ?>
                            <!--</div>-->
                        </li>
                        <li>
                            <?php echo CHtml::activeLabelEx($model, 'question'); ?>
                            <div class="data">
                                <?php echo CHtml::activeTextArea($model, 'question') ?>
                                <?php echo CHtml::error($model, 'question') ?>
                                <div class="button-box">
                                    <input type="submit" class="button big" value="Kirim">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <?php $this->endWidget(); ?>
                    <!--</form>-->
                </div>

                <div class="article-related-box single-box">
                    <ul>
                        <?php foreach ($related_aq_model as $related_aq) { ?> 
                            <li>
                                <p class="text-title"><?php echo $related_aq->getQuestion(); ?>.</p>
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailkonsultasi", array("id" => $related_aq->id, $related_aq->category->getCategory())) ?>" class="link-more">Selengkapnya</a>
                                <p class="meta"><span class="date"><?php echo $related_aq->getCreatedTime(); ?></span><a href="<?php echo Yii::app()->createUrl("front/page/detailkonsultasi", array("id" => $related_aq->id, $related_aq->category->getCategory())) ?>" class="comment"><?php echo $related_aq->getTotalComment(); ?></a></p>
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
                <div class="widget-box info">
                    <h4>Event Terbaru</h4>
                    <?php
                    $image = array();
                        $image[] = $newest_event->image;
                    ?>
                    <a class="image-box" href="<?php echo Yii::app()->createUrl("front/page/detailinfo/", array('id'=>$newest_event->id)); ?>">
                        <img src="<?php echo Yii::app()->baseUrl . $image[0] ?>" alt="<?php echo $newest_event->event ?>">
                    </a>
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