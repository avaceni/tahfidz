<li>
    <i class="icon-list left"></i>
    <?php echo CHtml::tag("div", array("class"=>"left"));?>
    <?php echo CHtml::link(CHtml::encode(ucfirst($data->name)), array('view', 'id'=>$data->id), array("class"=>"title")); ?>
    Admin Edit, Admin Create, Admin Delete
    <?php echo CHtml::closeTag("div");?>
    <div class="clear"></div>
</li>