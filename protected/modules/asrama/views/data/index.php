<?php
//$coreScript = file_get_contents(Yii::getPathOfAlias("webroot.js.admin").'/core.js');
$afterAjaxUpdate = "function(id, data) {
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
}";
?>
<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
        $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Asrama', 'url' => array('asrama/data/manage')),
                ),
            ));
            ?>
            <h1>Data Asrama<?php // echo $this->uniqueId . '/' . $this->action->id;       ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-indigo panel-top">
                            <div class="panel-heading">
                                <div class="clear"></div>
                                <h2 class="ng-binding">Tambah Asrama</h2>
                            </div>
                            <div class="panel-body">
                                <p>
                                    Untuk menambahkan asrama, isi form yang telah disediakan pada panel
                                    ini kemudian klik simpan.
                                    <br>
                                    Hasil inputan data baru akan ditampilkan pada 
                                    tabel asrama di bawah.
                                </br>
                            </p>
                            <div class="form-group">
                                <?php
                                $grid = 'quarters-grid';
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'mod-content-form',
                                    'enableAjaxValidation' => false,
                                    'htmlOptions' => array(
                                        'class' => 'c-simple-add-form',
                                        'data-grid' => $grid,
                                        )
                                    ));
                                    ?>
                                    <div class="col-sm-2">
                                        <?php
                                        echo CHtml::activeTextField($model_add, 'nama_pondok', array('class' => 'form-control', 'placeholder' => 'Nama Asrama'));
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php
                                        echo CHtml::activeDropDownList($model_add, "status", Utility::getQuartersOwnershipList(), array("prompt" => " - Pilih - ", 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group c-form-edit date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" value="<?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat(date('Y-m-d', time()))); ?>" name="Pondokan[tanggal_mulai]" id="Pondokan_tanggal_mulai">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php
                                        echo CHtml::activeTextField($model_add, 'jangka_waktu', array('class' => 'form-control', 'placeholder' => 'Jangka Waktu'));
                                        ?>
                                    </div>
                                    <div class="col-sm-1">
                                        <?php
                                        echo CHtml::submitButton('Tambah', array('class' => 'btn btn-primary'));
                                        ?>
                                    </div>
                                    <?php
                                    $this->endWidget();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </panel>
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-bottom">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Data Asrama</h2>
                                <?php /*
                                  <div class="panel-ctrls">
                                  <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
                                  </div>
                                 */ ?>
                                 <div class="panel-ctrls">
                                    <div class="right">
                                        <div class="btn-group">
                                            <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('asrama/data/deleteall') ?>">
                                                <i class="glyphicon glyphicon-minus"></i>
                                                <span>Hapus</span>
                                            </a>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini merupakan tabel yang berisikan data Asrama. 
                                    Pada panel ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                    data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                    tekan <b><i class="glyphicon glyphicon-pencil"></i></b> untuk edit data, tekan 
                                    <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                    <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                </p>
                                <div class="span-alert"> </div>
                                <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid)); ?>
                                <div class="box-content">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => $grid,
                                        'dataProvider' => $model->searchQuarters(),
                                        'filter' => $model,
                                        'selectableRows' => 2,
                                        'afterAjaxUpdate' => $afterAjaxUpdate,
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
                                                'name' => 'nama_pondok',
                                                'value' => 'ucwords($data->nama_pondok)'
                                                ),
                                            array(
                                                'name' => 'status',
                                                'value' => 'Utility::getQuartersOwneship($data->status)'
                                                ),
                                            array(
                                                'name' => 'tanggal_mulai',
//                            'value' => 'Utility::getDateFormat($data->tanggal);',
                                                'type' => 'raw',
                                                'value' => function($data) {
                                                    $date = '';
                                                    if(!empty($data->tanggal_mulai)){
                                                        $date = preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($data->tanggal_mulai));
                                                    }
                                                    return $date;
                                                },
                                                ),
                                            array(
                                                'name' => 'jangka_waktu',
                                                'value' => '$data->jangka_waktu'
                                                ),
                                            array(
                                                'class' => 'ButtonColumn',
                                                'template' => '{update} {delete}',
                                                "buttons" => array(
                                                    "update" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array(
                                                            'class' => 'glyphicon glyphicon-pencil c-simple-update',
                                                            'data-url' => 'Yii::app()->createUrl("/asrama/data/update/id/$data->id")',
                                                            ),
                                                        ),
//                                                    "view" => array(
//                                                        'label' => '',
//                                                        "imageUrl" => "",
//                                                        'options' => array('class' => 'glyphicon glyphicon-pencil'),
//                                                    ),
                                                    "delete" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array('class' => 'glyphicon glyphicon glyphicon-trash'),
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
?>
</div>                            
<?php echo CHtml::endForm(); ?>
<!-- Modal -->
<div id="" class="simple-update-modal modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Edit Pondok</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-simple-update-modal">Simpan</button>
            </div>
        </div>
    </div>
    <div class="hide c-success-alert">
        <div class="alert alert-success alert-dismissable" role="alert" type="success" close="closeAlert($index)">
            <button type="button" class="close">
                <span class=""></span>
                <span class="sr-only">Close</span>
            </button>
            <div><span class=""><strong>Sukses!</strong> Data berhasil disimpan</span></div>
        </div>
    </div>
</div>
</div>
</div>
</panel>
</div>
</div>
</div> <!-- container-fluid -->
</div> <!--wrap -->
</div>
<footer role="contentinfo" ng-show="!layoutLoading" class="">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li>SPOTKY © <?php echo date('Y', time()) ?></li>
        </ul>
        <button class="pull-right btn btn-default btn-sm hidden-print" back-to-top="" style="padding: 1px 10px;"><i class="fa fa-angle-up"></i></button>
    </div>
</footer>