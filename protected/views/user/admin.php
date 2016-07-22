<?php
//created by rizqi 
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
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
            'id' => 'user-grid',
            'dataProvider' => $model->search(),
//            'filter' => $model,
            'selectableRows' => 2,
            'columns' => array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                    'htmlOptions' => array("width" => "31px", "text-align" => "center")
                ),
//                'id',
                'username',
//                'password',
                'full_name',
                'email',
                'group.name',
                /*
                  'active',
                  'active_date',
                  'log',
                  'log_date',
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
