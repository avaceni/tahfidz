<?php
/* @var $this TemplateController */
/* @var $model Template */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'template-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>

    <!--	<div class="row">
    <?php //echo $form->labelEx($model,'name'); ?>
    <?php //echo $form->textField($model,'name',array('size'=>31,'maxlength'=>31));  ?>
    <?php //echo $form->error($model,'name');  ?>
                <div class="clear"></div>
            </div>-->

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'path'); ?></div>
        <div class="row-input">
            <?php echo CHtml::activeFileField($model, "path"); ?>
            <?php echo $form->error($model, 'path'); ?>
        </div>
        <?php //echo $form->textField($model,'path',array('size'=>51,'maxlength'=>51));  ?>
        <div class="clear"></div>
        <div class="row-desc">File Format (*.zip)</div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Upload And Install Template' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->