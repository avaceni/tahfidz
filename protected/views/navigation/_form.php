<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'navigation-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="form">
    <div class="span-alert">
        <?php if (Yii::app()->user->hasFlash('success')) { ?>
            <div class="alert-success"><i class="icon-times close"></i>Navigation <?php echo Yii::app()->user->getFlash('success') ?></div>
        <?php } elseif (Yii::app()->user->hasFlash('error')) { ?>
            <div class="alert-warning "> <i class="icon-times close"></i> <?php echo CHtml::errorSummary($navigation_model);?></div>
        <?php } ?>
    </div>
    <?php // awal id?>
    <?php echo CHtml::activeHiddenField($navigation_model, 'id') ?>
    <?php // akhir id?>
    
    <?php // awal group_id?>
    <?php echo CHtml::activeHiddenField($navigation_model, 'group_id') ?>
    <?php // akhir group_id?>

    <?php // awal module_id?>
    <?php echo CHtml::activeHiddenField($navigation_model, 'module_id') ?>
    <?php // akhir module_id?>

    <?php // awal controller?>
    <?php echo CHtml::activeHiddenField($navigation_model, 'controller') ?>
    <?php // akhir controller?>

    <?php // awal name?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::activeLabelEx($navigation_model, 'name') ?>
        </div>
        <div class="col-100-percentage">
            <?php echo CHtml::activeTextField($navigation_model, 'name', array('class' => 'input-width-100')) ?>
            <?php echo CHtml::error($navigation_model, 'name'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir name?>

    <?php // awal alias?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::activeLabelEx($navigation_model, 'alias') ?>
        </div>
        <div class="col-100-percentage">
            <?php echo CHtml::activeTextField($navigation_model, 'alias', array('class' => 'input-width-100')) ?>
            <?php echo CHtml::error($navigation_model, 'alias'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir alias?>

    <?php // icon?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::activeLabelEx($navigation_model, 'icon') ?>
        </div>
        <div class="col-100-percentage">
            <?php echo CHtml::activeTextField($navigation_model, 'icon', array('class' => 'input-width-100')) ?>
            <?php echo CHtml::error($navigation_model, 'icon'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir icon?>

    <?php // link_type?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::activeLabelEx($navigation_model, 'link_type') ?>
        </div>
        <div class="col-100-percentage">
            <?php echo CHtml::activeDropDownList($navigation_model, 'link_type', array('link'=>'link', 'ajax_link'=>'ajax_link', 'submit_link'=>'submit_link', 'blank_link'=>'blank_link'), array('prompt'=>' - Link Type Choice - ')) ?>
            <?php echo CHtml::error($navigation_model, 'link_type'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir icon?>

    <?php // link?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::activeLabelEx($navigation_model, 'link') ?>
        </div>
        <div class="col-100-percentage">
            <div class="col-30-percentage" style="padding-left: 0;">
                <?php echo CHtml::activeDropDownList($navigation_model, 'moduleUrl', Module::model()->readModule(), array('class' => 'input-width-100')); ?>
            </div>
            <div class="col-30-percentage">
                <?php echo CHtml::activeDropDownList($navigation_model, 'controllerUrl', Module::model()->readModuleController($navigation_model->getModuleUrl()), array('class' => 'input-width-100')); ?>
            </div>
            <div class="col-30-percentage" style="padding-right: 0;">
                <?php echo CHtml::activeDropDownList($navigation_model, 'actionUrl', Module::model()->readControllerAction($navigation_model->getModuleUrl(), $navigation_model->getControllerUrl()), array('class' => 'input-width-100')); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir link?>

    <?php // action?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::activeLabelEx($navigation_model, 'action') ?>
        </div>
        <div class="col-100-percentage">
            <?php echo CHtml::activeTextField($navigation_model, 'action', array('class' => 'input-width-100')) ?>
            <?php echo CHtml::error($navigation_model, 'action'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir action?>

    <?php // params?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::activeLabelEx($navigation_model, 'params') ?>
        </div>
        <div class="col-100-percentage">
            <?php echo CHtml::activeTextField($navigation_model, 'params', array('class' => 'input-width-100')) ?>
            <div class="row-desc">contoh : id=1|id=GET#id|id=POST#id</div>
            <?php echo CHtml::error($navigation_model, 'params'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir params?>

    <?php // submit?>
    <div class="row">
        <div class="col-100-percentage">
            <?php echo CHtml::button('Simpan', array('class' => 'button-submit submit-ajax', 'ajaxType' => 'POST', 'ajaxUrl' => '', 'ajaxSuccess' => '
                {
                $(".modal-content").html(response);
                }
                ')) ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php // akhir submit?>
</div>
<?php $this->endWidget(); ?>