<?php
/* @var $this ModContentController */
/* @var $model ModContent */

$this->breadcrumbs = array(
    'Mod Contents' => array('manage'),
    'Create',
);

$triger_last_step = <<<EOF
    var santriStep = sessionStorage.getItem("c-santri-step");
    if(santriStep){
        $(document).find(".c-step[data-tab='"+ santriStep +"']").trigger( "click" );;
    }
EOF;

Yii::app()->clientScript->registerScript('trigger_last_step', $triger_last_step);
//
?>

<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
            $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Halaqoh', 'url' => array('halaqoh/data/manage')),
                array('name' => 'Detail Halaqoh', 'url' => array('halaqoh/data/view', array('id'=>$model->id))),
            ),
        ));
        ?>
            <h1>Detail Halaqoh<?php // echo $this->uniqueId . '/' . $this->action->id;                 ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Detail Halaqoh</h2>
                                <div class="panel-ctrls">
                                    <?php // $this->widget("application.components.widgets.NavigationMenu"); ?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini informasi Halaqoh yang disajikan secara mendetail.
                                    Untuk memperbarui data santri, klik pada bagian
                                    kolom data yang ingin diperbarui selanjutnya
                                    isi dengan data baru. Setelah selesai memperbarui
                                    data, klik tombol simpan yang terletak di sebelah
                                    kanan kolom atau klik batal untuk membatalkan perubahan.
                                </p>
                                <fieldset title="Lain-Lain" class="stepy-step" data-tab="data-lain">
                                    <legend>Halaqoh</legend>
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <!--<a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>-->
                                                <a class="button-white btn c-btn-save c-halaqoh-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <!--<a class="button-white btn c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (!empty($model)) {
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'group-update-form',
                                            'enableAjaxValidation' => false,
                                            'htmlOptions' => array(
                                                'enctype' => 'multipart/form-data',
                                                'class' => 'form-horizontal'
                                            )
                                        ));
                                        ?>
                                        <?php
                                        echo $form->hiddenField($model, 'id');
                                        ?>
                                        <div class="form-group">
                                            <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_kelompok'); ?></label>
                                            <div class="col-md-6 hide c-detail-view">
                                                <a class="editable editable-click"><?php echo ucwords($model->nama_kelompok) ?></a>
                                            </div>
                                            <div class="col-md-6 c-form-edit">
                                                <?php
                                                echo CHtml::activeTextField($model, 'nama_kelompok', array('class' => 'form-control', 'placeholder' => 'Nama Kelompok'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'aktif'); ?></label>
                                            <div class="col-md-6 hide c-detail-view">
                                                <a class="editable editable-click"><?php echo $model->aktif == 1 ? 'Ya' : 'Tidak' ?></a>
                                            </div>
                                            <div class="col-md-6 c-form-edit">
                                                <input type="checkbox" <?php if ($model->aktif == 1) {
                                                echo "checked='checked'";
                                            } ?> name="Kelompok[aktif]" value="1">Aktif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fieldname" class="col-md-3 control-label"><?php echo CHtml::label('Ustadz', 'ustadz'); ?></label>
                                            <div class="col-md-6 hide c-detail-view">
                                                <a class="editable editable-click"><?php echo!empty((new Kelompok())->getUstadz($model->id)) ? ucwords((new Kelompok())->getUstadz($model->id)['nama']) : '' ?></a>
                                            </div>
                                            <div class="col-md-6 c-form-edit">
                                                <?php
                                                $ustadz = $model->getUstadz($model->id);
                                                $ustadz_id = !empty($ustadz)?$ustadz['id']:'empty';
                                                echo CHtml::dropDownList('Kelompok[ustadz_id]', $ustadz_id, User::getMusyrifList(), array('empty' => 'Ustadz', 'class' => 'form-control'));
                                                ?>                                    
                                            </div>
                                        </div>

                                        <?php
                                        $this->endWidget();
                                    }
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
                                </fieldset>
                                <div class="span-alert"> </div>
                                <div class="stepy-errors"></div>
                                <!--</form>-->
                            </div>                            
                        </div>
                    </panel>

                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="clear"></div>
                                <h2 class="ng-binding">Tambah Anggota Halaqoh</h2>
                            </div>
                            <div class="panel-body">
                                <p>
                                    Untuk menambahkan anggota halaqoh, isi form yang telah disediakan pada panel
                                    ini kemudian klik simpan.
                                    <br>
                                    Hasil inputan data baru akan ditampiklan pada 
                                    tabel halaqoh di bawah.
                                    </br>
                                </p>
                                <div class="form-group">
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'add-santri-halaqoh-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data'
                                        )
                                    ));
                                    ?>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <?php
                                                echo $form->hiddenField($model_add_santri_halaqoh, 'kelompok', array('value' => $model->id));
                                                echo $form->hiddenField($model_add_santri_halaqoh, 'user_id', array('value' => '', 'id' => 'bindedTypeaheadsantri'));
                                            ?>
                                            <div style="padding-top:13px;">
                                            <input type="text" class="form-control c-search-santri" name="search-santri" placeholder="Cari Santri" id="santri_id">
                                            </div>
                                            <!--<input type="text" class="form-control" placeholder="Cari Santri" name="srch-term" id="srch-term">-->
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-floppy-save"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $this->endWidget();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </panel>

                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Data Anggota Halaqoh</h2>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini merupakan tabel yang berisikan data Santri Halaqoh <?php $model->nama_kelompok ?>. 
                                    Pada panel ini anda diperbolehkan melakukan modifikasi (create, update, delete) 
                                    data. Tekan <b><i class="glyphicon glyphicon-plus"></i></b> untuk menambah data, 
                                    tekan <b><i class="glyphicon glyphicon-pencil"></i></b> untuk edit data, tekan 
                                    <b><i class="glyphicon glyphicon-minus"></i></b> untuk hapus data, tekan <b>
                                        <i class="glyphicon glyphicon-search"></i></b> untuk melihat detail.
                                </p>
                                <div class="panel-ctrls">
                                    <div class="right">
                                        <div class="btn-group">
                                            <?php $grid = 'santri-group-member-grid' ?>
                                            <a class="button-white btn c-grid-deleteall" url="" href="javascript:void(0);" data-grid="<?php echo $grid ?>" data-url="<?php echo Yii::app()->createAbsoluteUrl('halaqoh/data/deletememberall') ?>">
                                                <i class="glyphicon glyphicon-minus"></i>
                                                <span>Hapus</span>
                                            </a>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="span-alert"> </div>
                                    <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid)); ?>
                                <div class="box-content">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => $grid,
                                        'dataProvider' => $model_member,
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
                                                'header' => 'Santri',
                                                'value' => 'ucwords($data->user->full_name)'
                                            ),
                                            array(
                                                'class' => 'CButtonColumn',
                                                'template' => '{delete}',
                                                "buttons" => array(
//                                                    "view" => array(
//                                                        'label' => '',
//                                                        "imageUrl" => "",
//                                                        'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
//                                                    ),
//                                                    "update" => array(
//                                                        'label' => '',
//                                                        "imageUrl" => "",
//                                                        'options' => array('class' => 'glyphicon glyphicon-pencil'),
//                                                    ),
                                                    "delete" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array('class' => 'glyphicon glyphicon glyphicon-trash'),
                                                        'url' => 'Yii::app()->createUrl("halaqoh/data/deletemember", array("id"=>$data->id))'
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