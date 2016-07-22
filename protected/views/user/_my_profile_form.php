<p>
    Berikut ini ditampilkan data profil anda. Anda dapat mengubah dan menyimpan
    data pribadi anda melalui fitur ubah.
</p>
<div class="container" id="crop-avatar">
<div class="text-center container" id="crop-avatar">
    <div class="col-md-3 col-md-offset-3 avatar-view c-image-upload" title="Ganti Foto">
        <img data-target="#avatar-modal" src="<?php echo User::model()->getPhotoUrl($model_user->id) ?>" class="avatar img-thumbnail c-make-pointer" height="<?php echo (105.44) . 'px' ?>" width="<?php echo (82.24) . 'px' ?>" alt="Avatar">
    </div>
    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form dont-validate" action="<?php echo Yii::app()->createAbsoluteUrl('santri/data/photoupload', array('id' => $model_user->id)) ?>" enctype="multipart/form-data" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Ganti Foto Profil</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input type="hidden" class="avatar-src" name="avatar_src">
                                <input type="hidden" class="avatar-data" name="avatar_data">
                                <label for="avatarInput">Local upload</label>
                                <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                            </div>
                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <div class="row avatar-btns">
                                <div class="col-md-9">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>
                                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
</div>
</div>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'my-profile-form',
    'action' => Yii::app()->createUrl('user/myprofile/', array()),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'form-horizontal',
        'ng-submit'=>'saveMyProfile()',
//        'ng-controller'=>"MainController",
    )
        ));
?>
<!--<div class="col-md-7 col-md-offset-5" title="" data-original-title="Foto">
    <img class="c-finded-santri-image" id="bindedImages" src="<?php ?>" class="avatar" height="105.44px" width="82.24px" alt="Avatar">
</div>
<div class="form-group">
    <label placeholder="Nama" for="fieldname" class="col-md-3 control-label">Nama</label>    
    <div class="col-md-6">
        <input type="text" class="form-control c-search-<?php ?>" name="search-santri" id="santri_id">
    </div>
</div>-->
<?php
echo $form->hiddenField($model_user, 'id', array('ng-model' => 'myProfileData.id','keep-current-value' => ''));
?>
<div class="form-group" ng-class="myProfileData.hasError.full_name">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_user, 'full_name'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_user, 'full_name', array('class' => 'form-control', 'ng-model' => 'myProfileData.full_name', 'keep-current-value' => '', 'no-dirty-check' => ''));
        ?>
        <span class='c-error-field' ng-bind="myProfileData.errors.full_name"></span>
    </div>
    <!--<div ng-bind="myProfileData.full_name"></div>-->
</div>
<div class="form-group" ng-class="myProfileData.hasError.username">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_user, 'username'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_user, 'username', array('class' => 'form-control','ng-model' => 'myProfileData.username', 'keep-current-value' => '', 'no-dirty-check' => ''));
        ?>
        <span class='c-error-field' ng-bind="myProfileData.errors.username"></span>
    </div>
</div>
<div class="form-group" ng-class="myProfileData.hasError.email">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_user, 'email'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_user, 'email', array('class' => 'form-control','ng-model' => 'myProfileData.email', 'keep-current-value' => '', 'no-dirty-check' => ''));
        ?>
        <span class='c-error-field' ng-bind="myProfileData.errors.email"></span>
    </div>
</div>
<div class="form-group">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_user, 'phone_one'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->textField($model_user, 'phone_one', array('class' => 'form-control','ng-model' => 'myProfileData.phone_one', 'keep-current-value' => '', 'no-dirty-check' => ''));
        ?>
        <span class='c-error-field' ng-bind="myProfileData.errors.phone_one"></span>
    </div>
</div>
<?php
//echo CHtml::submitButton('Simpan', array());
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