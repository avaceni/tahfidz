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
$last_recitation = Santri::getLastRecitation($model->id);
?>

<div class="static-content">
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
        <?php
        $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
                array('name' => 'Santri', 'url' => array('santri/data/manage')),
                array('name' => 'Detail Santri', 'url' => array('santri/data/view',array('id'=>$model->id))),
            ),
        ));
        ?>
            <h1>Detail Santri<?php // echo $this->uniqueId . '/' . $this->action->id;             ?></h1>
            <div class="options">
                <div class="btn-group">
                   <?php $this->widget("application.components.widgets.NavigationMenu"); ?>
               </div>
            </div>
        </div>

        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    $this->widget("application.components.widgets.PanelUser", array(
                        'santri'=>$model,
                        'link'=> array(
                            'url'=>Yii::app()->createAbsoluteUrl('hafalan/data/view', array('id'=>$model->id)),
                            'title' => 'Lihat Hafalan'
                            )
                        )
                    );
                    ?>
                    <?php /*
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="clear"></div>
                            </div>
                            <div class="panel-body">
                                <div class="clear"></div>
                                <div class="col-sm-2 profile-image">
                                    <img class='img-circle' width='80px' src="<?php echo User::model()->getPhotoUrl($model->id) ?>" class="avatar" alt="avatar">
                                </div>
                                <div class="col-sm-10">
                                    <div class='form-group profile-head'>
                                        <div class="col-sm-3 control-label">
                                            <?php echo ucwords($model->nama_lengkap) ?>
                                        </div>
                                        <div class="col-sm-7 control-label">
                                            <?php echo!empty(Santri::getJuz($model->id)) ? floor(Santri::getJuz($model->id)) . " Juz" : "- Juz"; ?>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class="col-sm-3 control-label">
                                            <?php echo $model->user->getSantriEducation() . ', ' . Utility::calcutateAge($model->tanggal_lahir) ?> tahun
                                        </div>
                                        <div class="col-sm-2 control-label">
                                            Pembimbing
                                        </div>
                                        <div class="col-sm-5 control-label">
                                            <?php echo!empty($last_recitation) ? 'Ust. ' . ucwords($last_recitation['musyrif']) : '-'; ?>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class="col-sm-3 control-label">
                                            Asrama <?php echo ucwords($model->user->getPondokan()) ?>
                                        </div>
                                        <div class="col-sm-2 control-label">
                                            Hafalan sekarang
                                        </div>
                                        <div class="col-sm-5 control-label">
                                            <?php echo!empty($last_recitation) ? "Juz " . $last_recitation['juz'] . " Halaman " . $last_recitation['halaman'] : '-' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </panel>
                     */?>
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-bottom">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Detail Santri</h2>
                                <div class="panel-ctrls">
                                    <div class="right">
                                        <div class="btn-group">
                                            <a target="_blank" class="btn btn-primary" href="<?php echo Yii::app()->createUrl('santri/data/pdfpersonaldata', array('id'=>$model->id)) ?>">
                                                PDF
                                            </a>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                            <div class="panel-body c-combined-form">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini informasi Santri yang disajikan secara mendetail.
                                    Untuk memperbarui data santri, klik pada bagian
                                    kolom data yang ingin diperbarui selanjutnya
                                    isi dengan data baru. Setelah selesai memperbarui
                                    data, klik tombol simpan yang terletak di sebelah
                                    kanan kolom atau klik batal untuk membatalkan perubahan.
                                </p>
                                <div class="span-alert"> </div>
                                <ul class="nav nav-tabs">
                                    <li class="active c-step edit c-step-first" data-tab="data-diri"><a>Data Diri</a></li>
                                    <li class="c-step edit" data-tab="data-keluarga"><a>Keluarga</a></li>
                                    <li class="c-step edit" data-tab="data-pendidikan"><a>Pendidikan</a></li>
                                    <li class="c-step edit" data-tab="data-penyakit"><a>Riwayat Penyakit</a></li>
                                    <li class="c-step edit" data-tab="data-lain"><a>Lain-lain</a></li>
                                    <li class="c-step edit" data-tab="data-kelompok"><a>Riwayat Halaqoh</a></li>
                                </ul>
                                <?php echo $this->renderPartial('_Santri', array('model' => $model)); ?>
                                <?php echo $this->renderPartial('_SantriOrangtua', array('model' => $model_parent, 'hide' => 1)); ?>
                                <?php echo $this->renderPartial('_SantriRiwayatPendidikan', array('model' => $model_education, 'hide' => 1)); ?>
                                <?php echo $this->renderPartial('_SantriPenyakit', array('model' => $model_diseae, 'hide' => 1)); ?>
                                <?php echo $this->renderPartial('_SantriPrestasi', array('model' => $model_achievement, 'hide' => 1)); ?>
                                <?php echo $this->renderPartial('_RiwayatHalaqoh', array('model' => $model_group, 'hide' => 1)); ?>
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
<script type="text/html" id="data-keluarga">
    <h4 class="c-form-label">Orangtua <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-orangtua-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
            'data-model' => get_class($new_parent),
            'data-id' => '',
            )
    ));
    ?>

    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'nama'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'nama'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'tempat_lahir'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'tempat_lahir'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'tanggal_lahir'); ?></label>
        <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy">
            <input class="form-control" size="16" type="text" name="SantriOrangtua[tanggal_lahir]" id="SantriOrangtua_tanggal_lahir">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'agama'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'agama'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'no_telepon'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'no_telepon'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'pendidikan_id'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'pendidikan_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'pekerjaan'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'pekerjaan'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'penghasilan'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'penghasilan'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'alamat'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textArea($new_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'alamat'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_parent, 'hubungan_orangtua'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_parent, 'hubungan_orangtua'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>
<script type="text/html" id="data-pendidikan">
    <h4 class="c-form-label">Pendidikan <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-riwayat-pendidikan-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
            'data-model' => get_class($new_education),
            'data-id' => '',
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'jenjang_id'); ?></label>
        <div class="col-md-6">
            <?php echo CHtml::activeDropDownList($new_education, "jenjang_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'jenjang_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'nama_sekolah'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'nama_sekolah', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'nama_sekolah'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'tahun_masuk'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'tahun_masuk', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'tahun_masuk'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'tahun_lulus'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'tahun_lulus', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'tahun_lulus'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_education, 'nilai_rata_rata'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_education, 'nilai_rata_rata', array('size' => 7, 'maxlength' => 7, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_education, 'nilai_rata_rata'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>
<script type="text/html" id="data-penyakit">
    <h4 class="c-form-label">Penyakit <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-riwayat-penyakit-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
            'data-model' => get_class($new_diseae),
            'data-id' => '',
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_diseae, 'nama_penyakit'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_diseae, 'nama_penyakit', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_diseae, 'nama_penyakit'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_diseae, 'tahun'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_diseae, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_diseae, 'tahun'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?> 
</script>
<script type="text/html" id="data-lain">
    <h4 class="c-form-label">Prestasi <span id="c-multi-number">{{number}}</span> <a class="glyphicon glyphicon glyphicon-trash c-santri-delete" title="" href="#"></a></h4>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-achievement-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal c-new-form',
            'data-url-delete' => Yii::app()->createUrl('santri/data/deleteadditional'),
            'data-model' => get_class($new_achievement),
            'data-id' => '',
        )
    ));
    ?>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_achievement, 'prestasi'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_achievement, 'prestasi', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_achievement, 'prestasi'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_achievement, 'juara'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_achievement, 'juara', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_achievement, 'juara'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($new_achievement, 'tahun'); ?></label>
        <div class="col-md-6">
            <?php echo $form->textField($new_achievement, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
            <?php echo $form->error($new_achievement, 'tahun'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</script>