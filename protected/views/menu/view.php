<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs = array(
    'Menus' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Menu', 'url' => array('index')),
    array('label' => 'Create Menu', 'url' => array('create')),
    array('label' => 'Update Menu', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Menu', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Menu', 'url' => array('admin')),
);
?>

<div class="box">
    <div class="box-title">
        <div class="span-title">
            <span class="icon left"><i class="icon-tasks"></i></span>
            <h5 class="left">Detail Group Menu </h5>
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
//                'id',
//                'title',
                'url',
                'parameter',
                'aktif',
            ),
        ));
        ?>
    </div>
</div>