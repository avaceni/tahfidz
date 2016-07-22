<div class="body" id="profile">
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="profile-box">
                    <?php //for ($i=0; $i < 5; $i++) {?>

                    <?php
                    foreach ($chaplain_list as $chaplain) {
                        ?>
                        <div class="profile-list">
                            <div class="profile-image">
                                <div class="image-box">
                                    <img src="<?php echo $chaplain->getPhotoUrl(); ?>" alt="#">
                                </div>
                            </div>
                            <div class="intro">
                                <a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array('id' => $chaplain->id)); ?>" title="" class="title"><?php echo $chaplain->fullname ?></a>
                                <p class="intro-text"><?php echo Utility::shortText($chaplain->description, 350) ?></p>
                                <a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array('id' => $chaplain->id)); ?>" class="button more orange">Selengkapnya</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!--<div class="profile-list">
                        <div class="profile-image">
                            <div class="image-box">
                                <img src="<?php echo Yii::app()->baseUrl ?>/images/resource/cahyadi_takariawan.jpg" alt="#">
                                 <a href="#" class="consultation" title="Konsultasi"></a>
                            </div>
                        </div>
                        <div class="intro">
                            <a href="#" title="Ustadz Yusuf Mansur" class="title">Ustadz Cahyadi Takariawan</a>
                            <p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <a href="#" class="button more orange">Selengkapnya</a>
                        </div>
                    </div>-->
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