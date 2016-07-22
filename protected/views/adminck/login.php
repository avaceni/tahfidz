<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<!--<h1>Login</h1>-->

<!--<p>Please fill out the following form with your login credentials:</p>-->

<div class="form form-horizontal">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <?php echo $form->errorSummary($model); ?>
<!--	<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<div class="form-group">
		<?php echo $form->labelEx($model,'username', array('class' => "control-label col-sm-4")); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($model,'username', array("placeholder"=>"Username", "class"=>"form-control")); ?>
		</div>
		<?php //echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password', array('class' => "control-label col-sm-4")); ?>
		<div class="col-sm-8">
			<?php echo $form->passwordField($model,'password', array("placeholder"=>"Password", "class"=>"form-control")); ?>
		</div>
		<?php //echo $form->error($model,'password'); ?>
<!--		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>-->
	</div>

	<div class="clearfix">
		<div class="pull-right">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo CHtml::label("Tetap Login", ""); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>
	</div>
	<?php echo CHtml::submitButton('Login', array("class"=>"btn btn-primary btn-block")); ?>
        

        <div class="clear"></div>
<?php $this->endWidget(); ?>
        <br>
        <a class="btn btn-primary" href="<?php echo Yii::app()->createAbsoluteUrl('file/rumahtahfidzqu.debug.apk') ?>" style="background-color:#97C024 ">Download Versi Android</a>
</div><!-- form -->
