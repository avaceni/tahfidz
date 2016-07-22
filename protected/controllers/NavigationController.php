<?php

class NavigationController extends CkltController {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

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
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $module_model = Module::model()->findAll();
        $this->render('admin', array(
            'module_model' => $module_model
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

//    untuk menampilkan navigation berdasarkan controller
    public function actionSearchNavigation($group_id, $module_id, $controller_name) {
        $navigation_criteria = new CDbCriteria();
        $navigation_criteria->compare('group_id', $group_id);
        $navigation_criteria->compare('module_id', $module_id);
        $navigation_criteria->compare('controller', $controller_name);
        $navigation_model = Navigation::model()->findAll($navigation_criteria);
        if ($navigation_model != null)
            echo $this->renderPartial('_tree_navigation', array('navigation_model' => $navigation_model), true, false);
        else
            echo 'There is not navivigation found.';
    }

//    untuk menampilkan form
    public function actionCreate() {
        $navigation_model = new Navigation;
        if (isset($_POST['Navigation'])) {
            $navigation_model->attributes = $_POST['Navigation'];
            if($navigation_model->save()){
                Yii::app()->user->setFlash('success', 'Navigation has been created.');
            }else
                Yii::app()->user->setFlash('error', '');
//            print_r($navigation_model->errors);
        } else {
            $navigation_model->group_id = $_POST['group_id'];
            $navigation_model->module_id = $_POST['module_id'];
            $navigation_model->controller = $_POST['controller_name'];
        }

        echo $this->renderPartial('create', array('navigation_model' => $navigation_model), true, false);
    }
    
//    untuk menampilkan form
    public function actionUpdate() {
//        $navigation_model = new Navigation;
        if (isset($_POST['Navigation'])) {
            $navigation_model = $this->loadModel($_POST['Navigation']['id']);
            $navigation_model->attributes = $_POST['Navigation'];
            if($navigation_model->save()){
                Yii::app()->user->setFlash('success', 'Navigation has been updated.');
            }else
                Yii::app()->user->setFlash('error', '');
        }else
            $navigation_model = $this->loadModel($_POST['id']);

        echo $this->renderPartial('update', array('navigation_model' => $navigation_model), true, false);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Navigation the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Navigation::model()->findByPk($id);
        $model->moduleUrl = $model->getModuleUrl();
        $model->controllerUrl = $model->getControllerUrl();
        $model->actionUrl = $model->getActionUrl();
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Navigation $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'navigation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeleteAll() {
        $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : array();
        $this->deleteAll("id", $id);
        $this->redirect('index');
    }

    public function deleteAll($index, $params = array()) {
        $condition = "";
        $i = 0;
        foreach ($params as $param) {
            if ($i == 0)
                $condition .= " $index = $param ";
            else
                $condition .= " OR $index = $param ";
            $i++;
        }
        if (count($params) > 0)
            Navigation::model()->deleteAll($condition);
    }

}
