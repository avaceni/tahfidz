<?php
/**
 * Kelas Controller untuk mengelola data asrama
 *
 * Berisi action-action untuk mengelola data asrama, mulai dari
 * melihat daftar asrama, menambah, menghapus, mengubah
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
 * Action untuk halaman kelola asrama sekaligus menambahkan asrama baru
 *
 * Menampilkan daftar asrama  dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Pondokan'] (optional)
 *      @param string ['Pondokan']['nama_pondok']
 *      @param int ['Pondokan']['status'] (1=sewa,2=pinjaman,3=milik yayasan)
 *      @param string date ['Pondokan']['tanggal_mulai']
 *      @param string ['Pondokan']['jangka_waktu'] (optional)
 *
 * @return page kelola asrama
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional)  
 */
    public function actionManage() {
        if (isset($_POST['Pondokan']) && !empty($_POST['Pondokan'])) {
            $messages = array();
            $model_add = (new Pondokan())->findByAttributes(array('nama_pondok'=>$_POST['Pondokan']['nama_pondok']));
            if(empty($model_add)){
                $model_add = new Pondokan();
            }
            $model_add->attributes = $_POST['Pondokan'];
            if($model_add->validate()){
                $model_add->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model_add->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $model_add = new Pondokan();
        $model = new Pondokan('searchQuarters');
        $model->unsetAttributes();
        $this->render('index', array('model'=>$model, 'model_add' => $model_add));
    }
/**
 * Action untuk halaman kelola kelompok sekaligus menambahkan kelompok baru
 *
 * Menampilkan daftar kelompok dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Kelompok'] (optional)
 *      @param string ['Kelompok']['nama_kelompok']
 *      @param string ['Kelompok']['ustadz'] (optional)
 *
 * @return page kelola asrama
 * @return flash_message
 */
    public function actionView($id) {
        $model = (new Pondokan())->loadModel($id);
        if (isset($_POST['Pondokan'])) {
            $model->attributes = $_POST['Kelompok'];
            if ($model->save()) {
                Yii::app()->Pondokan->setFlash('suksess', 'Kelompok berhasil ditambahkan');
            }
        }        
        $this->render('view', array('model' => $model));
    }
/**
 * Action untuk mengubah data asrama
 *
 * Mengubah data asrama sesuai atribut yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Pondokan'] (optional)
 *      @param string ['Pondokan']['nama_pondok']
 *      @param int ['Pondokan']['status'] (1=sewa,2=pinjaman,3=milik yayasan)
 *      @param string date ['Pondokan']['tanggal_mulai']
 *      @param string ['Pondokan']['jangka_waktu'] (optional)
 *
 * @return html dialog kelola asrama
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional)  
 */
    public function actionUpdate($id){
        $model_quarters = (new Pondokan())->loadModel($id);
        if (isset($_POST['Pondokan'])) {
            $messages = array();
            $model_quarters->attributes = $_POST['Pondokan'];
            if($model_quarters->validate()){
                $model_quarters->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model_quarters->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $form = $this->renderPartial('_quartersForm', array('model' => $model_quarters));
        echo $form;
        Yii::app()->end();
    }

/**
 * Action untuk menghapus asrama berdasarkan id
 *
 * Menghapus baris data pada tabel pondokan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id asrama.
 *
 * @return bool kondisi sukses
 */
    public function actionDelete($id){
        $id = Yii::app()->request->getQuery('id');
        if(!empty($id)){
            (new Pondokan())->loadModel($id)->delete();
        }
    }
/**
 * Action untuk menghapus beberapa asrama berdasarkan id
 *
 * Menghapus baris data pada tabel pondokan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id pengguna (multi).
 *
 * @return string json jumlah asrama yang berhasil dihapus
 */
    public function actionDeleteAll(){
        $result = array('total_delete'=>0);
        if(isset($_POST['id'])){
            $result['total_delete'] = Pondokan::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
}
