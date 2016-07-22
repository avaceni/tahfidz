<?php
/* @var $this SiteController */
/* @var $data Site */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offline')); ?>:</b>
	<?php echo CHtml::encode($data->offline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costum_message')); ?>:</b>
	<?php echo CHtml::encode($data->costum_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offline_message')); ?>:</b>
	<?php echo CHtml::encode($data->offline_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_level_access')); ?>:</b>
	<?php echo CHtml::encode($data->default_level_access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_list_limit')); ?>:</b>
	<?php echo CHtml::encode($data->default_list_limit); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('default_feed_limit')); ?>:</b>
	<?php echo CHtml::encode($data->default_feed_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feed_email')); ?>:</b>
	<?php echo CHtml::encode($data->feed_email); ?>
	<br />

	*/ ?>

</div>