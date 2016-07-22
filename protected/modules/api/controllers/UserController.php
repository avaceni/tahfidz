<?php

class UserController extends CController {
    public function init() {
        $this->layout = FALSE;
    }
    /*
     * action untuk memverifikasi login pengguna
    */
    public function actionLogin() {
        $username = Yii::app()->request->getPost('username');
        $password = Yii::app()->request->getPost('password');
        $user = new UserIdentity($username, $password);
        if(!$user->authenticate()){
            $message = array('success'=>0,'message'=>'Username atau Password salah');
        }
        else{
            $user_data = $user->getUser();
            $message = array(
                'success'=>1,
                'message'=>array(
                    'userid' => $user_data->id,
                    'username' => $user_data->username,
                    'full_name' => $user_data->full_name,
                    'address' => $user_data->address,
                    'photo' => $user_data->getPhotoUrl($user_data->id),
                    'email' => $user_data->email,
                    'group_id' => $user_data->group_id,
                    'halaqoh' => $user_data->getActiveGroupId(),
                ));
        }
        echo json_encode($message);
        Yii::app()->end();
    }

    public function actionChangePassword() {
        $id = Yii::app()->request->getPost('id');
        $old_pass = Yii::app()->request->getPost('old_pass');
        $new_pass = Yii::app()->request->getPost('new_pass');
        echo json_encode(User::model()->changePassword($id, $old_pass, $new_pass));
    }
    
    protected function beforeAction($action) {
        ob_clean(); // clear output buffer to avoid rendering anything else
        header('Content-type: application/json'); // set content type header as json
        return parent::beforeAction($action);
    }

}
