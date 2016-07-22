<?php
/* @var $this SiteController */
/* @var $model Site */

$this->breadcrumbs=array(
	'Sites'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Table System</h3>
        <p>Some description goes here...</p>
    </div>
    <div class="panel-boddy">
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>