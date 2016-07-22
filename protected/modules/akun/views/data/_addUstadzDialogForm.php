<p>
    Untuk menambahkan ustadz, isi form yang telah disediakan pada dialog
    ini kemudian klik simpan.
</p>
<?php
if($action == 'update'){
    $action_url = Yii::app()->createUrl('akun/data/updateustadz/', array('id'=>$model_add->id));
}
else{
    $action_url = Yii::app()->createUrl('akun/data/addustadz/', array());
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'add-ustadz-form',
    'action' => $action_url,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'form-horizontal c-new-form',
    )
        ));
?>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'username'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'username', array('class' => 'form-control', 'placeholder' => 'yusron21'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'currentPassword'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->passwordField($model_add, 'currentPassword', array('class' => 'form-control', 'placeholder' => '********'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'retypePassword'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->passwordField($model_add, 'retypePassword', array('class' => 'form-control', 'placeholder' => '********'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'full_name'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'full_name', array('class' => 'form-control', 'placeholder' => 'Yusron Mahfouz'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'email'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'email', array('class' => 'form-control', 'placeholder' => 'yusron@rumahtahfidzqu.com'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'phone_one'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'phone_one', array('class' => 'form-control', 'placeholder' => '08124000xxx'));
        ?>
    </div>
</div>
<?php
$this->endWidget();
?>
<div class="hide c-success-alert">
    <div class="alert alert-success alert-dismissable" role="alert" type="success" close="closeAlert($index)">
        <button type="button" class="close">
            <span class=""></span>
            <span class="sr-only">Close</span>
        </button>
        <div><span class=""><strong>Sukses!</strong> Data berhasil disimpan</span></div>
    </div>
</div>