<?php
$afterAjaxUpdate = "function(id, data) {{}}";
?>
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
            <h1>Data Pengguna<?php // echo $this->uniqueId . '/' . $this->action->id;            ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-indigo">
                            <div class="panel-heading">
                                <h2>
                                    <ul class="nav nav-tabs">
                                        <li class="active c-tab" data-tab="hafalan-admin"><a>Admin</a></li>
                                        <li class="c-tab" data-tab="hafalan-ustadz"><a>Ustadz</a></li>
                                    </ul>
                                </h2>
                                <br>
                                <div class="c-data-tab c-panel-header" data-tab="hafalan-admin">
                                    <h2 class="ng-binding">Data User Admin</h2>
                                    <div class="panel-ctrls">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="btn-default btn" href="" data-toggle="modal" data-target="#add-admin-modal">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <?php $grid_admin = 'admin-list-grid' ?>
                                                <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid_admin ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('akun/data/deleteall') ?>">
                                                    <i class="glyphicon glyphicon-minus"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                                <div class="c-data-tab c-panel-header hide" data-tab="hafalan-ustadz">
                                    <h2 class="ng-binding">Data User Ustadz</h2>
                                    <div class="panel-ctrls">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="btn-default btn" href="" data-toggle="modal" data-target="#add-ustadz-modal">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <?php $grid_ustadz = 'ustadz-list-grid' ?>
                                                <a class="btn-default btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid_ustadz ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('akun/data/deleteall') ?>">
                                                    <i class="glyphicon glyphicon-minus"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="c-data-tab c-panel-body" data-tab="hafalan-admin">
                                    <div class="clear"></div>
                                    <p>
                                        Halaman ini menampilkan data akun admin yang tersimpan dalam sistem
                                        Rumah Tahfidzqu.
                                        Pada halaman ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                        data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                        tekan <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                            <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                    </p>
                                    <?php /*
                                    <div class="form-group">
                                        <?php
                                        echo CHtml::beginForm('#', 'POST', array("id" => "search-santri-santri", "data-grid" => $grid_santri));
                                        ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Santri" name="search-santri-santri" id="search-santri">
                                            <div class="input-group-btn c-santri-filter">
                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                        <?php echo CHtml::endForm(); ?>
                                    </div>
                                     * 
                                     */ ?>
                                    <div class="span-alert"> </div>
                                    <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid_admin)); ?>
                                    <div class="box-content">
                                        <?php
                                        if ($model_admin) {
                                            $this->widget('zii.widgets.grid.CGridView', array(
                                                'id' => $grid_admin,
                                                'dataProvider' => $model_admin,
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
                                                        'name' => 'full_name',
                                                        'value' => 'ucwords($data->full_name)',
                                                    ),
                                                    array(
                                                        'name' => 'username',
                                                        'value' => '$data->username',
                                                    ),
                                                    array(
                                                        'name' => 'email',
                                                        'value' => '$data->email',
                                                    ),
                                                    array(
                                                        'name' => 'phone_one',
                                                        'value' => '$data->phone_one',
                                                    ),
                                                    array(
                                                        'name' => 'is_active',
                                                        'type' => 'raw',
                                                        'value'=> function($data){
                                                            $is_active = "Tidak";
                                                            if($data->is_active == 1){$is_active = "Ya";}
                                                            return $is_active;
                                                        },
                                                    ),
                                                    array(
                                                        'class' => 'ButtonColumn',
                                                        'template' => '{update} {delete}',
                                                        "buttons" => array(
//                                                            "view" => array(
//                                                                'label' => '',
//                                                                "imageUrl" => "",
//                                                                'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
//                                                                'url' => 'Yii::app()->createUrl("akun/data/view", array("id"=>$data->id))'
//                                                            ),
                                                            "update" => array(
                                                                'label' => '',
                                                                "imageUrl" => "",
                                                                'options' => array(
                                                                    'class' => 'glyphicon glyphicon-pencil c-simple-update',
                                                                    'data-url' => 'Yii::app()->createUrl("/akun/data/update/id/$data->id")',
                                                                    'data-modal-id' => 'update-admin-modal',
                                                                ),
                                                            ),
                                                            "delete" => array(
                                                                'label' => '',
                                                                "imageUrl" => "",
                                                                'options' => array('class' => 'glyphicon glyphicon glyphicon-trash'),
                                                                'url' => 'Yii::app()->createUrl("akun/data/delete", array("id"=>$data->id))'
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
                                        Halaman ini menampilkan data akun ustadz yang tersimpan dalam sistem
                                        Rumah Tahfidzqu.
                                        Pada halaman ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                        data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                        tekan <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                            <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                    </p>
                                    <?php /*
                                    <div class="form-group">
                                        <?php
                                        echo CHtml::beginForm('#', 'POST', array("id" => "search-santri-ustadz", "data-grid" => $grid_ustadz));
                                        ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Santri" name="search-santri-ustadz" id="search-santri">
                                            <div class="input-group-btn c-santri-filter">
                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                        <?php echo CHtml::endForm(); ?>
                                    </div>
                                     */
                                    ?>
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
                                                'afterAjaxUpdate'=>$afterAjaxUpdate,
                                                'columns' => array(
                                                    array(
                                                        'header' => 'No',
                                                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                                        'htmlOptions' => array("width" => "31px", "text-align" => "center")
                                                    ),
                                                    array(
                                                        'name' => 'full_name',
                                                        'value' => 'ucwords($data->full_name)',
                                                    ),
                                                    array(
                                                        'name' => 'username',
                                                        'value' => '$data->username',
                                                    ),
                                                    array(
                                                        'name' => 'email',
                                                        'value' => '$data->email',
                                                    ),
                                                    array(
                                                        'name' => 'phone_one',
                                                        'value' => '$data->phone_one',
                                                    ),
                                                    array(
                                                        'name' => 'is_active',
                                                        'type' => 'raw',
                                                        'value'=> function($data){
                                                            $is_active = "Tidak";
                                                            if($data->is_active == 1){$is_active = "Ya";}
                                                            return $is_active;
                                                        },
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
                                                                    'data-url' => 'Yii::app()->createUrl("/akun/data/update/id/$data->id")',
                                                                    'data-modal-id' => 'update-ustadz-modal',
                                                                ),
                                                            ),
//                                                            "view" => array(
//                                                                'label' => '',
//                                                                "imageUrl" => "",
//                                                                'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
//                                                                'url' => 'Yii::app()->createUrl("akun/data/view", array("id"=>$data->id))'
//                                                            ),
                                                            "delete" => array(
                                                                'label' => '',
                                                                "imageUrl" => "",
                                                                'options' => array('class' => 'glyphicon glyphicon glyphicon-trash'),
                                                                'url' => 'Yii::app()->createUrl("akun/data/delete", array("id"=>$data->id))'
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
<div id="add-admin-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah Admin</h4>
            </div>
            <div class="modal-body">
                <?php
                $this->renderPartial('_addAdminDialogForm', array('model_add' => $model_admin_add, 'action' => 'addadmin'));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-admin-save" data-grid="<?php echo $grid_admin; ?>">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="add-ustadz-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah Ustadz</h4>
            </div>
            <div class="modal-body">
                <?php
                $this->renderPartial('_addUstadzDialogForm', array('model_add' => $model_ustadz_add, 'action' => 'addustadz'));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-recitation-save" data-grid="<?php echo $grid_ustadz ?>">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="update-admin-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Perbarui Admin</h4>
            </div>
            <div class="modal-body">
                <?php
                $this->renderPartial('_addAdminDialogForm', array('model_add' => $model_admin_add, 'action' => 'addadmin'));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary c-admin-save" data-grid="<?php echo $grid_admin; ?>">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="update-ustadz-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Perbarui Ustadz</h4>
            </div>
            <div class="modal-body">
                <?php
                $this->renderPartial('_addUstadzDialogForm', array('model_add' => $model_ustadz_add, 'action' => 'addustadz'));
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