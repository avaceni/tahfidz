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
                array('name' => 'Tahun Ajaran', 'url' => array('tahunajaran/data/manage')),
            ),
        ));
        ?>
            <h1>Data Tahun Ajaran<?php // echo $this->uniqueId . '/' . $this->action->id;       ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-indigo panel-top">
                            <div class="panel-heading">
                                <div class="clear"></div>
                                <h2 class="ng-binding">Tambah Tahun Ajaran</h2>
                            </div>
                            <div class="panel-body">
                                <p>
                                    Untuk menambahkan halaqoh, isi form yang telah disediakan pada panel
                                    ini kemudian klik simpan.
                                    <br>
                                    Hasil inputan data baru akan ditampiklan pada 
                                    tabel halaqoh di bawah.
                                    </br>
                                </p>
                                <div class="form-group">
                                    <?php
                                    $grid = 'academic-year-grid';
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'academic-year-add-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'c-simple-add-form',
                                            'data-grid' => $grid,
                                        )
                                    ));
                                    ?>
                                    <div class="col-sm-3">
                                        <?php
                                        echo CHtml::activeTextField($model_add, 'nama_tahun_ajaran', array('class' => 'form-control', 'placeholder' => 'Nama Tahun Ajaran'));
                                        ?>
                                    </div>
                                    <div style="float:left;" class="input-group date form_date col-sm-3" data-date="" data-date-format="dd MM yyyy">
                                        <input class="form-control" size="16" type="text" name="TahunAjaranBaru[tanggal_dimulai]" id="TahunAjaranBaru_tanggal_dimulai">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <?php
//                                        echo CHtml::activeTextField($model_add, 'tanggal_dimulai', array('class' => 'form-control', 'placeholder' => 'Tanggal Dimulai'));
                                    ?>
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
                                <h2 class="ng-binding">Data Tahun Ajaran</h2>
                                <?php /*
                                <div class="panel-ctrls">
                                    <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
                                </div>
                                */?>
                                 <div class="panel-ctrls">
                                    <div class="right">
                                        <div class="btn-group">
                                            <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('tahunajaran/data/deleteall') ?>">
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
                                    Berikut ini merupakan tabel yang berisikan data Tahun Ajaran. 
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
                                        'dataProvider' => $model->searchAcademicYear(),
                                        'filter' => $model,
                                        'selectableRows' => 2,
                                        'afterAjaxUpdate'=>$afterAjaxUpdate,
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
                                                'name' => 'nama_tahun_ajaran',
                                                'value' => 'ucwords($data->nama_tahun_ajaran)'
                                            ),
                                            array(
                                                'name' => 'tanggal_dimulai',
                                                'value' => ' Utility::getDateFormat($data->tanggal_dimulai, "/")'
                                            ),
                                            array(
                                                'class' => 'ButtonColumn',
                                                'template' => '{update} {delete}',
                                                "buttons" => array(
                                                    "update" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
//                                                        'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
                                                        'options' => array(
                                                            'class' => 'glyphicon glyphicon-pencil c-simple-update',
                                                            'data-url' => 'Yii::app()->createUrl("/tahunajaran/data/update/id/$data->id")',
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
                                                <h4 class="modal-title">Form Edit Tahun Ajaran</h4>
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