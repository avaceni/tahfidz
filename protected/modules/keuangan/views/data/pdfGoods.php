<div style="font-family: sans-serif">
    <div style="text-align: center">
        <p>
            Berikut ini daftar <b><span style="font-size: 16px; font-weight: bold">Donasi Barang</span></b>
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
        if ($model_donation) {
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => $grid_donation,
                'dataProvider' => $model_donation,
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
                        'header' => 'Nama',
                        'value' => 'ucwords($data->nama_donatur)',
                    ),
                    array(
                        'header' => 'Nama Barang',
                        'value' => '$data->nama_barang',
                    ),
                    array(
                        'header' => 'Tanggal',
                        'type' => 'raw',
                        'value' => function($data) {
                    $date = preg_replace(array('/(\w*,) (\d{1} )/', '/(\w*, )/'), array('0\2', ''), Utility::getDateFormat($data->tanggal));
                    return $date;
                },
                    ),
                    array(
                        'header' => 'Pencatat',
                        'type' => 'raw',
                        'value' => function($data) {
                    $admin = '';
                    if (!empty($data->user)) {
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
    </div>
</div>