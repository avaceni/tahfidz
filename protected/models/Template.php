<?php

/**
 * This is the model class for table "cklt_template".
 *
 * The followings are the available columns in table 'cklt_template':
 * @property string $id
 * @property string $name
 * @property string $path
 *
 * The followings are the available model relations:
 * @property Group[] $groups
 */
class Template extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Template the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_template';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('name, path', 'required'),
            array('name', 'length', 'max' => 31),
            array('name', 'unique'),
            array('path', 'file', 'types' => 'zip'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, path', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'groups' => array(self::HAS_MANY, 'Group', 'template_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'path' => 'Path',
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
        $criteria->compare('path', $this->path, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function findGroupTemplate($group_id="") {
        $template = null;
        $group = Group::model()->findByPk($group_id);
        if (isset($group)){
            $template = array(
                'theme'=>$group->template->name,
                'layout'=>$group->default_template_layout
            );
        }

        return $template;
    }

    public function listTemplates() {
        $listTemplates = array();
        $templates = $this->findAll(array(
                    "select" => "id, name",
                    "order" => "name"
                ));
        $listTemplates[''] = ' - Template Options - ';
        foreach ($templates as $template) {
            $listTemplates[$template->id] = $template->name;
        }
        return $listTemplates;
    }

    public function uploadTemplate($file){
        $tempUrl = Yii::getPathOfAlias('webroot.themes');
        $fileUpload = $tempUrl."/$file->name";
        $fileUrl = str_replace(".zip", "", str_replace("\\", "/", $fileUpload));
        if($file->saveAs($fileUpload)){
            if(!is_dir($fileUrl))
                mkdir ($fileUrl, 0777, true);
            @chmod($fileUrl, 0777);
            Utility::extractFile($fileUpload, $tempUrl);
            unlink($fileUpload);
            return true;
        }
        unlink($fileUpload);
        return false;
    }

}