<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'group-form',
        'enableAjaxValidation' => true,
    ));
    ?>

    <?php // nama group?>
    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'name'); ?></div>
        <div class="row-input">
            <?php echo $form->textField($model, 'name', array('size' => 21, 'maxlength' => 21)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir group?>

    <?php // awal template?>
    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'template_id'); ?></div>
        <div class="row-input">
            <?php //echo $form->textField($model,'template_id',array('size'=>11,'maxlength'=>11)); ?>
            <?php echo CHtml::activeDropDownList($model, "template_id", Template::model()->listTemplates()); ?>
            <?php echo $form->error($model, 'template_id'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir template?>
    
    <?php // default template layout?>
    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'default_template_layout'); ?></div>
        <div class="row-input">
            <?php echo $form->textField($model, 'default_template_layout', array('placeholder'=>'Type default template layout here', 'size' => 21, 'maxlength' => 31)); ?>
            <?php echo $form->error($model, 'default_template_layout'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir default template layout?>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'dashboard_url'); ?></div>
        <div class="row-input"><?php echo $form->textField($model, 'dashboard_url', array('size' => 21, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'dashboard_url'); ?></div>
        <div class="clear"></div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php
//                echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save', Yii::app()->createUrl('group/create'),
//                        array(
//                            'type'=>'POST',
//                            'dataType'=>'json',
//                            'success' => 'js:function(data){
//                                if(data.isSave == 1){
//                                    $(".content").html(data.html);
//                                }
//                            }',)
//                        ); 
        ?>
        <?php //echo CHtml::button('Cancel', array("onClick"=>"closeActionDialog()", "class"=>"cancelButton"))?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->