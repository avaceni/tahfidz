<p>
    Untuk mengganti password, masukkan password lama dan baru anda.
</p>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'my-profile-form',
    'action' => Yii::app()->createUrl('user/myprofile/', array()),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'form-horizontal',
        'ng-submit'=>'saveMyPassword()',
//        'ng-controller'=>"MainController",
    )
        ));
?>
<?php
echo $form->hiddenField($model_user, 'id', array('ng-model' => 'myPasswordData.id','keep-current-value' => ''));
?>
<div class="form-group" ng-class="myPasswordData.hasError.oldPassword">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_user, 'oldPassword'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->passwordField($model_user, 'oldPassword', array('class' => 'form-control', 'ng-model' => 'myPasswordData.oldPassword', 'keep-current-value' => '', 'no-dirty-check' => '', 'placeholder' => '********'));
        ?>
        <span class='c-error-field' ng-bind="myPasswordData.errors.oldPassword"></span>
    </div>
    <!--<div ng-bind="myProfileData.full_name"></div>-->
</div>
<div class="form-group" ng-class="myPasswordData.hasError.currentPassword">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_user, 'currentPassword'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->passwordField($model_user, 'currentPassword', array('class' => 'form-control', 'ng-model' => 'myPasswordData.currentPassword', 'keep-current-value' => '', 'no-dirty-check' => ''));
        ?>
        <span class='c-error-field' ng-bind="myPasswordData.errors.currentPassword"></span>
    </div>
</div>
<div class="form-group" ng-class="myPasswordData.hasError.retypePassword">
    <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_user, 'retypePassword'); ?></label>
    <div class="col-md-6">
        <?php
        echo $form->passwordField($model_user, 'retypePassword', array('class' => 'form-control', 'ng-model' => 'myPasswordData.retypePassword', 'keep-current-value' => '', 'no-dirty-check' => ''));
        ?>
        <span class='c-error-field' ng-bind="myPasswordData.errors.retypePassword"></span>
    </div>
</div>
<?php
//echo CHtml::submitButton('Simpan', array());
$this->endWidget();
?>