<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'quarters-add-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'c-simple-add-form form-horizontal',
        'data-grid' => 'quarters-grid',
        ),
    'action' => Yii::app()->createUrl('asrama/data/update', array('id' => $model->id)),
    ));
    ?>
    <?php
    echo $form->hiddenField($model, 'id', array());
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_pondok'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($model, "nama_pondok", array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'status'); ?></label>
        <div class="col-md-6">
            <?php
            echo $form->DropDownList($model, "status", Utility::getQuartersOwnershipList(), array("prompt" => " - Pilih - ", 'class' => 'form-control'));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tanggal_mulai'); ?></label>
        <div class="col-md-6">
            <div class="input-group c-form-edit date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" value="<?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model->tanggal_mulai)); ?>" name="Pondokan[tanggal_mulai]" id="Pondokan_tanggal_mulai">
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'jangka_waktu'); ?></label>
        <div class="col-md-6">
            <?php
            echo $form->TextField($model, 'jangka_waktu', array('class' => 'form-control', 'placeholder' => 'Jangka Waktu'));
            ?>
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