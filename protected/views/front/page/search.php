<div class="body" id="detail-page">
    <div class="container">
        <div class="wrapper-content">            
            <div class="content detail-view">
                <div class="detail-page-box search-box">
                    <div class="ajax-information">
                        <div class="search-timestamp" id=<?php echo $timestamp ?>></div>
                        <div class="search-keyword" id="<?php echo $key_search ?>"></div>
                        <div class="search-last-offset" id="0"></div>                        
                    </div>
                    <?php
                    echo CHtml::beginForm($this->createUrl('front/page/search'), 'get');
                    echo CHtml::textField('keyword', $key_search, array('id' => 'text', 'class' => 'sText'));
                    echo CHtml::submitButton('Cari', array('class' => ''));
                    echo CHtml::endForm();
                    ?>
                    <span id="count" class="sb_count"><?php echo '<b>' . $search_count . '</b>' ?> results for '<?php echo '<b>' . $key_search . '</b>' ?>'</span>
                    <div id="content">
                        <div id="results_area" class="result-area">
                            <ul class="search-list">
                                <?php
                                foreach ($search_result as $value) {
                                    ?>
                                    <li>
                                        <div>
                                            <h3>
                                                <a href="<?php echo Yii::app()->createUrl($value['url']) ?>"><?php echo $value['title'] ?></a>
                                            </h3>
                                            <div>
                                                <cite><?php echo Yii::app()->createAbsoluteUrl($value['url']) ?></cite>                                        
                                            </div>
                                            <p><?php echo $value['description'] ?></p>
                                            <div class="author">
                                                <?php echo $value['author'] . ' | ' . $value['created_time'] ?>
                                            </div>
                                        </div>
                                    </li>                                   
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if($search_count != 0){
                    ?>
                    <div class="button-box search-loader">
                        <a href="javascript:void(0);" class="button medium">Load More</a>
                        <span class="loader"></span>
                    </div>
                    <?php
                    }
                    ?>
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