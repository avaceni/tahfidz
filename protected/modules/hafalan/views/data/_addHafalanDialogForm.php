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
    'id' => 'add-hafalan-form',
    'action' => Yii::app()->createUrl('hafalan/data/addhafalan/', array()),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'form-horizontal c-new-form',
    )
        ));
?>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'absensi'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->dropDownList($model_add, 'absensi', Utility::getAbsentList(), array('options' => array('1' => array('selected' => true)), 'class' => 'form-control c-absent-type'));
        ?>
    </div>
</div>
<div class="col-md-7 col-md-offset-5" title="" data-original-title="Foto">
    <img class="c-finded-santri-image img-thumbnail" id="bindedImage<?php echo $group; ?>" src="<?php echo Yii::app()->createUrl('/images/resource/no-profile-image-2x3.jpg') ?>" class="avatar" height="105.44px" width="82.24px" alt="Avatar">
</div>
<div class="form-group"></div>
<div class="form-group">
    <label placeholder="Nama" for="fieldname" class="col-md-3 control-label">Nama</label>    
    <div class="col-md-6">
        <input type="text" class="form-control c-search-<?php echo $group; ?>" name="search-santri" id="santri_id">
    </div>
</div>
<?php
echo $form->hiddenField($model_add, 'santri_id', array('value' => '', 'class' => 'c-my-santri-id', 'id' => 'bindedTypeahead' . $group, 'data-url' => Yii::app()->createAbsoluteUrl('hafalan/data/getmyustadzoption')));
?>
<div class="c-non-absent">
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'tipe'); ?></label>
        <div class="col-md-6">
            <?php
            echo $form->dropDownList($model_add, 'tipe', Utility::getRecitationList(), array('empty' => '-- Hafalan --','data-url' => Yii::app()->createAbsoluteUrl('hafalan/data/getmyjuzoption') , 'class' => 'form-control c-recitation-type'));
//                                        echo CHtml::radioButtonList('tipe', 'ini', array('1' => 'Binadhor', '2' => 'Ziyadah', '3' => 'Murojaah'), array('separator' => "  "));
            ?>
        </div>
    </div>
    <div class='form-group c-surah hide'>
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'setoran_surat'); ?></label>
        <div class="col-md-6">
            <?php
            echo $form->dropDownList($model_add, 'setoran_surat', Utility::getMuqaddimah(), array('empty' => '-- Surat --', 'class' => 'form-control'));
            ?>
        </div>
    </div>
    <div class="form-group c-juz">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'setoran_juz'); ?></label>
        <div class="col-md-6">
            <?php
            echo $form->dropDownList($model_add, 'setoran_juz', Utility::getMergeJuz(), array('empty' => '-- Juz --', 'class' => 'form-control c-get-my-juz'));
            ?>
        </div>
    </div>
    <div class="form-group c-juz c-halaman">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'setoran_halaman'); ?></label>
        <div class="col-md-6">
            <?php
            echo $form->dropDownList($model_add, 'setoran_halaman', Utility::getSequenceArray(1, 20), array('empty' => '-- Halaman --', 'class' => 'form-control'));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'nilai'); ?></label>
        <div class="col-md-6">
            <input type="checkbox" name="MutabaahTahfidz[nilai]" value="lulus">Lulus 
            <?php
//        echo $form->checkBoxList($model_add, 'nilai', array('lulus' => 'Lulus'), array('checked' => 'lulus'));
            ?>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'ustadz_id'); ?></label>
    <div class="col-md-6">
        <?php
        $options = array();
        if (!empty($ustadz)) {
            $options = array($ustadz['id'] => array('selected' => 'selected'));
        }
        echo $form->dropDownList($model_add, 'ustadz_id', User::getMusyrifList(), array('empty' => '-- Musyrif --', 'class' => 'form-control c-ustadz', 'options' => $options));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_add, 'keterangan'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_add, 'keterangan', array('class' => 'form-control', 'placeholder' => 'Surat ... Ayat ke ... / Acara Keluarga'));
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