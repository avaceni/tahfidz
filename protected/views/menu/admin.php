<?php
/* @var $this GroupMenuController */
/* @var $menu_model Menu */

$this->breadcrumbs = array(
    'Group Menus' => array('index'),
    'Manage',
);
?>
<div class="col-15-percentage">
    <div class="panel panel-dark panel-alt">
        <div class="panel-heading">
            <h3 class="panel-title">Menu Filter</h3>
            <p>Some description goes here...</p>
        </div>
        <div class="panel-boddy">
            <h4 class="subtitle mb5">Title</h4>
            <?php echo CHtml::textField('filter', '', array('class' => 'input-width-100')) ?>
            <div class="mb20"></div>
            <h4 class="subtitle mb5">Url</h4>
            <?php echo CHtml::textField('filter', '', array('class' => 'input-width-100', 'style' => 'display: block;')) ?>
            <div class="mb20"></div>
            <h4 class="subtitle mb5">Parent</h4>
            <?php echo CHtml::textField('filter', '', array('class' => 'input-width-100')) ?>
            <div class="mb20"></div>
            <?php echo CHtml::submitButton('Find', array('class' => 'button-submit input-width-100')) ?>
            <div class="mb20"></div>
        </div>
    </div>
</div>

<div class="col-50-percentage">
    <div class="panel panel-default panel-alt">
        <div class="panel-heading">
            <h3 class="panel-title">Menu List</h3>
            <p class="">Some description goes here...</p>
        </div>
        <div class="panel-boddy">
            <?php echo CHtml::beginForm(); ?>
            <div class="span-alert" id="menulist-alert"></div>
            <div class="treeview" id="treeview-menulist">
                <?php $this->renderPartial('_tree_menu', array('menu_model' => $menu_model)); ?>
            </div>
            <div class="row">
                <?php
                echo CHtml::button('delete', array(
                    'class' => 'button-danger input-width-100 submit-ajax',
                    'ajaxUrl' => Yii::app()->createUrl('/menu/AjaxDelete'),
                    'ajaxSuccess' => "{
                        $.ajax({
                            url: '" . Yii::app()->createUrl('/menu/AjaxReloadMenuList') . "',
                            success: function(html){
                                $('#treeview-menulist').html(html);
                                $('#menulist-alert').parents('.panel-boddy').find('.span-alert').html(response.message);
                            }
                        });
                     }",
                    'ajaxError' => "{
                        $('#menulist-alert').parents('.panel-boddy').find('.span-alert').html('<div class=\"alert-danger\">'+jqXHR.responseText+' <i class=\"icon-times close\"></i></div>');
                     }",
                    'ajaxType' => 'POST',
                    'ajaxDataType' => 'json'
                ));
                ?>
            </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>

<div class="col-35-percentage">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Menu Detail</h3>
            <p>Some description goes here...</p>
        </div>
        <div class="panel-boddy">
            <div class="span-alert" id="menu-detail"></div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'group-menu-form',
                'enableAjaxValidation' => false,
            ));
            ?>
            <?php // awal title ?>
            <?php echo CHtml::activeHiddenField($model, 'parent_id', array('value'=>0));?>
            <div class="row">
                <div class="row-label float-none"><?php echo CHtml::activeLabelEx($model, 'title', array('class' => 'text-align-left')) ?></div>
                <div class="row-input float-none">
                    <?php echo CHtml::activeTextField($model, 'title', array('class' => 'input-width-100')) ?>
                </div>
            </div>
            <?php // akhir title ?>
            <?php // awal icon ?>
            <div class="row">
                <div class="row-label float-none"><?php echo CHtml::activeLabelEx($model, 'icon', array('class' => 'text-align-left')) ?></div>
                <div class="row-input float-none">
                    <?php echo CHtml::activeTextField($model, 'icon', array('class' => 'input-width-100')) ?>
                </div>
            </div>
            <?php // akhir icon ?>
            <?php // awal url ?>
            <div class="row">
                <div class="row-label float-none"><?php echo CHtml::activeLabelEx($model, 'url', array('class' => 'text-align-left')) ?></div>
                <div class="row-input float-none">
                    <div class="col-25-percentage" style="padding-left: 0;"><?php echo CHtml::activeDropDownList($model, 'moduleUrl', Module::model()->readModule(), array('class' => 'input-width-100')); ?></div>
                    <div class="col-25-percentage"><?php echo CHtml::activeDropDownList($model, 'controllerUrl', array(), array('class' => 'input-width-100')); ?></div>
                    <div class="col-50-percentage" style="padding-right: 0"><?php echo CHtml::activeDropDownList($model, 'actionUrl', array(), array('class' => 'input-width-100')); ?></div>
                    <?php // echo CHtml::activeTextField($model, 'url', array('class' => 'input-width-100')) ?>
                    <div class="clear"></div>
                </div>
            </div>
            <?php // akhir url?>
            <?php // akhir url ?>
            <?php // awal parameter ?>
            <div class="row">
                <div class="row-label float-none"><?php echo CHtml::activeLabelEx($model, 'parameter', array('class' => 'text-align-left')) ?></div>
                <div class="row-input float-none">
                    <div class="col-50-percentage" style="padding-left: 0;"><?php echo CHtml::textField('parameter', '', array('class' => 'input-width-100', 'placeholder' => 'parameter')) ?></div>
                    <div class="col-50-percentage" style="padding-right: 0;"><?php echo CHtml::textField('value', '', array('class' => 'input-width-100', 'placeholder' => 'value')) ?></div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php // akhir parameter ?>
            <?php // awal aktif ?>
            <div class="row">
                <div class="row-label float-none"><?php echo CHtml::activeLabelEx($model, 'aktif', array('class' => 'text-align-left')) ?></div>
                <div class="row-input float-none">
                    <?php echo CHtml::activeCheckBox($model, 'aktif', array('class' => '')) ?>
                </div>
            </div>
            <?php // akhir aktif?>

            <?php echo $form->errorSummary($model); ?>
            <div class="row">
                <div class="row-input float-none">
                    <?php
                    echo CHtml::button('Create', array('class' => 'button-submit input-width-100 submit-ajax',
                        'ajaxUrl' => Yii::app()->createUrl('/menu/create'),
                        'ajaxSuccess' => "{
                            $.ajax({
                                url: '" . Yii::app()->createUrl('/menu/AjaxReloadMenuList') . "',
                                success: function(html){
                                    $('#treeview-menulist').html(html);
                                    $('#menu-detail').parents('.panel-boddy').find('.span-alert').html(response.message);
                                }
                            });
                        }",
                        'ajaxError' => "{
                            $('#menu-detail').parents('.panel-boddy').find('.span-alert').html('<div class=\"alert-danger\">'+jqXHR.responseText+' <i class=\"icon-times close\"></i></div>');
                        }",
                        'ajaxType' => 'POST',
                        'ajaxDataType' => 'json'));
                    ?>
                </div>
                <div class="clear"></div>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
</div>
</div>
<div class="clear"></div>