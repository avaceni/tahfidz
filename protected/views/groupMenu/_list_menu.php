<li>
    <i class="icon-list left"></i>
    <?php echo CHtml::tag("div", array("class"=>"left"));?>
    <?php echo CHtml::link(CHtml::encode("".ucfirst($data->menu->title)), array('view', 'id'=>$data->id), array("class"=>"title")); ?>
    url : 
    <?php echo CHtml::closeTag("div");?>
    <div class="clear"></div>
</li>