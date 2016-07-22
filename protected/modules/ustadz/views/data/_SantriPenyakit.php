<fieldset title="Riwayat Penyakit" class="stepy-step <?php echo $hide==1?'hide':'' ?>" data-tab="data-penyakit">
    <legend>Riwayat Penyakit</legend>
    <div class="panel-ctrls" style="float:right">
        <div class="right">
            <div class="btn-group">
                <a class="button-white btn c-btn-multi" href="">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Tambah</span>
                </a>
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
    $k = 1;
    if (!empty($model)) {
        foreach ($model as $this_diseae) {
            ?>
            <h4 class="c-form-label">Penyakit <span id="c-multi-number"><?php echo $k ?></span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-riwayat-penyakit-form' . $k,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                    'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
                    'data-model' => get_class($this_diseae),
                    'data-id' => $this_diseae->id,
                )
            ));
            ?>
            <?php
            echo $form->hiddenField($this_diseae, 'id', array());
            echo $form->hiddenField($this_diseae, 'santri_id', array());
            ?>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_diseae, 'nama_penyakit'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_diseae->nama_penyakit; ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_diseae, 'nama_penyakit', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_diseae, 'tahun'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_diseae->tahun ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_diseae, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                </div>
            </div>
            <?php
            $this->endWidget();
            $k++;
        }
    }
    ?>
</fieldset>