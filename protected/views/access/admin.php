<?php
/* @var $this AccessController */
/* @var $model Access */

$this->breadcrumbs = array(
    'Accesses' => array('admin'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#access-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php
//echo array_search('tiga', array('satu', 'tiga', 'tiga'));
//echo in_array('tiga', array('satu', 'stiga', 'tigas'));
?>
<div class="col-25-percentage">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h3 class="panel-title">Role</h3>
            <p>You can search on here.</p>
        </div>
        <div class="panel-body">
            <h4 class="subtitle mb5">Groups</h4>
            <?php echo CHtml::dropDownList('group_id', '', Group::model()->listGroups(), array('class' => 'input-width-100')) ?>
            <div class="mb20"></div>
        </div>
    </div>
</div>

<div class="col-25-percentage">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List Module</h3>
            <p>Some description goes here...</p>
        </div>
        <div class="panel-body">
            <div class="treeview" id="access-treeview-module-list">
                <?php $this->renderPartial("_tree_module", array('module_model'=>$module_model)); ?>
                <div class="mb20"></div>
            </div>
        </div>
    </div>
</div>

<div class="col-25-percentage">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List Controller</h3>
            <p>Some description goes here...</p>
        </div>
        <div class="panel-body">
            <div class="treeview" id="access-treeview-controller-list">
                No Module selected
            </div>
        </div>
    </div>
</div>

<div class="col-25-percentage">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List Action</h3>
            <p>Some description goes here...</p>
        </div>
        <div class="span-alert"></div>
        <div class="panel-body">
            <?php echo CHtml::beginForm(Yii::app()->createUrl('/access/save'), 'post');?>
            <?php echo CHtml::hiddenField('access_module_id')?>
            <?php echo CHtml::hiddenField('access_controller')?>
            <?php echo CHtml::hiddenField('access_group_id')?>
            <div class="treeview" id="access-treeview-action-list" >
                No Controller selected
            </div>
            <div class="mb20"></div>
            <?php echo CHtml::button('Save', array('class' => 'button-submit submit-ajax', 'ajaxType'=>'post', 'ajaxUrl'=>Yii::app()->createUrl('/access/save'), 
                'ajaxDataType'=>'json',
                'ajaxSuccess'=>'{
                    $(".span-alert").html(response.message);
                }')) ?>
            <?php echo CHtml::endForm();?>
        </div>
    </div>
</div>