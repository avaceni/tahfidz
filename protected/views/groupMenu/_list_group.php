<li>
    <?php echo CHtml::link(CHtml::encode(Utility::toGeneral($data->name)), array('index', 'gid'=>$data->id), array(
        "class"=>(isset ($_GET["gid"])&& $_GET["gid"]==$data->id)?"active icon-l-group":"icon-l-group",
    )); ?>
</li>