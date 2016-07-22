<div class="body" id="consultation">
    <div class="container">
        <div class="wrapper-content">
            <div class="content">
                <div class="guide-box">
                    <h2>Anda bertanya kami menjawab.</h2>
                    <div class="guide-content">
                        <p>Rubrik Konsultasi Islami ini, Insya Allah akan menjawab persoalan Anda seputar:</p>
                        <p><b>Syari’ah</b> (berisi masalah seputar Aqidah, Ibadah, Akhlak, dan Fiqh Kontemporer) diasuh oleh <i>Ustadz. H. Sulhan Zainuri, Lc., MA</i>. <i>Ustadz. Muhammad A. Sholihun</i>, dan <i>Ustadz. Syafi’I Masykur, S.Ag., M.Hum</i>.</p>
                        <p><b>Curhat</b> (berisi masalah penyakit-penyakit hati serta tips-tips mengobatinya) diasuh oleh <i>Ustadz. KH. Syatori Abdurrauf</i>.</p> 
                        <p><b>Keluarga Bahagia</b> (Curahan keluarga sakinah, mawaddah, warahmah, pintu masuk surga) diasuh oleh <i>Ustadz. Cahyadi Takariawan</i>.</p> 
                        <p><b>Remaja dan Pernikahan</b> (permasalahan keluarga dan persiapan menuju pelaminan) diasuh oleh <i>Ustadz. Salim A. Fillah</i>.</p>
                        <p><b>Kesehatan</b> diasuh oleh <i>dr. Arif Rahman</i>.</p> 
                        <p><b>Gizi Halalan Thayyiban</b> diasul oleh <i>Ustadzah. Deri Rizki Anggarani, S.Gz</i>.</p>
                    </div>
                    <a href="javascript:void(0);" class="button big show-ask">Kirim Pertanyaan</a>
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
                <div id="ask-form" class="main-form-box child-box" style="display: <?php echo isset($_POST['AnswerQuestion']) ? 'block' : 'none'; ?>">
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
                        <li>
                            <?php echo CHtml::activeLabelEx($model, 'category_id'); ?>
                            <div class="data">
                                <?php echo CHtml::activeDropDownList($model, 'category_id', AqCategory::model()->findListCategory(), array('prompt' => 'Pilih Jenis Konsultasi')) ?>
                                <?php echo CHtml::error($model, 'category_id') ?>
                            </div>
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
                <!--</form>-->
                <input type="hidden" id="newconsultation_last_offset" value="1">
                <div class="content-list-box" id="newConsultation">
                    <?php foreach ($newConsultations as $newConsultation) { ?>
                        <div class="box-list">
                            <div class="box-list-wrap">
                                <a href="<?php echo Yii::app()->createUrl("front/page/kategorikonsultasi", array("cid" => $newConsultation->category->id, $newConsultation->category->getCategory())) ?>" class="category"><?php echo $newConsultation->category->getCategory() ?></a>
                                <div class="box-list-detail">
                                    <p class="meta"><span class="date"><?php echo $newConsultation->getCreatedTime(); ?></span><a href="" class="comment"><?php echo $newConsultation->getTotalComment(); ?></a></p>
                                    <p class="content">
                                        <?php echo Utility::shortText($newConsultation->getQuestion()) ?>
                                    </p>
                                    <div class="button-box">
                                        <a href="<?php echo Yii::app()->createUrl("front/page/detailkonsultasi", array("id" => $newConsultation->id, $newConsultation->category->getCategory())) ?>" class="button more orange">Selengkapnya</a>
                                    </div>
                                </div>
                                <div class="author-box table">
                                    <div class="image-box column"><img src="<?php echo Yii::app()->baseUrl ?>/images/resource/profile.jpg"></div>
                                    <div class="author-detail column">                                        
                                        <?php if (isset($newConsultation->answeredBy->id)) { ?>
                                            <span>dijawab oleh</span>
                                            <a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array("id" => $newConsultation->answeredBy->id, str_replace(" ", "-", $newConsultation->answeredBy->getFullName()))) ?>"><?php echo $newConsultation->answeredBy->getFullName() ?></a>
                                        <?php
                                        } else {
                                            ?>
                                            <span><i><b>menunggu jawaban Tim Konsultasi</b></i></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="button-box consultation-loader">
                    <a href="javascript:void(0);" class="button medium">Load More</a>
                    <span class="loader"></span>
                </div>
            </div>

            <div class="sidebar">
                <div class="widget-box consultation">
                    <h4>Konsultasi</h4>
                    <ul>
                        <?php foreach ($populerConsultations as $populerConsultation) { ?>
                            <li>
                                <a class="category" href="<?php echo Yii::app()->createUrl("front/page/kategorikonsultasi", array("cid" => $populerConsultation->category->id, $populerConsultation->category->getCategory())) ?>"><?php echo $populerConsultation->category->getCategory() ?></a>
                                <p class="meta"><span class="date"><?php echo $populerConsultation->getCreatedTime(); ?></span><a href="" class="comment"><?php echo $populerConsultation->getTotalComment(); ?></a></p>
                                <p><?php echo Utility::shortText($populerConsultation->getQuestion(), 127); ?></p>
                                <a href="<?php echo Yii::app()->createUrl("front/page/detailkonsultasi", array("id" => $newConsultation->id, $populerConsultation->category->getCategory())) ?>" class="link-more">Selengkapnya</a>
                                <?php if (isset($populerConsultation->answeredBy->id)) { ?>
                                    <p class="meta"><span>oleh</span><a href="<?php echo Yii::app()->createUrl("front/profil/detaildai", array("id" => $populerConsultation->answeredBy->id, str_replace(" ", "-", $populerConsultation->answeredBy->getFullName()))) ?>" class="author"><?php echo $populerConsultation->answeredBy->getFullName() ?></a></p>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="button-box">
                        <!--<a href="#" class="button medium">Konsultasi</a>-->
                    </div>
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