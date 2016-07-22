<?php

class UserController extends CkltController {

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
        $model = new User;
        $model->setScenario('create');
        // Uncomment the following line if AJAX validation is needed
//        $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()){
                echo 'asd';
                $this->redirect(array('view', 'id' => $model->id));
            }
//            print_r($model->errors);
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = "update";
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
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
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
//    untuk edit profile pengguna
    public function actionEditProfile(){
        $model = User::model()->findByPk(Yii::app()->user->id);
        $this->render("edit_profile", array('model'=>$model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function md5Cklt(){
        
    }
    
    public function actionDefaultProfileImage(){
        echo Yii::app()->baseUrl . "/images/resource/no-profile-image-2x3.jpg";
    }
    
    public function actionMyProfile(){
        if(isset($_POST)){
            $request_body = json_decode(file_get_contents('php://input'),true);
//            file_put_contents('myprofile', json_encode($request_body));
            if(!empty($request_body)){
                $message = array();
                $model_user = User::model()->findByPk($request_body['id']);
                $model_user->attributes = $request_body;
                if($model_user->validate()){
                    $model_user->save();
                    $message = array('success' => 1, 'messages' => '');
                }
                else{
                    $message = array('success' => 0, 'messages' => $model_user->errors);                    
                }
                echo json_encode($message);
                Yii::app()->end();
            }
        }
        $form = $this->renderPartial('_my_profile_form', array('model_user' => $this->cklt_user));
        echo $form;
    }
    
    public function actionChangePassword(){
        if(isset($_POST)){
            $request_body = json_decode(file_get_contents('php://input'),true);
            if(!empty($request_body)){
                $message = array();
                $model_user = User::model()->findByPk($request_body['id']);
                $model_user->setScenario('updating');
                $this_password = $model_user->password;
                $model_user->attributes = $request_body;
                if($model_user->validate()){
                    $model_user->password = $this_password;
                    $model_user->save();
                    $message = array('success' => 1, 'messages' => '');
                }
                else{
                    $message = array('success' => 0, 'messages' => $model_user->errors);                    
                }
                echo json_encode($message);
                Yii::app()->end();
            }
        }
        $form = $this->renderPartial('_my_password_form', array('model_user' => $this->cklt_user));
        echo $form;
    }
    
}
