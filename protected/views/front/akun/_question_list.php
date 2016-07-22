<?php foreach ($aq_model as $aq) { ?> 
    <li key="<?php echo $aq->id; ?>" id="question-list">
        <a href="javascript:void(0);" class="delete"><i class="icon-trash"></i></a>
        <a href="javascript:void(0);">
            <span>
                <span><b><?php echo $aq->name; ?></b></span>
                <?php echo $aq->getQuestion(); ?>
            </span>
        </a>
    </li>
<?php } ?>