<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
        $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Halaqoh', 'url' => array('halaqoh/data/manage')),
            ),
        ));
        ?>
            <h1>Data Halaqoh<?php // echo $this->uniqueId . '/' . $this->action->id;       ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-indigo panel-top">
                            <div class="panel-heading">
                                <div class="clear"></div>
                                <h2 class="ng-binding">Tambah Halaqoh</h2>
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
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'add-halaqoh-form',
                                        'enableAjaxValidation' => false,
                                        'method' => 'POST',
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data'
                                        ),
                                    ));
                                    ?>
                                    <div class="col-sm-3">
                                        <?php
                                        echo CHtml::activeTextField($model_add, 'nama_kelompok', array('class' => 'form-control', 'placeholder' => 'Nama Kelompok'));
                                        ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <?php
                                        echo CHtml::dropDownList('Kelompok[ustadz_id]', 'empty', User::getMusyrifList(), array('empty' => 'Ustadz', 'class' => 'form-control'));
                                        ?>                                    
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" checked='checked' name="Kelompok[aktif]" value="1">Aktif
                                    </div>
                                    <div class="col-sm-1">
                                        <?php
                                        echo CHtml::submitButton('Simpan', array('class' => 'btn btn-indigo'));
                                        ?>
                                    </div>                                    
                                    <?php
                                    $this->endWidget();
                                    ?>
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
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-bottom">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Data Halaqoh</h2>
                                <?php /*
                                <div class="panel-ctrls">
                                    <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
                                </div>
                                */?>
                                <div class="panel-ctrls">
                                    <div class="right">
                                        <div class="btn-group">
                                            <?php $grid = 'halaqoh-list-grid' ?>
                                            <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('halaqoh/data/deleteall') ?>">
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
                                    Berikut ini merupakan tabel yang berisikan data Halaqoh. 
                                    Pada panel ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                    data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                    tekan <b><i class="glyphicon glyphicon-pencil"></i></b> untuk edit data, tekan 
                                    <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                        <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                </p>
                                <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid)); ?>
                                <div class="box-content">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => $grid,
                                        'dataProvider' => $model->searchGroup(),
                                        'filter' => $model,
                                        'selectableRows' => 2,
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
                                                'name' => 'nama_kelompok',
                                                'value' => 'ucwords($data->nama_kelompok)'
                                            ),
                                            array(
                                                'name' => 'aktif',
                                                'type' => 'raw',
                                                'value'=> function($data){
                                                    $is_active = "Tidak";
                                                    if($data->aktif == 1){$is_active = "Ya";}
                                                    return $is_active;
                                                },
                                            ),
                                            array(
                                                'name' => 'riwayatRegistrasiUlangOne.pendidikan_id',
                                                'header' => 'Ustadz',
                                                'value' => '!empty($data->getUstadz($data->id))?ucwords($data->getUstadz($data->id)["nama"]):""',
                                            ),
                                            array(
                                                'class' => 'ButtonColumn',
                                                'template' => '{view} {delete}',
                                                "buttons" => array(
                                                    "view" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
                                                    ),
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