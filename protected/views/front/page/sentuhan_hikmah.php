<div class="body" id="article">
    <div class="container">
        <div class="wrapper-content">
            <div class="content">
                <div class="popular-news-box table">
                    <div class="column top-news">
                        <div class="ajax-information">
                            <div class="page-type" id="2"></div>                        
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
                                <img src="<?php echo Yii::app()->baseUrl . $content->image_popular ?>" alt="#">
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailberita") ?>" class="comment"><?php echo $cn ?></a>
                            </div>
                            <div class="intro">
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailberita") ?>" title=""><?php echo $content->title ?></a>
                                <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content->created_time) ?></span><a href="#" class="author"><?php echo $content->createdBy->full_name ?></a></p>
                                <p><?php echo $content->description ?></p>
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailberita") ?>" class="button small orange more">Selengkapnya</a>
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
                                    <a href="#" title=""><?php echo $content->title ?></a>
                                    <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content->created_time) ?></span><a href="#" class="author"><?php echo $content->createdBy->full_name ?></a><a href="" class="comment"><?php echo $cn ?></a></p>
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
                                        <img src="<?php echo Yii::app()->baseUrl . $content->image_list ?>" alt="#">
                                        <a href="" class="comment"><?php echo $cn ?></a>
                                    </div>
                                </div>
                                <div class="intro">
                                    <a href="#" title=""><?php echo $content->title ?></a>
                                    <p class="meta"><span class="date"><?php echo Utility::getDateFormat($content->created_time) ?></span><a href="#" class="author"><?php echo $content->createdBy->full_name ?></a></p>
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
            </div>
            <div class="sidebar">
                <div class="widget-box magazine">
                    <h4>Swaraikadi Magazine</h4>
                    <a class="image-box" href="#">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/resource/magazine.jpg" alt="#">
                    </a>
                    <ul>
                        <li><a href="#">Edisi Januari 2014</a></li>
                        <li><a href="#">Edisi Desember 2013</a></li>
                        <li><a href="#">Edisi November 2013</a></li>
                        <li><a href="#">Edisi Oktober 2013</a></li>
                        <li><a href="#">Edisi September 2013</a></li>
                        <li><a href="#">Edisi Agustus 2013</a></li>
                    </ul>
                    <div class="button-box">
                        <a href="#" class="button medium">Arsip</a>
                    </div>
                </div>
                <div class="widget-box info">
                    <h4>Info Kajian Terdekat</h4>
                    <a class="image-box" href="#">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/resource/kajian.jpg" alt="#">
                    </a>
                    <ul>
                        <li>
                            <a href="#">Typi non habent claritatem insitamest usus legentis in iis qui facit eorum</a>
                            <p class="meta"><span class="date">12 Januari 2014</span><a href="" class="comment">14</a></p>
                        </li>
                        <li>
                            <a href="#">Typi non habent claritatem insitamest usus legentis in iis qui facit eorum</a>
                            <p class="meta"><span class="date">12 Januari 2014</span><a href="" class="comment">14</a></p>
                        </li>
                        <li>
                            <a href="#">Typi non habent claritatem insitamest usus legentis in iis qui facit eorum</a>
                            <p class="meta"><span class="date">12 Januari 2014</span><a href="" class="comment">14</a></p>
                        </li>
                    </ul>
                    <div class="button-box">
                        <a href="#" class="button medium">Arsip</a>
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