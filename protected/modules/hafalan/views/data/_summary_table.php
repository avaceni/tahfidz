<table cellspacing="0" class="table table-bordered table-condensed c-pdf-table">
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
        if (!empty($data)) {
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
        } else {
            ?>
            <tr>
                <td colspan="16">
                    <i>Tidak ada data.</i>
                </td>
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