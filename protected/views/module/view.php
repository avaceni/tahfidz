<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs = array(
    'Modules' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Module', 'url' => array('index')),
    array('label' => 'Create Module', 'url' => array('create')),
    array('label' => 'Update Module', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Module', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Module', 'url' => array('admin')),
);
?>
<div class="box">
    <div class="box-title">
        <div class="span-title">
            <span class="icon left"><i class="icon-tasks"></i></span>
            <h5 class="left">Detail Module </h5>
            <div class="span-navigation right navigation">
                <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="box-content">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'name',
                'path',
            ),
        ));
        ?>
    </div>
</div>

