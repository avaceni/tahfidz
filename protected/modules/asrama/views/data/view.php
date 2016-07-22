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

            <ol class="breadcrumb">
                <li><a href="#/">Dashboard</a></li>
                <li>UI Elements</li>
                <li class="active">Buttons</li>
            </ol>

            <h1>Detail Asrama<?php // echo $this->uniqueId . '/' . $this->action->id;               ?></h1>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope"><div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Detail Asrama</h2>
                                <div class="panel-ctrls">
                                    <?php // $this->widget("application.components.widgets.NavigationMenu"); ?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini informasi Asrama yang disajikan secara mendetail.
                                    Untuk memperbarui data santri, klik pada bagian
                                    kolom data yang ingin diperbarui selanjutnya
                                    isi dengan data baru. Setelah selesai memperbarui
                                    data, klik tombol simpan yang terletak di sebelah
                                    kanan kolom atau klik batal untuk membatalkan perubahan.
                                </p>
                                <fieldset title="Lain-Lain" class="stepy-step" data-tab="data-lain">
                                    <legend>Asrama</legend>
                                    <div class="panel-ctrls" style="float:right">
                                        <div class="right">
                                            <div class="btn-group">
                                                <a class="button-white btn c-btn-edit" href="">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                    <span>Ubah</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-save" href="">
                                                    <i class="glyphicon glyphicon-save"></i>
                                                    <span>Simpan</span>
                                                </a>
                                                <a class="button-white btn hide c-btn-cancel" href="">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span>Batal</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (!empty($model)) {
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'santri-achievement-form',
                                            'enableAjaxValidation' => false,
                                            'htmlOptions' => array(
                                                'enctype' => 'multipart/form-data',
                                                'class' => 'form-horizontal'
                                            )
                                        ));
                                        ?>

                                        <div class="form-group">
                                            <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_pondok'); ?></label>
                                            <div class="col-md-6 c-detail-view">
                                                <a class="editable editable-click"><?php echo ucwords($model->nama_pondok) ?></a>
                                            </div>
                                            <div class="col-md-6 hide c-form-edit">
                                                <?php echo $form->textField($model, 'nama_pondok', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'nama_pondok'); ?>
                                            </div>
                                        </div>

                                        <?php
                                        $this->endWidget();
                                    }
                                    ?>
                                </fieldset>
                                <div class="span-alert"> </div>
                                <div class="stepy-errors"></div>
                                <!--</form>-->
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