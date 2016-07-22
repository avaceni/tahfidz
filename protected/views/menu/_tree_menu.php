<?php
/* @var $menu_model Menu */
$menu_model->arrMenu = $menu_model->findListMenu();
?>

<ul>
    <?php $menu_model->printTreeMenu(0);?>
</ul>