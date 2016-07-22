<li>
    <i class="icon-m-user left"></i>
    <?php echo CHtml::tag("div", array("class"=>"left"));?>
    <?php echo CHtml::link(CHtml::encode(ucfirst($data->full_name)), array('user/view', 'id'=>$data->id), array("class"=>"title")); ?>
    <?php echo "Join With Group : ".$data->group->name;?>
    <?php echo CHtml::closeTag("div");?>
    <div class="clear"></div>
</li>