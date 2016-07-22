<div class="col-100-percentage">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Icon</h3>
            <p>
                Dibawah ini adalah icon yang disediakan untuk beberapa pengolahan yaitu pada kelola menu. kelola navigasi dll.
            </p>
        </div>
        <div class="panel-body">
            <?php 
            foreach ($icon_model as $icon)
                echo "<div style='height: 63px;' class='col-10-percentage text-align-center '><i class='icon-lg $icon->class'></i><span>$icon->class</span></div>";
            ?>
            <div class="clear"></div>
        </div>
    </div>
</div>