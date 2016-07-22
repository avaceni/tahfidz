<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'registration-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'form-horizontal c-new-form',
    ),
    'action' => Yii::app()->createUrl('santri/data/registrationsave'),
        ));
?>
<?php
echo $form->hiddenField($registration_data, 'user_id', array());
?>
<div class="col-md-7 col-md-offset-5" title="" data-original-title="Foto">
    <img class="c-finded-santri-image" src="<?php echo (new User())->getPhotoUrl($user_id) ?>" class="avatar" height="105.44px" width="82.24px" alt="Avatar">
    <div><?php echo ucwords($santri->nama_lengkap) ?></div>
</div>
<div style="font-weight:bold;font-size: 14px;">Registrasi Ulang <span style="font-style: italic;">diperbarui : <?php echo!empty($registration_data->tanggal_registrasi_ulang) ? Utility::getDateFormat($registration_data->tanggal_registrasi_ulang) : '-' ?></span></div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'pendidikan_id'); ?></label>
    <div class="col-md-6">
        <?php
        if ($registration_status == 3) {
            ?>
            <a class="editable"><?php echo Utility::getSantriEducation($registration_data->pendidikan_id); ?></a>
            <?php
        } else {
            echo CHtml::activeDropDownList($registration_data, "pendidikan_id", Utility::getSantriEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control'));
        }
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'tingkat'); ?></label>
    <div class="col-md-6">
        <?php
        if ($registration_status == 3) {
            ?>
            <a class="editable"><?php echo $registration_data->tingkat; ?></a>
            <?php
        } else {
            echo $form->textField($registration_data, 'tingkat', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control'));
        }
        ?>
    </div>
</div>
<br/>
<div style="font-weight:bold;font-size: 14px;">Asrama <span style="font-style: italic;">diperbarui : <?php echo!empty($registration_data->tanggal_pindah_pondok) ? Utility::getDateFormat($registration_data->tanggal_pindah_pondok) : '-' ?></span></div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'pondok_id'); ?></label>
    <div class="col-md-6">
        <?php echo CHtml::activeDropDownList($registration_data, "pondok_id", Pondokan::getPondokanList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'keterangan_pindah'); ?></label>
    <div class="col-md-6">
        <?php echo $form->textArea($registration_data, 'keterangan_pindah', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
    </div>
</div>
<br/>
<div style="font-weight:bold;font-size: 14px;">Halaqoh <span style="font-style: italic;">diperbarui : <?php echo!empty($registration_data->tanggal_dibuat) ? Utility::getDateFormat($registration_data->tanggal_dibuat) : '-' ?></span></div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'kelompok'); ?></label>
    <div class="col-md-6">
        <?php echo CHtml::activeDropDownList($registration_data, "kelompok", Kelompok::getKelompokList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<div class="hide c-success-alert">
    <div class="alert alert-success alert-dismissable" role="alert" type="success" close="closeAlert($index)">
        <button type="button" class="close">
            <span class=""></span>
            <span class="sr-only">Close</span>
        </button>
        <div><span class=""><strong>Sukses!</strong> Data berhasil disimpan</span></div>
    </div>
</div>