<div class="body detail-view" id="info">
    <div class="container">
        <div class="wrapper-content">
            <div class="content">
                <div class="schedule-box">
                    <h4>Kajian Rutin</h4>
                    <ul id="schedule-detail" class="form-format text">
                        <?php foreach($model_routine as $routine){?>
                        <li>
                            <label><?php echo $routine->getEvery()?></label>
                            <div class="data">
                                <ul>
                                    <li>
                                        <p class="content-info"><?php echo $routine->getProgram()?></p>
                                        <p class="meta"><span class="time"><?php echo $routine->getTimeStart()?> - <?php echo $routine->getTimeEnd()?></span><span>bersama</span><a href="" class="author"><?php echo $routine->getEvery()?></a></p>
                                        <p class="content-info place"><?php echo $routine->getPlace()?> | <?php echo $routine->getContactPerson()?></p>
                                        <p class="content-info detail"><?php echo $routine->getAddress()?></p>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
                    <!-- <div class="button-box">
                            <a href="" class="button basic">Load More</a>
                    </div> -->
                </div>
            </div>
            <div class="sidebar">
                <div class="widget-box info">
                    <h4>Info Kajian Terdekat</h4>
                    <a class="image-box" href="#">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/resource/kajian.jpg" alt="#">
                    </a>
                    <ul>
                        <li>
                            <a href="#">Typi non habent claritatem insitamest usus legentis in iis qui facit eorum</a>
                            <p class="meta"><span class="date">12 Januari 2014</span><a href="" class="comment">14</a></p>
                        </li>
                        <li>
                            <a href="#">Typi non habent claritatem insitamest usus legentis in iis qui facit eorum</a>
                            <p class="meta"><span class="date">12 Januari 2014</span><a href="" class="comment">14</a></p>
                        </li>
                        <li>
                            <a href="#">Typi non habent claritatem insitamest usus legentis in iis qui facit eorum</a>
                            <p class="meta"><span class="date">12 Januari 2014</span><a href="" class="comment">14</a></p>
                        </li>
                    </ul>
                    <div class="button-box">
                        <a href="#" class="button medium">Arsip</a>
                    </div>
                </div>
                <div class="widget-box donate">
                    <h4>Rekening Donasi</h4>
                    <div class="donate-detail">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/resource/mandiri.jpg">
                        <b>BSM Cabang Sleman</b>
                        <span><i>No. Rek.</i><strong>7000347447</strong></span>
                        <b>a/n IKADI Yogyakarta</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>