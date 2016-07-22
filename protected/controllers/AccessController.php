<?php

//class AccessController extends Controller {
class AccessController extends CkltController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionSave() {
        $access_model = new Access;
        $exist_criteria = new CDbCriteria;
        $exist_criteria->compare('module_id', $_POST['access_module_id']);
        $exist_criteria->compare('controller', $_POST['access_controller']);
        $exist_criteria->compare('group_id', $_POST['access_group_id']);
        $exist = $access_model->find($exist_criteria);
        if ($exist == null) {
            if (isset($_POST['ids'])) {
                $access_model->module_id = $_POST['access_module_id'];
                $access_model->controller = $_POST['access_controller'];
                $access_model->group_id = $_POST['access_group_id'];
                $access_model->access_action = implode(',', $_POST['ids']);
                if ($access_model->save())
                    $result = array(
                        'type' => 1,
                        'message' => '<div class="alert-success"><i class="icon-times close"></i>Akses baru telah berhasil ditambahkan. </div>'
                    );
            }
        }else {
            if (isset($_POST['ids']))
                $access_model->updateByPk($exist->id, array('access_action' => implode(',', $_POST['ids'])));
            $result = array(
                'type' => 1,
                'message' => '<div class="alert-success"><i class="icon-times close"></i>Akses telah berhasil diperbaharui. </div>'
            );
        }
        echo json_encode($result);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $module_model = Module::model()->findAll();
        $this->render('admin', array(
            'module_model' => $module_model,
        ));
    }

//    untuk menampilkan controller berdasarkan module
    public function actionSearchController($module_id) {
        $module_criteria = new CDbCriteria();
        $module_criteria->compare('id', $module_id);
        $module_name = (strlen($module_id) > 0) ? Module::model()->find($module_criteria)->name : '';
        $controller_model = Module::model()->readModuleController($module_name);
        echo $this->renderPartial('_tree_controller', array('controller_model' => $controller_model), true, false);
    }

//    untuk menampilkan action berdasarkan module dan controller
    public function actionSearchAction($module_name, $controller_name, $group_id) {
        $action_model = Module::model()->readControllerAction($module_name, $controller_name);
//        access
        $access_criteria = new CDbCriteria();
        $access_criteria->compare('group_id', $group_id);
        $access_criteria->compare('module_id', $module_name);
        $access_criteria->compare('controller', $controller_name);
        $access_model = Access::model()->findAll($access_criteria);
        $selected_access = array();
        foreach ($access_model as $access) {
            $access_action_arr = explode(',', $access->access_action);
            foreach ($access_action_arr as $action)
                $selected_access[$action] = $action;
//                $selected_access[$module_name][$controller_name][$action] = $action;
        }
        echo $this->renderPartial('_tree_action', array('action_model' => $action_model, 'selected_access' => $selected_access), true, false);
    }

    /**
     * Performs the AJAX validation.
     * @param Access $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'access-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
