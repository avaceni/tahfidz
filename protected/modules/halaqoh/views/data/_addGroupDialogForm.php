<p>
    Untuk menambahkan hafalan santri, isi form yang telah disediakan pada panel
    ini kemudian klik simpan. Jika terdapat kesalahan format isian data,
    inputan akan berubah warna menjadi merah dan isian harus disesuaikan
    dengan petunjuk yang ada.
    <br>
    Hasil inputan data baru akan ditampiklan pada 
    tabel mutabaah tahfidz dibawah.                                    
    </br>
</p>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'edit-group-form',
    'action' => Yii::app()->createUrl('hafalan/data/addhafalan/', array()),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'form-horizontal c-new-form',
    )
        ));
?>
<div class="col-md-7 col-md-offset-5" title="" data-original-title="Foto">
    <img id="bindedImage" src="<?php echo Yii::app()->createUrl('/images/resource/no-profile-image-2x3.jpg') ?>" class="avatar" height="105.44px" width="82.24px" alt="Avatar">
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_kelompok'); ?></label>
    <div class="col-md-6">
        <?php
        echo CHtml::activeTextField($model, 'nama_kelompok', array('class' => 'form-control', 'placeholder' => 'Nama Kelompok'));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_kelompok'); ?></label>
    <div class="col-md-6">
        <?php
        echo CHtml::activeTextField($model, 'nama_kelompok', array('class' => 'form-control', 'placeholder' => 'Nama Kelompok'));
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