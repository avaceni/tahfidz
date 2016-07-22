<?php
/* @var $this TemplateController */
/* @var $model Template */

$this->breadcrumbs = array(
    'Templates' => array('index'),
    $model->name,
);

?>

<div class="box">
    <div class="box-title">
        <div class="span-title">Detail <?php echo $model->name; ?> Template </div>
        <div class="span-navigation right navigation">
            <?php $this->widget("application.components.widgets.NavigationMenu");?>
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
