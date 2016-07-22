<div class="static-content"> 
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
        $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Hafalan', 'url' => array('hafalan/data/manage')),
            ),
        ));
        ?>
            <h1>Data Hafalan<?php // echo $this->uniqueId . '/' . $this->action->id;            ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-indigo">
                            <div class="panel-heading">
                                <h2>
                                    <ul class="nav nav-tabs">
                                        <li class="active c-tab" data-tab="hafalan-santri"><a>Santri</a></li>
                                        <li class="c-tab" data-tab="hafalan-ustadz"><a>Ustadz</a></li>
                                    </ul>
                                </h2>
                                <br>
                                <div class="c-data-tab c-panel-header" data-tab="hafalan-santri">
                                    <h2 class="ng-binding">Data Hafalan Santri</h2>
                                    <div class="panel-ctrls">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="btn-default btn" href="" data-toggle="modal" data-target="#recitation-modal-santri">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <?php $grid_santri = 'santri-list-grid' ?>
                                                <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid_santri ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('hafalan/data/deleteall') ?>">
                                                    <i class="glyphicon glyphicon-minus"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                                <div class="c-data-tab c-panel-header hide" data-tab="hafalan-ustadz">
                                    <h2 class="ng-binding">Data Hafalan Ustadz</h2>
                                    <div class="panel-ctrls">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="btn-default btn" href="" data-toggle="modal" data-target="#recitation-modal-ustadz">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <?php $grid_ustadz = 'ustadz-list-grid' ?>
                                                <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid_ustadz ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('hafalan/data/deleteall') ?>">
                                                    <i class="glyphicon glyphicon-minus"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="c-data-tab c-panel-body" data-tab="hafalan-santri">
                                    <div class="clear"></div>
                                    <p>
                                        Halaman ini menampilkan data hafalan santri yang tersimpan dalam sistem
                                        Rumah Tahfidzqu.
                                        Pada halaman ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                        data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                        tekan <b><i class="glyphicon glyphicon-pencil"></i></b> untuk edit data, tekan 
                                        <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                            <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                    </p>
                                    <div class="form-group">
                                        <?php
                                        echo CHtml::beginForm('#', 'POST', array("id" => "search-santri-santri", "data-grid" => $grid_santri));
                                        ?>
                                        <div class="col-sm-2">
                                            <?php
                                            echo CHtml::dropDownList('pondok-santri', 'empty', Pondokan::getPondokanList(), array('empty' => '-- Asrama --', 'class' => 'form-control c-santri-filter', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            ?>
                                        </div>
                                        <div class="btn-group col-sm-3" style="width:195px">
                                            <?php
                                            echo CHtml::button('Semua', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            echo CHtml::button('Putra', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '1', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            echo CHtml::button('Putri', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '2', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            echo CHtml::hiddenField('gender-santri', '');
                                            ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php
                                            echo CHtml::dropDownList('bulan', $last_month_recite_santri, Utility::getMonthList(), array('class' => 'form-control c-santri-filter', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php
                                            echo CHtml::dropDownList('tahun', $last_year_recite_santri, $year_sequence_santri, array('class' => 'form-control c-santri-filter', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            ?>
                                        </div>
                                        <div class="btn-group col-sm-1">
                                            <a target="_blank" class="btn btn-primary c-btn-pdf" href="<?php echo Yii::app()->createUrl('hafalan/data/pdfallsantri') ?>">
                                                PDF
                                            </a>
                                        </div>
                                        <?php
//                                    echo CHtml::beginForm('#', 'POST', array("id" => "search-santri"));
                                        ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Santri" name="search-santri-santri" id="search-santri">
                                            <div class="input-group-btn c-santri-filter">
                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                        <?php echo CHtml::endForm(); ?>
                                    </div>
                                    <div class="span-alert"> </div>
                                    <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid_santri)); ?>
                                    <div class="box-content">
                                        <?php
                                        if ($model_santri) {
                                            $this->widget('zii.widgets.grid.CGridView', array(
                                                'id' => $grid_santri,
                                                'dataProvider' => $model_santri,
                                                'selectableRows' => 2,
                                                'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
                                                'itemsCssClass' => 'table table-bordered table-condensed',
                                                'columns' => array(
                                                    array(
                                                        'header' => 'No',
                                                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                                        'htmlOptions' => array("width" => "31px", "text-align" => "center")
                                                    ),
                                                    array(
                                                        'name' => 'user_santri.santri.nama_lengkap',
                                                        'header' => 'Nama',
                                                        'value' => 'ucwords($data->user_santri->santri->nama_lengkap)',
                                                    ),
                                                    array(
                                                        'name' => 'user_santri.santri.jenis_kelamin',
                                                        'header' => 'Asrama',
                                                        'value' => 'ucwords($data->user_santri->getPondokan())',
                                                    ),
                                                    array(
                                                        'name' => 'user_santri.santri.jenis_kelamin',
                                                        'header' => 'Jenis Kelamin',
                                                        'value' => 'ucfirst(Utility::getGender($data->user_santri->santri->jenis_kelamin))',
                                                    ),
//                                                    array(
//                                                        'name' => 'user_santri.santri.pendidikan_id',
//                                                        'header' => 'Pendidikan',
//                                                        'value' => '$data->user_santri->getSantriEducation()',
//                                                    ),
                                                    array(
                                                        'name' => 'absensi',
                                                        'value' => 'Utility::getAbsentType($data->absensi)',
                                                    ),
                                                    array(
                                                        'name' => 'tipe',
                                                        'header' => 'Hafalan',
                                                        'value' => 'Utility::getRecitationType($data->tipe)',
                                                    ),
                                                    array(
                                                        'name' => 'musyrif',
                                                        'header' => 'Musyrif',
                                                        'value' => 'ucwords($data->user_ustadz->full_name)',
                                                    ),
                                                    array(
                                                        'name' => 'tanggal',
                                                        'header' => 'Tanggal',
                                                        'value' => 'Utility::getDateFormat2($data->tanggal)',
                                                    ),
                                                    array(
                                                        'name' => 'waktu',
                                                        'header' => 'Waktu',
                                                        'value' => 'date("H:i", strtotime($data->tanggal))',
                                                    ),
                                                    array(
                                                        'class' => 'CButtonColumn',
                                                        'template' => '{view} {delete}',
                                                        "buttons" => array(
                                                            "view" => array(
                                                                'label' => '',
                                                                "imageUrl" => "",
                                                                'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
                                                                'url' => 'Yii::app()->createUrl("hafalan/data/view", array("id"=>$data->santri_id))'
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
                                                                'url' => 'Yii::app()->createUrl("hafalan/data/delete", array("id"=>$data->id))'
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
                                    <?php echo CHtml::endForm(); ?>
                                </div>
                                <div class="c-data-tab hide c-panel-body" data-tab="hafalan-ustadz">
                                    <div class="clear"></div>
                                    <p>
                                        Halaman ini menampilkan data hafalan ustadz yang tersimpan dalam sistem
                                        Rumah Tahfidzqu.
                                        Pada halaman ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                        data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                        tekan <b><i class="glyphicon glyphicon-pencil"></i></b> untuk edit data, tekan 
                                        <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                            <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                    </p>
                                    <div class="form-group">
                                        <?php
                                        echo CHtml::beginForm('#', 'POST', array("id" => "search-santri-ustadz", "data-grid" => $grid_ustadz));
                                        ?>
                                        <div class="col-sm-2">
                                            <?php
                                            echo CHtml::dropDownList('pondok-ustadz', 'empty', Pondokan::getPondokanList(), array('empty' => '-- Asrama --', 'class' => 'form-control c-santri-filter', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            ?>
                                        </div>
                                        <div class="btn-group col-sm-3">
                                            <?php
                                            echo CHtml::button('Semua', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            echo CHtml::button('Putra', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '1', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            echo CHtml::button('Putri', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '2', 'data-url' => Yii::app()->createUrl('hafalan/data/')));
                                            echo CHtml::hiddenField('gender-ustadz', '');
                                            ?>
                                        </div>
                                        <?php
//                                    echo CHtml::beginForm('#', 'POST', array("id" => "search-santri"));
                                        ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Santri" name="search-santri-ustadz" id="search-santri">
                                            <div class="input-group-btn c-santri-filter">
                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                        <?php echo CHtml::endForm(); ?>
                                    </div>
                                    <div class="span-alert"> </div>
                                    <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid_ustadz)); ?>
                                    <div class="box-content">
                                        <?php
                                        if ($model_ustadz) {
                                            $this->widget('zii.widgets.grid.CGridView', array(
                                                'id' => $grid_ustadz,
                                                'dataProvider' => $model_ustadz,
                                                'selectableRows' => 2,
                                                'itemsCssClass' => 'table table-bordered table-condensed',
                                                'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
                                                'columns' => array(
                                                    array(
                                                        'header' => 'No',
                                                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                                        'htmlOptions' => array("width" => "31px", "text-align" => "center")
                                                    ),
                                                    array(
                                                        'header' => 'Nama',
                                                        'value' => 'ucwords($data->user_santri->santri->nama_lengkap)',
                                                    ),
                                                    array(
                                                        'header' => 'Asrama',
                                                        'value' => 'ucwords($data->user_santri->getPondokan())',
                                                    ),
                                                    array(
                                                        'header' => 'Jenis Kelamin',
                                                        'value' => 'ucfirst(Utility::getGender($data->user_santri->santri->jenis_kelamin))',
                                                    ),
//                                                    array(
//                                                        'header' => 'Pendidikan',
//                                                        'value' => '$data->user_santri->getSantriEducation()',
//                                                    ),
                                                    array(
                                                        'name' => 'absensi',
                                                        'value' => 'Utility::getAbsentType($data->absensi)',
                                                    ),
                                                    array(
                                                        'name' => 'tipe',
                                                        'header' => 'Hafalan',
                                                        'value' => 'Utility::getRecitationType($data->tipe)',
                                                    ),
                                                    array(
                                                        'name' => 'musyrif',
                                                        'header' => 'Musyrif',
                                                        'value' => 'ucwords($data->user_ustadz->full_name)',
                                                    ),
                                                    array(
                                                        'name' => 'tanggal',
                                                        'header' => 'Tanggal',
                                                        'value' => 'Utility::getDateFormat2($data->tanggal)',
                                                    ),
                                                    array(
                                                        'name' => 'waktu',
                                                        'header' => 'Waktu',
                                                        'value' => 'date("H:i", strtotime($data->tanggal))',
                                                    ),
                                                    array(
                                                        'class' => 'CButtonColumn',
                                                        'template' => '{view} {delete}',
                                                        "buttons" => array(
                                                            "view" => array(
                                                                'label' => '',
                                                                "imageUrl" => "",
                                                                'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
                                                                'url' => 'Yii::app()->createUrl("hafalan/data/view", array("id"=>$data->santri_id))'
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
                                                                'url' => 'Yii::app()->createUrl("hafalan/data/delete", array("id"=>$data->id))'
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
                                    <?php echo CHtml::endForm(); ?>
                                </div>
                            </div>
                        </div>
                    </panel>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!--wrap -->
</div>
<div id="recitation-modal-santri" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah Hafalan</h4>
            </div>
            <div class="modal-body">
                <?php
                $this->renderPartial('_addHafalanDialogForm', array('model_add' => $model_add, 'group' => 'santri'));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-recitation-save" data-grid="<?php echo $grid_santri; ?>">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="recitation-modal-ustadz" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah Hafalan</h4>
            </div>
            <div class="modal-body">
                <?php
                $this->renderPartial('_addHafalanDialogForm', array('model_add' => $model_add, 'group' => 'ustadz'));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-recitation-save" data-grid="<?php echo $grid_ustadz ?>">Simpan</button>
            </div>
        </div>
    </div>
</div>
<footer role="contentinfo" ng-show="!layoutLoading" class="">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li>SPOTKY © <?php echo date('Y', time()) ?></li>
        </ul>
        <button class="pull-right btn btn-default btn-sm hidden-print" back-to-top="" style="padding: 1px 10px;"><i class="fa fa-angle-up"></i></button>
    </div>
</footer>