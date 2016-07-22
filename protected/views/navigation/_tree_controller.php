
<ul>
    <?php
    if (count($controller_model) > 0) {
        foreach ($controller_model as $controller) {
            echo CHtml::openTag("li", array('key'=>$controller));
            echo CHtml::openTag("a", array());
            echo CHtml::openTag("i", array("class" => "icon-folder-o"));
            echo CHtml::closeTag("i");
            echo "<span> $controller </span>";
            echo CHtml::closeTag("a");
            echo CHtml::closeTag("li");
        }
    } else
        echo 'No Module selected';
    ?>
</ul>
