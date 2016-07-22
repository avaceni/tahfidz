<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'account-form',
    'enableAjaxValidation' => true,
        ));
?>
<ul>
    <li>
        <?php echo CHtml::activeTextField($account_form_model, 'username', array('placeholder' => 'Username')) ?>
        <?php echo CHtml::error($account_form_model, 'username') ?>
    </li>
    <li>
        <?php echo CHtml::activePasswordField($account_form_model, 'oldPassword', array('placeholder' => 'Password Lama')) ?>
        <?php echo CHtml::error($account_form_model, 'oldPassword') ?>
    </li>
    <li>
        <?php echo CHtml::activePasswordField($account_form_model, 'currentPassword', array('placeholder' => 'Password Baru')) ?>
        <?php echo CHtml::error($account_form_model, 'currentPassword') ?>
    </li>
    <li>
        <?php echo CHtml::activePasswordField($account_form_model, 'retypePassword', array('placeholder' => 'Ulangi Password Baru')) ?>
        <?php echo CHtml::error($account_form_model, 'retypePassword') ?>
    </li>
    <li>
        <input type="button" value="Simpan" class="big" id="submit-account-form" />
    </li>
</ul>
<?php $this->endWidget(); ?>