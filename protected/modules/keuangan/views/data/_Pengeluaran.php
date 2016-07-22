<?php
$afterAjaxUpdate = "function(id, data) {{
    $('.c-simple-update').on('click', function() {
        var action = $(this).attr('data-url');
        var modal = $(this).attr('data-modal-id');
        if(typeof modal != typeof undefined){
            var modalElement = '#'+modal;
        }
        else{
            var modalElement = '.simple-update-modal';
        }
        var updateModal = $(document).find(modalElement);
        $.ajax({
            type: 'GET',
            url: action,
            success: function(data) {
                updateModal.find('.modal-body').html(data);
                $(modalElement).modal('show');
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
return false;
});
}}";
?>
<?php $grid_expenditure = 'expenditure-list-grid' ?>
<fieldset title="Pengeluaran" class="stepy-step <?php echo $hide==1?'hide':'' ?>" data-tab="data-pengeluaran">
    <legend>Pengeluaran</legend>
    <div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'add-hafalan-form',
            'enableAjaxValidation' => false,
//                                            'action' => Yii::app()->createUrl('hafalan/data/addhafalan/', array('id' => $santri->id)),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'data-grid' => $grid_expenditure
                )
            ));
            ?>
            <div class="col-sm-2 c-donation-month">
                <?php
                $month_list = Utility::getMonthList();
                $all_month = array('all' => '-- Semua Bulan--');
                $month_list = $all_month + $month_list;
                echo CHtml::dropDownList('expenditure_month', $last_month_expenditure, $month_list, array('class' => 'form-control c-filter-donation','data-url' => Yii::app()->createAbsoluteUrl('keuangan/data/getexpendituremonth')));
                ?>
            </div>
            <div class="col-sm-2 c-donation-year">
                <?php
                $year_list = $year_sequence_expenditure;
                $all_year = array('all' => '-- Semua Tahun--');
                $year_list = $all_year + $year_list;
                echo CHtml::dropDownList('expenditure_year', $last_year_expenditure, $year_list, array('class' => 'form-control c-filter-donation','data-url' => Yii::app()->createAbsoluteUrl('keuangan/data/getexpendituremonth')));
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                $quarters_list = Pondokan::getPondokanList();
                $all_quarters = array('all' => '-- Semua Pondok --');
                $quarters_list = $all_quarters + $quarters_list;
                echo CHtml::dropDownList('expenditure_quarters', '', $quarters_list, array('class' => 'form-control c-filter-donation'));
                ?>
            </div>
            <div class="panel-ctrls">
                <div class="right">
                    <div class="btn-group">
                        <a class="btn-default btn" href="" data-toggle="modal" data-target="#add-expenditure-modal">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Tambah</span>
                        </a>
                        <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid_expenditure ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('keuangan/data/deleteallexpenditure') ?>">
                            <i class="glyphicon glyphicon-minus"></i>
                            <span>Hapus</span>
                        </a>
                        <a target="_blank" class="btn btn-primary c-btn-pdf" href="<?php echo Yii::app()->createUrl('keuangan/data/pdfexpenditure') ?>">
                            PDF
                        </a>
                    </div>
                </div> 
            </div>
            <?php
            $this->endWidget();
            ?>
        </div>
        <?php
        if ($this->cklt_user->group_id == 10) {
            ?>        
            <?php echo CHtml::beginForm('#', 'POST', array("id" => "donation-form", "class" => $grid_expenditure)); ?>
            <div class="box-content">
                <?php
                if ($model_expenditure) {
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => $grid_expenditure,
                        'dataProvider' => $model_expenditure,
                        'selectableRows' => 2,
                        'itemsCssClass' => 'table table-bordered table-condensed',
                        'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
                        'afterAjaxUpdate'=>$afterAjaxUpdate,
                        'columns' => array(
                            array(
                                'header' => 'No',
                                'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                'htmlOptions' => array("width" => "31px", "text-align" => "center")
                                ),
                            array(
                                'name' => 'tanggal',
//                            'value' => 'Utility::getDateFormat($data->tanggal);',
                                'type' => 'raw',
                                'value' => function($data) {
                                    $date = preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($data->tanggal));
                                    return $date;
                                },
                                ),
                            array(
                                'name' => 'keperluan',
                                'value' => 'ucfirst($data->keperluan)',
                                ),
                            array(
                                'name' => 'jumlah',
                                'header' => 'Jumlah (Rp)',
                                'type' => 'raw',
                                'htmlOptions' => array("style" => "text-align:right;"),
                                'value' => function($data) {
                                    $number_format = number_format($data->jumlah, 2, ",", ".");
                                    return $number_format;
                                },
                                ),
                            array(
                                'name' => 'pondok_id',
                                'type' => 'raw',
                                'value' => function($data) {
                                    $pondok = '';
                                    if(!empty($data->quarters)){
                                        $pondok = ucwords($data->quarters->nama_pondok);
                                    }
                                    return $pondok;
                                },
                                ),
                            array(
                                'name' => 'pencatat',
                                'type' => 'raw',
                                'value' => function($data) {
                                    $admin = '';
                                    if(!empty($data->user)){
                                        $admin = $data->user->full_name;
                                    }
                                    return $admin;
                                },
                                ),
                            array(
                                'class' => 'ButtonColumn',
                                'template' => '{view} {delete}',
                                "buttons" => array(
                                    "view" => array(
                                        'label' => '',
                                        "imageUrl" => "",
                                        'options' => array('class' => 'glyphicon glyphicon-search c-simple-update', 'data-url'=>'Yii::app()->createUrl("keuangan/data/updateExpenditure", array("id"=>$data->id))', 'data-modal-id'=>'update-expenditure-modal', 'target' => "_blank"),
//                                                                'url' => 'Yii::app()->createUrl("hafalan/data/view", array("id"=>$data->santri_id))'
                                        ),
//                                                        "update" => array(
//                                                            'label' => '',
//                                                            "imageUrl" => "",
//                                                            'options' => array('class' => 'glyphicon glyphicon-pencil'),
//                                                            'url' => 'Yii::app()->createUrl("hafalan/data/delete", array("id"=>$data->id))'
//                                                        ),
                                    "delete" => array(
                                        'label' => '',
                                        "imageUrl" => "",
                                        'options' => array('class' => 'glyphicon glyphicon glyphicon-trash'),
                                        'url' => 'Yii::app()->createUrl("keuangan/data/deleteexpenditure", array("id"=>$data->id))'
                                        )
                                    )
),
array(
    'class' => 'CCheckBoxColumn',
    'id' => 'id'
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
));
}
?>
</div>                            
<?php
echo CHtml::endForm();        
}
?>
<table class="table table-bordered table-condensed">
    <tbody>
        <tr>
            <td>
                Jumlah Total
            </td>
            <td width="20%" style="text-align:right;" class="c-total-finance-month">
                <?php echo "Rp ".number_format($page_expenditure, 2, ",", "."); ?>
            </td>
        </tr>
    </tbody>
</table>
<div id="add-expenditure-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah Pengeluaran</h4>
            </div>
            <div class="modal-body">
                <?php
                $this->renderPartial('_addExpenditureDialogForm', array('model_add' => $model_add, 'action' => 'addexpenditure'));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-admin-save" data-grid="<?php echo $grid_expenditure; ?>">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="update-expenditure-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Perbarui Pengeluaran</h4>
            </div>
            <div class="modal-body">
                <?php
//                $this->renderPartial('_addDonationDialogForm', array('model_add' => $model_donation_add, 'action' => 'adddonation'));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-recitation-save no-reset" data-grid="<?php echo $grid_expenditure ?>">Simpan</button>
            </div>
        </div>
    </div>
</div>
</fieldset>