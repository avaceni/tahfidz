<?php

/**
 * This is the model class for table "cklt_module".
 *
 * The followings are the available columns in table 'cklt_module':
 * @property string $id
 * @property string $name
 * @property string $path
 *
 * The followings are the available model relations:
 * @property Access[] $accesses
 */
class Module extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Module the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_module';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('path', 'file', 'types' => 'zip'),
            array('name, path', 'required'),
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
            'accesses' => array(self::HAS_MANY, 'Access', 'module_id'),
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
        $criteria->addCondition("name <> ''");

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function readModule() {
        $arrModule = array();
        $modules = Utility::findDirFromPath(Yii::app()->basePath . "/modules");
        $arrModule[''] = "No Module";
        foreach ($modules as $module) {
            $module = str_replace(".", "", $module);
            if ($module != "")
                $arrModule[$module] = $module;
        }
        return $arrModule;
    }

    public function readModuleController($module = "") {
        $arrController = array();
        if ($module == "")
            $controllers = Utility::findFileFromFolder(Yii::app()->basePath . "/controllers");
        else
            $controllers = Utility::findFileFromFolder(Yii::app()->basePath . "/modules/$module/controllers");
        foreach ($controllers as $controller) {
            if (strpos($controller, 'Controller')) {
                $controller = str_replace("Controller.php", "", $controller);
                $controller = str_replace(".", "", $controller);
                if ($controller != "") {
//                $controller_id = strtolower($controller);
//                $arrController[$controller_id] = $controller;
                    $arrController[$controller] = $controller;
                }
            }
        }
        return $arrController;
    }

    public function readControllerAction($module = "", $controller = "") {
        $arrAction = array();
        $controller = ucfirst($controller);
        $module = ($module != "") ? "/modules/$module" : "";
        $controller = ($controller != "") ? "{$controller}Controller.php" : "";
        $actions = (isset($module) && ($controller != "")) ? Utility::findMethodFromFile(Yii::app()->basePath . "$module/controllers/$controller") : array();
        foreach ($actions as $action) {
            $arrAction[$action] = $action;
        }
        return $arrAction;
    }

    public function listModules() {
        $listModules = array();
        $modules = $this->findAll(array(
            "select" => "id, name",
            "order" => "name",
            "condition" => "id > 0"
        ));
        $listModules[''] = '';
        foreach ($modules as $module) {
            $listModules[$module->id] = $module->name;
        }
        return $listModules;
    }

    public function uploadModule($file) {
        $tempUrl = Yii::getPathOfAlias('webroot.protected.modules');
        $fileUpload = $tempUrl . "/$file->name";
        $fileUrl = str_replace(".zip", "", str_replace("\\", "/", $fileUpload));
        if ($file->saveAs($fileUpload)) {
            if (!is_dir($fileUrl))
                mkdir($fileUrl, 0777, true);
            @chmod($fileUrl, 0777);
            Utility::extractFile($fileUpload, $tempUrl);
            unlink($fileUpload);
            return true;
        }
        unlink($fileUpload);
        return false;
    }

    public function listControllerAction($module) {
        $arrControllerAction = array();
        $controllers = $this->readModuleController($module);
        foreach ($controllers as $controller) {
            $actions = $this->readControllerAction($module, $controller);
            foreach ($actions as $action) {
                $arrControllerAction[] = "$controller|$action";
            }
        }
    }

    public function idToModulename($id) {
        $module_name = isset(Module::model()->findByPk($id)->name) ? Module::model()->findByPk($id)->name : "";
        return $module_name;
    }

}
