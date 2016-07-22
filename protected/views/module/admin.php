<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs = array(
    'Modules' => array('admin'),
    'Manage',
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
            'id' => 'module-grid',
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
                'path',
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