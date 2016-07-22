<?php
/* @var $this GroupMenuController */
/* @var $model GroupMenu */
/* @var $navigation_model Navigation */
/* @var $group_model  Group */

$this->breadcrumbs = array(
    'Group Menus' => array('index'),
    'Manage',
);
?>

<div class="col-25-percentage">
    <div class="panel panel-dark panel-alt">
        <div class="panel-heading">
            <h3 class="panel-title">List Groups</h3>
            <p>Select group to view menu of group</p>
        </div>
        <div class="panel-boddy">
            <h4 class="subtitle mb5">Groups</h4>
            <?php echo CHtml::dropDownList('group', '', Group::model()->listGroups(), array('id' => 'group-menu-filter', 'class' => 'input-width-100', 'prompt' => ' - Select Group -')) ?>
            <div class="mb20"></div>
        </div>
    </div>
</div>

<div class="col-75-percentage">
    <div class="panel panel-default panel-alt">
        <div class="panel-heading">
            <h3 class="panel-title">Menu List</h3>
            <p class="">Check the following menu to perform actions</p>
        </div>
        <div class="panel-boddy">
            <?php echo CHtml::beginForm() ?>
            <div class="span-alert"></div>
            <input type="hidden" id="group-id" value="" name="group_id">
            <div id="group-menu-list"class="treeview">
                <?php $group_menu_model->arrMenu = $group_menu_model->findListMenuByGroup(0); ?>
                <?php $this->renderPartial('_tree_menu', array('group_menu_model' => $group_menu_model)) ?>
            </div>
            <div class="row">
                <div class="row-input float-none">
                    <?php
                    echo CHtml::button('Create', array('class' => 'button-submit submit-ajax',
                        'ajaxUrl' => Yii::app()->createUrl('/GroupMenu/ajaxsave'),
                        'ajaxSuccess' => "{
                            $('#group-menu-list').parents('.panel-boddy').find('.span-alert').html('<div class=\"alert-success\">'+response.message+' <i class=\"icon-times close\"></i></div>');
                        }",
                        'ajaxError' => "{
                            $('#group-menu-list').parents('.panel-boddy').find('.span-alert').html('<div class=\"alert-danger\">'+jqXHR.responseText+' <i class=\"icon-times close\"></i></div>');
                        }",
                        'ajaxType' => 'POST',
                        'ajaxDataType' => 'json'));
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php echo CHtml::endForm() ?>
        </div>
    </div>
</div>
<div class="clear"></div>