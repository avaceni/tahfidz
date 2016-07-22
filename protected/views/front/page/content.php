<div class="body" id="article">
    <div class="container">
        <div class="wrapper-content">

            <div class="content">
                <?php
                if ($newest != null) {
                    ?>                    
                    <div class="popular-news-box table">
                        <div class="column top-news">
                            <div class="ajax-information">
                                <div class="page-type" id=<?php echo $content_type ?>></div>
                                <div class="load-times" id="1"></div>
                            </div>
                            <?php
                            foreach ($newest as $content) {
                                $cn = 0;
                                foreach ($content['comment'] as $comment) {
                                    $cn++;
                                }
                                ?>
                                <div class="image-box">
                                    <img src="<?php echo $content->getImagePopularUrl(); ?>" alt="">
                                    <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" class="comment"><?php echo $cn ?></a>
                                </div>
                                <div class="intro">
                                    <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" title=""><?php echo $content->title ?></a>
                                    <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content->created_time) ?></span><a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array('id' => $content->createdBy->id)); ?>" class="author"><?php echo $content->createdBy->full_name ?></a></p>
                                    <p><?php echo $content->description ?></p>
                                    <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" class="button small orange more">Selengkapnya</a>
                                </div>
                                <?php
                                break;
                            }
                            ?>
                        </div>
                        <div class="column popular-news">
                            <h4>Artikel Terpopuler</h4>
                            <ul>
                                <?php
                                foreach ($popular as $content) {
                                    $cn = 0;
                                    foreach ($content['comment'] as $comment) {
                                        $cn++;
                                    }
                                    ?> 
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" title=""><?php echo $content->title ?></a>
                                        <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content->created_time) ?></span><a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array('id' => $content->createdBy->id)); ?>" class="author"><?php echo $content->createdBy->full_name ?></a><a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" class="comment"><?php echo $cn ?></a></p>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="article-box">
                        <?php
                        $in = 1;
                        foreach ($newest as $content) {
                            $cn = 0;
                            foreach ($content['comment'] as $comment) {
                                $cn++;
                            }
                            if ($in > 1) {
                                ?>
                                <div class="article-list">
                                    <div class="article-image">
                                        <div class="image-box">
                                            <img src="<?php echo $content->getImageListUrl(); ?>" alt="#">
                                            <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" class="comment"><?php echo $cn ?></a>
                                        </div>
                                    </div>
                                    <div class="intro">
                                        <a href="<?php echo Yii::app()->createUrl($base_url, array('id' => $content->id)) ?>" title=""><?php echo $content->title ?></a>
                                        <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content->created_time) ?></span><a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array('id' => $content->createdBy->id)); ?>" class="author"><?php echo $content->createdBy->full_name ?></a></p>
                                        <p class="intro-text"><?php echo $content->description ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                            $in++;
                        }
                        ?>
                    </div>
                    <div class="button-box loader">
                        <a href="javascript:void(0);" class="button medium">Load More</a>
                        <span class="loader"></span>
                    </div>
                    <?php
                } else {
                    ?>    
                    <div class="guide-box">
                        <h2>Afwan, konten belum tersedia</h2>
                    </div>                
                    <?php
                }
                ?>                
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