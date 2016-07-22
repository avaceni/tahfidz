<fieldset title="Riwayat Halaqoh" class="stepy-step <?php echo $hide==1?'hide':'' ?>" data-tab="data-kelompok">
    <legend>Riwayat Halaqoh</legend>
    <?php $grid = "table" ?>
    <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid)); ?>
    <div class="box-content">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => $grid,
            'dataProvider' => $model,
            'filter' => $model,
            'selectableRows' => 0,
            'filter' => null,
            'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
            'itemsCssClass' => 'table table-bordered table-condensed',
            'columns' => array(
                array(
                    'header' => 'No',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                    'htmlOptions' => array("width" => "31px", "text-align" => "center")
                    ),
                array(
                    'name' => 'Kelompok',
                    'value' => 'ucwords($data->kelompoknya->nama_kelompok)'
                    ),
                array(
                    'name' => 'Tanggal',
                    'value' => '$data->tanggal_dibuat'
                    ),                
                ),
            'pager' => array(
                'header' => '',
                'cssFile' => false,
                'maxButtonCount' => 9,
                'selectedPageCssClass' => 'active',
                'hiddenPageCssClass' => 'hide',
                    'firstPageCssClass' => 'hide', //'previous',
                    'lastPageCssClass' => 'hide', //'next',
                    'firstPageLabel' => '<<',
                    'lastPageLabel' => '>>',
                    'prevPageLabel' => '<',
                    'nextPageLabel' => '>',
                    ),
            )
);
?>
<?php echo CHtml::endForm(); ?>
</div>
</fieldset>