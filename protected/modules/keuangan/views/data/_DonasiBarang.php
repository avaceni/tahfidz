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
        <?php $grid_donation = 'donation-list-grid' ?>
<fieldset title="Donasi" class="stepy-step" data-tab="data-donasi">
    <legend>Donasi</legend>
    <div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'add-hafalan-form',
        'enableAjaxValidation' => false,
//                                            'action' => Yii::app()->createUrl('hafalan/data/addhafalan/', array('id' => $santri->id)),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'data-grid' => $grid_donation
        )
    ));
    ?>
    <div class="col-sm-2 c-donation-month">
        <?php
        $month_list = Utility::getMonthList();
        $all_month = array('all' => '-- Semua Bulan--');
        $month_list = $all_month + $month_list;
        echo CHtml::dropDownList('donation_month', $last_month_donation, $month_list, array('class' => 'form-control c-filter-donation', 'data-url' => Yii::app()->createAbsoluteUrl('keuangan/data/getdonationmonth')));
        ?>
    </div>
    <div class="col-sm-2 c-donation-year">
        <?php
        $year_list = $year_sequence_donation;
        $all_year = array('all' => '-- Semua Tahun--');
        $year_list = $all_year + $year_list;
        echo CHtml::dropDownList('donation_year', $last_year_donation, $year_list, array('class' => 'form-control c-filter-donation', 'data-url' => Yii::app()->createAbsoluteUrl('keuangan/data/getdonationmonth')));
        ?>
    </div>
    <div class="panel-ctrls">
        <div class="right">
            <div class="btn-group">
                <a class="btn-default btn" href="" data-toggle="modal" data-target="#add-donation-modal">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Tambah</span>
                </a>
                <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid_donation ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('keuangan/data/deleteallgoods') ?>">
                    <i class="glyphicon glyphicon-minus"></i>
                    <span>Hapus</span>
                </a>
                <a target="_blank" class="btn btn-primary c-btn-pdf" href="<?php echo Yii::app()->createUrl('keuangan/data/pdfgoods') ?>">
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
        <div class="panel-ctrls">
            <div class="right">
                <div class="btn-group">
<!--                    <a class="btn-default btn" href="" data-toggle="modal" data-target="#add-donation-modal">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Tambah</span>
                    </a>
                    <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php // echo $grid_donation ?>" data-url="<?php // echo Yii::app()->createAbsoluteUrl('keuangan/data/deletealldonation') ?>">
                        <i class="glyphicon glyphicon-minus"></i>
                        <span>Hapus</span>
                    </a>-->
                </div>
            </div> 
        </div>
    
        <?php
        echo CHtml::beginForm('#', 'POST', array(
            "id" => "donation-form",
            "class" => $grid_donation
        ));
        ?>
        <div class="box-content">
            <?php
            if ($model_donation) {
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => $grid_donation,
                    'dataProvider' => $model_donation,
                    'selectableRows' => 2,
                    'itemsCssClass' => 'table table-bordered table-condensed',
                    'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
                    'afterAjaxUpdate' => $afterAjaxUpdate,
                    'columns' => array(
                        array(
                            'header' => 'No',
                            'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                            'htmlOptions' => array("width" => "31px", "text-align" => "center")
                        ),
                        array(
                            'name' => 'nama_donatur',
                            'value' => 'ucwords($data->nama_donatur)',
                        ),
                        array(
                            'name' => 'nama_barang',
                            'type' => 'raw',
                            'htmlOptions' => array("style" => "text-align:right;"),
                            'value' => '$data->nama_barang',
                        ),
                        array(
                            'name' => 'detail_barang',
                            'value' => '$data->detail_barang',
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
                            'name' => 'pencatat',
                            'type' => 'raw',
                            'value' => function($data) {
                        $admin = '';
                        if (!empty($data->user)) {
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
                                    'options' => array('class' => 'glyphicon glyphicon-search c-simple-update', 'data-url' => 'Yii::app()->createUrl("keuangan/data/updateGoods", array("id"=>$data->id))', 'data-modal-id' => 'update-donation-modal', 'target' => "_blank"),
//                                        'url' => 'Yii::app()->createUrl("keuangan/data/view", array("id"=>$data->id))'
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
                                    'url' => 'Yii::app()->createUrl("keuangan/data/deletegoods", array("id"=>$data->id))'
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
    <div id="add-donation-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Tambah Donasi</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $this->renderPartial('_addGoodsDialogForm', array('model_add' => $model_add, 'action' => 'adddonation'));
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary c-admin-save" data-grid="<?php echo $grid_donation; ?>">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div id="update-donation-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Perbarui Donasi</h4>
                </div>
                <div class="modal-body">
                    <?php
//                $this->renderPartial('_addDonationDialogForm', array('model_add' => $model_donation_add, 'action' => 'adddonation'));
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary c-recitation-save no-reset" data-grid="<?php echo $grid_donation ?>">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</fieldset>