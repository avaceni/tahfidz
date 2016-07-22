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
<div class="form-group">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'add-hafalan-form',
        'enableAjaxValidation' => false,
        'action' => Yii::app()->createUrl('hafalan/data/addhafalan/', array('id' => $santri->id)),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <?php    
    echo $form->hiddenField($model_add, 'santri_id', array('value' => $santri->id, 'class' => 'c-my-santri-id'));
    ?>
    <div class="col-sm-1" style="width:112px">
        <?php
        echo $form->dropDownList($model_add, 'absensi', Utility::getAbsentList(), array('options' => array('1' => array('selected' => true)), 'class' => 'form-control c-absent-type'));
        ?>
    </div>
    <div class="c-non-absent">
    <div class="col-sm-2" style="width:110px">
        <?php
        echo $form->dropDownList($model_add, 'tipe', Utility::getRecitationList(), array('empty' => 'Hafalan', 'class' => 'form-control c-recitation-type', 'data-url' => Yii::app()->createAbsoluteUrl('hafalan/data/getmyjuzoption')));
        ?>
    </div>
    <div class='col-sm-2 c-surah hide'>
        <?php
        echo $form->dropDownList($model_add, 'setoran_surat', Utility::getMuqaddimah(), array('empty' => 'Surat', 'class' => 'form-control'));
        ?>
    </div>
    <div class="col-sm-1 c-juz">
        <?php
        echo $form->dropDownList($model_add, 'setoran_juz', Utility::getSequenceArray(1, 30), array('empty' => 'Juz', 'class' => 'form-control c-get-my-juz'));
        ?>
    </div>
    <div class="col-sm-1 c-juz c-halaman" style="width:80px">
        <?php
        echo $form->dropDownList($model_add, 'setoran_halaman', Utility::getSequenceArray(1, 20), array('empty' => 'Hal', 'class' => 'form-control'));
        ?>
    </div>
    <div class="col-sm-1">
        <input type="checkbox" name="MutabaahTahfidz[nilai]" value="lulus">Lulus 
        <?php
//        echo $form->checkBoxList($model_add, 'nilai', array('lulus' => 'Lulus'), array('checked' => 'lulus'));
        ?>
    </div>
    </div>
    <div class="col-sm-2">
        <?php
        $options = array();
        if(!empty($ustadz)){
            $options = array($ustadz['id'] => array('selected' => 'selected'));
        }
        echo $form->dropDownList($model_add, 'ustadz_id', User::getMusyrifList(), array('empty' => 'Musyrif', 'class' => 'form-control', 'options' => $options));
        ?>
    </div>
    <div class="col-sm-3" style="width:200px">
        <?php
        echo $form->textField($model_add, 'keterangan', array('class' => 'form-control', 'placeholder' => 'Keterangan'));
        ?>
    </div>
    <div class="col-sm-1">
        <?php
        echo CHtml::submitButton('Simpan', array('class' => 'btn btn-primary'));
        ?>
    </div>                                    
    <?php
    $this->endWidget();
    ?>
</div>