<fieldset title="Keluarga" class="stepy-step <?php echo $hide==1?'hide':'' ?>" data-tab="data-keluarga">
    <legend>Keluarga</legend>                                   
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
    $i = 1;
    if (!empty($model)) {
        foreach ($model as $this_parent) {
            ?>
            <h4 class="c-form-label">Orangtua <span id="c-multi-number"><?php echo $i ?></span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-orangtua-form' . $i,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                    'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
                    'data-model' => get_class($this_parent),
                    'data-id' => $this_parent->id,
                )
            ));
            ?>
            <?php
            echo $form->hiddenField($this_parent, 'id', array());
            echo $form->hiddenField($this_parent, 'santri_id', array());
            ?>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'nama'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->nama); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'tempat_lahir'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->tempat_lahir); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_parent, 'tempat_lahir', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'tanggal_lahir'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($this_parent->tanggal_lahir)); ?></a>
                </div>
                <div class="input-group date hide c-form-edit form_date col-md-6" data-date="" data-date-format="dd MM yyyy">
                    <input class="form-control" size="16" type="text" name="SantriOrangtua[tanggal_lahir]" value="<?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($this_parent->tanggal_lahir)); ?>" id="SantriOrangtua_tanggal_lahir">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'agama'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getReligion($this_parent->agama); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo CHtml::activeDropDownList($this_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'no_telepon'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_parent->no_telepon; ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'pendidikan_id'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getEducation($this_parent->pendidikan_id); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo CHtml::activeDropDownList($this_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'pekerjaan'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->pekerjaan); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'penghasilan'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->penghasilan); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'alamat'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->alamat); ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textArea($this_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_parent, 'hubungan_orangtua'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getKinship($this_parent->hubungan_orangtua) ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo CHtml::activeDropDownList($this_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                </div>
            </div>
            <?php
            $this->endWidget();
            $i++;
        }
    }
    ?>
</fieldset>