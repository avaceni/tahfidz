<?php
    $last_recitation = Santri::getLastRecitation($santri->id);
    $image = User::getPhotoUrl($santri->id);
    $juz = !empty(Santri::getJuz($santri->id)) ? floor(Santri::getJuz($santri->id)) . " Juz" : "- Juz";
    $sekolah = ($santri->user->getSantriEducation() != '') ? $santri->user->getSantriEducation() . ', ' : '';
    $umur = Utility::calcutateAge($santri->tanggal_lahir);
    $pondok = ucwords($santri->user->getPondokan());        
    $hafalan = !empty($last_recitation) ? "Juz " . $last_recitation['juz'] . " Halaman " . $last_recitation['halaman'] : '-';
    $ustadz = !empty($santri->user->getUstadz())?$santri->user->getUstadz()['name']:'-';
?>
<div style="font-family: sans-serif">
    <div style="text-align: center">
        <p>
            Berikut ini ringkasan Mutabaah Harian <b><span style="font-size: 16px; font-weight: bold"><?php echo ucwords($santri->nama_lengkap) ?></span></b>
            yang tersimpan dalam sistem Rumah Tahfidzqu selama    
            <span style="font-size: 16px; font-weight: bold">
                <span id="c-month-recite"><?php echo Utility::getIdMonth($bulan) ?></span> - <span id="c-year-recite"><?php echo $tahun ?></span>.
            </span>
        </p>
        <p>

        </p>    
    </div>

    <div class="" style="width: 90%; padding-left: 60px; padding-bottom: 20px">
        <div style="float:left; width: 110px; height: 115px;">
            <img class="img-thumbnail" src="<?php echo $image ?>" height="105.44px" width="82.24px" alt="Avatar">
        </div>
        <div style="float:left; width:88%;">
            <div class="row" style="font-size: 18px; font-weight: bold; width:100%; padding-top: 5px;">
                <div class="col-md-3 control-label" style="float:left; width: 30%">
                    <?php echo ucwords($santri->nama_lengkap) ?></div>
                <div class="col-md-7 control-label" style="float:left; width: 30%;">
                    <?php echo "$juz" ?>
                </div>
            </div>
            <div class="row" style="font-size: 15px; width:100%; padding-top: 12px;">
                <div class="col-md-3 control-label" style="float:left; width: 30%;">
                    <?php echo $sekolah . $umur ?>th
                </div>
                <div class="col-md-2 control-label" style="float:left; width: 20%;">
                    Pembimbing
                </div>
                <div class="col-md-5 control-label" style="float:left; width: 20%;">
                    <?php echo $ustadz ?>
                </div>
            </div>
            <div class="row" style="font-size: 15px; width:100%; padding-top: 12px;">
                <div class="col-md-3 control-label" style="float:left; width: 30%;">
                    <?php echo $pondok ?>
                </div>
                <div class="col-md-2 control-label" style="float:left; width: 20%;">
                    Hafalan sekarang
                </div>
                <div class="col-md-5 control-label" style="float:left; width: 20%;">
                    <?php echo $hafalan ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->renderPartial('_summary_table', array('data' => $data, 'absent'=>$absent)) ?>
</div>