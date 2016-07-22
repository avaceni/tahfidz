<div class="body" id="consultation">
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="guide-box">
                    <h2>Anda bertanya kami menjawab.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
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