<div style="font-family: sans-serif">
    <div style="text-align: center">
        <p>
            Berikut ini daftar <b><span style="font-size: 16px; font-weight: bold">Pengeluaran <?php echo $pondok ?></span></b>
            yang tersimpan dalam sistem Rumah Tahfidzqu selama    
            <span style="font-size: 16px; font-weight: bold">
                <span id="c-month-recite"><?php echo $bulan ?></span> - <span id="c-year-recite"><?php echo $tahun ?></span>.
            </span>
        </p>
        <p>

        </p>    
    </div>
    <div class="box-content">
            <?php
            if ($model_expenditure) {
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => $grid_expenditure,
                    'dataProvider' => $model_expenditure,
                    'selectableRows' => 2,
                    'itemsCssClass' => 'table table-bordered table-condensed',
                    'summaryText' => '',
                    'columns' => array(
                        array(
                            'header' => 'No',
                            'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                            'htmlOptions' => array("width" => "31px", "text-align" => "center")
                        ),
                        array(
                            'header' => 'Keperluan',
                            'value' => 'ucfirst($data->keperluan)',
                        ),
                        array(
                            'header' => 'Jumlah (Rp)',
                            'type' => 'raw',
                            'htmlOptions' => array("style" => "text-align:right;"),
                            'value' => function($data) {
                                $number_format = number_format($data->jumlah, 2, ",", ".");
                                return $number_format;
                            },
                        ),
                        array(
                            'header' => 'Tanggal',
//                            'value' => 'Utility::getDateFormat($data->tanggal);',
                            'type' => 'raw',
                            'value' => function($data) {
                                $date = preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($data->tanggal));
                                return $date;
                            },
                        ),
                        array(
                            'header' => 'Pondok',
                            'type' => 'raw',
                            'value' => function($data) {
                                $pondok = '';
                                if(!empty($data->quarters)){
                                    $pondok = ucwords($data->quarters->nama_pondok);
                                }
                                return $pondok;
                            },
                        ),
                        array(
                            'header' => 'Pencatat',
                            'type' => 'raw',
                            'value' => function($data) {
                                $admin = '';
                                if(!empty($data->user)){
                                    $admin = $data->user->full_name;
                                }
                                return $admin;
                            },
                        ),                       
                    ),
                    'pager' => array(
                        'header' => '',
                        'cssFile' => false,
                        'maxButtonCount' => 9,
                        'selectedPageCssClass' => 'active',
                        'hiddenPageCssClass' => 'hide',
                        'firstPageCssClass' => 'hide', //'previous',
                        'lastPageCssClass' => 'hide', //'next',
                        'firstPageLabel' => '<<',
                        'lastPageLabel' => '>>',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                    ),
                ));
            }
            ?>
        <table class="table table-bordered table-condensed">
    <tbody>
        <tr>
            <td>
                Jumlah Total
            </td>
            <td width="20%" style="text-align:right;" class="c-total-finance-month">
                <?php echo $month_expenditure ?>
            </td>
        </tr>
        </tbody>
    </table>            
        </div>     
</div>