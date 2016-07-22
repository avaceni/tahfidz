<ul>
    <li>
        <a class="category" href="#">Curhat</a>
        <p class="meta"><span class="date">Selasa, 18 Februari 2014</span><a href="" class="comment">14</a></p>
        <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat?</p>
        <a href="#" class="link-more">Selengkapnya</a>
        <p class="meta"><span>oleh</span><a href="#" class="author">Ust. Syatori Abdurrouf</a></p>
    </li>
    <li>
        <a class="category" href="#">Keluarga Bahagia</a>
        <p class="meta"><span class="date">Selasa, 18 Februari 2014</span><a href="" class="comment">14</a></p>
        <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat?</p>
        <a href="#" class="link-more">Selengkapnya</a>
        <p class="meta"><span>oleh</span><a href="#" class="author">Ust. Cahyadi Takariawan</a></p>
    </li>
    <li>
        <a class="category" href="#">Gizi Halalan Thayyiban</a>
        <p class="meta"><span class="date">Selasa, 18 Februari 2014</span><a href="" class="comment">14</a></p>
        <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat lobortis nisl ut aliquip ex ea commodo consequat?</p>
        <a href="#" class="link-more">Selengkapnya</a>
        <p class="meta"><span>oleh</span><a href="#" class="author">Ustzh. Anggraini Yazid</a></p>
    </li>
    <li>
        <a class="category" href="#">Remaja &amp; Pernikahan</a>
        <p class="meta"><span class="date">Selasa, 18 Februari 2014</span><a href="" class="comment">14</a></p>
        <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat?</p>
        <a href="#" class="link-more">Selengkapnya</a>
        <p class="meta"><span>oleh</span><a href="#" class="author">Ust. Salim A. Fillah</a></p>
    </li>
    <!-- <li>
            <a class="category" href="#">Syari'ah</a>
            <p class="meta"><span class="date">Selasa, 18 Februari 2014</span><a href="" class="comment">14</a></p>
            <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat?</p>
            <a href="#" class="link-more">Selengkapnya</a>
            <p class="meta"><span>oleh</span><a href="#" class="author">Ust. Syafi'i Masykur</a></p>
    </li> -->
</ul>



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
            <span class="error-message"></span>
        </div>
    </li>
    <li>
        <?php echo CHtml::activeLabelEx($model, 'email'); ?>
        <div class="data">
            <?php echo CHtml::activeTextField($model, 'email', array('placeholder' => 'contoh: fulan@gmail.com')) ?>
            <span class="error-message"></span>
        </div>
    </li>
    <li>
        <?php echo CHtml::activeLabelEx($model, 'phone_number'); ?>
        <div class="data">
            <?php echo CHtml::activeTextField($model, 'phone_number', array('placeholder' => 'contoh: 08571234567')); ?>
            <span class="error-message"></span>
        </div>
    </li>
    <li>
        <?php echo CHtml::activeLabelEx($model, 'category_id'); ?>
        <div class="data">
            <?php echo CHtml::activeDropDownList($model, 'category_id', AqCategory::model()->findListCategory(), array('prompt' => 'Pilih Jenis Konsultasi')) ?>
            <span class="error-message"></span>
        </div>
    </li>
    <li>
        <?php echo CHtml::activeLabelEx($model, 'question'); ?>
        <div class="data">
            <?php echo CHtml::activeTextArea($model, 'question') ?>
            <span class="error-message"></span>
            <div class="button-box">
                <input type="submit" class="button big" value="Kirim">
            </div>
        </div>
    </li>
</ul>
<?php $this->endWidget(); ?>