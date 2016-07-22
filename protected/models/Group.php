<?php

/**
 * This is the model class for table "cklt_group".
 *
 * The followings are the available columns in table 'cklt_group':
 * @property string $id
 * @property string $name
 * @property string $template_id
 * @property string $default_template_layout
 * @property string $dashboard_url
 *
 * The followings are the available model relations:
 * @property Access[] $accesses
 * @property Template $template
 * @property Navigation[] $navigations
 * @property Site[] $sites
 * @property User[] $users
 */
class Group extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Group the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('template_id,name,dashboard_url', 'required'),
            array('name', 'length', 'max' => 21),
            array('template_id', 'length', 'max' => 11),
            array('default_template_layout', 'length', 'max' => 31),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, template_id, template.name,default_template_layout', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'accesses' => array(self::HAS_MANY, 'Access', 'group_id'),
            'template' => array(self::BELONGS_TO, 'Template', 'template_id'),
            'navigations' => array(self::HAS_MANY, 'Navigation', 'group_id'),
            'sites' => array(self::HAS_MANY, 'Site', 'default_level_access'),
            'users' => array(self::HAS_MANY, 'User', 'group_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Group Name',
            'template_id' => 'Template',
            'template.name' => 'Template Name',
            'default_template_layout' => 'Default Template Layout',
            'dashboard_url' => 'Dashboard Url',
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
        $criteria->compare('template_id', $this->template_id, true);
        $criteria->compare('default_template_layout', $this->default_template_layout, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function listGroups() {
        $listGroups = array();
        $modules = $this->findAll(array(
                    "select" => "id, name",
                    "order" => "name"
                ));
        foreach ($modules as $module) {
            $listGroups[$module->id] = $module->name;
        }
        return $listGroups;
    }

    public function findAllGroup(){
        $criteria = new CDBCriteria;
        $criteria->order = "id";
        $model = $this->model()->findAll($criteria);
        return $model;
    }
}