<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div
    class="form relative">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    ));
    ?>


    <div class="box no-border padding-15">
        <div class="table-display">
            <div class="table-cell-display left-381 padding-15">
                <div class="detailview">
                    <h1>Photo</h1>
                    <dl>
                        <dt>
                        <img alt=""
                             src="<?php echo Yii::app()->baseUrl . "/images/resource/big.jpg"; ?>"
                             class="img-widht">
                        </dt>
                    </dl>
                </div>
            </div>
            <div class="table-cell-display">

                <div class="box no-border padding-15">
                    <div class="box-header">
                        <div class="span-title">
                            <h4>General Information</h4>
                        </div>
                    </div>
                    <div class="table-display">
                        <div class="table-cell-display">
                            <?php // awal nama lengkap?>
                            <div class="row table-display">
                                <div class="table-cell-display left-181">
                                    <div class="row-label float-none">
                                        <?php echo $form->labelEx($model, 'full_name', array("class" => "text-bold text-align-right side-padding-15")); ?>
                                    </div>
                                </div>
                                <div class="table-cell-display">

                                    <div class="row-input float-none">
                                        <?php echo $form->textField($model, 'full_name', array('size' => 21, 'maxlength' => 21, "class" => "input-width-100")); ?>
                                        <?php echo $form->error($model, 'full_name'); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php // akhir nama lengkap?>
                            <?php // awal gender?>
                            <div class="row table-display">
                                <div class="table-cell-display left-181">
                                    <div class="row-label float-none">
                                        <?php echo $form->labelEx($model, 'gender', array("class" => "text-bold text-align-right side-padding-15")); ?>
                                    </div>
                                </div>
                                <div class="table-cell-display">

                                    <div class="row-input float-none">
                                        <?php echo CHtml::activeDropDownList($model, 'gender', array(1=>'Male', 2=>'Female', 3=>'Other'), array('prompt'=>' - please chose gender - ')); ?>
                                        <?php echo $form->error($model, 'gender'); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php // akhir gender?>
                            <?php // awal aktivasi?>
                            <div class="row table-display">
                                <div class="table-cell-display left-181">
                                    <div class="row-label float-none">
                                        <?php echo $form->labelEx($model, 'active', array("class" => "text-bold text-align-right side-padding-15")); ?>
                                    </div>
                                </div>
                                <div class="table-cell-display">
                                    <div class="row-input float-none">
                                        <?php $this->widget("ext.flatcheckbox.FlatCheckbox", array("model" => $model, "attribute" => "is_active", "htmlOptions" => array("id" => "1"))); ?>
                                        <?php echo $form->error($model, 'is_active'); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php // akhir aktivasi?>
                        </div>

                        <div class="table-cell-display">

                            <div class="row table-display">
                                <div class="table-cell-display left-181">
                                    <div class="row-label float-none">
                                        <?php echo $form->labelEx($model, 'group_id', array("class" => "text-bold text-align-right side-padding-15")); ?>
                                    </div>
                                </div>
                                <div class="table-cell-display">
                                    <div class="row-input float-none">
                                        <?php echo CHtml::activeDropDownList($model, "group_id", Group::model()->listGroups(), array("class" => "input-width-100")); ?>
                                        <?php echo $form->error($model, 'group_id'); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="row table-display">
                                <div class="table-cell-display left-181">
                                    <div class="row-label float-none">
                                        <?php echo $form->labelEx($model, 'email', array("class" => "text-bold text-align-right side-padding-15")); ?>
                                    </div>
                                </div>
                                <div class="table-cell-display">
                                    <div class="row-input float-none">
                                        <?php echo $form->textField($model, 'email', array('size' => 21, 'maxlength' => 21, "class" => "input-width-100")); ?>
                                        <?php echo $form->error($model, 'email'); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box no-border padding-15">
                    <div class="box-header">
                        <div class="span-title">
                            <h4>Account</h4>
                        </div>
                    </div>
                    <div class="row table-display">
                        <div class="table-cell-display left-181">
                            <div class="text-subtitle">Username</div>
                            <div class="text-mutted">You Can type usrname here</div>
                        </div>
                        <div class="table-cell-display">
                            <div class="row-label float-none">
                                <?php echo $form->labelEx($model, 'username'); ?>
                            </div>
                            <div class="row-input float-none">
                                <?php echo $form->textField($model, 'username', array("class" => "input-width-100", "size" => 21)); ?>
                                <?php echo $form->error($model, 'username'); ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <?php //old password;?>
                    <?php if (!$model->isNewRecord) { ?>
                        <div class="row table-display">
                            <div class="table-cell-display left-181">
                                <div class="text-subtitle">Old Password</div>
                                <div class="text-mutted">You Can type old password here</div>
                            </div>
                            <div class="table-cell-display">
                                <div class="row-label float-none">
                                    <?php echo $form->labelEx($model, 'oldPassword'); ?>
                                </div>
                                <div class="row-input float-none">
                                    <?php echo $form->passwordField($model, 'oldPassword', array("class" => "input-width-100", "size" => 21)); ?>
                                    <?php echo $form->error($model, 'oldPassword'); ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php //old password;?>

                    <?php //new password;?>
                    <div class="row table-display">
                        <div class="table-cell-display left-181">
                            <div class="text-subtitle">New Password</div>
                            <div class="text-mutted">You Can type new password here</div>
                        </div>
                        <div class="table-cell-display">
                            <div class="row-label float-none">
                                <?php echo $form->labelEx($model, 'currentPassword'); ?>
                            </div>
                            <div class="row-input float-none">
                                <?php echo $form->passwordField($model, 'currentPassword', array("class" => "input-width-100", "size" => 21)); ?>
                                <?php echo $form->error($model, 'currentPassword'); ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php //new password;?>

                    <?php //retype password;?>
                    <div class="row table-display">
                        <div class="table-cell-display left-181">
                            <div class="text-subtitle">Retype Password</div>
                            <div class="text-mutted">You Can retype password here</div>
                        </div>
                        <div class="table-cell-display">
                            <div class="row-label float-none">
                                <?php echo $form->labelEx($model, 'retypePassword'); ?>
                            </div>
                            <div class="row-input float-none">
                                <?php echo $form->passwordField($model, 'retypePassword', array("class" => "input-width-100", "size" => 21)); ?>
                                <?php echo $form->error($model, 'retypePassword'); ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php //retype password;?>

                    <div class="row table-display">
                        <div class="row-input float-none">
                            <?php echo CHtml::submitButton($model->isNewRecord ? "create" : "save", array("class" => "input-width-100")); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
    <!--    <div class="clear"></div>-->
</div>
