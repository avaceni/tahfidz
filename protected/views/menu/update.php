<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	'Menus'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Menu', 'url'=>array('index')),
	array('label'=>'Create Menu', 'url'=>array('create')),
	array('label'=>'View Menu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Menu', 'url'=>array('admin')),
);
?>

<div class="box">
    <div class="box-title">
        <div class="span-title">
            <span class="icon left"><i class="icon-tasks"></i></span>
            <h5 class="left">Form Update Group Menu </h5>
            <div class="span-navigation right navigation">
                <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="box-content">
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>