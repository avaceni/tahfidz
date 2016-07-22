<li>
    <i class="icon-m-menu left"></i>
    <?php echo CHtml::tag("div", array("class"=>"left"));?>
    <?php echo CHtml::link(CHtml::encode(ucfirst($data->title)), array('menu/view', 'id'=>$data->id), array("class"=>"title")); ?>
    <?php echo "URL : ".$data->url;?>
    <?php echo CHtml::closeTag("div");?>
    <div class="clear"></div>
</li>