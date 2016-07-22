<?php

class DataController extends CkltController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
/**
 * Action untuk halaman kelola kelompok sekaligus tambah kelompok
 *
 * Menampilkan daftar kelompok dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Kelompok']
 * @param string ['Kelompok']['nama_kelompok']
 * @param int ['Kelompok']['ustadz_id']
 *
 * @return page kelola kelompok
 */
    public function actionManage() {
        if (isset($_POST['Kelompok']) && !empty($_POST['Kelompok'])) {
            $model = Kelompok::model()->find("nama_kelompok = '{$_POST['Kelompok']['nama_kelompok']}'");
            if(empty($model)){
                $model = new Kelompok();
            }
            $model->attributes = $_POST['Kelompok'];
            $model->aktif = !empty($_POST['Kelompok']['aktif'])?1:0;
            if ($model->validate()) {
                if($model->save()){
                    if(!empty($_POST['Kelompok']['ustadz_id'])){
                        $model_kelompok_ustadz = new RiwayatKelompok();
                        $model_kelompok_ustadz->kelompok = $model->id;
                        $model_kelompok_ustadz->tanggal_dibuat = date('Y-m-d H:i:s', time());
                        $model_kelompok_ustadz->aktif = 1;
                        $model_kelompok_ustadz->user_id = $_POST['Kelompok']['ustadz_id'];
                        if($model_kelompok_ustadz->validate()){
                            $model_kelompok_ustadz->save();
                        }
                    }
                }                
            }
            else {
            }
        }
        $model_add = new Kelompok();
        $model = new Kelompok('searchGroup');
        $model->unsetAttributes();
        $this->render('index', array('model'=>$model, 'model_add' => $model_add));
    }
/**
 * Action untuk halaman kelola kelompok tertentu beserta daftar anggota kelompoknya
 *
 * Menampilkan detail kelompok, anggota kelompok dalam bentuk tabel
 * yang disertai opsi hapus anggota
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Kelompok']
 * @param int ['Kelompok']['aktif'] status aktif ustadz pengampu kelompok
 * @param int ['Kelompok']['ustadz_id'] id ustadz pengampu kelompok
 *
 * @param array $_POST['RiwayatKelompok']
 * @param int ['RiwayatKelompok']['aktif'] status aktif kelompok
 * @param string ['RiwayatKelompok']['nama_kelompok']
 * 
 * @return page kelola kelompok
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */
    public function actionView($id) {
        $params = array();
        $model = (new Kelompok())->loadModel($id);
        if (isset($_POST['Kelompok'])) {
            $messages = array();
            $model->attributes = $_POST['Kelompok'];
            $model->aktif = !empty($_POST['Kelompok']['aktif'])?1:0;
            if ($model->validate()) {
                if($model->save()){
                    if(!empty($_POST['Kelompok']['ustadz_id'])){
                        $model_kelompok_ustadz = new RiwayatKelompok();
                        $model_kelompok_ustadz->kelompok = $model->id;
                        $model_kelompok_ustadz->tanggal_dibuat = date('Y-m-d H:i:s', time());
                        $model_kelompok_ustadz->aktif = 1;
                        $model_kelompok_ustadz->user_id = $_POST['Kelompok']['ustadz_id'];
                        if($model_kelompok_ustadz->validate()){
                            $model_kelompok_ustadz->save();
                            $messages = array('success' => 1, 'message'=>'');
                        }
                    }
                    $messages = array('success' => 1, 'message'=>'');
                }
            }
            else{
                $messages = array('success' => 0, 'message'=>$model->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        if (isset($_POST['RiwayatKelompok'])) {
            $messages_add_member = array();
            $model_riwayat_kelompok = new RiwayatKelompok();
            $model_riwayat_kelompok->attributes = $_POST['RiwayatKelompok'];
            $model_riwayat_kelompok->tanggal_dibuat = date('Y-m-d H:i:s', time());
            $model_riwayat_kelompok->aktif = 1;
            if($model_riwayat_kelompok->validate()){
                $model_riwayat_kelompok->save();
                $message_add_member = array('success' => 1, 'messages' => '');
            }
            else{
                $message_add_member = array('success' => 0, 'messages' => $model_riwayat_kelompok->errors);
            }
            echo json_encode($message_add_member);
            Yii::app()->end();
        }
        $model_ustadz = Kelompok::getUstadz($id);
               
        $params['kelompok'] = $id;
        $model_member = (new RiwayatKelompok())->getGroupMember($params);
        
        $model_add_santri_halaqoh = new RiwayatKelompok();
        $this->render('view', array('model' => $model, 'model_member' => $model_member,
            'model_ustadz' => $model_ustadz, 'model_add_santri_halaqoh' => $model_add_santri_halaqoh));
    }
/**
 * Action untuk menghapus data kelompok berdasarkan id
 *
 * Menghapus baris data pada tabel kelompok
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id kelompok.
 *
 * @return bool kondisi sukses
 */
    public function actionDelete($id){
        $id = Yii::app()->request->getQuery('id');
        if(!empty($id)){
            (new Kelompok())->loadModelId($id)->delete();
        }
    }
/**
 * Action untuk menghapus beberapa data kelompok berdasarkan id
 *
 * Menghapus baris data pada tabel kelompok
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id kelompok (multi).
 *
 * @return string json jumlah kelompok yang berhasil dihapus
 */
    public function actionDeleteAll(){
        $result = array('total_delete'=>0);
        if(isset($_POST['id'])){
            $result['total_delete'] = Kelompok::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
/**
 * Action untuk menonaktifkan keanggotaan kelompok berdasarkan id
 *
 * Mengeset aktif menjadi 0 baris pada tabel kelompok
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id pengguna.
 *
 * @return bool kondisi sukses
 */
    public function actionDeleteMember($id){
        $id = Yii::app()->request->getQuery('id');
        if(!empty($id)){
            RiwayatKelompok::model()->updateByPk($id, array('aktif'=>0));
        }
    }
/**
 * Action untuk menonaktifkan beberapa anggota kelompok berdasarkan id
 *
 * Mengeset aktif menjadi 0 baris pada tabel kelompok
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id kelompok (multi).
 *
 * @return string json jumlah kelompok yang berhasil dinonaktifkan
 */
    public function actionDeleteMemberAll(){
        $result = array('total_delete'=>0);
        if(isset($_POST['id'])){
            $result['total_delete'] = RiwayatKelompok::model()->updateByPk($_POST['id'], array('aktif'=>0));
        }
        echo json_encode($result);
    }
/**
 * Action untuk halaman kelompok ustadz tertentu
 *
 * Menampilkan daftar anggota kelompok ustadz tertentu dalam bentuk tabel
 *
 * @since 1.0.0
 * @access grup ustadz
 *
 *
 * @return page anggota kelompok
 */
    public function actionMyGroup(){
        $kelompok = $this->halaqoh_last;
        if(!empty($kelompok)){
            $params['kelompok'] = $this->halaqoh_last->kelompok;
        }
        else{
            $params['kelompok'] = 0;
        }
        $model = (new RiwayatKelompok())->getGroupMember($params);
        
        $this->render('myGroup', array('model'=>$model));
    }
}
