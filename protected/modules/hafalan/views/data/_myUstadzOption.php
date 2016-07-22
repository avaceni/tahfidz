<?php

echo CHtml::dropDownList("MutabaahTahfidz[ustadz_id]", $default_key, User::getMusyrifList(),
    array('data-url' => Yii::app()->createAbsoluteUrl('hafalan/data/getmyjuzoption') , 'class' => 'form-control c-recitation-type'));
?>