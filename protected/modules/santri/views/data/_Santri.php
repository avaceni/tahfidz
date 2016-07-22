<fieldset title="Data Diri" class="stepy-step" data-tab="data-diri">
    <legend>Data Diri</legend>
    <?php
    if ($this->cklt_user->group_id == 10) {
        ?>
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
    }
    ?>
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