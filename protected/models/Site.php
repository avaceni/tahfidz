<?php

/**
 * This is the model class for table "cklt_site".
 *
 * The followings are the available columns in table 'cklt_site':
 * @property string $id
 * @property string $name
 * @property string $offline
 * @property string $costum_message
 * @property string $offline_message
 * @property string $default_level_access
 * @property string $default_list_limit
 * @property string $default_feed_limit
 * @property string $feed_email
 * @property string $is_actived
 *
 * The followings are the available model relations:
 * @property Group $defaultLevelAccess
 */
class Site extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Site the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_site';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, costum_message, offline_message, default_level_access, feed_email, password', 'required'),
            array('name', 'unique'),
            array('name', 'length', 'max' => 21),
            array('name', 'length', 'max' => 255),
            array('offline, is_actived', 'length', 'max' => 1),
            array('costum_message, default_list_limit, default_feed_limit, feed_email', 'length', 'max' => 31),
            array('offline_message', 'length', 'max' => 51),
            array('default_level_access', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, offline, costum_message, offline_message, default_level_access, default_list_limit, default_feed_limit, feed_email, is_actived', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'defaultLevelAccess' => array(self::BELONGS_TO, 'Group', 'default_level_access'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'offline' => 'Offline',
            'costum_message' => 'Costum Message',
            'offline_message' => 'Offline Message',
            'default_level_access' => 'Default Level Access',
            'default_list_limit' => 'Default List Limit',
            'default_feed_limit' => 'Default Feed Limit',
            'feed_email' => 'Feed Email',
            'defaultLevelAccess.name' => 'Default Level Access',
            'is_actived' => 'Actived',
            'password' => 'Password',
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
        $criteria->compare('offline', $this->offline, true);
        $criteria->compare('costum_message', $this->costum_message, true);
        $criteria->compare('offline_message', $this->offline_message, true);
        $criteria->compare('default_level_access', $this->default_level_access, true);
        $criteria->compare('default_list_limit', $this->default_list_limit, true);
        $criteria->compare('default_feed_limit', $this->default_feed_limit, true);
        $criteria->compare('feed_email', $this->feed_email, true);
        $criteria->compare('is_actived', $this->is_actived, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        $count = $this->model()->count();
        if($this->offline == 0 && $count > 0){
            $this->updateAll (array("is_actived"=>0), "id <> $this->id");
        }
        return true;
    }
    
//    dibuat oleh rizqi, 13-02-2014
//    untuk mendapatkan tema default untuk site, index array adalah template dan default_template_layout
    public function getDefaultTheme(){
        $criteria = new CDbCriteria;
        $criteria->compare('is_actived', 1);
        $criteria->with = array(
            'defaultLevelAccess'=>array('select'=>'default_template_layout'),
            'defaultLevelAccess.template'=>array('select'=>'name')
        );
        $criteria->select = 't.name';
        $model = $this->model()->find($criteria);
        if($model != null){
            return array(
                'template'=>$model->defaultLevelAccess->template->name,
                'default_template_layout'=>$model->defaultLevelAccess->default_template_layout
            );
        }else
            return null;
    }
    
    public static function findOfficer(){
        return Site::model()->find();
    }
}