<?php
/* @var $this ModContentController */
/* @var $model ModContent */

$this->breadcrumbs = array(
    'Mod Contents' => array('manage'),
    'Create',
);
?>

<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
        $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Ustadz', 'url' => array('ustadz/data/manage')),
                array('name' => 'Tambah Ustadz', 'url' => array('ustadz/data/create')),
            ),
        ));
        ?>
            <h1>Tambah Ustadz<?php // echo $this->uniqueId . '/' . $this->action->id;                     ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Tambah Ustadz</h2>
                                <?php /*
                                <div class="panel-ctrls">
                                    <div class="right">
                                        <div class="btn-group">
                                            <a class="button-white btn" href="<?php echo Yii::app()->createAbsoluteUrl('ustadz/data/create') ?>">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Tambah</span>
                                            </a>
                                        </div>
                                    </div>                                
                                </div>
                                 */ ?>
                            </div>
                            <div class="panel-body c-combined-form">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini form untuk menambahkan data Ustadz.
                                    Isi kolom isian sesuai dengan label keterangan
                                    yang diberikan. Bagian kolom dengan label bertanda
                                    asterisk (*) menandai bahwa kolom tersebut harus
                                    diisi. Klik tombol simpan pada bagian paling bawah form
                                    untuk menyimpan halaman. Jika terdapat kesalahan
                                    isian data, kolom akan ditandai dengan warna merah
                                    disertai pesan kesalahan.
                                </p>
                                <div class="span-alert"> </div>
                                <ul class="stepy-header">
                                    <li class="stepy-active c-step c-step-first" data-tab="data-diri">
                                        <div><span>1</span>Data Diri</div>
                                    </li>
                                    <li class="c-step disable" data-tab="data-keluarga">
                                        <div><span>2</span>Keluarga</div>
                                    </li>
                                    <li class="c-step disable c-last-required" data-tab="data-pendidikan">
                                        <div><span>3</span>Pendidikan</div>
                                    </li>
                                    <li class="c-step disable" data-tab="data-penyakit">
                                        <div><span>4</span>Riwayat Penyakit</div>
                                    </li>
                                    <li class="c-step disable" data-tab="data-lain">
                                        <div><span>5</span>Lain-lain</div>
                                    </li>
                                    <li class="c-step disable" data-tab="data-simpan">
                                        <div><span class="fa fa-check"></span>Simpan</div><span></span>
                                    </li>
                                </ul>
                                <fieldset title="Data Diri" class="stepy-step" data-tab="data-diri">
                                    <legend>Data Diri</legend>
                                    <div class="text-center container" id="crop-avatar">
                                        <div class="col-md-4 col-md-offset-4 avatar-view c-image-upload" title="Ganti Foto">
                                            <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#avatar-modal">Open Modal</button>-->
                                            <img data-target="#avatar-modal" src="<?php echo Yii::app()->baseUrl . '/images/resource/no-profile-image-2x3.jpg' ?>" class="avatar img-thumbnail c-make-pointer" height="<?php echo (105.44 * 2) . 'px' ?>" width="<?php echo (82.24 * 2) . 'px' ?>" alt="Avatar">
                                            <!--<h6>Foto</h6>-->
                                            <!--<input type="file" class="form-control" >-->
                                        </div>
                                        <!-- Cropping modal -->
                                        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <form class="avatar-form dont-validate" action="<?php echo Yii::app()->createAbsoluteUrl('ustadz/data/photoupload', array('id'=>'')) ?>" enctype="multipart/form-data" method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="avatar-body">

                                                                <!-- Upload image and data -->
                                                                <div class="avatar-upload">
                                                                    <input type="hidden" class="avatar-src" name="avatar_src">
                                                                    <input type="hidden" class="avatar-data" name="avatar_data">
                                                                    <label for="avatarInput">Local upload</label>
                                                                    <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                                                </div>

                                                                <!-- Crop and preview -->
                                                                <div class="row">
                                                                    <div class="col-md-9">
                                                                        <div class="avatar-wrapper"></div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <!--                    <div class="avatar-preview preview-lg"></div>
                                                                                            <div class="avatar-preview preview-md"></div>
                                                                                            <div class="avatar-preview preview-sm"></div>-->
                                                                    </div>
                                                                </div>

                                                                <div class="row avatar-btns">
                                                                    <div class="col-md-9">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>
                                                                        </div>
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>
                                                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div> -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- /.modal -->
                                    </div>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-form',
                                        'action' => Yii::app()->createAbsoluteUrl('ustadz/data/create'),
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal'
                                        ),
                                    ));
                                    ?>
                                    <?php
                                        echo CHtml::hiddenField('Santri[photo_id]' , 'null', array('id' => 'crop-photo-id'));
                                    ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'nama_lengkap'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'nama_lengkap', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'nama_lengkap'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'nama_panggilan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'nama_panggilan', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'nama_panggilan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'tempat_lahir'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'tempat_lahir'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'tanggal_lahir'); ?></label>
                                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" name="Santri[tanggal_lahir]" id="Santri_tanggal_lahir">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="dtp_input2" value=""><br>
                                    </div>
                                    <?php /*
                                      <div class="form-group">
                                      <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'tanggal_lahir'); ?></label>
                                      <div class="col-md-6">
                                      <?php
                                      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                      'model' => $model_santri,
                                      'attribute' => 'tanggal_lahir',
                                      'value' => $model->tanggal_lahir,
                                      'htmlOptions' => array('class' => 'form-control'),
                                      'options' => array(
                                      'showAnim' => 'fold',
                                      'chageYear' => true,
                                      'showButtonPanel' => true,
                                      'autoSize' => true,
                                      'dateFormat' => 'yy-mm-dd',
                                      'defaultDate' => $model->tanggal_lahir,
                                      'changeYear' => true,
                                      'changeMonth' => true,
                                      ),
                                      ));
                                      ?>
                                      <?php // echo $form->error($model_santri, 'tanggal_lahir'); ?>
                                      </div>
                                      </div>
                                     */ ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'golongan_darah'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_santri, "golongan_darah", Utility::getBloodList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'golongan_darah'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'jumlah_saudara'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'jumlah_saudara', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'jumlah_saudara'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'anak_ke'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'anak_ke', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'anak_ke'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'jenis_kelamin'); ?></label>
                                        <div class="col-md-6">
                                            <?php
                                            echo $form->radioButtonList($model_santri, 'jenis_kelamin', array(
                                                1 => 'Putra',
                                                2 => 'Putri'
                                                    ), array(
                                                'labelOptions' =>
                                                array('style' => 'display:inline'),
                                                'separator' => '  ',
//                                                                    'class'=>"radio-inline"
                                            ));
                                            ?>
                                            <?php // echo $form->error($model_santri, 'jenis_kelamin'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'alamat_keluarga_yogya'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textArea($model_santri, 'alamat_keluarga_yogya', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'alamat_keluarga_yogya'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'no_telepon_keluarga_yogya'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'no_telepon_keluarga_yogya', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'no_telepon_keluarga_yogya'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'cita_cita'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'cita_cita', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'cita_cita'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'hobi'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'hobi', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'hobi'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'motivasi_masuk_rtqu'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textArea($model_santri, 'motivasi_masuk_rtqu', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'motivasi_masuk_rtqu'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'prestasi_hafalan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_santri, 'prestasi_hafalan', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php // echo $form->error($model_santri, 'prestasi_hafalan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_santri, 'tanggal_masuk_rtqu'); ?></label>
                                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" name="Santri[tanggal_masuk_rtqu]" id="Santri_tanggal_masuk_rtqu">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="dtp_input2" value=""><br>
                                    </div>
                                    <?php /*
                                      <div class="form-group">
                                      <?php echo CHtml::button('Validasi', array('class' => 'c-validate-form')) ?>
                                      </div>
                                     */
                                    ?>
                                    <?php $this->endWidget(); ?>
                                    <div class="stepy-navigator"><div class="btn-group"><a href="#" class="btn btn-indigo c-stepy-next">Lanjut<i class="fa fa-angle-right"></i></a></div></div>
                                </fieldset>

                                <fieldset title="Keluarga" class="stepy-step hide" data-tab="data-keluarga">
                                    <legend>Keluarga</legend>                                    
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <!--<a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="c-form-label">Ayah <span class="hide" id="c-multi-number">1</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-orangtua-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal c-new-form'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'nama'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'nama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'tempat_lahir'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'tempat_lahir'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'tanggal_lahir'); ?></label>
                                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" name="SantriOrangtua[tanggal_lahir]" id="SantriOrangtua_tanggal_lahir">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="dtp_input2" value=""><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'agama'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'agama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'no_telepon'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'no_telepon'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pendidikan_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'pendidikan_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pekerjaan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'pekerjaan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'penghasilan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'penghasilan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'alamat'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textArea($model_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'alamat'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'hubungan_orangtua'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control', 'options' => array('1'=>array('selected'=>true)))); ?>
                                            <?php echo $form->error($model_parent, 'hubungan_orangtua'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <h4 class="c-form-label">Ibu <span class="hide" id="c-multi-number">2</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-orangtua-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal c-new-form'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'nama'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'nama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'tempat_lahir'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'tempat_lahir'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'tanggal_lahir'); ?></label>
                                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" name="SantriOrangtua[tanggal_lahir]" id="SantriOrangtua_tanggal_lahir">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'agama'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'agama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'no_telepon'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'no_telepon'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pendidikan_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'pendidikan_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pekerjaan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'pekerjaan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'penghasilan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'penghasilan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'alamat'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textArea($model_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'alamat'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'hubungan_orangtua'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control', 'options' => array('2'=>array('selected'=>true)))); ?>
                                            <?php echo $form->error($model_parent, 'hubungan_orangtua'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <p class="stepy-navigator"><div class="pull-right btn-group"><a href="#" class="btn btn-default c-stepy-back">&lt; Kembali</a><a href="#" class="btn btn-primary c-stepy-next">Lanjut &gt;</a></div></p></fieldset>

                                <fieldset title="Pendidikan" class="stepy-step hide" data-tab="data-pendidikan">
                                    <legend>Riwayat Pendidikan</legend>                                    
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <!--<a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="c-form-label">Pendidikan <span id="c-multi-number">1</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-riwayat-pendidikan-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal c-new-form'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'jenjang_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_education, "jenjang_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'jenjang_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'nama_sekolah'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'nama_sekolah', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'nama_sekolah'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'tahun_masuk'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'tahun_masuk', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'tahun_masuk'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'tahun_lulus'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'tahun_lulus', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'tahun_lulus'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'nilai_rata_rata'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'nilai_rata_rata', array('size' => 7, 'maxlength' => 7, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'nilai_rata_rata'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <p class="stepy-navigator"><div class="pull-right btn-group"><a href="#" class="btn btn-default c-stepy-back">&lt; Kembali</a><a href="#" class="btn btn-primary c-stepy-next">Lanjut &gt;</a></div></p></fieldset>

                                <fieldset title="Riwayat Penyakit" class="stepy-step hide" data-tab="data-penyakit">
                                    <legend>Riwayat Penyakit</legend>                                    
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <!--<a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="c-form-label">Penyakit <span id="c-multi-number">1</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-riwayat-penyakit-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal c-new-form'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_diseae, 'nama_penyakit'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_diseae, 'nama_penyakit', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_diseae, 'nama_penyakit'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_diseae, 'tahun'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_diseae, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_diseae, 'tahun'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?> 
                                    <p class="stepy-navigator"><div class="pull-right btn-group"><a href="#" class="btn btn-default c-stepy-back">&lt; Kembali</a><a href="#" class="btn btn-primary c-stepy-next">Lanjut &gt;</a></div></p></fieldset>

                                <fieldset title="Lain-Lain" class="stepy-step hide" data-tab="data-lain">
                                    <legend>Prestasi</legend>                                    
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <!--<a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="c-form-label">Prestasi <span id="c-multi-number">1</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-achievement-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal c-new-form'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'prestasi'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_achievement, 'prestasi', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_achievement, 'prestasi'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'juara'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_achievement, 'juara', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_achievement, 'juara'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'tahun'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_achievement, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_achievement, 'tahun'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <p class="stepy-navigator"><div class="pull-right btn-group"><a href="#" class="btn btn-default c-stepy-back">&lt; Kembali</a><a href="#" class="btn btn-primary c-stepy-next">Lanjut &gt;</a></div></p></fieldset>
                                <fieldset title="Simpan" class="stepy-step hide" data-tab="data-simpan">
                                    <a class="btn btn-success" id="c-create-santri" data-url="<?php echo Yii::app()->createAbsoluteUrl('ustadz/data/save') ?>">Simpan</a>
                                </fieldset>
                                <div class="stepy-errors"></div>
                                <!--</form>-->

                            </div>                            
                        </div>
                    </panel>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!--wrap -->
</div>
<footer role="contentinfo" ng-show="!layoutLoading" class="">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li>SPOTKY © <?php echo date('Y', time()) ?></li>
        </ul>
        <button class="pull-right btn btn-default btn-sm hidden-print" back-to-top="" style="padding: 1px 10px;"><i class="fa fa-angle-up"></i></button>
    </div>
</footer>
<script type="text/html" id="data-keluarga">
    <h4 class="c-form-label">Wali <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-orangtua-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form'
        )
    ));
    ?>

    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'nama'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'nama'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'tempat_lahir'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_parent, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'tempat_lahir'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'tanggal_lahir'); ?></label>
        <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" name="SantriOrangtua[tanggal_lahir]" id="SantriOrangtua_tanggal_lahir">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="hidden" id="dtp_input2" value=""><br>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'agama'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($model_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'agama'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'no_telepon'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'no_telepon'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pendidikan_id'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($model_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'pendidikan_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pekerjaan'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'pekerjaan'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'penghasilan'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'penghasilan'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'alamat'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textArea($model_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'alamat'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'hubungan_orangtua'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($model_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($model_parent, 'hubungan_orangtua'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>
<script type="text/html" id="data-pendidikan">
    <h4 class="c-form-label">Pendidikan <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-riwayat-pendidikan-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form'
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'jenjang_id'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($model_education, "jenjang_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($model_education, 'jenjang_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'nama_sekolah'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_education, 'nama_sekolah', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_education, 'nama_sekolah'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'tahun_masuk'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_education, 'tahun_masuk', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_education, 'tahun_masuk'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'tahun_lulus'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_education, 'tahun_lulus', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_education, 'tahun_lulus'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'nilai_rata_rata'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_education, 'nilai_rata_rata', array('size' => 7, 'maxlength' => 7, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_education, 'nilai_rata_rata'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>
<script type="text/html" id="data-penyakit">
    <h4 class="c-form-label">Penyakit <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-riwayat-penyakit-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form'
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_diseae, 'nama_penyakit'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_diseae, 'nama_penyakit', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_diseae, 'nama_penyakit'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_diseae, 'tahun'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_diseae, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_diseae, 'tahun'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?> 
</script>
<script type="text/html" id="data-lain">
    <h4 class="c-form-label">Prestasi <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-achievement-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form'
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'prestasi'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_achievement, 'prestasi', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_achievement, 'prestasi'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'juara'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_achievement, 'juara', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_achievement, 'juara'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'tahun'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model_achievement, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($model_achievement, 'tahun'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>