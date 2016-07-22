<?php
$model = Menu::model()->findGroupUnselectedMenu($groupId);
//echo $model;
echo CHtml::openTag("ul", array('class'=>'side-tab overflow-auto', 'style'=>'height: 655px'));
foreach ($model as $menu){
    echo CHtml::openTag("li");
    echo CHtml::link($menu->title, "javascript:void(0);");
    echo CHtml::closeTag("li");
}
echo CHtml::closeTag("ul")
?>