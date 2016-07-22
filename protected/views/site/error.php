<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
    'Error',
);
?>
<?php /*
  <div class="column">
  <div class="number-error">
  <?php echo $code; ?>
  </div>
  </div>
  <div class="column">
  <h2>Afwan,</h2>
  <p>Halaman yang Anda cari tidak ditemukan.</p>
  <a href="<?php echo Yii::app()->baseUrl;?>" class="main-button">Kembali ke Halaman Utama</a>
  </div>
 */ ?>
<h2>Afwan,</h2>
<p>Halaman yang Anda cari tidak ditemukan.</p>
<a href="<?php echo Yii::app()->request->getBaseUrl(true); ?>" class="main-button">Kembali ke Halaman Utama</a>
<p><?php // echo CHtml::encode($message); ?></p>
<?php
/*
  <div class="number-error">
  </div>

  <div class="error">
  <?php echo CHtml::encode($message); ?>
  </div>
 */
?>