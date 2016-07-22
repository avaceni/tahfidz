<p>
    Untuk menambahkan donasi, isi form yang telah disediakan pada dialog
    ini kemudian klik simpan.
</p>
<?php
if($action == 'updateGoods'){
    $action_url = Yii::app()->createUrl('keuangan/data/updategoods/', array('id'=>$model_add->id));
}
else{
    $action_url = Yii::app()->createUrl('keuangan/data/addgoods/', array());
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'add-donation-form',
    'action' => $action_url,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'form-horizontal',
    )
        ));
?>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'nama_donatur'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'nama_donatur', array('class' => 'form-control', 'placeholder' => 'Bp Ahmad'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'nama_barang'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'nama_barang', array('class' => 'form-control', 'placeholder' => 'Meja'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'detail_barang'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'detail_barang', array('class' => 'form-control', 'placeholder' => 'Meja'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'tanggal'); ?></label>
    <div style="float:left;" class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy">
        <input class="form-control" size="16" type="text" value="
        <?php
        if($action == 'updateGoods'){
            $date_this = $model_add->tanggal;
        }
        else{
            $date_this = date('Y-m-d', time());
        }
        echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($date_this));
        ?>"
        name="DonasiBarang[tanggal]" id="DonasiBarang_tanggal">
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
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