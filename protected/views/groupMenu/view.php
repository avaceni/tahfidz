<?php
/* @var $this GroupMenuController */
/* @var $model GroupMenu */

$this->breadcrumbs = array(
    'Group Menus' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List GroupMenu', 'url' => array('index')),
    array('label' => 'Create GroupMenu', 'url' => array('create')),
    array('label' => 'Update GroupMenu', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete GroupMenu', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage GroupMenu', 'url' => array('admin')),
);
?>

<div class="box">
    <div class="box-title">
        <div class="span-title">Detail Menu</div>
    </div>
    <div class="box-content">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'group_id',
                'menu_id',
            ),
        ));
        ?>
    </div>
</div>
