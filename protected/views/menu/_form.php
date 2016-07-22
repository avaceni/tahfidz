<?php
/* @var $this MenuController */
/* @var $model Menu */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'menu-form',
                'enableAjaxValidation' => false,
            )); ?>
    <div class="box no-border padding-15">
        <div class="box-header">
            <div class="span-title">
                <h4>Menu Form</h4>
            </div>
        </div>
        <div class="box-content table-display overflow-auto">
            <div class="table-cell-display">
                <div class="row table-display">
                    <div class="table-cell-display left-181">
                        <div class="text-subtitle">Title</div>
                        <div class="text-mutted">You Can type title menu here</div>
                    </div>
                    <div class="table-cell-display">
                        <div class="row-label float-none">
                            <?php echo $form->labelEx($model, 'title'); ?>
                        </div>
                        <div class="row-input float-none">
                            <?php echo $form->textField($model, 'title', array('size' => 21, 'maxlength' => 21)); ?>
                            <?php echo $form->error($model,'title'); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="row table-display">
                    <div class="table-cell-display left-181">
                        <div class="text-subtitle">Icon</div>
                        <div class="text-mutted">You Can type icon name that enable in css</div>
                    </div>
                    <div class="table-cell-display">
                        <div class="row-label float-none">
                            <?php echo $form->labelEx($model, 'icon'); ?>
                        </div>
                        <div class="row-input float-none">
                            <?php echo $form->textField($model, 'icon', array('size' => 21, 'maxlength' => 51)); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="row table-display">
                    <div class="table-cell-display left-181">
                        <div class="text-subtitle">Url</div>
                        <div class="text-mutted">Type url for this menu to redirect</div>
                    </div>
                    <div class="table-cell-display">
                        <div class="row-label float-none">
                            <?php echo $form->labelEx($model, 'url'); ?>
                        </div>
                        <div class="row-input float-none">
                            <?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 71)); ?>
                            <?php echo $form->error($model, 'url'); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="row table-display">
                    <div class="table-cell-display left-181">
                        <div class="text-subtitle">Parameter Url</div>
                        <div class="text-mutted">ex : param=value | param=GET#index | param=POST#index</div>
                    </div>
                    <div class="table-cell-display">
                        <div class="row-label float-none">
                            <?php echo $form->labelEx($model, 'parameter'); ?>
                        </div>
                        <div class="row-input float-none">
                            <?php echo $form->textField($model, 'parameter', array('size' => 21, 'maxlength' => 21)); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="row table-display">
                    <div class="table-cell-display left-181">
                        <div class="text-subtitle">Aktiv Stats</div>
                        <div class="text-mutted">You can use it for login</div>
                    </div>
                    <div class="table-cell-display">
                        <div class="row-label float-none">
                            <?php //echo $form->labelEx($model, 'aktif'); ?>
                        </div>
                        <div class="row-input float-none">
                            <?php $this->widget("ext.flatcheckbox.FlatCheckbox", array("model" => $model, "attribute" => "aktif", "htmlOptions" => array("id" => "1"))); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->