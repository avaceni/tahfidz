<li>
    <i class="icon-m-group left"></i>
    <?php echo CHtml::tag("div", array("class"=>"left"));?>
    <?php echo CHtml::link(CHtml::encode(Utility::toGeneral($data->name)), array('group/view', 'id'=>$data->id), array("class"=>"title")); ?>
    <?php echo "This Group Has Template : ".$data->template->name;?>
    <?php echo CHtml::closeTag("div");?>
    <div class="clear"></div>
</li>