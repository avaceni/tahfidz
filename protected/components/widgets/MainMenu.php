<?php

class MainMenu extends CWidget {

    private $arrMenu = array();
    private $requestUrl;

    public function init() {
        
    }

    public function run() {
        $this->requestUrl = $this->generateCurrentUrl(strtolower($_SERVER['REQUEST_URI']));

        $this->renderView();
    }

//    untuk mendapatkan module/controller saja
    private function generateCurrentUrl($url) {
        $url = substr($url, 0);
        $splitUrl = explode("/", $url);
        $lengthSplitUrl = count($splitUrl);
        unset($splitUrl[$lengthSplitUrl - 1]);

        return implode("/", $splitUrl);
    }

    private function renderView() {
        $this->arrMenu = $this->readMenu(Yii::app()->user->group);
        echo CHtml::tag("ul", array("class" => "link", 'id'=>'sidebar'));
        $this->printMenu(0);
        echo CHtml::closeTag("ul");
    }

    private function reChild($parent) {
        $filterd = array_filter($this->arrMenu, function($val)use($parent) {
            return $val["parent_id"] == $parent;
        });
        return $filterd;
    }

    private function readMenu($group_id) {
        $arrMenu = array();
        $model = GroupMenu::model()->with(array(
                    "menu" => array(
                        "select" => "title,url,parent_id,id,icon,separator_group,module_id"
                    ),
                    "menu.modul" => array(
                        "select" => "name"
                    ),
                ))->findAll(array(
//            "select"=>"id,parent_id",
            "select" => "id",
            "order" => "separator_group ASC, menu.order ASC",
            "condition" => "group_id = $group_id"
        ));

        foreach ($model as $menu) {
            $arrMenu[] = array(
                "id" => $menu->menu->id,
                "parent_id" => $menu->menu->parent_id,
                "title" => $menu->menu->title,
                "url" => $menu->menu->getUrl(),
                "icon" => $menu->menu->icon,
                "separator_group" => $menu->menu->separator_group,
                "modul_name" => !(empty($menu->menu->modul))?$menu->menu->modul->name:'',
            );
        }
        return $arrMenu;
    }

    private function printMenu($parent) {
        $filtered = $this->reChild($parent);
        $separator = array();
        foreach ($filtered as $filter) {
            $id = $filter["id"];
            $label = $filter["title"];
            $url = $filter["url"];
            if(!array_key_exists($filter["separator_group"],$separator)){
                $separator[$filter["separator_group"]] = (new Menu())->getSeparatorName($filter["separator_group"]);
                $separator_tag = <<<EOF
                <li class='nav-separator'>
                    <span>{$separator[$filter["separator_group"]]}</span>
                </li>
EOF;
                echo $separator_tag;
            }
            
            $class = '';
            $module = !empty(Yii::app()->controller->module)?Yii::app()->controller->module->id:'none';
            if($module == 'keuangan' && Yii::app()->controller->id == 'data'){                
                if($filter["title"] == 'Kas Masuk' && Yii::app()->controller->action->id == 'donation'){
                    $class = 'active';
                }
                elseif($filter["title"] == 'Kas Keluar' && Yii::app()->controller->action->id == 'expenditure'){
                    $class = 'active';
                }
                elseif($filter["title"] == 'Donasi Barang' && Yii::app()->controller->action->id == 'goods'){
                    $class = 'active';
                }                
            }
            elseif($filter["modul_name"] == $module){
                $class = 'active';
            }
            elseif (strtolower ($filter["title"])=='dashboard' && Yii::app()->controller->id == 'adminck' && Yii::app()->controller->action->id == 'dashboard') {
                $class = 'active';    
            }
            
//            echo CHtml::openTag("li", array("class" => (strtolower($this->generateCurrentUrl($url)) == $this->requestUrl) ? "active" : ""));
            echo CHtml::openTag("li", array("class" => $class));
            echo CHtml::tag("a", array("href" => $url));
            echo CHtml::openTag("i", array("class" => $filter["icon"]));
            echo CHtml::closeTag("i");
            echo "<span>$label</span>";
            echo CHtml::closeTag("a");
            $count = count($this->reChild($id));
            if ($count > 0) {
                echo CHtml::tag("ul", array("class" => "dropdown-menu"));
                $this->printMenu($id);
                echo CHtml::closeTag("ul");
            }
            echo CHtml::closeTag("li");
        }
        $myProfile = Yii::app()->createAbsoluteUrl('User/myprofile');
        $changePassword = Yii::app()->createAbsoluteUrl('User/changepassword');        
        $profile = <<<EOF
            <li class="">
                <a ng-click="showProfile()">Edit Profile
                    <i class="pull-right glyphicon glyphicon-user"></i>
                </a>
            </li>
            <li class="">
                <a ng-click="showPassword()">Ganti Password
                    <i class="pull-right glyphicon glyphicon-cog"></i>
                </a>
            </li>                
EOF;
        echo $profile;
    }

}

?>
