
<div class="question-answer-content">
    <div class="consul-detail-box">
        <div class="consul-content question">
            <div class="consul-content-header">
                <p class="meta"><span class="name"><?php echo $aq_model->getName()?></span><span class="date"><?php echo $aq_model->getCreatedTime()?></span></p>
            </div>
            <div class="consul-content-detail">
                <p>
                    <?php echo $aq_model->getQuestion(); ?>
                </p>
            </div>
        </div>
        <?php if (strlen($aq_model->getAnswer()) > 0) { ?>
            <div class="consul-content answer">
                <div class="consul-content-header">
                    <p class="meta"><span class="name"><?php echo $aq_model->answeredBy->getFullName()?></span><span class="date"><?php echo $aq_model->getUpdatedTime()?></span><a href="javascript:void(0);" class="edit" id="edit-answer"><i class="icon-pencil"></i>Edit</a></p>
                </div>
                <div class="consul-content-detail">
                    <p>
                        <?php echo $aq_model->getAnswer(); ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="answer-form" style="display: <?php echo (strlen($aq_model->getAnswer()) <= 0)?'block':'none';?>">
    <?php // awal form?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'answer-form',
        'enableAjaxValidation' => true,
    ));
    ?>
    <?php echo CHtml::activeHiddenField($aq_model, 'id');?>
    <?php echo CHtml::activeTextArea($aq_model, 'answer', array('class'=>'boxizing'))?>
    <?php echo CHtml::button('Kirim', array('id'=>'send-answer'))?>
    <?php $this->endWidget(); ?>
</div>