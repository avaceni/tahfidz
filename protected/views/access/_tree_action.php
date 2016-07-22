
<ul>
    <?php
    foreach ($action_model as $action) {
        echo CHtml::openTag("li", array());
        echo CHtml::openTag("a", array());
        echo CHtml::checkBox('ids[]', isset($selected_access[$action])?true:false, array('class' => 'treeview-checkbox', 'value' => $action));
        echo CHtml::openTag("i", array("class" => "icon-file"));
        echo CHtml::closeTag("i");
        echo "<span> $action </span>";
        echo CHtml::closeTag("a");
        echo CHtml::closeTag("li");
    }
    ?>
</ul>   
