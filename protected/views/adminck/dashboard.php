<div id="wrap" class="mainview-animation animated">
    <div id="page-heading">
        <?php
        $this->widget('application.components.BreadCrumb', array(
            'crumbs' => array(
                array('name' => 'Home', 'url' => array('adminck/dashboard')),
            ),
        ));
        ?>
        <h1>Dasboard</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="" class="info-tiles tiles-danger">
                                    <div class="tiles-heading">
                                        <div class="text-center">SD</div>
                                    </div>
                                    <div class="tiles-body no-bdr-radius">
                                        <div class="pull-left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon_sd.png" height="46px"></div>
                                        <div class="pull-right"><?php echo ($total_santri['sd_putra'] + $total_santri['sd_putri']) ?></div>
                                    </div>
                                    <div class="tiles-footer">
                                        <div class="text-center footer-box">
                                            <span class="footer-column"><?php echo ($total_santri['sd_putra']) ?><sup>Putra</sup></span>
                                            <span class="footer-column"><?php echo ($total_santri['sd_putri']) ?><sup>Putri</sup></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <a href="" class="info-tiles tiles-info">
                                    <div class="tiles-heading">
                                        <div class="text-center">SMP</div>
                                    </div>
                                    <div class="tiles-body no-bdr-radius">
                                        <div class="pull-left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon_smp.png" height="46px"></div>
                                        <div class="pull-right"><?php echo ($total_santri['smp_putra'] + $total_santri['smp_putri']) ?></div>
                                    </div>
                                    <div class="tiles-footer">
                                        <div class="text-center footer-box">
                                            <span class="footer-column"><?php echo ($total_santri['smp_putra']) ?><sup>Putra</sup></span>
                                            <span class="footer-column"><?php echo ($total_santri['smp_putri']) ?><sup>Putri</sup></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <a href="" class="info-tiles tiles-inverse">
                                    <div class="tiles-heading">
                                        <div class="text-center">SMA</div>
                                    </div>
                                    <div class="tiles-body no-bdr-radius">
                                        <div class="pull-left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon_sma.png" height="46px"></div>
                                        <div class="pull-right"><?php echo ($total_santri['sma_putra'] + $total_santri['sma_putri']) ?></div>
                                    </div>
                                    <div class="tiles-footer">
                                        <div class="text-center footer-box">
                                            <span class="footer-column"><?php echo ($total_santri['sma_putra']) ?><sup>Putra</sup></span>
                                            <span class="footer-column"><?php echo ($total_santri['sma_putri']) ?><sup>Putri</sup></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <a href="" class="info-tiles tiles-green">
                                    <div class="tiles-heading">
                                        <div class="text-center">Mahasiswa</div>
                                    </div>
                                    <div class="tiles-body no-bdr-radius">
                                        <div class="pull-left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon_mahasiswa.png" height="46px"></div>
                                        <div class="pull-right"><?php echo ($total_santri['mahasiswa_putra'] + $total_santri['mahasiswa_putri']) ?></div>
                                    </div>
                                    <div class="tiles-footer">
                                        <div class="text-center footer-box">
                                            <span class="footer-column"><?php echo ($total_santri['mahasiswa_putra']) ?><sup>Putra</sup></span>
                                            <span class="footer-column"><?php echo ($total_santri['mahasiswa_putri']) ?><sup>Putri</sup></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- statistik keuangan -->
                        <div class="panel no-padding">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Grafik Keuangan 6 Bulan Terakhir</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id="chart" style="height: 400px;">
                                    <svg></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading">
                        <h2>Santri Aktif <?php echo !empty($academic_year)?$academic_year->nama_tahun_ajaran:'' ?></h2>
                    </div>
                    <div class="panel-body" style="width:100%; padding:0 10px 0 10px;">
                        <table class="table table-curved table-bordered table-condensed" border="1">
                            <?php /* <tr style="background-color: #7a869c; color: white;">
                                <th style="text-align:center;" rowspan=2>Asrama</th>
                                <th style="text-align:center;" colspan=2>Santri</th>		
                                <th style="text-align:center;" rowspan=2>Total</th>
                            </tr>
                            <tr style="background-color: #7a869c; color: white;">
                                <th style="text-align:center;">Putra</th>		
                                <th style="text-align:center;">Putri</th>		
                            </tr>
                            */ ?>
                            <tr style="background-color: #7a869c; color: white;">
                                <th style="text-align:center;border:0px;">Asrama</th>
                                <th style="text-align:center;border:0px;">Putra</th>		
                                <th style="text-align:center;border:0px;">Putri</th>		  
                                <th style="text-align:center;border:0px;">Total</th>
                            </tr>
                                <?php
                                    $perquarters = array();
                                    $quarters_dictionary = array();
                                    if(!empty($santri_perquarters)){
                                        foreach($santri_perquarters as $quarters){
                                            if(!array_key_exists($quarters->user->riwayatPondokanOne->pondok->nama_pondok, $quarters_dictionary)){
                                                $perquarters[$quarters->user->riwayatPondokanOne->pondok->nama_pondok]['total'] = $quarters->total;
                                                $quarters_dictionary[$quarters->user->riwayatPondokanOne->pondok->nama_pondok] = 1;
                                            }
                                            else{
                                                $perquarters[$quarters->user->riwayatPondokanOne->pondok->nama_pondok]['total'] = $perquarters[$quarters->user->riwayatPondokanOne->pondok->nama_pondok]['total'] + $quarters->total;
                                            }
                                            $perquarters[$quarters->user->riwayatPondokanOne->pondok->nama_pondok][$quarters->jenis_kelamin] = $quarters->total;
                                        }
                                    }
                                ?>
                                <?php
                                    if(!empty($perquarters)){
                                        foreach ($perquarters as $key=>$value) {
                                            ?>
                            <tr>
                                <td><?php echo ucwords($key)?></td>
                                <td style="text-align:right;"><?php echo array_key_exists(1, $value)?$value[1]:'0' ?></td>
                                <td style="text-align:right;"><?php echo array_key_exists(2, $value)?$value[2]:'0' ?></td>
                                <td style="text-align:right;"><?php echo $value['total'] ?></td>
                            </tr>
                                            <?php
                                        }
                                    }
                                    else{
                                            ?>
                            <tr>
                                <td colspan="4">tidak ada data</td>
                            </tr>
                                            <?php
                                    }
                                ?>
                        </table>
                    </div>
                </div>
                <div class="panel no-padding">
                    <div class="panel-heading">
                        <h2>Top 10 Hafalan Terbanyak</h2>
                    </div>
                    <div class="panel-body">
                        <div class="tab-container tab-grape tab-top">
                            <ul class="nav nav-tabs c-top-reciters">
                                <li class="active"><a data-grade="sd">SD</a></li>
                                <li><a data-grade="smp">SMP</a></li>
                                <li><a data-grade="sma">SMA</a></li>
                                <li><a data-grade="mahasiswa">MAHASISWA</a></li>
                            </ul>
                            <div class="tab-content">
                                <?php
                                foreach ($top_reciter as $grade => $reciters) {
                                    ?>
                                    <div class="tab-pane c-pane-reciters <?php echo $grade ?> <?php echo $grade == 'sd' ? 'active' : ''; ?> ">
                                        <div class="table-responsive">
                                            <table class="table table-hover" style="margin-bottom:0;">
                                                <?php
                                                $i = 1;
                                                foreach ($reciters as $reciter) {
                                                    ?>
                                                    <tr class="c-create-link c-make-pointer" data-url="<?php echo $reciter['url_profil']; ?>">
                                                        <td class="col-xs-1"><?php echo $i; ?></td>
                                                        <td class="col-xs-1"><img src="<?php echo ucwords($reciter['foto']); ?>" class="img-circle table-list-avatar"></td>
                                                        <td class="col-xs-7"><?php echo ucwords($reciter['nama']); ?></td>
                                                        <td class="col-xs-4 text-right"><?php echo floor($reciter['persen']); ?> Juz</td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>