<?php
/* @var $this TemplateController */
/* @var $model Template */

$this->breadcrumbs=array(
	'Templates'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Template', 'url'=>array('index')),
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'View Template', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Template', 'url'=>array('admin')),
);
?>

<div class="box">
    <div class="box-title">Update <?php echo $model->name;?> Template</div>
    <div class="box-content">
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>