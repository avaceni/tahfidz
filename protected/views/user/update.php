<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>

<div class="box">
    <div class="box-title">
        <div class="span-title">
            <span class="icon left"><i class="icon-tasks"></i></span>
            <h5 class="left">Form Update User </h5>
            <div class="span-navigation right navigation">
                <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="box-content pad25">
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>