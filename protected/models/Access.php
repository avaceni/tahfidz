<?php

/**
 * This is the model class for table "cklt_access".
 *
 * The followings are the available columns in table 'cklt_access':
 * @property integer $id
 * @property string $module_id
 * @property string $controller
 * @property string $access_action
 * @property string $group_id
 * @property string $parent_id
 *
 * The followings are the available model relations:
 * @property Module $module
 * @property Group $group
 */
class Access extends CActiveRecord {
//    public $access_action;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Access the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_access';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('module_id, group_id, controller, access_action', 'required'),
            array('group_id, controller, access_action', 'required'),
            array('module_id, group_id', 'length', 'max' => 11),
//            array('access_action', 'length', 'max' => 71),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, module_id, access, group_id,access_action', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'module' => array(self::BELONGS_TO, 'Module', 'module_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'module_id' => 'Module',
            'controller' => 'Controller',
//            'access' => 'Access',
            'access_action' => 'Access',
            'group_id' => 'Group',
            'group.name' => 'Group Name',
            'module.name' => 'Module Name',
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
        $criteria->compare('module_id', $this->module_id, true);
//        $criteria->compare('access_action', $this->access, true);
        $criteria->compare('access_action', $this->access_action, true);
        $criteria->compare('group_id', $this->group_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

//    public function beforeSave() {
//        if(!parent::beforeSave()){
//            $this->access_action = implode(",", $this->access_action);
//        }
//        return true;
//    }

    public function beforeValidate() {
//        if(parent::beforeValidate()){
            if(is_array($this->access_action))
                $this->access_action = implode(",", $this->access_action);
//        }
        return parent::beforeValidate();
    }

}