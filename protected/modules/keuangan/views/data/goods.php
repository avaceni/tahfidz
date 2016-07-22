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
            <h1>Donasi Barang<?php // echo $this->uniqueId . '/' . $this->action->id;             ?></h1>
        </div>
        <div class="container-fluid ng-scope">
            <div class="row">
                <div class="col-xs-12">
                    <panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
                        <div class="panel panel-bottom">
                            <div class="panel-heading">
                                <h2 class="ng-binding">Donasi Barang</h2>
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
                                </ul>-->
                                <?php echo $this->renderPartial('_DonasiBarang', array('model_donation' => $model_donation, 'model_add' => $model_donation_add, 'year_sequence_donation' => $year_sequence_donation, 'last_year_donation'=>$last_year_donation, 'last_month_donation'=>$last_month_donation)); ?>
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