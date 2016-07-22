<?php

//$this->breadcrumbs = array(
//    'News' => array('manage'),
//    'Create',
//);
?>
<div class="box">
    <div class="box-content">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'officers-email-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data'
                )
            ));
            ?>
            
            <div class="col-50-percentage">
                <div class="row">
                    <div class="row-label"><?php echo $form->labelEx($model, 'feed_email'); ?></div>
                    <div class="row-input">
                        <?php echo $form->textField($model, 'feed_email', array('class' => 'input-width-100', 'maxlength' => 31)); ?>
                        <?php echo $form->error($model, 'feed_email'); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <div class="row-label"><?php echo $form->labelEx($model, 'password'); ?></div>
                    <div class="row-input">
                        <?php echo $form->textField($model, 'password', array('class' => 'input-width-100', 'maxlength' => 31)); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php // awal submit button?>
            <div class="row">
                <div class="row-label"></div>
                <div class="row-input">
                    <?php echo CHtml::submitButton("save", array("class" => "button-submit")); ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php // akhir submit button?>
            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
</div>
