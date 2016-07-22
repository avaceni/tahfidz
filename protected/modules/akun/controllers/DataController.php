<?php
/**
 * Kelas Controller untuk mengatur akun admin dan ustadz
 *
 * Berisi action-action untuk mengelola akun pengguna, mulai dari
 * melihat daftar pengguna, menambah, menghapus, mengubah
 *
 * @since 1.0.0
 */
class DataController extends CkltController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
/**
 * Action untuk halaman kelola akun admin dan ustadz
 *
 * Menampilkan daftar admin, dan ustadz dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @return page kelola admin & ustadz
 */
    public function actionManage() {
        $param_admin['group_id'] = 10;
        $model_admin = (new User())->getAllUser($param_admin);        
        $param_ustadz['group_id'] = 12;
        $model_ustadz = (new User())->getAllUser($param_ustadz);
        $model_admin_add = new User();
        $model_ustadz_add = new User();
        $this->render('index',
            array(
                'model_admin' => $model_admin,
                'model_ustadz' => $model_ustadz,
                'model_admin_add' => $model_admin_add,
                'model_ustadz_add' => $model_ustadz_add,
                )
            );
    }
    
/**
 * Action untuk menghapus akun admin dan ustadz berdasarkan id
 *
 * Menghapus baris data pada tabel user
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id pengguna.
 *
 * @return bool kondisi sukses
 */
    public function actionDelete($id) {
        if (!empty($id)) {
            (new User())->loadModelId($id)->delete();
        }
    }

/**
 * Action untuk menghapus beberapa akun admin/ustadz berdasarkan id
 *
 * Menghapus baris data pada tabel user
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id pengguna (multi).
 *
 * @return string json jumlah akun yang berhasil dihapus
 */
    public function actionDeleteAll() {
        $result = array('total_delete' => 0);
        if (isset($_POST['id'])) {
            $result['total_delete'] = User::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }

/**
 * Action untuk menambahkan admin
 *
 * Menambahkan data pengguna sesuai atribut yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['User']
 *      @param string ['User']['username']
 *      @param string ['User']['password']
 *      @param string ['User']['retypePassword']
 *      @param string ['User']['fullname']
 *      @param string ['User']['email']
 *      @param int ['User']['is_active']
 *      @param string ['User']['phone']   
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional)  
 */    
    public function actionAddAdmin(){
        $result = array();
        if (isset($_POST['User']) && !empty($_POST['User'])) {
            $model = new User();
            $model->attributes = $_POST['User'];
            $model->group_id = 10;
            $model->setScenario('create');
            if ($model->validate()) {
                $model->save();
                $result = array('success' => 1, 'messages' => '');
            } else {
                $result = array('success' => 0, 'messages' => $model->errors);
            }
        }
        echo json_encode($result);
    }

/**
 * Action untuk mengubah pengguna
 *
 * Mengubah data pengguna sesuai atribut yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['User']
 *      @param string ['User']['username']
 *      @param string ['User']['password']
 *      @param string ['User']['retypePassword']
 *      @param string ['User']['fullname']
 *      @param string ['User']['email']
 *      @param int ['User']['is_active']
 *      @param string ['User']['phone']
 * @return string json jumlah akun yang berhasil dihapus
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) atau page form sukses 
 */    
    public function actionUpdate($id){
        $model = (new User())->loadModelId($id);
        if (isset($_POST['User'])) {
            $messages = array();
            $model->attributes = $_POST['User'];
            if($model->validate()){
                $model->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $form = $this->renderPartial('_addAdminDialogForm', array('model_add' => $model, 'action'=>'update'));
        echo $form;
        Yii::app()->end();
    }

/**
 * Action untuk menambahkan akun ustadz
 *
 * Menambahkan data ustadz sesuai atribut yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['User']
 *      @param string ['User']['username']
 *      @param string ['User']['password']
 *      @param string ['User']['retypePassword']
 *      @param string ['User']['fullname']
 *      @param string ['User']['email']
 *      @param int ['User']['is_active']
 *      @param string ['User']['phone']   
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional)  
 */    
    public function actionAddUstadz(){
        $result = array();
        if (isset($_POST['User']) && !empty($_POST['User'])) {
            $model = new User();
            $model->attributes = $_POST['User'];
            $model->group_id = 12;
            $model->setScenario('create');
            if ($model->validate()) {
                if($model->save()){
                    $model_santri = new Santri();
                    $model_santri->create_user = FALSE;
                    $model_santri->id = $model->id;
                    $model_santri->nama_lengkap = $model->full_name;
                    $model_santri->jenis_kelamin = 1;
                    $model_santri->save();
                }
                $result = array('success' => 1, 'messages' => '');
            } else {
                $result = array('success' => 0, 'messages' => $model->errors);
            }
        }
        echo json_encode($result);
    }

/**
 * Action untuk mengubah akun ustadz
 *
 * Mengubah data pengguna sesuai atribut yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['User']
 *      @param string ['User']['username']
 *      @param string ['User']['password']
 *      @param string ['User']['retypePassword']
 *      @param string ['User']['fullname']
 *      @param string ['User']['email']
 *      @param int ['User']['is_active']   
 *      @param string ['User']['phone']   
 * @return string json jumlah akun yang berhasil dihapus
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) atau page form sukses 
 */ 
    public function actionUpdateUstadz($id){
        $model = (new User())->loadModelId($id);
        if (isset($_POST['User'])) {
            $messages = array();
            $model->attributes = $_POST['User'];
            if($model->validate()){
                $model->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $form = $this->renderPartial('_addAdminDialogForm', array('model_add' => $model, 'action'=>'update'));
        echo $form;
        Yii::app()->end();
    }
    
}
