<?php
/* @var $this ModContentController */
/* @var $model ModContent */

$this->breadcrumbs = array(
    'Mod Contents' => array('manage'),
    'Create',
);
$ustadz = $model_detail->user->getUstadz();
$last_recitation = Santri::getLastRecitation($model_detail->id);
$user_type = 'santri';
if($model_detail->user->group_id == 12){
    $user_type = 'ustadz';
}
?>

<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
        $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Hafalan', 'url' => array('hafalan/data/manage')),
                array('name' => "Hafalan ".ucfirst($user_type), 'url' => array('hafalan/data/view', array('id'=>$model_detail->id))),
            ),
        ));
        ?>
            <h1>Hafalan <?php echo ucfirst($user_type); ?><?php // echo $this->uniqueId . '/' . $this->action->id;                  ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    $this->widget("application.components.widgets.PanelUser", array(
                        'santri'=>$model_detail,
                        'link'=> array(
                            'url'=>Yii::app()->createAbsoluteUrl("{$user_type}/data/view", array('id'=>$model_detail->id)),
                            'title' => 'Lihat Profile'
                            )
                        )
                    );
                    ?>
                    <?php
                    if((new Santri())->isMyStudent($model_detail->id, $this->halaqoh_member_list) ||
                        $this->cklt_user->group_id == 10){
                    ?>
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="clear"></div>
                                <h2 class="ng-binding">Tambah Hafalan</h2>
                            </div>
                            <div class="panel-body">
                                <?php $this->renderPartial('_addHafalanForm', array('santri' => $model_detail, 'model_add' => $model_add, 'ustadz' => $ustadz)); ?>
                            </div>
                        </div>
                    </panel>
                    <?php                        
                        }
                    ?>
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="clear"></div>
                                <h2 class="ng-binding">Mutabaah Tahfidz</h2>
                                <div class="panel-ctrls">
                                    <?php $grid = 'add-hafalan-grid' ?>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'show-hafalan-form',
                                        'action' => Yii::app()->createUrl('hafalan/data/showhafalan/', array()),
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => '',
                                            'data-grid' => $grid
                                        )
                                            ));
                                    ?>
                                    <div class="right">
                                        <div style="float:right;padding-left:10px;">
                                            <input class="btn btn-primary c-recitation-summary" data-url="<?php echo Yii::app()->createAbsoluteUrl('hafalan/data/getsummary', array('id'=>$model_detail->user->id)) ?>" data-modal-id="show-recitation-summary-modal" type="button" value="Ringkasan">
                                        </div>
                                        <div class="form-group c-recitation-filter-month" style="float:right;">
                                            <div class="input-right">
                                                <?php
                                                $month_list = Utility::getMonthList();
                                                $all_month = array('all' => '-- Semua --');
                                                $month_list = $all_month + $month_list;
                                                echo CHtml::dropDownList('bulan', $last_month_recite, $month_list, array('class'=>'form-control c-filter-recitation'));
                                                ?>
                                            </div>
                                            <div class="label-right">
                                                <?php
                                                echo CHtml::label('Bulan', 'bulan');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group c-recitation-filter-year" style="float:right; padding-right: 8px">
                                            <div class="input-right">
                                                <?php
//                                                end($year_sequence);
//                                                $last_year_sequence=key($year_sequence);
                                                echo CHtml::dropDownList('tahun', $last_year_recite, $year_sequence, array('class'=>'form-control c-filter-recitation'));
                                                ?>
                                            </div>
                                            <div class="label-right">
                                                <?php
                                                echo CHtml::label('Tahun', 'tahun');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $this->endWidget();
                                ?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php
                                if((new Santri())->isMyStudent($model_detail->id, $this->halaqoh_member_list) ||
                                    $this->cklt_user->group_id == 10){
                                ?>
                                <p>
                                    Panel ini menampilkan data hafalan <b><span style="font-size: 16px"><?php echo ucwords($model_detail->nama_lengkap) ?></span></b>
                                    yang tersimpan dalam sistem Rumah Tahfidzqu.
                                    Pada halaman ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                    data. Tekan <b><i class="glyphicon glyphicon-trash"></i></b> untuk menghapus data.
                                </p>
                                <div class="panel-ctrls">
                                    <div class="right">
                                        <div class="btn-group">
                                            <a class="button-white btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="add-hafalan-grid" data-url="http://localhost/tahfidz-web/hafalan/data/deleteall">
                                                <i class="glyphicon glyphicon-minus"></i>
                                                <span>Hapus</span>
                                            </a>
                                        </div>

                                    </div> 
                                </div>
                                <?php
                                    }
                                    else{
                                ?>
                                <p>
                                    Panel ini menampilkan data hafalan <b><span style="font-size: 16px"><?php echo ucwords($model_detail->nama_lengkap) ?></span></b>
                                    yang tersimpan dalam sistem Rumah Tahfidzqu.
                                </p>
                                <?php
                                    }
                                ?>
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
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Tanggal',
                                            'value' => 'date("d",strtotime($data->tanggal))',
                                        ),
                                        array(
                                            'header' => 'Bulan/Tahun',
                                            'value' => 'date("n/Y",strtotime($data->tanggal))',
                                        ),
                                        array(
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Waktu',
                                            'value' => 'date("H:i",strtotime($data->tanggal))',
                                        ),
                                        array(
                                            'name' => 'absensi',
                                            'value' => 'Utility::getAbsentType($data->absensi)',
                                        ),
                                        array(
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Tipe',
                                            'value' => 'Utility::getRecitationType($data->tipe)',
                                        ),
                                        array(
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Juz',
                                            'value' => function($data) {
                                                $juz = '';
                                                if(!empty($data->setoran_juz)){
                                                    if($data->setoran_juz < 0){
                                                        $juz = Utility::getFourSurahName($data->setoran_juz);
                                                    }
                                                    else{
                                                        $juz = $data->setoran_juz;
                                                    }
                                                }
                                                return $juz;
                                            },
                                        ),
                                        array(
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Halaman',
                                            'value' => '$data->setoran_halaman',
                                        ),
                                        array(
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Keterangan',
                                            'value' => '$data->keterangan',
                                        ),
                                        array(
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Nilai',
                                            'value' => '$data->nilai',
                                        ),
                                        array(
                                            'name' => 'user_santri.santri.nama_lengkap',
                                            'header' => 'Musrif',
                                            'value' => 'ucwords($data->user_ustadz->full_name)',
                                        ),
                                    );
                                    $checkbox_column = array(
                                        array(
                                            'class' => 'CCheckBoxColumn',
                                            'id' => 'id'
                                        ),
                                    );
                                    $button_column = array(
                                        array(
                                            'class' => 'ButtonColumn',
                                            'template' => '{delete}',
                                            "buttons" => array(
                                                "delete" => array(
                                                    'label' => '',
                                                    "imageUrl" => "",
                                                    'options' => array('class' => 'glyphicon glyphicon-trash', 'target' => "_blank"),
                                                ),
                                            )
                                        ),
                                    );
                                    if((new Santri())->isMyStudent($model_detail->id, $this->halaqoh_member_list) ||
                                            $this->cklt_user->group_id == 10){
                                        $selectableRows = 2;  
                                        $columns = array_merge($bassic_column,$button_column,$checkbox_column);
                                    }
                                    else{
                                        $selectableRows = 0;
                                        $columns = $bassic_column;
                                    }
                                    
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => $grid,
                                        'dataProvider' => $model,
                                        'selectableRows' => $selectableRows,
                                        'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
                                        'itemsCssClass' => 'table table-bordered table-condensed',
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
                            </div>
                            <div id="show-recitation-summary-modal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Ringkasan Hafalan</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $this->renderPartial('_summary', array(
                                                'model_detail' => $model_detail,
                                                'data' => $data,
                                                'year_sequence' => $year_sequence,
                                                'last_month_recite' => $last_month_recite,
                                                'last_year_recite' => $last_year_recite,
                                                'absent'=>$absent,
                                                )
                                            );
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
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