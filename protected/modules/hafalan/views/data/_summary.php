<div>
    <p>
        Dialog ini menampilkan ringkasan hafalan <b><span style="font-size: 16px"><?php echo ucwords($model_detail->nama_lengkap) ?></span></b>
        yang tersimpan dalam sistem Rumah Tahfidzqu selama
    </p>
    <p style="font-size: 16px; font-weight: bold">
        <span id="c-month-recite"><?php echo Utility::getIdMonth($last_month_recite) ?></span> - <span id="c-year-recite"><?php echo $last_year_recite ?></span>.
    </p>
</div>
<div class="panel-heading">
    <div class="panel-ctrls">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'show-hafalan-form',
            'action' => Yii::app()->createUrl('hafalan/data/summaryfilter/', array('id' => $model_detail->id)),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => '',
                'data-modal-id' => 'show-recitation-summary-modal',
            )
        ));
        ?>
        <div class="right">
            <a target="_blank" class="btn btn-primary c-btn-pdf" href="<?php echo Yii::app()->createUrl('hafalan/data/pdfsummary') ?>">PDF</a>
            <?php echo CHtml::hiddenField('id', $model_detail->id) ?>
            <div class="form-group c-recitation-filter-month" style="float:right;">
                <div class="input-right">
                    <?php
                    $month_list = Utility::getMonthList();
                    echo CHtml::dropDownList('bulan', $last_month_recite, $month_list, array('class' => 'form-control c-filter-summary-recitation'));
                    ?>
                </div>
                <div class="label-right" style="line-height: 48px;">
                    <?php
                    echo CHtml::label('Bulan', 'bulan');
                    ?>
                </div>
            </div>
            <div class="form-group c-recitation-filter-year" style="float:right; padding-right: 8px">
                <div class="input-right">
                    <?php
                    echo CHtml::dropDownList('tahun', $last_year_recite, $year_sequence, array('class' => 'form-control c-filter-summary-recitation'));
                    ?>
                </div>
                <div class="label-right" style="line-height: 48px;">
                    <?php
                    echo CHtml::label('Tahun', 'tahun');
                    ?>
                </div>
            </div>
        </div>
        <?php
        $this->endWidget();
        ?>
    </div>
</div>
<div id="summary-table" style="overflow-x: scroll;">
    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th rowspan="2">Tanggal</th>
                <th colspan="5" style="text-align:center;">Ziyadah</th>
                <th colspan="5" style="text-align:center;">Binadhor</th>
                <th colspan="5" style="text-align:center;">Murojaah</th>
            </tr>
            <tr>
                <th>Juz</th>
                <th>Hal</th>
                <th>Lulus</th>                
                <th>Musrif</th>
                <th>Keterangan</th>
                <th>Juz</th>
                <th>Hal</th>
                <th>Lulus</th>
                <th>Musrif</th>
                <th>Keterangan</th>
                <th>Juz</th>
                <th>Hal</th>
                <th>Lulus</th>
                <th>Musrif</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $date => $value) {
                ?>
                <tr>
                    <td style="text-align:center;"><?php echo $date ?></td>
                    <?php
                    if (!array_key_exists('masuk', $value)) {
                        ?>
                        <td colspan="15" style="text-align:center;">
                            <?php
                            echo MutabaahTahfidz::getAbsentName($value['tidak_masuk']['alasan']);
                            echo ' --- oleh Ust. ';
                            if(!empty((new Santri)->loadModel($value['tidak_masuk']['ustadz']))){
                                echo (new Santri)->loadModel($value['tidak_masuk']['ustadz'])->nama_lengkap;
                            }
                            else{
                                echo '...';
                            }
                            echo ' --- keterangan : ';
                            echo $value['tidak_masuk']['keterangan'];
                            ?>
                        </td>
                        <?php
                    } else {
                        if (array_key_exists('1', $value['masuk'])) {
                            ?>
                            <td>
                                <?php
                                if ($value['masuk']['1']['subtipe'] == 1) {
                                    echo $value['masuk']['1']['juz'];
                                } else {
                                    echo MutabaahTahfidz::getMuqaddimahSurahName($value['masuk']['1']['surat']);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($value['masuk']['1']['subtipe'] == 1) {
                                    echo $value['masuk']['1']['hal'];
                                }
                                ?>
                            </td>
                            <td><?php echo $value['masuk']['1']['nilai'] ?></td>
                            <td>
                                <?php
                                if(!empty((new Santri)->loadModel($value['masuk']['1']['ustadz']))){
                                    echo (new Santri)->loadModel($value['masuk']['1']['ustadz'])->nama_lengkap;
                                }
                                ?>
                            </td>
                            <td><?php echo $value['masuk']['1']['keterangan'] ?></td>
                            <?php
                        } else {
                            for ($i = 0; $i < 5; $i++) {
                                ?>
                                <td></td>
                                <?php
                            }
                        }
                        if (array_key_exists('2', $value['masuk'])) {
                            ?>
                            <td><?php echo $value['masuk']['2']['juz'] ?></td>
                            <td><?php echo $value['masuk']['2']['hal'] ?></td>
                            <td><?php echo $value['masuk']['2']['nilai'] ?></td>
                            <td>
                                <?php
                                if(!empty((new Santri)->loadModel($value['masuk']['2']['ustadz']))){
                                    echo (new Santri)->loadModel($value['masuk']['2']['ustadz'])->nama_lengkap;
                                }
                                ?>
                            </td>
                            <td><?php echo $value['masuk']['2']['keterangan'] ?></td>
                            <?php
                        } else {
                            for ($i = 0; $i < 5; $i++) {
                                ?>
                                <td></td>
                                <?php
                            }
                        }
                        if (array_key_exists('3', $value['masuk'])) {
                            ?>
                            <td><?php echo $value['masuk']['3']['juz'] ?></td>
                            <td><?php echo $value['masuk']['3']['hal'] ?></td>
                            <td><?php echo $value['masuk']['3']['nilai'] ?></td>
                            <td>
                                <?php
                                if(!empty((new Santri)->loadModel($value['masuk']['3']['ustadz']))){
                                    echo (new Santri)->loadModel($value['masuk']['3']['ustadz'])->nama_lengkap;
                                }
                                ?>
                            </td>
                            <td><?php echo $value['masuk']['3']['keterangan'] ?></td>
                            <?php
                        } else {
                            for ($i = 0; $i < 5; $i++) {
                                ?>
                                <td></td>
                                <?php
                            }
                        }
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <br>
    <table style="width:20%;" class="table table-bordered table-condensed" border="1">
        <tr>
            <th colspan="2" style="text-align: center;">Ketidakhadiran</th>
        </tr>
        <?php
        $absent_day = array();
        if (!empty($absent)) {
            foreach ($absent as $key => $value) {
                $absent_day[$value->absensi] = $value->total;
            }
        }
        ?>
        <tr>
            <td>Sakit</td>
            <td><?php echo array_key_exists('2', $absent_day) ? $absent_day['2'] . ' kali' : '-' ?></td>
        </tr>
        <tr>
            <td>Izin</td>
            <td><?php echo array_key_exists('3', $absent_day) ? $absent_day['3'] . ' kali' : '-' ?></td>
        </tr>
        <tr>
            <td>Tanpa Keterangan</td>
            <td><?php echo array_key_exists('4', $absent_day) ? $absent_day['4'] . ' kali' : '-' ?></td>
        </tr>
    </table>    
</div>