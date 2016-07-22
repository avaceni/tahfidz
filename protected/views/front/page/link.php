<div class="body" id="link">
    <div class="container">
        <div class="wrapper-content">
            <div class="content detail-view">
                <div class="guide-box"><h1>Link Rekanan</h1></div>
                <?php echo $content->content?>
            </div>
            <div class="sidebar">
                <div class="widget-box magazine">
                    <h4>Swaraikadi Magazine</h4>
                    <a class="image-box" href="#">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/resource/magazine.jpg" alt="#">
                    </a>
                    <ul>
                        <li><a href="#">Edisi Januari 2014</a></li>
                        <li><a href="#">Edisi Desember 2013</a></li>
                        <li><a href="#">Edisi November 2013</a></li>
                        <li><a href="#">Edisi Oktober 2013</a></li>
                        <li><a href="#">Edisi September 2013</a></li>
                        <li><a href="#">Edisi Agustus 2013</a></li>
                    </ul>
                    <div class="button-box">
                        <a href="#" class="button medium">Arsip</a>
                    </div>
                </div>
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