<?php
/* @var $this GroupMenuController */
/* @var $model GroupMenu */
/* @var $form CActiveForm */

$gid = 0;

if (isset($_GET["gid"]))
    $gid = $_GET["gid"];
else if (!$model->isNewRecord)
    $gid = $model->group_id;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'group-menu-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'group_id'); ?></div>
        <div class="row-input">
            <?php echo CHtml::activeDropDownList($model, "group_id", Group::model()->listGroups()); ?>
            <?php echo $form->error($model, 'group_id'); ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'menu_id'); ?></div>
        <div class="row-input">
            <?php //echo CHtml::activeDropDownList($model, "menu_id", Menu::model()->listParentMenu()); ?>
            <?php
            $this->widget("zii.widgets.jui.CJuiAutoComplete", array(
                "name" => "menu_ids",
                "model" => $model,
                "source" => Menu::model()->listAutoComplete(),
                "value" => (isset($model->menu_id) ? $model->menu->title : null),
                "options" => array(
                    "minLength" => 1,
                    "select" => "js:function(event, ui){
                            $('#GroupMenu_menu_id').val(ui.item.id);
                        }"
                )
            ));
            ?>
            <?php echo $form->error($model, 'menu_id'); ?>
        </div>
        <div class="clear"></div>
        <?php ?>
        <?php echo CHtml::activeHiddenField($model, "menu_id"); ?>
    </div>

    <div class="row">
        <div class="row-label"><?php echo $form->labelEx($model, 'parent_id'); ?></div>
        <div class="row-input">
            <?php
            $this->widget("zii.widgets.jui.CJuiAutoComplete", array(
                "name" => "parent_ids",
                "model" => $model,
                "source" => GroupMenu::model()->listParentAutoComplete($gid),
                "value" => (isset($model->parent_id)) ? $model->parent_id : null,
                "options" => array(
                    "minLength" => 1,
                    "select" => "js:function(event, ui){
                            $('#GroupMenu_parent_id').val(ui.item.id);
                        }",
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                    ),
                )
            ));
            ?>
            <?php echo CHtml::activeHiddenField($model, "parent_id") ?>
            <?php echo $form->error($model, 'parent_id'); ?>
        </div>
        <div class="clear"></div>
        <?php echo $model->parent_id; ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
