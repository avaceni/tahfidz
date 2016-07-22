<?php

class MenuController extends CkltController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Menu;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Menu'])) {
            $model->attributes = $_POST['Menu'];
            if ($model->save())
                $result = array(
                    'type' => 1,
                    'message' => '<div class="alert-success">Menu telah berhasil ditambahkan. <i class="icon-times close"></i></div>'
                );
            else
                $result = array(
                    'type' => 0,
                    'message' => '<div class="alert-warning"><i class="icon-times close"></i>'.CHtml::errorSummary($model).' <div class="clear"></div></div>'
                );
        } else {
            $result = array(
                'type' => 0,
                'message' => '<div class="alert-warning">Tidak ada data menu yang terhapus. <i class="icon-times close"></i></div>'
            );
        }

        echo json_encode($result);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Menu'])) {
            $model->attributes = $_POST['Menu'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionAjaxDelete() {
        $result = array();
        $ids = isset($_POST['ids']) ? $_POST['ids'] : null;
        if (isset($ids) && Menu::model()->deleteByPk($ids)) {
            $result = array(
                'type' => 1,
                'message' => '<div class="alert-success">Menu telah berhasil dihapus. <i class="icon-times close"></i></div>'
            );
        } else {
            $result = array(
                'type' => 0,
                'message' => '<div class="alert-warning">Tidak ada data menu yang terhapus. <i class="icon-times close"></i></div>'
            );
        }
        echo json_encode($result);
    }

    public function actionAjaxReloadMenuList() {
        $menu_model = new Menu;
        $result = $this->renderPartial('_tree_menu', array('menu_model' => $menu_model));
        echo $result;
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->redirect(array("admin"));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Menu('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Menu']))
            $model->attributes = $_GET['Menu'];
        $menu_model = new Menu;
        $this->render('admin', array(
            'model' => $model,
            'menu_model' => $menu_model
        ));
    }
    
//    untuk mendapatkan list controller
    public function actionAjaxControllerList($module){
        foreach (Module::model()->readModuleController($module) as $controller)
            echo CHtml::tag ('option', array('value'=>$controller), $controller);
    }
    
//    untuk mendapatkan list action
    public function actionAjaxActionList($module, $controller){
        foreach (Module::model()->readControllerAction($module, $controller) as $action)
            echo CHtml::tag ('option', array('value'=>$action), $action);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Menu the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Menu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Menu $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeleteAll() {
        $id = array();
        $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '';
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
        Menu::model()->deleteAll($condition);
    }

}
