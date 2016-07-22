<?php
/* @var $this SiteController */
/* @var $model Site */

$this->breadcrumbs = array(
    'Sites' => array('index'),
    $model->name,
);
?>

<div class="box">
    <div class="box-title">
        <div class="span-title">
            <span class="icon left"><i class="icon-tasks"></i></span>
            <h5 class="left">Detail System </h5>
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
                'offline',
                'costum_message',
                'offline_message',
                'defaultLevelAccess.name',
                'default_list_limit',
                'default_feed_limit',
                'feed_email',
            ),
        ));
        ?>
    </div>
</div>