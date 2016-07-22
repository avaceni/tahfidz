<?php
//
/* @var $this SiteController */
/* @var $model Site */

$this->breadcrumbs = array(
    'System' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Site', 'url' => array('index')),
    array('label' => 'Create Site', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#module-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Table System</h3>
        <p>Some description goes here...</p>
    </div>
    <div class="panel-boddy">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'site-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'selectableRows' => 2,
            'columns' => array(
//                'id',
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                    'htmlOptions' => array("width" => "31px", "text-align" => "center")
                ),
                'name',
                array(
                    "header" => "Offline",
                    "type" => "raw",
                    "value" => 'Utility::convertCheckedToIcon($data->offline)',
                ),
                'costum_message',
                'offline_message',
                'defaultLevelAccess.name',
                /*
                  'default_list_limit',
                  'default_feed_limit',
                  'feed_email',
                 */
                array(
                    'class' => 'CButtonColumn',
                    "buttons" => array(
                        "view" => array(
                            'label' => '',
                            "imageUrl" => ""
                        ),
                        "update" => array(
                            'label' => '',
                            "imageUrl" => ""
                        ),
                        "delete" => array(
                            'label' => '',
                            "imageUrl" => ""
                        )
                    )
                ),
                array(
                    'class' => 'CCheckBoxColumn',
                    'id' => 'id'
                ),
            ),
        ));
        ?>
    </div>
</div>