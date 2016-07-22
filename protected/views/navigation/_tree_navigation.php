<ul>
    <?php foreach ($navigation_model as $navigation){?>
    <li key="<?php echo $navigation->id;?>">
        <a>
            <input type="checkbox" class="treeview-checkbox">
            <i class="<?php echo $navigation->icon;?>"></i>
            <span><?php echo $navigation->name;?></span>
        </a>
    </li>
    <?php }?>
</ul>