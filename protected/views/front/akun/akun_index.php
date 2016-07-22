<div id="dialog" class="overlay">
    <div class="dialog-box boxsizing">
        <div class="dialog-header clearfix">
            <h2>Pengaturan</h2>
            <a href="javascript:void(0)" class="close"><i class="icon-close"></i></a>
        </div>
        <div id="account-box">
            <?php $this->renderPartial('_account_form', array('account_form_model' => $account_form_model)); ?>
        </div>

    </div>
</div>
<div class="question-list">
    <div class="content-box">
        <div class="category-option boxsizing">
            <?php echo CHtml::dropDownList('answer-search', '0', $dai_skill_list, array('prompt' => ' - Pilihan kategori - ')) ?>
        </div>
        <div class="question-box">
            <ul class="question-list-box" id="question-list-box">
                <?php $i = 1; ?>
                <?php foreach ($aq_model as $aq) { ?> 
                    <li key="<?php echo $aq->id; ?>" id="question-list" class="<?php if ($i == 1) echo 'active'; ?>">
                        <a href="javascript:void(0);" class="delete"><i class="icon-trash"></i></a>
                        <a href="javascript:void(0);" class="active">
                            <span>
                                <span><b><?php echo $aq->name; ?></b></span>
                                <?php echo $aq->getQuestion(); ?>
                            </span>
                        </a>
                    </li>
                    <?php $i++; ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</div

<div class="question-answer boxsizing">
    <div class="question-answer-box">
        <?php if (isset($aq_model[0])) { ?>
            <div class="question-answer-content">

                <div class="question-answer-content">
                    <div class="consul-detail-box">
                        <div class="consul-content question">
                            <div class="consul-content-header">
                                <p class="meta"><span class="name"><?php echo $aq_model[0]->getName() ?></span><span class="date"><?php echo $aq_model[0]->getCreatedTime() ?></span></p>
                            </div>
                            <div class="consul-content-detail">
                                <p>
                                    <?php echo $aq_model[0]->getQuestion(); ?>
                                </p>
                            </div>
                        </div>
                        <?php if (strlen($aq_model[0]->getAnswer()) > 0) { ?>
                            <div class="consul-content answer">
                                <div class="consul-content-header">
                                    <p class="meta"><span class="name"><?php echo $aq_model[0]->answeredBy->getFullName() ?></span><span class="date"><?php echo $aq_model[0]->getUpdatedTime() ?></span><a href="javascript:void(0);" class="edit" id="edit-answer"><i class="icon-pencil"></i>Edit</a></p>
                                </div>
                                <div class="consul-content-detail">
                                    <p>
                                        <?php echo $aq_model[0]->getAnswer(); ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <div class="answer-form" style="display: <?php echo (strlen($aq_model[0]->getAnswer()) <= 0) ? 'block' : 'none'; ?>">
                    <?php // awal form ?>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'answer-form',
                        'enableAjaxValidation' => true,
                    ));
                    ?>
                    <?php echo CHtml::activeHiddenField($aq_model[0], 'id'); ?>
                    <?php echo CHtml::activeTextArea($aq_model[0], 'answer', array('class' => 'boxizing')) ?>
                    <?php echo CHtml::button('Kirim', array('id' => 'send-answer')) ?>
                    <?php $this->endWidget(); ?>
                </div>
                <?php echo CHtml::beginForm('#', 'POST', array("id" => "form-admin")); ?>
                <div class="box-content">
                    <?php
                    if(!empty($model_comment)){
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'mod-content-grid',
                        'dataProvider' => $model_comment->searchAQComments($aq_model[0]->id),
                        'filter' => $model_comment,
                        'selectableRows' => 2,
                        'columns' => array(
                            array(
                                'header' => 'No',
                                'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                'htmlOptions' => array("width" => "31px", "text-align" => "center")
                            ),
                            'name',
                            'email',
                            'comment',
                            /*
                              'publish',
                              'content',
                              'description',
                             */
                            array(
                    'class' => 'ButtonColumn',
                    'evaluateID' => true,
                    'template' => '{delete}',
                                "buttons" => array(
                                    "delete" => array(
                                        'label' => '',
                                        'url' => 'Yii::app()->createUrl("comment/commentAQ/delete", array("id" => $data->id))',
                                    )
                                )
                            ),
                        ),
                    ));
                    }
                    ?>
                </div>
                <?php echo CHtml::endForm(); ?>   
            </div>
        <?php } ?>

    </div>
</div>