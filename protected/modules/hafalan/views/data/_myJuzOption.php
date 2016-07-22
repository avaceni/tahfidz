<?php
    echo CHtml::dropDownList("MutabaahTahfidz[setoran_juz]", '', $array_option,
    array('data-url' => Yii::app()->createAbsoluteUrl('hafalan/data/getmyjuzoption') , 'class' => 'form-control c-recitation-type'));
?>