<div class="static-content"> 
    <div id="wrap" class="mainview-animation animated ng-scope"><div id="page-heading" class="ng-scope">
            <?php
            $this->widget('application.components.BreadCrumb', array(
                'crumbs' => array(
                    array('name' => 'Home', 'url' => array('adminck/dashboard')),
                    array('name' => 'Keuangan', 'url' => array('keuangan/data/manage')),
                ),
            ));
            ?>
            <h1>Kas Keluar<?php // echo $this->uniqueId . '/' . $this->action->id;             ?></h1>
        </div>
        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-4">
                                    <a href="" class="info-tiles tiles-info">
                                        <div class="tiles-heading">
                                            <div class="text-center">DONASI</div>
                                        </div>
                                        <div class="tiles-body no-bdr-radius">
                                            <div style="text-align: center;">
                                                <span style="font-weight:normal;padding-right:10px">Rp</span>
                                                <?php echo number_format($total_donation,0,",","."); ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="" class="info-tiles tiles-danger">
                                        <div class="tiles-heading">
                                            <div class="text-center">PENGELUARAN</div>
                                        </div>
                                        <div class="tiles-body no-bdr-radius">
                                            <div style="text-align: center;">
                                                <span style="font-weight:normal;padding-right:10px">Rp</span>
                                                <?php echo number_format($total_expenditure,0,",","."); ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="" class="info-tiles tiles-green">
                                        <div class="tiles-heading">
                                            <div class="text-center">SALDO SAAT INI</div>
                                        </div>
                                        <div class="tiles-body no-bdr-radius">
                                            <div style="text-align: center;">
                                                <span style="font-weight:normal;padding-right:10px">Rp</span>
                                                <?php echo number_format(($total_donation - $total_expenditure),0,",","."); ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-bottom">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Kas Keluar</h2>
                            </div>
                            <div class="panel-body c-combined-form">
                                <div class="clear"></div>
                                <p>
                                    Berikut ini informasi Santri yang disajikan secara mendetail.
                                    Untuk memperbarui data santri, klik pada bagian
                                    kolom data yang ingin diperbarui selanjutnya
                                    isi dengan data baru. Setelah selesai memperbarui
                                    data, klik tombol simpan yang terletak di sebelah
                                    kanan kolom atau klik batal untuk membatalkan perubahan.
                                </p>
                                <div class="span-alert"> </div>
<!--                                <ul class="nav nav-tabs">
                                    <li class="active c-step edit c-step-first" data-tab="data-donasi"><a>Donasi</a></li>
                                    <li class="c-step edit" data-tab="data-pengeluaran"><a>Pengeluaran</a></li>
                                </ul>-->
                                <?php echo $this->renderPartial('_Pengeluaran', array('model_expenditure' => $model_expenditure, 'model_add' => $model_expenditure_add, 'hide' => 0, 'year_sequence_expenditure'=>$year_sequence_expenditure, 'last_year_expenditure'=>$last_year_expenditure, 'last_month_expenditure'=>$last_month_expenditure, 'page_expenditure'=>$page_expenditure)); ?>
                                <!--</form>-->
                            </div>                            
                        </div>
                    </panel>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!--wrap -->
</div>
<footer role="contentinfo" ng-show="!layoutLoading" class="">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li>SPOTKY © <?php echo date('Y', time()) ?></li>
        </ul>
        <button class="pull-right btn btn-default btn-sm hidden-print" back-to-top="" style="padding: 1px 10px;"><i class="fa fa-angle-up"></i></button>
    </div>
</footer>