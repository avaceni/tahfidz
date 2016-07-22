<?php
/*created by rizqi*/
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs = array(
    'Groups' => array('index'),
    $model->name,
);
?>

<div class="box">
    <div class="box-title">
        <div class="span-title">
            <span class="icon left"><i class="icon-tasks"></i></span>
            <h5 class="left">Detail Group</h5>
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
                'name',
                'template.name',
                'dashboard_url',
            ),
        ));
        ?>
    </div>
</div>