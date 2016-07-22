<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'academic-year-add-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'c-simple-add-form form-horizontal',
        'data-grid' => 'academic-year-grid',
    ),
    'action' => Yii::app()->createUrl('tahunajaran/data/update', array('id' => $model->id)),
        ));
?>
<?php
echo $form->hiddenField($model, 'id', array());
?>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_tahun_ajaran'); ?></label>
    <div class="col-md-6">
        <?php echo $form->textField($model, "nama_tahun_ajaran", array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tanggal_dimulai'); ?></label>
    <div style="float:left;" class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy">
        <input class="form-control" size="16" type="text" value="<?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model->tanggal_dimulai)); ?>" name="TahunAjaranBaru[tanggal_dimulai]" id="TahunAjaranBaru_tanggal_dimulai">
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
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