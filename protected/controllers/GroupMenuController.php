<?php

class GroupMenuController extends CkltController {

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
        $model = new GroupMenu;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['GroupMenu'])) {
            $model->attributes = $_POST['GroupMenu'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));

//        $model = new Menu('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['Menu']))
//            $model->attributes = $_GET['Menu'];
//
//        $this->render('create', array(
//            'model' => $model,
//        ));
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

        if (isset($_POST['GroupMenu'])) {
            $model->attributes = $_POST['GroupMenu'];
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
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $group_id = isset($_GET["gid"]) ? $_GET["gid"] : "0";
//        $groupMenuProvider = new CActiveDataProvider('GroupMenu', array(
//            "criteria"=>array(
//                "condition"=>"group_id = $group_id"
//            )
//        ));
        $groupMenuModel = new GroupMenu('search');
        $groupMenuModel->group_id = $group_id;

        $groupProvider = new CActiveDataProvider('Group', array(
            "criteria" => array(
                "select" => "id,name"
            )
        ));

        $this->render('index', array(
            'groupMenuModel' => $groupMenuModel,
            'groupProvider' => $groupProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new GroupMenu;
        $navigation_model = new Navigation;
        $group_model = Group::model()->findAll(array('order' => 'name', 'select' => 'id, name'));
        $group_menu_model = new GroupMenu;
//        $group_menu_model->findListMenuByGroup(0);
        $this->render('admin', array(
            'model' => $model,
            'navigation_model' => $navigation_model,
            'group_model' => $group_model,
            'group_menu_model' => $group_menu_model
        ));
    }

//    untuk filter menu berdasarkan group
    public function actionAjaxFilterGroup($id) {
        $group_menu_model = new GroupMenu;
//        $group_menu_model->
        $group_menu_model->arrMenu = $group_menu_model->findListMenuByGroup($id);
        echo $this->renderPartial('_tree_menu', array('group_menu_model' => $group_menu_model), true, false);
    }

//    untuk modifikasi group menu
    public function actionAjaxSave() {
        $group_id = $_POST['group_id'];
        $ids = $_POST['ids'];
        
        $result = array();
        if (count($ids) > 0 && isset($group_id)) {
            $group_menu_model = new GroupMenu;
            $ids = implode(',', $ids);
//            menghapus menu yang tidak jadi dipilih
            $group_menu_model->deleteAllByAttributes(array("group_id" => $group_id), "menu_id NOT IN($ids)");
//            mencari menu yang belum ditambahkan pada group
            $saved_group_menu_arr = array();
            $saved_group_menu_model = $group_menu_model->findAll(array('condition' => "group_id = $group_id AND menu_id IN($ids)"));
            foreach ($saved_group_menu_model as $saved_group_menu)
                $saved_group_menu_arr[] = $saved_group_menu->menu_id;
//            menyimpan menu yang belum tersimpan
            $unsaved_group_menu_arr = array_diff(explode(',', $ids), $saved_group_menu_arr);
//            jika terdapat menu yang ditambah
            if (count($unsaved_group_menu_arr) > 0) {
                $data = "";
                $i = 1;
                foreach ($unsaved_group_menu_arr as $unsaved_group_menu){
                    if($i == 1)
                        $data .= "($group_id, $unsaved_group_menu)";
                    else
                        $data .= ",($group_id, $unsaved_group_menu)";
                    $i++;
                }
                $sql = "INSERT INTO {$group_menu_model->tableName()}(group_id, menu_id) VALUES $data";
                Yii::app()->db->createCommand($sql)->execute();
            }
            $result = array(
                'type' => 1,
                'message' => 'Data berhasil disimpan.'
            );
        } else {
            $result = array(
                'type' => 0,
                'message' => 'Tidak ada perubahan yang terjadi.'
            );
        }
        echo json_encode($result);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return GroupMenu the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = GroupMenu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param GroupMenu $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'group-menu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
