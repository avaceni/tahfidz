<?php

//class AccessController extends Controller {
class TestController extends CkltController {

    public function actionCreateSantri() {
        //array('nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir,
        //jumlah_saudara, anak_ke, jenis_kelamin, tanggal_masuk_rtqu', 'required'),
        $model = new Santri();
        $model->nama_lengkap = "ibnu' hanif. > barakallah";
        $model->nama_panggilan = 'ibnu';
        $model->tempat_lahir = 'sleman';
        $model->tanggal_lahir = '1988-09-12';
        $model->jumlah_saudara = '3';
        $model->anak_ke = '2';
        $model->jenis_kelamin = '1';
        $model->tanggal_masuk_rtqu = '2015-08-08';
        if($model->validate()){
            $model->save();
        }
        else {
        }
    }
    
    public function actionCreateUser() {
        //array('nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir,
        //jumlah_saudara, anak_ke, jenis_kelamin, tanggal_masuk_rtqu', 'required'),
        $model = new User();
        $model->username = "ind4e";
        $model->full_name = "uje deh";
        $model->group_id = '13';
        $model->email = 'trigono@ya.com.eee';
        $model->password = 'sdsfd1^&';
        if($model->validate()){
            $model->save();
        }
        else {
            echo json_encode($model->errors);
        }
    }
}
