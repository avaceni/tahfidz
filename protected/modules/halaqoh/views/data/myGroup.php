<?php
/* @var $this ModContentController */
/* @var $model ModContent */
//
?>

<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
//            $this->widget('application.components.BreadCrumb', array(
//            'crumbs' => array(
//                array('name' => 'Home', 'url' => array('adminck/dashboard')),
//                array('name' => 'Halaqoh', 'url' => array('halaqoh/data')),
//                array('name' => 'Detail Halaqoh', 'url' => array('halaqoh/data/view', array('id'=>$model->id))),
//            ),
//        ));
        ?>
            <h1>Anggota Halaqoh<?php // echo $this->uniqueId . '/' . $this->action->id;                 ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">                                       
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Data Anggota Halaqoh</h2>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini merupakan tabel yang berisikan data Santri Halaqoh Anda.
                                    Tekan <b><i class="glyphicon glyphicon-file"></i></b> untuk menambah hafalan,
                                    <b><i class="glyphicon glyphicon-search"></i></b> untuk melihat profil santri.
                                </p>
                                <?php $grid = 'santri-group-member-grid' ?>                                                               
                                <div class="span-alert"> </div>
                                    <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin", "class" => $grid)); ?>
                                <div class="box-content">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => $grid,
                                        'dataProvider' => $model,
                                        'selectableRows' => 0,
                                        'summaryText' => 'Menampilkan data no {start} - {end} dari {count} data',
                                        'itemsCssClass' => 'table table-bordered table-condensed',
                                        'columns' => array(
                                            array(
                                                'header' => 'No',
                                                'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                                'htmlOptions' => array("width" => "31px", "text-align" => "center")
                                            ),
                                            array(
                                                'header' => 'Foto',
                                                'value' => 'CHtml::image(User::getPhotoIconUrl($data->user->id), $data->user->santri->nama_lengkap, array("class"=>"img-thumbnail"))',
                                                'type' => 'raw'
                                            ),
                                            array(
                                                'header' => 'Nama Lengkap',
                                                'value' => 'ucwords($data->user->full_name)'
                                            ),
                                            array(
                                                'header' => 'Panggilan',
                                                'value' => 'ucwords($data->user->santri->nama_panggilan)'
                                            ),
                                            array(
                                                'header' => 'TTL',
                                                'type' => 'raw',
                                                'value'=> function($data){
                                                    return "<div class=''>".ucfirst($data->user->santri->tempat_lahir).", "
                                                            .preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($data->user->santri->tanggal_lahir))."</div>";
                                                },
                                            ),
                                            array(
                                                'header' => 'Alamat',
                                                'value' => '$data->user->santri->alamat_keluarga_yogya'
                                            ),
                                            array(
                                                'header' => 'Asrama',
                                                'value' => 'ucwords($data->user->getPondokan())'
                                            ),
                                            array(
                                                'header' => 'Pendidikan',
                                                'value' => '$data->user->getSantriEducation()',
                                            ),
                                            
                                            array(
                                                'class' => 'CButtonColumn',
                                                'template' => '{recitation}{view}',
                                                "buttons" => array(
                                                    "recitation" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array('class' => 'glyphicon glyphicon-file', 'target' => "_blank"),
                                                        'url' => 'Yii::app()->createUrl("hafalan/data/view", array("id"=>$data->user_id))'
                                                    ),
                                                    "view" => array(
                                                        'label' => '',
                                                        "imageUrl" => "",
                                                        'options' => array('class' => 'glyphicon glyphicon-search', 'target' => "_blank"),
                                                        'url' => 'Yii::app()->createUrl("santri/data/view", array("id"=>$data->user_id))'                                                        
                                                    ),
//                                                    "update" => array(
//                                                        'label' => '',
//                                                        "imageUrl" => "",
//                                                        'options' => array('class' => 'glyphicon glyphicon-pencil'),
//                                                    ),
//                                                    "delete" => array(
//                                                        'label' => '',
//                                                        "imageUrl" => "",
//                                                        'options' => array('class' => 'glyphicon glyphicon glyphicon-trash'),
//                                                        'url' => 'Yii::app()->createUrl("halaqoh/data/deletemember", array("id"=>$data->id))'
//                                                    )
                                                )
                                            ),
//                                            array(
//                                                'class' => 'CCheckBoxColumn',
//                                                'id' => 'id'
//                                            ),
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