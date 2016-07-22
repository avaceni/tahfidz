<fieldset title="Lain-Lain" class="stepy-step <?php echo $hide==1?'hide':'' ?>" data-tab="data-lain">
    <legend>Lain-lain</legend>
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
    $l = 1;
    if (!empty($model)) {
        foreach ($model as $this_achievement) {
            ?>
            <h4 class="c-form-label">Prestasi <span id="c-multi-number"><?php echo $l ?></span> <?php echo $icon_trash; ?></h4>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-achievement-form',
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                    'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
                    'data-model' => get_class($this_achievement),
                    'data-id' => $this_achievement->id,
                )
            ));
            ?>
            <?php
            echo $form->hiddenField($this_achievement, 'id', array());
            echo $form->hiddenField($this_achievement, 'santri_id', array());
            ?>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_achievement, 'prestasi'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_achievement->prestasi; ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_achievement, 'prestasi', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_achievement, 'juara'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_achievement->juara; ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_achievement, 'juara', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($this_achievement, 'tahun'); ?></label>
                <div class="col-md-6 c-detail-view">
                    <a class="editable editable-click"><?php echo $this_achievement->tahun ?></a>
                </div>
                <div class="col-md-6 hide c-form-edit">
                    <?php echo $form->textField($this_achievement, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                </div>
            </div>
            <?php
            $this->endWidget();
            $l++;
        }
    }
    ?>
</fieldset>