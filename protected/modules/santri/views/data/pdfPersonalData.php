<div class="pdf-body">
    <div class="pdf-header">
        1. Data Diri
    </div>
    <hr>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'santri-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal'
        )
    ));
    ?>
    <div style="padding-left: 300px; padding-bottom: 30px; width: 220px; height: 230px;">
        <img class="img-thumbnail" src="<?php echo User::getPhotoUrl($model_santri->id) ?>" height="<?php echo 105.44 * 2 ?>px" width="<?php echo 82.24 * 2 ?>px" alt="Avatar">
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'nama_lengkap'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucwords($model_santri->nama_lengkap); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'nama_panggilan'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucwords($model_santri->nama_panggilan); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'tempat_lahir'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucfirst($model_santri->tempat_lahir); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'tanggal_lahir'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model_santri->tanggal_lahir)); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'golongan_darah'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo Utility::getBloodType($model_santri->golongan_darah); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'jumlah_saudara'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo $model_santri->jumlah_saudara; ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">    
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'anak_ke'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo $model_santri->anak_ke; ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'jenis_kelamin'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucfirst(Utility::getGender($model_santri->jenis_kelamin)); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'alamat_keluarga_yogya'); ?></label>
        </div>    
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucfirst($model_santri->alamat_keluarga_yogya); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'no_telepon_keluarga_yogya'); ?></label>
        </div>    
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo $model_santri->no_telepon_keluarga_yogya; ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'cita_cita'); ?></label>
        </div>    
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucfirst($model_santri->cita_cita); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'hobi'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucfirst($model_santri->hobi); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">    
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'motivasi_masuk_rtqu'); ?></label>
        </div>    
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucfirst($model_santri->motivasi_masuk_rtqu); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'prestasi_hafalan'); ?></label>
        </div>    
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo ucfirst($model_santri->prestasi_hafalan); ?></a>
        </div>
    </div>
    <div class="pdf-form-group">
        <div class="pdf-control-label">
            <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($model_santri, 'tanggal_masuk_rtqu'); ?></label>
        </div>
        <div class="col-md-6 pdf-detail-view">
            <a class="editable editable-click"><?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($model_santri->tanggal_masuk_rtqu)); ?></a>
        </div>
    </div>
    <?php $this->endWidget(); ?>

    <?php
    $i = 1;
    if (!empty($model_parent)) {
        ?>
        <hr>
        <div class="pdf-header">
            2. Orang Tua
        </div>
        <hr>
        <?php
        foreach ($model_parent as $this_parent) {
            ?>
            <div class="pdf-header-2">Orangtua <span id="c-multi-number"><?php echo $i ?></span></div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-orangtua-form' . $i,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                )
            ));
            ?>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'nama'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->nama); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'tempat_lahir'); ?></label>
                </div>                
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->tempat_lahir); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'tanggal_lahir'); ?></label>
                </div>                
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($this_parent->tanggal_lahir)); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'agama'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getReligion($this_parent->agama); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'no_telepon'); ?></label>
                </div>                
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_parent->no_telepon; ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'pendidikan_id'); ?></label>
                </div>                
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getEducation($this_parent->pendidikan_id); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'pekerjaan'); ?></label>
                </div>                
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->pekerjaan); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'penghasilan'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->penghasilan); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'alamat'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_parent->alamat); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_parent, 'hubungan_orangtua'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getKinship($this_parent->hubungan_orangtua) ?></a>
                </div>
            </div>
            <?php
            $this->endWidget();
            $i++;
        }
    }
    ?>

    <?php
    $j = 1;
    if (!empty($model_education)) {
        ?>
        <hr>
        <div class="pdf-header">
            3. Riwayat Pendidikan
        </div>
        <hr>
        <?php
        foreach ($model_education as $this_education) {
            ?>
            <div class="pdf-header-2">Pendidikan <span id="c-multi-number"><?php echo $j ?></span> <?php echo $icon_trash; ?></div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-riwayat-pendidikan-form' . $j,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                )
            ));
            ?>
            <?php
            ?>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_education, 'jenjang_id'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo Utility::getEducation($this_education->jenjang_id) ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_education, 'nama_sekolah'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo ucwords($this_education->nama_sekolah); ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_education, 'tahun_masuk'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_education->tahun_masuk; ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_education, 'tahun_lulus'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_education->tahun_lulus ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_education, 'nilai_rata_rata'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_education->nilai_rata_rata; ?></a>
                </div>
            </div>
            <?php
            $this->endWidget();
            $j++;
        }
    }
    ?>

    <?php
    $k = 1;
    if (!empty($model_diseae)) {
        ?>
        <hr>
        <div class="pdf-header">
            4. Riwayat Penyakit
        </div>
        <hr>
        <?php
        foreach ($model_diseae as $this_diseae) {
            ?>
            <div class="pdf-header-2">Penyakit <span id="c-multi-number"><?php echo $k ?></span> <?php echo $icon_trash; ?></div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-riwayat-penyakit-form' . $k,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                )
            ));
            ?>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_diseae, 'nama_penyakit'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_diseae->nama_penyakit; ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_diseae, 'tahun'); ?></label>
                </div>                
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_diseae->tahun ?></a>
                </div>
            </div>
            <?php
            $this->endWidget();
            $k++;
        }
    }
    ?>
    <?php
    $l = 1;
    if (!empty($model_achievement)) {
        ?>
        <hr>
        <div class="pdf-header">
            5. Prestasi
        </div>
        <hr>
        <?php
        foreach ($model_achievement as $this_achievement) {
            ?>
            <div class="pdf-header-2">Prestasi <span id="c-multi-number"><?php echo $l ?></span> <?php echo $icon_trash; ?></div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'santri-achievement-form',
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                )
            ));
            ?>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_achievement, 'prestasi'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_achievement->prestasi; ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_achievement, 'juara'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_achievement->juara; ?></a>
                </div>
            </div>
            <div class="pdf-form-group">
                <div class="pdf-control-label">                
                    <label for="fieldname" class="col-md-3"><?php echo $form->labelEx($this_achievement, 'tahun'); ?></label>
                </div>
                <div class="col-md-6 pdf-detail-view">
                    <a class="editable editable-click"><?php echo $this_achievement->tahun ?></a>
                </div>
            </div>
            <?php
            $this->endWidget();
            $l++;
        }
    }
    ?>

</div>