<?php

/**
 * This is the model class for table "cklt_menu".
 *
 * The followings are the available columns in table 'cklt_menu':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $parameter
 * @property string $icon
 * @property string $order
 * @property string $aktif
 * @property string $parent_id
 */
class Menu extends CActiveRecord {

    public $arrMenu;
    public $moduleUrl;
    public $controllerUrl;
    public $actionUrl;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, parent_id', 'required'),
            array('title', 'unique'),
            array('title, parameter,order', 'length', 'max' => 21),
            array('separator_group, module_id', 'numerical', 'integerOnly'=>true),
            array('url', 'length', 'max' => 71),
            array('icon', 'length', 'max' => 51),
            array('aktif', 'length', 'max' => 1),
            array('order', 'length', 'max' => 4),
            array('moduleUrl,controllerUrl,actionUrl', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, url, parameter, aktif, separator_group, module_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            "group_menu" => array(self::HAS_MANY, "GroupMenu", "menu_id"),
            'separator' => array(self::BELONGS_TO, 'MenuSeparator', 'separator_group'),
            'modul' => array(self::BELONGS_TO, 'Module', 'module_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'Url',
            'parameter' => 'Parameter',
            'icon' => 'Icon',
            'aktif' => 'Aktif',
            'order' => 'Order',
            'separator_group' => 'Separator Group',
            'module_id' => 'Module',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('parameter', $this->parameter, true);
        $criteria->compare('aktif', $this->aktif, true);
        $criteria->compare('separator_group',$this->separator_group);
        $criteria->compare('order',$this->order);
        $criteria->compare('module_id',$this->module_id);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
//    dilakukan sebelum save dan validasi
    protected function beforeValidate() {
        if(!isset($this->parent_id))
            $this->parent_id = 0;
//        memberikan nilai default icon
        if($this->icon == null)
            $this->icon = 'icon-caret-right';
//        memberikan nilai default untuk order menu
        if($this->order == null)
            $this->order = 0;
        if(isset($this->controllerUrl) && isset($this->actionUrl))
            $this->url = (strlen ($this->moduleUrl)>0)?$this->moduleUrl.'/'.$this->controllerUrl.'/'.$this->actionUrl:$this->controllerUrl.'/'.$this->actionUrl;
        return true;
    }

    public function listAutoComplete() {
        $result = array();
        $model = Menu::model()->findAll(array(
            "select" => "id,title",
            "order" => "title"
        ));
        foreach ($model as $menu) {
            $result[] = array(
                "id" => $menu->id,
                "value" => $menu->title,
            );
        }
        return $result;
    }

//    dibuat oleh rizqi, 26-01-2014
//    untuk mendapatkan nilai title
    public function getId() {
        return $this->id;
    }

//    dibuat oleh rizqi, 26-01-2014
//    untuk mendapatkan nilai title
    public function getParentId() {
        return $this->parent_id;
    }

//    dibuat oleh rizqi, 26-01-2014
//    untuk mendapatkan nilai title
    public function getTitle() {
        return $this->title;
    }

//    dibuat oleh rizqi, 26-01-2014
//    untuk mendapatkan icon
    public function getIcon() {
        return $this->icon;
    }

//    dibuat oleh rizqi, 26-01-2014
//    untuk mendapatkan nilai url
    public function getUrl() {
        if ($this->url == '' || $this->url == '#' || $this->url == '-' || $this->url == 'javascript:void(0);')
            return 'javascript:void(0);';
        else
            return Yii::app()->createUrl($this->url);
    }

//    dibuat oleh rizqi, 12-04-2014
//    untuk mendapatkan nilai module url
    public function getModuleUrl() {
        if (strlen($this->url) > 0) {
            $explodeUrl = explode('/', $this->url);
            if (count($explodeUrl) > 2)
                $this->moduleUrl = $explodeUrl[0];
        }
        return $this->moduleUrl;
    }

//    dibuat oleh rizqi, 12-04-2014
//    untuk mendapatkan nilai controller url
    public function getControllerUrl() {
        if (strlen($this->url) > 0) {
            $explodeUrl = explode('/', $this->url);
            if (count($explodeUrl) > 2)
                $this->controllerUrl = $explodeUrl[2];
            else if (count($explodeUrl) > 0)
                $this->controllerUrl = $explodeUrl[1];
        }
        return $this->controllerUrl;
    }

//    dibuat oleh rizqi, 12-04-2014
//    untuk mendapatkan action url
    public function getActionUrl() {
        if (strlen($this->url) > 0) {
            $explodeUrl = explode('/', $this->url);
            if (count($explodeUrl) > 2)
                $this->actionUrl = $explodeUrl[3];
            else if (count($explodeUrl) > 0)
                $this->controllerUrl = $explodeUrl[2];
        }
        return $this->actionUrl;
    }

//    dibuat oleh rizqi, 11-04-2014
//    digunakan untuk mendapatkan list menu
    public function findListMenu() {
        $arrMenu = array();
        $model = $this->findAll(array(
            "select" => "id, title, url, icon, parent_id"
        ));

        foreach ($model as $menu) {
            $arrMenu[] = array(
                "id" => $menu->getId(),
                "parent_id" => $menu->getParentId(),
                "title" => $menu->getTitle(),
                "url" => $menu->getUrl(),
                "icon" => $menu->getIcon(),
            );
        }
        return $arrMenu;
    }

//    dibuat oleh rizqi, 11-04-2014
//    digunakan untuk mendapatkan anak menu
    private function getListChild($parent) {
        $filtered = array_filter($this->arrMenu, function($val)use($parent) {
            return $val["parent_id"] == $parent;
        });
        return $filtered;
    }

//    dibuat oleh rizqi, 11-04-2014
//    digunakan untuk mencetak menu
    public function printTreeMenu($parent) {
        $filtered = $this->getListChild($parent);
        foreach ($filtered as $filter) {
            $id = $filter["id"];
            $label = $filter["title"];
            $url = $filter["url"];
            echo CHtml::openTag("li", array());
            echo CHtml::openTag("a", array());
            echo CHtml::checkBox('ids[]', false, array('class' => 'treeview-checkbox', 'value' => $id));
            echo CHtml::openTag("i", array("class" => $filter["icon"]));
            echo CHtml::closeTag("i");
            echo "<span> $label </span>";
            echo CHtml::closeTag("a");
            $count = count($this->getListChild($id));
            if ($count > 0) {
                echo CHtml::openTag("ul", array("class" => "child"));
                $this->printTreeMenu($id);
                echo CHtml::closeTag("ul");
            }
            echo CHtml::closeTag("li");
        }
    }
    
    public function getSeparatorName($id){
        $separator = '';
        $model = MenuSeparator::model()->findByPk($id);
        if(!empty($model)){
            $separator = $model->separator_name;
        }
        return $separator;
    }

}
