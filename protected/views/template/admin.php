<?php
/* @var $this TemplateController */
/* @var $model Template */

$this->breadcrumbs = array(
    'Templates' => array('index'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#template-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
        <h3 class="panel-title">Table Template</h3>
        <p>Some description goes here...</p>
    </div>
    <div class="panel-boddy">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'template-grid',
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
                    ),
                    "template" => "{delete}"
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