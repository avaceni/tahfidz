<?php
$modules = Module::model()->listModules();
?>
<ul>
    <?php
    echo CHtml::openTag("li", array('name' => '', 'key' => ''));
    echo CHtml::openTag("a", array());
    echo CHtml::openTag("i", array("class" => "icon-folder-o"));
    echo CHtml::closeTag("i");
    echo "<span> No Module </span>";
    echo CHtml::closeTag("a");
    echo CHtml::closeTag("li");
    foreach ($module_model as $module) {
        echo CHtml::openTag("li", array('name' => $module->name, 'key' => $module->id));
        echo CHtml::openTag("a", array());
        echo CHtml::openTag("i", array("class" => "icon-folder-o"));
        echo CHtml::closeTag("i");
        echo "<span> $module->name </span>";
        echo CHtml::closeTag("a");
        echo CHtml::closeTag("li");
    }
    ?>
</ul>   