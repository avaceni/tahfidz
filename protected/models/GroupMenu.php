<?php

/**
 * This is the model class for table "cklt_group_menu".
 *
 * The followings are the available columns in table 'cklt_group_menu':
 * @property string $id
 * @property string $group_id
 * @property string $menu_id
 * @property string $path
 * @property string $parent_id
 *
 * The followings are the available model relations:
 * @property Group $group
 * @property Menu $menu
 */
class GroupMenu extends CActiveRecord {

    private $dataMenu;
    public $arrMenu;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GroupMenu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_group_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('group_id, menu_id', 'required'),
            array('parent_id', 'numerical', "integerOnly" => true),
            array('group_id, menu_id', 'length', 'max' => 11),
            array('group_id', 'uniqueGroupMenu'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, group_id, menu_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'menu' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
            'parent' => array(self::BELONGS_TO, 'GroupMenu', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'group_id' => 'Group Name',
            'menu_id' => 'Menu',
            'parent_id' => 'Parent Name',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('group_id', $this->group_id, true);
        $criteria->compare('menu_id', $this->menu_id, true);
        $criteria->order = "path";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

//    dibuat oleh rizqi, 11-04-2014
//    digunakan untuk mendapatkan list menu
    public function findListMenuByGroup($group_id) {
        $arrMenu = array();
        $model = Menu::model()->with(array(
                    "group_menu" => array(
                        "select" => "menu_id",
                        "alias" => "gm",
                        "on"=>"group_id = $group_id"
                    ),
                ))->findAll(array(
            "select" => "title,url,parent_id,id,icon"
        ));

        foreach ($model as $menu) {
            $arrMenu[] = array(
                "id" => $menu->id,
                "parent_id" => $menu->parent_id,
                "title" => $menu->title,
                "url" => $menu->getUrl(),
                "icon" => $menu->icon,
                "is_selected" => count($menu->group_menu)
            );
        }
        return $arrMenu;
    }

//    dibuat oleh rizqi, 11-04-2014
//    digunakan untuk mendapatkan anak menu
    private function getListChild($parent) {
        $filterd = array_filter($this->arrMenu, function($val)use($parent) {
            return $val["parent_id"] == $parent;
        });
        return $filterd;
    }

//    dibuat oleh rizqi, 11-04-2014
//    digunakan untuk mencetak menu
    public function printTreeMenu($parent) {
        $filtered = $this->getListChild($parent);
        foreach ($filtered as $filter) {
            $id = $filter["id"];
            $label = $filter["title"];
            $url = $filter["url"];
            $isSelected = $filter["is_selected"];
            echo CHtml::openTag("li", array());
            echo CHtml::openTag("a", array());
            echo CHtml::checkBox('ids[]', ($isSelected == 0)?false:true, array('class' => 'treeview-checkbox', 'value' => $id));
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

//    validasi unique menu pada suatu group
    public function uniqueGroupMenu($params, $attribute) {
        $model = $this->model()->findByAttributes(array(
            "group_id" => $this->group_id,
            "menu_id" => $this->menu_id,
        ));
        if (isset($model)) {
            $this->addError('menu_id', 'This menu has been used by this user');
        }
    }

//    dialakukan setelah validasi dan sebelum save
    public function beforeSave() {
        $child = $this->model()->countByAttributes(array(
            "parent_id" => $this->parent_id
        ));
        $path_temp = "$this->parent_id$child";
        $this->path = ($this->parent_id != 0) ? $path_temp : $this->parent_id;
        return true;
    }

//    mendapatkan 
    public function listParentAutoComplete($groupId) {
        $result = array();
        $criteria = new CDbCriteria;
        $criteria->compare('group_id', $groupId);
        $criteria->select = "id";
        $criteria->with = array(
            "menu" => array(
                "select" => "menu.title"
        ));

        $model = GroupMenu::model()->findAll($criteria);
//        array(
//            "select"=>"id",
//            "condition"=>"group_id = $groupId",
        foreach ($model as $groupMenu) {
            $result[] = array(
                "id" => $groupMenu->id,
                "value" => $groupMenu->menu->title,
            );
        }
        return $result;
    }

}
