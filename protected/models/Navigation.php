<?php

/**
 * This is the model class for table "cklt_navigation".
 *
 * The followings are the available columns in table 'cklt_navigation':
 * @property string $id
 * @property string $name
 * @property string $group_id
 * @property string $module_id
 * @property string $controller
 * @property string $action
 * @property string $link
 * @property string $params
 * @property string $alias
 * @property string $icon
 *
 * The followings are the available model relations:
 * @property Access $access
 * @property Module $module
 */
class Navigation extends CActiveRecord {

    public $controller;
    public $moduleUrl;
    public $controllerUrl;
    public $actionUrl;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Navigation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_navigation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, group_id, controller, alias, module_id,action,link,link_type', 'required'),
            array('name, controller, class', 'length', 'max' => 21),
            array('group_id, params', 'length', 'max' => 11),
            array('link, alias', 'length', 'max' => 31),
            array('icon', 'length', 'max' => 51),
            array('moduleUrl, controllerUrl, actionUrl', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, group_id, controller, link, params, alias, module_id,icon', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//            'access' => array(self::BELONGS_TO, 'Access', 'access_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'module' => array(self::BELONGS_TO, 'Module', 'module_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'group_id' => 'Level Name',
//            'access_id' => 'Access',
            'module_id' => 'Module Name',
            'controller' => 'Controller',
            'action' => 'Action',
            'link' => 'Link',
            'params' => 'Params',
            'alias' => 'Alias',
            'group.name' => 'Group Name',
            'link_type' => 'Link Type',
            'class' => 'Class',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('group_id', $this->group_id, true);
        $criteria->compare('controller', $this->controller, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('params', $this->params, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('module_id', $this->module_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

//    dilakukan sebelum validasi
    protected function beforeValidate() {
        if ($this->link_type == 'link') {
            if ($this->moduleUrl != '')
                $this->link = "$this->moduleUrl/$this->controllerUrl/$this->actionUrl";
            else
                $this->link = "$this->controllerUrl/$this->actionUrl";
        }
        return true;
    }

//    awal getter
//    dibuat oleh rizqi, 12-04-2014
//    untuk mendapatkan nilai module url
    public function getModuleUrl() {
        if (strlen($this->link) > 0) {
            $explodeUrl = explode('/', $this->link);
            if (count($explodeUrl) > 2)
                $this->moduleUrl = $explodeUrl[0];
        }
        return $this->moduleUrl;
    }

//    dibuat oleh rizqi, 12-04-2014
//    untuk mendapatkan nilai controller url
    public function getControllerUrl() {
        if (strlen($this->link) > 0) {
            $explodeUrl = explode('/', $this->link);
            if (count($explodeUrl) >= 2)
                $this->controllerUrl = $explodeUrl[1];
            else if (count($explodeUrl) >= 3)
                $this->controllerUrl = $explodeUrl[2];
        }
        return $this->controllerUrl;
    }

//    dibuat oleh rizqi, 12-04-2014
//    untuk mendapatkan action url
    public function getActionUrl() {
        if (strlen($this->link) > 0) {
            $explodeUrl = explode('/', $this->link);
            if (count($explodeUrl) >= 2)
                $this->actionUrl = $explodeUrl[2];
            else if (count($explodeUrl) >= 3)
                $this->controllerUrl = $explodeUrl[3];
        }
        return $this->actionUrl;
    }

//    akhir getter
}
