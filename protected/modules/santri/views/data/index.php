<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/admin/core.js',CClientScript::POS_READY);
//Yii::app()->clientScript->registerScript('initLikeButtons',<<<JS
//    $(".c-santri-register").on("click", function () {alert("post-ready")});
//JS
//, CClientScript::POS_END);
//$coreScript = file_get_contents(Yii::getPathOfAlias("webroot.js.admin") . '/core.js');
$afterAjaxUpdate = "function(id, data) {
        $('.c-santri-register').on('click', function() {
        var action = $(this).attr('data-url');
        var registerModal = $(document).find('#register-modal');
        $.ajax({
            type: 'GET',
            url: action,
            success: function(data) {
                registerModal.find('.modal-body').html(data);
                $('#register-modal').modal('show');
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });
        }";
?>

<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
            <?php
            $this->widget('application.components.BreadCrumb', array(
                'crumbs' => array(
                    array('name' => 'Home', 'url' => array('adminck/dashboard')),
                    array('name' => 'Santri', 'url' => array('santri/data/manage')),
                ),
            ));
            ?>
            <h1>Data Santri<?php // echo $this->uniqueId . '/' . $this->action->id;          ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-indigo panel-single">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Manajemen Data Santri</h2>
                                <?php
                                $grid = 'santri-list-grid';
                                ?>
                                <?php
                                if ($this->cklt_user->group_id == 10) {
                                    ?>
                                    <div class="panel-ctrls">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="btn-default btn" href="<?php echo Yii::app()->createUrl('santri/data/create') ?>">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Tambah</span>
                                                </a>
                                                <a class="button-white btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('santri/data/deleteall') ?>">
                                                    <i class="glyphicon glyphicon-minus"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </div>
                                        </div>                                
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini merupakan tabel yang berisikan data Santri. 
                                    Pada halaman ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                    data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                    tekan <b><i class="glyphicon glyphicon-pencil"></i></b> untuk edit data, tekan 
                                    <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                        <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                </p>                                
                                <div class="form-group">
                                    <?php
                                    echo CHtml::beginForm('#', 'POST', array("id" => "search-santri", "data-grid" => $grid));
                                    ?>
                                    <div class="col-sm-2">
                                        <?php
                                        echo CHtml::dropDownList('pondok', 'empty', Pondokan::getPondokanList(), array('empty' => 'Asrama', 'class' => 'form-control c-santri-filter', 'data-url' => Yii::app()->createUrl('santri/data/')));
                                        ?>
                                    </div>
                                    <div class="btn-group col-sm-3">
                                        <?php
                                        echo CHtml::button('Semua', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '', 'data-url' => Yii::app()->createUrl('santri/data/')));
                                        echo CHtml::button('Putra', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '1', 'data-url' => Yii::app()->createUrl('santri/data/')));
                                        echo CHtml::button('Putri', array('class' => 'btn btn-default c-gender-filter', 'data-id' => '2', 'data-url' => Yii::app()->createUrl('santri/data/')));
                                        echo CHtml::hiddenField('gender', '');
                                        ?>
                                    </div>
                                    <?php
//                                    echo CHtml::beginForm('#', 'POST', array("id" => "search-santri"));
                                    ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Santri" name="search-santri" id="search-santri">
                                        <div class="input-group-btn c-santri-filter">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                    <?php echo CHtml::endForm(); ?>
                                </div>
                                <div class="c-filter-info-panel">
                                    <div class="col-md-2 ng-scope">
                                        <a class="shortcut-tiles tiles-orange" ng-href="" data="item">
                                            <div class="tiles-body">
                                                <div class="pull-left"><i class="fa fa-male" id="c-filter-count-putra"> <?php echo $count_filter['count_putra'] ?> </i></div>
                                                <div class="pull-right hide"><span class="badge ng-binding">7</span></div>
                                            </div>
                                            <div class="tiles-footer ng-binding">
                                                Putra
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-1 ng-scope">
                                        <div class="glyphicon glyphicon-plus" style="font-size:30px; padding:15px 0 0 12px;"></div>
                                    </div><div class="col-md-2 ng-scope">
                                        <a class="shortcut-tiles tiles-purple" ng-href="" data="item">
                                            <div class="tiles-body">
                                                <div class="pull-left"><i class="fa fa-female" id="c-filter-count-putri"> <?php echo $count_filter['count_putri'] ?> </i></div>
                                                <div class="hide pull-right"><span class="badge ng-binding">15</span></div>
                                            </div>
                                            <div class="tiles-footer ng-binding">
                                                Putri
                                            </div>
                                        </a>
                                    </div><div class="col-md-1 ng-scope">
                                        <div class="glyphicon glyphicon-arrow-right" style="font-size:30px; padding:15px 0 0 12px;"></div>
                                    </div>
                                    <div class="col-md-3 ng-scope">
                                        <a class="shortcut-tiles tiles-indigo" ng-href="" data="item">
                                            <div class="tiles-body">
                                                <div class="pull-left"><i class="fa fa-group c-filter-count-total"> <?php echo $count_filter['count_putri'] + $count_filter['count_putra'] ?> </i></div>
                                                <div class="pull-right"><span class="hide badge ng-binding">15</span></div>
                                            </div>
                                            <div class="tiles-footer ng-binding">
                                                Santri
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 ng-scope">
                                        <a class="shortcut-tiles tiles-success" ng-href="" data="item">
                                            <div class="tiles-body">
                                                <div class="pull-left">
                                                    <i class="fa fa-home"> Total</i>
                                                </div>
                                                <div class="pull-right"><span class="badge ng-binding c-filter-count-total"><?php echo $count_filter['count_putri'] + $count_filter['count_putra'] ?></span></div>
                                            </div>
                                            <div class="tiles-footer ng-binding">
                                                di <span id="c-filter-quarters-name"><?php echo $count_filter['quarters_name'] ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid)); ?>
                                <div class="box-content">
                                    <?php
                                    $bassic_column = array(
                                        array(
                                            'header' => 'No',
                                            'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                            'htmlOptions' => array("width" => "31px", "text-align" => "center")
                                        ),
                                        array(
                                            'name' => 'nama_lengkap',
                                            'value' => 'ucwords($data->nama_lengkap)'
                                        ),
                                        array(
                                            'name' => 'jenis_kelamin',
                                            'value' => '$data->jenis_kelamin==1?"putra":"putri"'
                                        ),
                                        array(
                                            'header' => 'Asrama',
                                            'value' => 'ucwords($data->user->getPondokan())'
                                        ),
                                        array(
                                            'header' => 'Pendidikan',
                                            'value' => '$data->user->getSantriEducation()',
                                        ),
//                                            array(
//                                                'name' => 'riwayatRegistrasiUlangOne.pendidikan_id',
//                                                'header' => 'Jenjang',
//                                                'value' => '!empty($data->user->riwayatRegistrasiUlangOne)?Utility::getSantriEducation($data->user->riwayatRegistrasiUlangOne->pendidikan_id):""',
//                                            ),
                                        array(
                                            'name' => 'riwayatRegistrasiUlangOne.pendidikan_id',
                                            'header' => 'Registrasi',
                                            'value' => 'Utility::getReregistrationStatus(User::getRegistrationStatus($data->user->id))',
//                                                'class'=>'CLinkColumn',
//                                                'label'=>'id',
//                                                'urlExpression'=>'"users/view&id=".$data->id',
//                                                'header' => 'Registrasi',
                                        ),
                                    );
                                    $checkbox_column = array(
                                        array(
                                            'class' => 'CCheckBoxColumn',
                                            'id' => 'id'
                                        ),
                                    );
                                    if ($this->cklt_user->group_id == 10) {
                                        $selectableRows = 2;
                                        $button_column = array(
                                            array(
                                                'class' => 'ButtonColumn',
                                                'template' => '{register} {view} {delete}',
                                                "buttons" => array(
                                                    "register" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array(
                                                            'class' => 'glyphicon glyphicon-credit-card c-santri-register',
                                                            'data-url' => 'Yii::app()->createUrl("/santri/data/registration/id/$data->id")',
                                                        //                                                            'data-toggle' => 'modal',
                                                        //                                                            'data-target' => '#register-modal',
                                                        //                                                            'onclick' => 'alert("")',
                                                        ),
                                                    ),
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
                                        );
                                        $columns = array_merge($bassic_column, $button_column, $checkbox_column);
                                    } else {
                                        $selectableRows = 0;
                                        $button_column = array(
                                            array(
                                                'class' => 'ButtonColumn',
                                                'template' => '{view}',
                                                "buttons" => array(
                                                    "view" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
                                                    ),
                                                )
                                            ),
                                        );
                                        $columns = array_merge($bassic_column, $button_column);
                                    }

                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => $grid,
                                        'dataProvider' => $model,
//                                        'filter' => $model,
                                        'selectableRows' => $selectableRows,
//                                        'filter' => null,
                                        'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
                                        'itemsCssClass' => 'table table-bordered table-condensed',
                                        'afterAjaxUpdate' => $afterAjaxUpdate,
                                        'columns' => $columns,
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
                                <div id="register-modal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Form Registrasi Santri</h4>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary c-registration-save">Simpan</button>
                                            </div>
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
            <li>SPOTKY � <?php echo date('Y', time()) ?></li>
        </ul>
        <button class="pull-right btn btn-default btn-sm hidden-print" back-to-top="" style="padding: 1px 10px;"><i class="fa fa-angle-up"></i></button>
    </div>
</footer>