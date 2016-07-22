<?php
$metades = $content_detail->meta_description !== '' ? $content_detail->meta_description : Utility::shortText($content_detail->description, 60);
$metakey = $content_detail->meta_keywords !== '' ? $content_detail->meta_keywords : $content_detail->tags !== '' ? $content_detail->tags : Utility::getMetaKeyFromTitle($content_detail->title);
$metaaut = $content_detail->meta_author !== '' ? $content_detail->meta_author : $content_detail->createdBy->full_name;
Yii::app()->clientScript->registerMetaTag(
        $metades, 'description', NULL, array('lang' => 'id'), 'meta-des'
);
Yii::app()->clientScript->registerMetaTag(
        Utility::getMetaKeyFromTitle($content_detail->title), 'keywords', NULL, array('lang' => 'id'), 'meta-key'
);
Yii::app()->clientScript->registerMetaTag(
        $metaaut, 'author', NULL, array('lang' => 'id'), 'meta-aut'
);
?>
<div class="body" id="detail-page">
    <div class="content_id" id="<?php echo $content_id ?>"></div>
    <div class="content_type" id="<?php echo $content_type ?>"></div>
    <div class="last-offset" id="5"></div>
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="detail-page-box">
                    <div class="image-box">
                        <img src="<?php echo $content_detail->getImageCoverUrl() ?>">
                        <span class="caption"><?php isset($content_detail->image_source) ? print_r($content_detail->image_source) : print_r('Redaksi Ikadi') ?></span>
                    </div>
                    <div class="detail-article">
                        <h1><?php echo $content_detail->title ?></h1>
                        <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content_detail->created_time) ?></span></p>
                        <div class="text-box">
                            <?php echo $content_detail->content ?>
                        </div>
                        <p class="meta"><span class="date">Penulis : <?php echo $content_detail->createdBy->full_name ?></span></p>                        
                    </div>    
                </div>                
                <div class="comment-box">
                    <div id="comment-notify" class="child-box successed" style="display:none">
                        <h6>Terimakasih</h6><p>Telah memberikan komentar dengan sopan<br/></p>
                    </div>                    
                    <div class="comment-header">
                        <a href="javascript:void(0);" class="button medium" id="comment">Komentar</a>
                    </div>
                    <div id="comment-form" class="child-box form-box">

                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'com-form',
                            'enableAjaxValidation' => true,
                                //<!--'htmlOptions' => array('enctype' => 'multipart/form-data')-->,
                        ));
                        ?>
                        <?php echo $form->errorSummary($comment_model); ?>
                        <ul class="form-format">
                            <li>
                                <label><?php echo $form->labelEx($comment_model, 'name'); ?></label>
                                <div class="data name">
                                    <?php echo $form->textField($comment_model, 'name'); ?>
                                    <span class="errorMessage name"> </span>
                                </div>
                            </li>
                            <li>
                                <label><?php echo $form->labelEx($comment_model, 'email'); ?></label>
                                <div class="data email">
                                    <?php echo $form->textField($comment_model, 'email', array('placeholder' => 'contoh: fulan@gmail.com')); ?>
                                    <span class="errorMessage email"> </span>
                                </div>
                            </li>
                            <div>
                                <?php echo $form->hiddenField($comment_model, 'content_id', array('value' => $_GET['id'])); ?>
                            </div>
                            <li>
                                <label><?php echo $form->labelEx($comment_model, 'comment'); ?></label>
                                <div class="data comment">
                                    <?php echo $form->textArea($comment_model, 'comment'); ?>
                                    <span class="errorMessage comment"> </span>                                                             
                                    <div class="button-box ">
                                        <?php echo CHtml::Button('Kirim', array('onclick' => 'sendComment();', 'class' => 'button big')); ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php $this->endWidget(); ?>
                    </div>
                    <ul class="comment-list">
                        <?php
                        foreach ($comment_list as $comment_each) {
                            ?>
                            <li>
                                <div class="comment-detail">
                                    <p class="meta"><span class="user"><?php echo $comment_each->name ?></span><span class="date"><?php echo Utility::getDateFormat($comment_each->created_date) ?></span></p>
                                    <p class="comment-text"><?php echo $comment_each->comment ?></p>
                                </div>
                            </li>
                            <?php
                        }
                        ?>                            
                    </ul>
                </div>
                <?php
                if ($comment_list != null) {
                    ?>
                    <div class="button-box comment-loader">
                        <a href="javascript:void(0);" class="button medium">Load More</a>
                        <span class="loader"></span>
                    </div>
                    <?php
                }
                ?>
                <div class="article-related-box">
                    <h4>Artikel Lainnya</h4>
                    <ul>
                        <?php
                        $ic = 0;
                        $content_list = array();
                        foreach ($some_content as $content) {
                            $cn = 0;
                            foreach ($content['comment'] as $comment) {
                                $cn++;
                            }
                            $content_list[$ic]['id'] = $content->id;
                            $content_list[$ic]['title'] = $content->title;
                            $content_list[$ic]['created_time'] = $content->created_time;
                            $content_list[$ic]['comment'] = $cn;
                            $ic++;
                        }
                        shuffle($content_list);
                        if (isset($content_list[4])) {
                            for ($i = 0; $i < 5; $i++) {
                                ?> 
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content_list[$i]['id'])) ?>"><?php echo $content_list[$i]['title'] ?></a>
                                    <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content_list[$i]['created_time']) ?></span><a href="" class="comment"><?php echo $content_list[$i]['comment'] ?></a></p>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>                
            </div>
            <div class="sidebar">
                <div class="widget-box popular">
                    <h4>Artikel Terpopuler</h4>
                    <ul>
                        <?php
                        foreach ($popular as $value) {
                            $cn = 0;
                            foreach ($value['comment'] as $comment) {
                                $cn++;
                            }
                            ?>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $value->id)) ?>"><?php echo $value->title ?></a>
                                <p class="meta"><span class="date"><?php echo Utility::getDateFormat($value->created_time) ?></span><a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $value->id)) ?>" class="comment"><?php echo $cn ?></a></p>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
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