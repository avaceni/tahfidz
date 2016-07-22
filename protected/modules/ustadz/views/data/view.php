<?php
/* @var $this ModContentController */
/* @var $model ModContent */

$this->breadcrumbs = array(
    'Mod Contents' => array('manage'),
    'Create',
);

$triger_last_step = <<<EOF
    var santriStep = sessionStorage.getItem("c-santri-step");
    if(santriStep){
        $(document).find(".c-step[data-tab='"+ santriStep +"']").trigger( "click" );;
    }
EOF;

Yii::app()->clientScript->registerScript('trigger_last_step', $triger_last_step);
$last_recitation = Santri::getLastRecitation($model->id);
?>

<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
            $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Ustadz', 'url' => array('ustadz/data/manage')),
                array('name' => 'Detail Ustadz', 'url' => array('ustadz/data/view',array('id'=>$model->id))),
            ),
        ));
        ?>
            <h1>Detail Ustadz<?php // echo $this->uniqueId . '/' . $this->action->id;             ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    $this->widget("application.components.widgets.PanelUser", array(
                        'santri'=>$model,
                        'link'=> array(
                            'url'=>Yii::app()->createAbsoluteUrl('hafalan/data/view', array('id'=>$model->id)),
                            'title' => 'Lihat Hafalan'
                            )
                        )
                    );
                    ?>
                    <?php /*
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="clear"></div>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <div class="col-sm-2 profile-image">
                                    <img class='img-circle' width='80px' src="<?php echo User::model()->getPhotoUrl($model->id) ?>" class="avatar" alt="avatar">
                                </div>
                                <div class="col-sm-10">
                                    <div class='form-group profile-head'>
                                        <div class="col-sm-3 control-label">
                                            <?php echo ucwords($model->nama_lengkap) ?>
                                        </div>
                                        <div class="col-sm-7 control-label">
                                            <?php echo!empty(Santri::getJuz($model->id)) ? floor(Santri::getJuz($model->id)) . " Juz" : "- Juz"; ?>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class="col-sm-3 control-label">
                                            <?php echo $model->user->getSantriEducation() . ', ' . Utility::calcutateAge($model->tanggal_lahir) ?> tahun
                                        </div>
                                        <div class="col-sm-2 control-label">
                                            Pembimbing
                                        </div>
                                        <div class="col-sm-5 control-label">
                                            <?php echo!empty($last_recitation) ? 'Ust. ' . ucwords($last_recitation['musyrif']) : '-'; ?>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class="col-sm-3 control-label">
                                            Asrama <?php echo ucwords($model->user->getPondokan()) ?>
                                        </div>
                                        <div class="col-sm-2 control-label">
                                            Hafalan sekarang
                                        </div>
                                        <div class="col-sm-5 control-label">
                                            <?php echo!empty($last_recitation) ? "Juz " . $last_recitation['juz'] . " Halaman " . $last_recitation['halaman'] : '-' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </panel>
                     */?>
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Detail Ustadz</h2>
                                <div class="panel-ctrls">
                                    <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
                                </div>
                            </div>
                            <div class="panel-body c-combined-form">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini informasi Ustadz yang disajikan secara mendetail.
                                    Untuk memperbarui data ustadz, klik pada bagian
                                    kolom data yang ingin diperbarui selanjutnya
                                    isi dengan data baru. Setelah selesai memperbarui
                                    data, klik tombol simpan yang terletak di sebelah
                                    kanan kolom atau klik batal untuk membatalkan perubahan.
                                </p>
                                <div class="span-alert"> </div>
                                <ul class="nav nav-tabs">
                                    <li class="active c-step edit c-step-first" data-tab="data-diri"><a>Data Diri</a></li>
                                    <li class="c-step edit" data-tab="data-keluarga"><a>Keluarga</a></li>
                                    <li class="c-step edit" data-tab="data-pendidikan"><a>Pendidikan</a></li>
                                    <li class="c-step edit" data-tab="data-penyakit"><a>Riwayat Penyakit</a></li>
                                    <li class="c-step edit" data-tab="data-lain"><a>Lain-lain</a></li>
                                    <li class="c-step edit" data-tab="data-kelompok"><a>Riwayat Halaqoh</a></li>                                    
                                </ul>
                                <fieldset title="Data Diri" class="stepy-step" data-tab="data-diri">
                                    <legend>Data Diri</legend>
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save c-santri-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-form',
//                                        'action' => Yii::app()->createAbsoluteUrl('santri/data/edit'),
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal'
                                        )
                                    ));
                                    ?>
                                    <?php
                                    echo $form->hiddenField($model, 'id', array());
                                    ?>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_lengkap'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucwords($model->nama_lengkap); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'nama_lengkap', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_panggilan'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucwords($model->nama_panggilan); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'nama_panggilan', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tempat_lahir'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucfirst($model->tempat_lahir); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tanggal_lahir'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model->tanggal_lahir)); ?></a>
                                        </div>
                                        <div class="input-group date c-form-edit hide form_date col-md-6" data-date="" data-date-format="dd MM yyyy">
                                            <input class="form-control" size="16" value="<?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model->tanggal_lahir)); ?>" type="text" name="Santri[tanggal_lahir]" id="Santri_tanggal_lahir">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'golongan_darah'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo Utility::getBloodType($model->golongan_darah); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo CHtml::activeDropDownList($model, "golongan_darah", Utility::getBloodList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'jumlah_saudara'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo $model->jumlah_saudara; ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'jumlah_saudara', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'anak_ke'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo $model->anak_ke; ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'anak_ke', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'jenis_kelamin'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucfirst(Utility::getGender($model->jenis_kelamin)); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php
                                            echo $form->radioButtonList($model, 'jenis_kelamin', array(
                                                1 => 'Putra',
                                                2 => 'Putri'
                                                    ), array(
                                                'labelOptions' =>
                                                array('style' => 'display:inline'),
                                                'separator' => '  ',
//                                                                    'class'=>"radio-inline"
                                            ));
                                            ?>
                                            <?php echo $form->error($model, 'jenis_kelamin'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'alamat_keluarga_yogya'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucfirst($model->alamat_keluarga_yogya); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textArea($model, 'alamat_keluarga_yogya', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'no_telepon_keluarga_yogya'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo $model->no_telepon_keluarga_yogya; ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'no_telepon_keluarga_yogya', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'cita_cita'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucfirst($model->cita_cita); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'cita_cita', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'hobi'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucfirst($model->hobi); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'hobi', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'motivasi_masuk_rtqu'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucfirst($model->motivasi_masuk_rtqu); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textArea($model, 'motivasi_masuk_rtqu', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'prestasi_hafalan'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo ucfirst($model->prestasi_hafalan); ?></a>
                                        </div>
                                        <div class="col-md-6 c-form-edit hide">
                                            <?php echo $form->textField($model, 'prestasi_hafalan', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tanggal_masuk_rtqu'); ?></label>
                                        <div class="col-md-6 c-detail-view">
                                            <a class="editable editable-click"><?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model->tanggal_masuk_rtqu)); ?></a>
                                        </div>
                                        <div class="input-group c-form-edit date form_date col-md-6 hide" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" value="<?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model->tanggal_masuk_rtqu)); ?>" name="Santri[tanggal_masuk_rtqu]" id="Santri_tanggal_masuk_rtqu">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                </fieldset>
                                <?php echo $this->renderPartial('_SantriOrangtua', array('model' => $model_parent, 'hide' => 1)); ?>
                                <?php /*
                                <fieldset title="Keluarga" class="stepy-step hide" data-tab="data-keluarga">
                                    <legend>Keluarga</legend>                                   
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save c-santri-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i = 1;
                                    if (!empty($model_parent)) {
                                        foreach ($model_parent as $this_parent) {
                                            ?>
                                            <h4 class="c-form-label">Orangtua <span id="c-multi-number"><?php echo $i ?></span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                            <?php
                                            $form = $this->beginWidget('CActiveForm', array(
                                                'id' => 'santri-orangtua-form' . $i,
                                                'htmlOptions' => array(
                                                    'enctype' => 'multipart/form-data',
                                                    'class' => 'form-horizontal',
                                                    'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
                                                    'data-model' => get_class($this_parent),
                                                    'data-id' => $this_parent->id,
                                                )
                                            ));
                                            ?>
                                            <?php
                                            echo $form->hiddenField($this_parent, 'id', array());
                                            echo $form->hiddenField($this_parent, 'santri_id', array());
                                            ?>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'nama'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo ucwords($this_parent->nama); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'tempat_lahir'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo ucwords($this_parent->tempat_lahir); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_parent, 'tempat_lahir', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'tanggal_lahir'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($this_parent->tanggal_lahir)); ?></a>
                                                </div>
                                                <div class="input-group date hide c-form-edit form_date col-md-6" data-date="" data-date-format="dd MM yyyy">
                                                    <input class="form-control" size="16" type="text" name="SantriOrangtua[tanggal_lahir]" value="<?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($this_parent->tanggal_lahir)); ?>" id="SantriOrangtua_tanggal_lahir">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'agama'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo Utility::getReligion($this_parent->agama); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo CHtml::activeDropDownList($this_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'no_telepon'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_parent->no_telepon; ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'pendidikan_id'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo Utility::getEducation($this_parent->pendidikan_id); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo CHtml::activeDropDownList($this_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'pekerjaan'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo ucwords($this_parent->pekerjaan); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'penghasilan'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo ucwords($this_parent->penghasilan); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'alamat'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo ucwords($this_parent->alamat); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textArea($this_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'hubungan_orangtua'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo Utility::getKinship($this_parent->hubungan_orangtua) ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo CHtml::activeDropDownList($this_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <?php
                                            $this->endWidget();
                                            $i++;
                                        }
                                    }
                                    ?>
                                </fieldset>
                                 */ ?>
                                <fieldset title="Pendidikan" class="stepy-step hide" data-tab="data-pendidikan">
                                    <legend>Riwayat Pendidikan</legend>
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save c-santri-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $j = 1;
                                    if (!empty($model_education)) {
                                        foreach ($model_education as $this_education) {
                                            ?>
                                            <h4 class="c-form-label">Pendidikan <span id="c-multi-number"><?php echo $j ?></span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                            <?php
                                            $form = $this->beginWidget('CActiveForm', array(
                                                'id' => 'ustadz-riwayat-pendidikan-form' . $j,
                                                'htmlOptions' => array(
                                                    'enctype' => 'multipart/form-data',
                                                    'class' => 'form-horizontal',
                                                    'data-url-delete' => Yii::app()->createUrl('ustadz/data/deleteadditional'),
                                                    'data-model' => get_class($this_education),
                                                    'data-id' => $this_education->id,
                                                )
                                            ));
                                            ?>
                                            <?php
                                            echo $form->hiddenField($this_education, 'id', array());
                                            echo $form->hiddenField($this_education, 'santri_id', array());
                                            ?>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'jenjang_id'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo Utility::getEducation($this_education->jenjang_id) ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo CHtml::activeDropDownList($this_education, "jenjang_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'nama_sekolah'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo ucwords($this_education->nama_sekolah); ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_education, 'nama_sekolah', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'tahun_masuk'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_education->tahun_masuk; ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_education, 'tahun_masuk', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'tahun_lulus'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_education->tahun_lulus ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_education, 'tahun_lulus', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'nilai_rata_rata'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_education->nilai_rata_rata; ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_education, 'nilai_rata_rata', array('size' => 7, 'maxlength' => 7, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <?php
                                            $this->endWidget();
                                            $j++;
                                        }
                                    }
                                    ?>
                                </fieldset>
                                <fieldset title="Riwayat Penyakit" class="stepy-step hide" data-tab="data-penyakit">
                                    <legend>Riwayat Penyakit</legend>
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save c-santri-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $k = 1;
                                    if (!empty($model_diseae)) {
                                        foreach ($model_diseae as $this_diseae) {
                                            ?>
                                            <h4 class="c-form-label">Penyakit <span id="c-multi-number"><?php echo $k ?></span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                            <?php
                                            $form = $this->beginWidget('CActiveForm', array(
                                                'id' => 'ustadz-riwayat-penyakit-form' . $k,
                                                'htmlOptions' => array(
                                                    'enctype' => 'multipart/form-data',
                                                    'class' => 'form-horizontal',
                                                    'data-url-delete' => Yii::app()->createUrl('ustadz/data/deleteadditional'),
                                                    'data-model' => get_class($this_diseae),
                                                    'data-id' => $this_diseae->id,
                                                )
                                            ));
                                            ?>
                                            <?php
                                            echo $form->hiddenField($this_diseae, 'id', array());
                                            echo $form->hiddenField($this_diseae, 'santri_id', array());
                                            ?>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_diseae, 'nama_penyakit'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_diseae->nama_penyakit; ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_diseae, 'nama_penyakit', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_diseae, 'tahun'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_diseae->tahun ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_diseae, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <?php
                                            $this->endWidget();
                                            $k++;
                                        }
                                    }
                                    ?>
                                </fieldset>

                                <fieldset title="Lain-Lain" class="stepy-step hide" data-tab="data-lain">
                                    <legend>Lain-lain</legend>
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-multi" href="">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save c-santri-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $l = 1;
                                    if (!empty($model_achievement)) {
                                        foreach ($model_achievement as $this_achievement) {
                                            ?>
                                            <h4 class="c-form-label">Prestasi <span id="c-multi-number"><?php echo $l ?></span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
                                            <?php
                                            $form = $this->beginWidget('CActiveForm', array(
                                                'id' => 'ustadz-achievement-form',
                                                'htmlOptions' => array(
                                                    'enctype' => 'multipart/form-data',
                                                    'class' => 'form-horizontal',
                                                    'data-url-delete' => Yii::app()->createUrl('ustadz/data/deleteadditional'),
                                                    'data-model' => get_class($this_achievement),
                                                    'data-id' => $this_achievement->id,
                                                )
                                            ));
                                            ?>
                                            <?php
                                            echo $form->hiddenField($this_achievement, 'id', array());
                                            echo $form->hiddenField($this_achievement, 'santri_id', array());
                                            ?>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_achievement, 'prestasi'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_achievement->prestasi; ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_achievement, 'prestasi', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_achievement, 'juara'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_achievement->juara; ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_achievement, 'juara', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_achievement, 'tahun'); ?></label>
                                                <div class="col-md-6 c-detail-view">
                                                    <a class="editable editable-click"><?php echo $this_achievement->tahun ?></a>
                                                </div>
                                                <div class="col-md-6 hide c-form-edit">
                                                    <?php echo $form->textField($this_achievement, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                                </div>
                                            </div>
                                            <?php
                                            $this->endWidget();
                                            $l++;
                                        }
                                    }
                                    ?>
                                </fieldset>
                                <?php echo $this->renderPartial('_RiwayatHalaqoh', array('model' => $model_group, 'hide' => 1)); ?>
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
    <h4 class="c-form-label">Orangtua <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ustadz-orangtua-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('ustadz/data/deleteadditional'),
            'data-model' => get_class($new_parent),
            'data-id' => '',
            )
    ));
    ?>

    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'nama'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'nama'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'tempat_lahir'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'tempat_lahir'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'tanggal_lahir'); ?></label>
        <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy">
            <input class="form-control" size="16" type="text" name="SantriOrangtua[tanggal_lahir]" id="SantriOrangtua_tanggal_lahir">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'agama'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'agama'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'no_telepon'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'no_telepon'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'pendidikan_id'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'pendidikan_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'pekerjaan'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'pekerjaan'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'penghasilan'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'penghasilan'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'alamat'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textArea($new_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'alamat'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'hubungan_orangtua'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'hubungan_orangtua'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>
<script type="text/html" id="data-pendidikan">
    <h4 class="c-form-label">Pendidikan <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ustadz-riwayat-pendidikan-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('ustadz/data/deleteadditional'),
            'data-model' => get_class($new_education),
            'data-id' => '',
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'jenjang_id'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_education, "jenjang_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'jenjang_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'nama_sekolah'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'nama_sekolah', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'nama_sekolah'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'tahun_masuk'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'tahun_masuk', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'tahun_masuk'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'tahun_lulus'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'tahun_lulus', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'tahun_lulus'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'nilai_rata_rata'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'nilai_rata_rata', array('size' => 7, 'maxlength' => 7, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'nilai_rata_rata'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>
<script type="text/html" id="data-penyakit">
    <h4 class="c-form-label">Penyakit <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ustadz-riwayat-penyakit-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('ustadz/data/deleteadditional'),
            'data-model' => get_class($new_diseae),
            'data-id' => '',
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_diseae, 'nama_penyakit'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_diseae, 'nama_penyakit', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_diseae, 'nama_penyakit'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_diseae, 'tahun'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_diseae, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_diseae, 'tahun'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?> 
</script>
<script type="text/html" id="data-lain">
    <h4 class="c-form-label">Prestasi <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ustadz-achievement-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('ustadz/data/deleteadditional'),
            'data-model' => get_class($new_achievement),
            'data-id' => '',
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_achievement, 'prestasi'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_achievement, 'prestasi', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_achievement, 'prestasi'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_achievement, 'juara'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_achievement, 'juara', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_achievement, 'juara'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_achievement, 'tahun'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_achievement, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_achievement, 'tahun'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>