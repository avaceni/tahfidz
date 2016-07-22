<div class="body" id="detail-page">
    <div class="content_id" id="<?php echo $content_id ?>"></div>
    <div class="content_type" id="<?php echo $content_type ?>"></div>
    <div class="last-offset" id="5"></div>
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="detail-page-box">
                    <div class="image-box">
                        <img src="<?php echo Yii::app()->baseUrl . $content_detail->image_cover ?>">
                        <span class="caption"><?php isset($content_detail->image_source) ? print_r($content_detail->image_source) : print_r('Redaksi Ikadi') ?></span>
                    </div>
                    <div class="detail-article">
                        <h1><?php echo $content_detail->title ?></h1>
                        <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content_detail->created_time) ?></span></p>
                        <div class="text-box">
                            <?php echo $content_detail->content ?>
                        </div>
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