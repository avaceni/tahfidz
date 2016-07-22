<?php

class NavigationMenu extends CWidget {

    private $arrNavigation = array();

    public function init() {
        
    }

    public function run() {
        $this->renderView();
    }

    private function renderView() {
        $this->arrNavigation = $this->readNavigation();
        echo CHtml::tag("div", array("class" => "right"));
        echo CHtml::tag("div", array("class" => "btn-group"));
        $this->printNavigation();
        echo CHtml::closeTag("div");
        echo CHtml::closeTag("div");
    }

    private function readNavigation() {
        $module = isset(Yii::app()->controller->module->id) ? "module.name='" . Yii::app()->controller->module->id . "'" : "";
        $controller = isset(Yii::app()->controller->id) ? "AND controller='" . Yii::app()->controller->id . "'" : "";
        $action = isset(Yii::app()->controller->action->id) ? trim(Yii::app()->controller->action->id) : "";

        if ($action != '')
            $actionCondition = "AND (action LIKE '$action' OR action LIKE '%,$action' OR action LIKE '%,$action,%' OR action LIKE '$action,%')";

        $arrNavigation = array();
        $model = array();
        if (isset(Yii::app()->user->group)) {
            $model = Navigation::model()->with(array(
                        "module" => array(
                            "condition" => "$module",
                        )
                    ))->findAll(array(
                "select" => "t.name,params,link,link_type,class,icon",
                "condition" => "t.group_id=" . Yii::app()->user->group . " $controller $actionCondition"
            ));
        }
        foreach ($model as $navigation) {
            $arrNavigation[] = array(
                "title" => $navigation->name,
                "link" => $navigation->link,
                "link_type" => $navigation->link_type,
                "class" => $navigation->class,
                "params" => $navigation->params,
                "alias" => $navigation->alias,
                "icon" => $navigation->icon
            );
        }
        return $arrNavigation;
    }

    private function printNavigation() {
        foreach ($this->arrNavigation as $navigation) {
            $link = $navigation["link"];
            $params = Utility::generateUrl($navigation['params']);
            $content = "<i class='{$navigation["icon"]}'></i> <span>{$navigation["title"]}</span>";
            if ($navigation["link_type"] == "link")
                echo CHtml::link($content, Yii::app()->createUrl($link, $params), array("class" => "btn-default btn " . $navigation["class"]));
            else if ($navigation["link_type"] == "ajax_link")
                echo CHtml::ajaxLink($content, array(Yii::app()->createUrl($link, $params)), array("class" => "btn-default btn " . $navigation["class"]));
            else if ($navigation["link_type"] == "submit_link")
                echo CHtml::link($content, "javascript:void(0);", array("class" => "btn-default btn " . $navigation["class"], "url" => Yii::app()->createUrl($link)));
            else if ($navigation["link_type"] == "blank_link")
                echo CHtml::link($content, "javascript:void(0);", array("class" => "btn-default btn " . $navigation["class"]));
        }
    }

}

?>
