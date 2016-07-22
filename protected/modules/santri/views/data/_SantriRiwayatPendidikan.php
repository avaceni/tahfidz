<fieldset title="Pendidikan" class="stepy-step <?php echo $hide==1?'hide':'' ?>" data-tab="data-pendidikan">
    <legend>Riwayat Pendidikan</legend>
    <?php
    $icon_trash = '';
    if($this->cklt_user->group_id == 10){
        $icon_trash = '<a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a>';
    ?>
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
    }
    ?>
    <?php
    $j = 1;
    if (!empty($model)) {
        foreach ($model as $this_education) {
            ?>
            <h4 class="c-form-label">Pendidikan <span id="c-multi-number"><?php echo $j ?></span> <?php echo $icon_trash; ?></h4>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-riwayat-pendidikan-form' . $j,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                    'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
                    'data-model' => get_class($this_education),
                    'data-id' => $this_education->id,
                )
            ));
            ?>
            <?php
            echo $form->hiddenField($this_education, 'id', array());
            echo $form->hiddenField($this_education, 'santri_id', array());
            ?>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'jenjang_id'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getEducation($this_education->jenjang_id) ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo CHtml::activeDropDownList($this_education, "jenjang_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'nama_sekolah'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_education->nama_sekolah); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_education, 'nama_sekolah', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'tahun_masuk'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_education->tahun_masuk; ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_education, 'tahun_masuk', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'tahun_lulus'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_education->tahun_lulus ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_education, 'tahun_lulus', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_education, 'nilai_rata_rata'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_education->nilai_rata_rata; ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_education, 'nilai_rata_rata', array('size' => 7, 'maxlength' => 7, 'class' => 'form-control')); ?>
                </div>
            </div>
            <?php
            $this->endWidget();
            $j++;
        }
    }
    ?>
</fieldset>