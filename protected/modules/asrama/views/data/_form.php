                                <fieldset title="Data Diri" class="stepy-step" data-tab="data-diri">
                                    <legend>Data Diri</legend>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group">
                                        <div class="text-center">
                                            <div class="col-md-4 col-md-offset-4">
                                                <img src="//placehold.it/200" class="avatar" alt="avatar">
                                                <h6>Unggah Foto</h6>
                                                <input type="file" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_lengkap'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'nama_lengkap', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'nama_lengkap'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'nama_panggilan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'nama_panggilan', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'nama_panggilan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tempat_lahir'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'tempat_lahir', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'tempat_lahir'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tanggal_lahir'); ?></label>
                                        <div class="col-md-6">
                                            <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'model' => $model,
                                                'attribute' => 'tanggal_lahir',
                                                'value' => $model->tanggal_lahir,
                                                'htmlOptions' => array('class' => 'form-control'),
                                                'options' => array(
                                                    'showAnim' => 'fold',
                                                    'chageYear' => true,
                                                    'showButtonPanel' => true,
                                                    'autoSize' => true,
                                                    'dateFormat' => 'yy-mm-dd',
                                                    'defaultDate' => $model->tanggal_lahir,
                                                    'changeYear' => true,
                                                    'changeMonth' => true,
                                                ),
                                            ));
                                            ?>
                                            <?php echo $form->error($model, 'tanggal_lahir'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'golongan_darah'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model, "golongan_darah", Utility::getBloodList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'golongan_darah'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'jumlah_saudara'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'jumlah_saudara', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'jumlah_saudara'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'anak_ke'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'anak_ke', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'anak_ke'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'jenis_kelamin'); ?></label>
                                        <div class="col-md-6">
                                            <?php
                                            echo $form->radioButtonList($model, 'jenis_kelamin', array(
                                                1 => 'Putra',
                                                2 => 'Putri'
                                                    ), array(
                                                'labelOptions' =>
                                                array('style' => 'display:inline'),
                                                'separator' => '  ',
//                                                                    'class'=>"radio-inline"
                                            ));
                                            ?>
                                            <?php echo $form->error($model, 'jenis_kelamin'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'alamat_keluarga_yogya'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textArea($model, 'alamat_keluarga_yogya', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'alamat_keluarga_yogya'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'no_telepon_keluarga_yogya'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'no_telepon_keluarga_yogya', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'no_telepon_keluarga_yogya'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'cita_cita'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'cita_cita', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cita_cita'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'hobi'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'hobi', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'hobi'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'motivasi_masuk_rtqu'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textArea($model, 'motivasi_masuk_rtqu', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'motivasi_masuk_rtqu'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'prestasi_hafalan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model, 'prestasi_hafalan', array('size' => 31, 'maxlength' => 31, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'prestasi_hafalan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model, 'tanggal_masuk_rtqu'); ?></label>
                                        <div class="col-md-6">
                                            <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'model' => $model,
                                                'attribute' => 'tanggal_masuk_rtqu',
                                                'value' => $model->tanggal_masuk_rtqu,
                                                'htmlOptions' => array('class' => 'form-control'),
                                                'options' => array(
                                                    'showAnim' => 'fold',
                                                    'chageYear' => true,
                                                    'showButtonPanel' => true,
                                                    'autoSize' => true,
                                                    'dateFormat' => 'yy-mm-dd',
                                                    'defaultDate' => $model->tanggal_masuk_rtqu,
                                                    'changeYear' => true,
                                                    'changeMonth' => true,
                                                ),
                                            ));
                                            ?>
                                            <?php echo $form->error($model, 'tanggal_masuk_rtqu'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <p class="stepy-navigator"><div class="pull-right"><a href="#" class="button-next">Next &gt;</a></div></p></fieldset>

                                <fieldset title="Keluarga" class="stepy-step hide" data-tab="data-keluarga" <?php /* style="display: none;" */ ?>>
                                    <legend>Personal Data</legend>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-orangtua-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group hide">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'santri_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'santri_id', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'santri_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'nama'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'nama', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'nama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'tanggal_lahir'); ?></label>
                                        <div class="col-md-6">
                                            <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'model' => $model_parent,
                                                'attribute' => 'tanggal_lahir',
                                                'value' => $model_parent->tanggal_lahir,
                                                'htmlOptions' => array('class' => 'form-control'),
                                                'options' => array(
                                                    'showAnim' => 'fold',
                                                    'chageYear' => true,
                                                    'showButtonPanel' => true,
                                                    'autoSize' => true,
                                                    'dateFormat' => 'yy-mm-dd',
                                                    'defaultDate' => $model_parent->tanggal_lahir,
                                                    'changeYear' => true,
                                                    'changeMonth' => true,
                                                ),
                                            ));
                                            ?>
                                            <?php echo $form->error($model_parent, 'tanggal_lahir'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'agama'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "agama", Utility::getReligionList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'agama'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'no_telepon'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'no_telepon', array('size' => 15, 'maxlength' => 15, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'no_telepon'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pendidikan_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "pendidikan_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'pendidikan_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'pekerjaan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'pekerjaan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'pekerjaan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'penghasilan'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_parent, 'penghasilan', array('size' => 60, 'maxlength' => 80, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'penghasilan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'alamat'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textArea($model_parent, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'alamat'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_parent, 'hubungan_orangtua'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_parent, "hubungan_orangtua", Utility::getFamilyRelationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_parent, 'hubungan_orangtua'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <p class="stepy-navigator"><div class="pull-right"><a href="#" class="button-back">&lt; Back</a><a href="#" class="button-next">Next &gt;</a></div></p></fieldset>

                                <fieldset title="Pendidikan" class="stepy-step hide" data-tab="data-pendidikan" <?php /* style="display: none; */ ?>">
                                    <legend>Riwayat Pendidikan</legend>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-riwayat-pendidikan-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group hide">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'santri_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'santri_id', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'santri_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'jenjang_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo CHtml::activeDropDownList($model_education, "jenjang_id", Utility::getEducationList(), array("prompt" => " - Pilih - ", 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'jenjang_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'nama_sekolah'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'nama_sekolah', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'nama_sekolah'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'tahun_masuk'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'tahun_masuk', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'tahun_masuk'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'tahun_lulus'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'tahun_lulus', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'tahun_lulus'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_education, 'nilai_rata_rata'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_education, 'nilai_rata_rata', array('size' => 7, 'maxlength' => 7, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_education, 'nilai_rata_rata'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <p class="stepy-navigator"><div class="pull-right"><a href="#" class="button-back">&lt; Back</a><a href="#" class="button-next">Next &gt;</a></div></p></fieldset>

                                <fieldset title="Riwayat Penyakit" class="stepy-step hide" data-tab="data-penyakit" <?php /* style="display: none; */ ?>">
                                    <legend>Riwayat Penyakit</legend>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-riwayat-penyakit-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal'
                                        )
                                    ));
                                    ?>
                                    <div class="form-group hide">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_diseae, 'santri_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_diseae, 'santri_id', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_diseae, 'santri_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_diseae, 'nama_penyakit'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_diseae, 'nama_penyakit', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_diseae, 'nama_penyakit'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_diseae, 'tahun'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_diseae, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_diseae, 'tahun'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?> 
                                    <p class="stepy-navigator"><div class="pull-right"><a href="#" class="button-back">&lt; Back</a><a href="#" class="button-next">Next &gt;</a></div></p></fieldset>

                                <fieldset title="Lain-Lain" class="stepy-step hide" data-tab="data-lain">
                                    <legend>Lain-lain</legend>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'santri-achievement-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array(
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'form-horizontal'
                                        )
                                    ));
                                    ?>   
                                    <div class="form-group hide">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'santri_id'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_achievement, 'santri_id', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_achievement, 'santri_id'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'prestasi'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_achievement, 'prestasi', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_achievement, 'prestasi'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'juara'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_achievement, 'juara', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_achievement, 'juara'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldname" class="col-md-3 control-label"><?php echo $form->labelEx($model_achievement, 'tahun'); ?></label>
                                        <div class="col-md-6">
                                            <?php echo $form->textField($model_achievement, 'tahun', array('size' => 4, 'maxlength' => 4, 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model_achievement, 'tahun'); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    <p class="stepy-navigator"><div class="pull-right"><a href="#" class="button-back">&lt; Back</a></div></p></fieldset>
                                <div class="stepy-errors"></div>