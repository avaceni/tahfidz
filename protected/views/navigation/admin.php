<div class="col-25-percentage">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h3 class="panel-title">Group</h3>
            <p>
                Select group to view menu of group
            </p>
        </div>
        <div class="panel-body">
            <?php echo CHtml::dropDownList('group', '', Group::model()->listGroups(), array('id' => 'navigation-group-filter', 'class' => 'input-width-100', 'prompt' => ' - Select Group -')) ?>
        </div>
    </div>
</div>

<div class="col-25-percentage">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Module</h3>
            <p>
                Select group to view menu of group
            </p>
        </div>
        <div class="panel-body">
            <div class="treeview" id="navigation-treeview-module-list">
                <?php $this->renderPartial('_tree_module', array('module_model' => $module_model)); ?>
            </div>
        </div>
    </div>
</div>

<div class="col-25-percentage">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Controller</h3>
            <p>
                Select group to view menu of group
            </p>
        </div>
        <div class="panel-body">
            <div class="treeview" id="navigation-treeview-controller-list">
                No navigation selected.
            </div>
        </div>
    </div>
</div>

<div class="col-25-percentage">
    <div class="panel panel-default">
        <form>
            <div class="panel-heading">
                <div class="right">
                    <div class="btn-group">
                        <a class="button-submit btn" id="navigation-create" url="<?php echo Yii::app()->createUrl('/navigation/create') ?>">
                            <i class="icon-plus"></i>
                        </a>
                        <a class="button-submit btn" id="navigation-update"url="<?php echo Yii::app()->createUrl('/navigation/update') ?>">
                            <i class="icon-pencil"></i>
                        </a>
                        <a class="button-danger btn" url="<?php echo Yii::app()->createUrl('/navigation/delete') ?>">
                            <i class="icon-trash-o"></i>
                        </a>
                    </div>
                </div>
                <h3 class="panel-title">Navigation</h3>
                <p>
                    Select group to view menu of group
                </p>
            </div>
            <div class="panel-body">
                <div class="treeview" id="navigation-list">
                    No controller selected.
                </div>
            </div>
        </form>
    </div>
</div>