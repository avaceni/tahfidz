<div class="body" id="consultation">
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="consul-category-box">
                    <div class="consul-category-content table">
                        <div class="column image-box">
                            <?php
                            if (isset($currentConsultation->answeredBy->id)) {
                                ?>
                                <img src="<?php echo $currentConsultation->answeredBy->getPhotoUrl()    ?>">
                                <?php
                            }
                            else{
                                ?>
                                <img src="<?php echo Yii::app()->baseUrl . "/images/resource/profile.jpg"?>">                                
                                <?php
                            }
                            ?>

                        </div>
                        <div class="column category-detail">
                            <a href="<?php echo Yii::app()->createUrl("front/page/kategorikonsultasi", array("cid" => $currentConsultation->category->id, $currentConsultation->category->getCategory())) ?>" class="category-title"><?php echo $currentConsultation->category->getCategory(); ?></a>
                            <div class="author">
                                <?php
                                if (isset($currentConsultation->answeredBy->id)) {
                                    ?>
                                    <span>bersama</span><a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array("id" => $currentConsultation->answeredBy->id, str_replace(" ", "-", $currentConsultation->answeredBy->getFullName()))) ?>"><?php echo $currentConsultation->answeredBy->getFullName(); ?></a>                                
                                    <?php
                                } else {
                                    ?>
                                    <span><i><b>menunggu jawaban Tim Konsultasi</b></i></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <p><?php echo $currentConsultation->category->getDetail(); ?></p>
                            <a href="<?php echo Yii::app()->createUrl("front/page/formkonsultasi") ?>" class="button medium">Konsultasi</a>
                        </div>
                    </div>
                </div>
                <div class="consul-detail-box">
                    <div class="consul-content question">
                        <div class="consul-content-header">
                            <h5><?php echo $currentConsultation->getName(); ?></h5>
                            <p class="meta"><span class="date"><?php echo $currentConsultation->getCreatedTime(); ?></span></p>
                        </div>
                        <div class="consul-content-detail">
                            <p>
                                <?php echo $currentConsultation->getQuestion(); ?>
                            </p>
                        </div>
                    </div>
                    <?php if (isset($currentConsultation->answeredBy)) { ?>
                        <div class="consul-content answer">
                            <div class="consul-content-header table">
                                <div class="column author-box">
                                    <a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array("id" => $currentConsultation->answeredBy->id, str_replace(" ", "-", $currentConsultation->answeredBy->getFullName()))) ?>"><?php echo $currentConsultation->answeredBy->getFullName(); ?></a>
                                    <p class="meta"><span class="date"><?php $currentConsultation->getCreatedTime(); ?></span></p>
                                </div>
                                <div class="column image-box"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/profile.jpg"></div>
                            </div>
                            <div class="consul-content-detail">
                                <p>
                                    <?php echo $currentConsultation->getAnswer(); ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="article-related-box">
                    <h4>Konsultasi Lainnya</h4>
                    <ul>
                        <?php foreach ($relatedConsultations as $relatedConsultation) { ?> 
                            <li>
                                <a class="category" href="<?php echo Yii::app()->createUrl("front/page/kategorikonsultasi", array("cid" => $relatedConsultation->category->id, $relatedConsultation->category->getCategory())) ?>"><?php echo $relatedConsultation->category->getCategory() ?></a>
                                <p class="meta"><span class="date"><?php echo $relatedConsultation->getCreatedTime(); ?></span><a href="" class="comment"><?php echo $relatedConsultation->getTotalComment(); ?></a></p>
                                <p class="text-title"><?php echo $relatedConsultation->getQuestion(); ?></p>
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailkonsultasi", array("id" => $relatedConsultation->id, $relatedConsultation->category->getCategory())) ?>" class="link-more">Selengkapnya</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="comment-box">
                    <div class="comment-header">
                        <a href="javascript:void(0);" class="button medium" id="comment">Komentar</a>
                    </div>
                    <div id="comment-form" class="child-box form-box" style="display: <?php echo isset($_POST['Comment']) ? 'block' : 'none' ?>">
                        <?php // awal form ?>
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
                                <?php echo CHtml::activeLabelEx($model, 'comment'); ?>
                                <div class="data">
                                    <?php echo CHtml::activeTextArea($model, 'comment') ?>
                                    <?php echo CHtml::error($model, 'comment') ?>
                                    <div class="button-box">
                                        <input type="submit" class="button big" value="Kirim">
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php $this->endWidget(); ?>
                        <?php // akhir form?>
                    </div>
                    <input type="hidden" id="consultationcomment_last_offset" value="1">
                    <ul id="consultationcomment"class="comment-list">
                        <?php foreach ($currentConsultation->comment as $comment) { ?>
                            <li>
                                <div class="comment-detail">
                                    <p class="meta"><span class="user"><?php echo $comment->getName(); ?></span><span class="date"><?php echo $comment->getCreatedDate(); ?></span></p>
                                    <p class="comment-text"><?php echo $comment->getComment(); ?></p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="btn_consultationcomment_loadmore"class="button-box consultation-loader">
                        <a href="javascript:void(0);" class="button medium">Load More</a>
                        <span class="loader"></span>
                    </div>
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
                    <a class="image-box" href="<?php echo Yii::app()->createUrl("front/page/detailinfo/", array('id' => $newest_event->id)); ?>">
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
                 */ ?>
                <div class="widget-box fanpage">
                    <div class="fb-like-box" data-href="https://www.facebook.com/swaraikadi" data-width="100%" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
                </div>
            </div>
        </div>
    </div>
</div>