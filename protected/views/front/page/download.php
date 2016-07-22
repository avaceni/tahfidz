<div class="body" id="download">
    <div class="select-option" id=""></div>                        
    <div class="select-keyword" id=""></div>
    <div class="last-offset" id="20"></div>
    <div class="container">
        <div class="wrapper-content">
            <div class="content">
                <div class="clearfix">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'com-form-download',
                        'enableAjaxValidation' => true,
                         'htmlOptions'=>array(
                         'onsubmit'=>"return false;",
                         'onkeypress'=>" if(event.keyCode == 13){ searchDownload(); } "
                                 ),
                            //<!--'htmlOptions' => array('enctype' => 'multipart/form-data')-->,
                    ));
                    ?>
                    <?php /*
                      <select id="Download_type" name="Download[option]">
                      <option value="">Pilih Pencarian</option>
                      <option value="ustadz">Ustadz</option>
                      <option value="tema">Tema</option>
                      </select>
                     */ ?>
                    <input id="Download_keyword" type="text" maxlength="255" name="Download[keyword]" placeholder="Cari File" onkeypress="searchDownload();">
                    <?php echo CHtml::Button('Cari', array('onclick' => 'searchDownload();')); ?>
                    <?php $this->endWidget(); ?>                
                </div>
                <div class="table-box">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th colspan="2">Tema</th>
                            <th>Oleh</th>
                            <th>Tanggal</th>
                            <th>Size</th>
                            <th>Download</th>
                        </tr>
                        <?php
                        $ip = 1;
                        foreach ($download_list as $download) {
                            $path_info = pathinfo($download->url);
                            $file_extension = pathinfo($download->url, PATHINFO_EXTENSION);
                            $file_icon = $file_extension == 'mp3' ? 'audio' : 'file';
                            ?>
                            <tr>
                                <td><?php echo $ip ?></td>
                                <td><span class="<?php echo $file_icon ?>" title=""></span></td>
                                <td><a href="<?php echo Yii::app()->baseUrl . $download->url ?>" class="title" onclick="return countDownload(<?php echo $download->id ?>);"><?php echo $download->title ?></a></td>
                                <td><a href="" class="author"><?php echo $download->author ?></a>
                                    <!--<a href='javascript:void(0);' onclick='return countDownload(225)'>check</a></td>-->
                                <td><?php echo Utility::getDateFormat2($download->created_time) ?></td>
                                <td><?php echo Utility::getHumanReadableFilesize(filesize($_SERVER["DOCUMENT_ROOT"] . Yii::app()->baseUrl . $download->url)) ?></td>
                                <td><a href="<?php echo Yii::app()->baseUrl . $download->url ?>" class="download" onclick="return countDownload(<?php echo $download->id ?>);"></a></td>
                            </tr>
                            <?php
                            $ip++;
                        }
                        ?>
                    </table>
                </div>
                <div class="button-box download-loader">
                    <a href="javascript:void(0);" class="button medium">Load More</a>
                    <span class="loader"></span>
                </div>
            </div>
            <div class="sidebar">
                <div class="widget-box download">
                    <h4>Download Terpopuler</h4>
                    <ul>
                        <?php
                        foreach ($download_popular as $download) {
                            $path_info = pathinfo($download->url);
                            $file_extension = pathinfo($download->url, PATHINFO_EXTENSION);
                            $file_icon = $file_extension == 'mp3' ? 'audio' : 'file';
                            ?>                                                                    
                            <li>
                                <div class="file-detail-box">
                                    <span class="file-type <?php echo $file_icon ?>"></span>
                                    <div class="file-name">
                                        <a href="<?php echo Yii::app()->baseUrl . $download->url ?>" class="title" onclick="return countDownload(<?php echo $download->id ?>);"><?php echo $download->title ?></a>
                                        <?php echo $download->author ?>
                                    </div>
                                </div>
                                <p class="meta"><span><?php echo $download->total_download ?> downloads</span><a href="<?php echo Yii::app()->baseUrl . $download->url ?>" class="download" onclick="return countDownload(<?php echo $download->id ?>);"></a></p>
                            </li>
                            <?php
                        }
                        ?>                        
                    </ul>
                </div>
                <div class="widget-box magazine">
                    <h4>Swaraikadi Magazine</h4>
                    <?php
                    foreach ($magazine as $content) {
                        ?>
                       <a class="image-box" href="<?php echo Yii::app()->baseUrl . $content->url ?>" onclick="return countDownload(<?php echo $content->id ?>);">
                            <img src="<?php echo Yii::app()->baseUrl . $content->cover_image ?>" alt="#">
                        </a>
                        <?php
                        break;
                    }
                    ?>
                    <ul>
                        <?php
                        foreach ($magazine as $content) {
                            ?>
                            <li><a href="<?php echo Yii::app()->baseUrl . $content->url ?>" onclick="return countDownload(<?php echo $content->id ?>);"><?php echo $content->title ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>

                    <div class="button-box">
                        <a href="<?php echo Yii::app()->createUrl("front/page/download"); ?>" class="button medium">Arsip</a>
                    </div>
                </div>
                <?php /*
                <div class="widget-box donate">
                    <h4>Rekening Donasi</h4>
                    <div class="donate-detail">
                        <img src="<?php echo Yii::app()->baseUrl . $bank->bank_logo ?>">
                        <b><?php echo $bank->bank_name ?></b>
                        <span><i>No. Rek.</i><strong><?php echo $bank->account_number ?></strong></span>
                        <b>a/n <?php echo $bank->account_name ?></b>
                    </div>
                </div>
                */?>
                <div class="widget-box fanpage">
                    <div class="fb-like-box" data-href="https://www.facebook.com/swaraikadi" data-width="100%" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
                </div>
            </div>
        </div>
    </div>
</div>