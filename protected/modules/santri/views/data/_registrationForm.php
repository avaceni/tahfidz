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
    <div class="row">
        <div class="col-md-12 profile-box" title="" data-original-title="Foto">
            <img class="c-finded-santri-image profile-image img-thumbnail" src="<?php echo (new User())->getPhotoUrl($user_id) ?>" class="avatar" height="105.44px" width="82.24px" alt="Avatar">
            <h3 class="profile-name"><?php echo ucwords($santri->nama_lengkap) ?></h3>
        </div>
    </div>
    <div class="row c-last-registration">
        <h4>Registrasi Ulang <i>diperbarui : 
            <?php //$icon_trash = '<a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a>';
                if(!empty($registration_data->tanggal_registrasi_ulang)){
                    echo Utility::getDateFormat($registration_data->tanggal_registrasi_ulang);
                    ?>
                <a class="glyphicon glyphicon glyphicon-trash c-registration-delete" title="" href="<?php echo Yii::app()->createAbsoluteUrl('santri/data/deleteRegistration', array('id'=>$registration_data->registrasi_id)) ?>"></a>
                    <?php
                }
                else{
                    echo '-';
                }
//                echo!empty($registration_data->tanggal_registrasi_ulang) ? Utility::getDateFormat($registration_data->tanggal_registrasi_ulang) : '-'
            ?>
            </i>
            <div class="btn-group">
                <a class="btn-default btn c-registration-graduate" href=<?php echo Yii::app()->createUrl('santri/data/setstatus', array('id'=>$user_id, 'status'=>'2')) ?> style="float:right">
                    <span>Keluar</span>
                </a>
                <a class="btn-default btn c-registration-graduate" href=<?php echo Yii::app()->createUrl('santri/data/setstatus', array('id'=>$user_id, 'status'=>'1')) ?> style="float:right">
                    <span>Lulus</span>
                </a>            
            </div>
            </h4>
        <div class="form-group">
            <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'pendidikan_id'); ?></label>
            <div class="col-md-9">
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
            <div class="col-md-9">
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
    </div>
    <div class="row">
        <h4>Asrama <i>diperbarui : <?php echo!empty($registration_data->tanggal_pindah_pondok) ? Utility::getDateFormat($registration_data->tanggal_pindah_pondok) : '-' ?></i></h4>
        <div class="form-group">
            <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'pondok_id'); ?></label>
            <div class="col-md-9">
                <?php echo CHtml::activeDropDownList($registration_data, "pondok_id", Pondokan::getPondokanList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'keterangan_pindah'); ?></label>
            <div class="col-md-9">
                <?php echo $form->textArea($registration_data, 'keterangan_pindah', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <h4>Halaqoh <i>diperbarui : <?php echo!empty($registration_data->tanggal_dibuat) ? Utility::getDateFormat($registration_data->tanggal_dibuat) : '-' ?></i></h4>
        <div class="form-group">
            <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($registration_data, 'kelompok'); ?></label>
            <div class="col-md-9">
                <?php echo CHtml::activeDropDownList($registration_data, "kelompok", Kelompok::getKelompokList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            </div>
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