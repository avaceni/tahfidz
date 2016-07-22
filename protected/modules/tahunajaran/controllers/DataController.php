<?php

class DataController extends CkltController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
/**
 * Action untuk halaman kelola tahun ajaran sekaligus tambah tahun ajaran
 *
 * Menampilkan daftar tahun ajaran dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['TahunAjaranBaru']
 * @param string ['TahunAjaranBaru'][nama_tahun_ajaran]
 * @param string date ['TahunAjaranBaru'][tanggal dimulai]
 *
 * @return page kelola santri
 */ 
    public function actionManage() {
        $model_add = new TahunAjaranBaru();
        if (isset($_POST['TahunAjaranBaru'])) {
            $messages = array();
            $model_add->attributes = $_POST['TahunAjaranBaru'];
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
        $model = new TahunAjaranBaru('searchAcademicYear');
        $model->unsetAttributes();
        $this->render('index', array('model'=>$model, 'model_add' => $model_add));
    }
/**
 * Action untuk menghapus data tahun ajaran
 *
 * Menghapus data tahun ajaran
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id tahun ajaran
 *
 * @return bool kondisi sukses
 */
    public function actionDelete($id){
        $id = Yii::app()->request->getQuery('id');
        if(!empty($id)){
            (new TahunAjaranBaru())->loadModelId($id)->delete();
        }
    }
/**
 * Action untuk menghapus beberapa data tahun ajaran berdasarkan id
 *
 * Menghapus baris data pada tabel tahun_ajaran_baru
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id tahun ajaran baru (multi)
 *
 * @return string json jumlah tahun ajaran baru yang berhasil dihapus
 */
    public function actionDeleteAll(){
        $result = array('total_delete'=>0);
        if(isset($_POST['id'])){
            $result['total_delete'] = TahunAjaranBaru::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
/**
 * Action untuk mengubah data tahun ajaran
 *
 * Mengubah data asrama sesuai atribut yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['TahunAjaranBaru']
 * @param string ['TahunAjaranBaru'][nama_tahun_ajaran]
 * @param string date ['TahunAjaranBaru'][tanggal dimulai]
 *
 * @return html dialog ubah tahun ajaran
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional)  
 */
    public function actionUpdate($id){
        $model_academic_year = (new TahunAjaranBaru())->loadModelId($id);
        if (isset($_POST['TahunAjaranBaru'])) {
            $messages = array();
            $model_academic_year->attributes = $_POST['TahunAjaranBaru'];
            if($model_academic_year->validate()){
                $model_academic_year->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model_academic_year->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $form = $this->renderPartial('_academicYearForm', array('model' => $model_academic_year));
        echo $form;
        Yii::app()->end();
    }
    
}
