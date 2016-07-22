<?php

class DataController extends CkltController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }    
/**
 * Action untuk halaman kelola ustadz
 *
 * Menampilkan daftar ustadz dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['search-santri'] (opsional-filter) keyword nama ustadz
 * @param int $_GET['gender'] (opsional-filter)
 * @param int $_GET['pondok'] (opsional-filter) pondok id
 *
 * @return page kelola ustadz
 */ 
    public function actionManage() {
        $param['nama_lengkap'] = Yii::app()->request->getParam('search-santri');
        $param['jenis_kelamin'] = Yii::app()->request->getParam('gender');
        $param['pondok_id'] = Yii::app()->request->getParam('pondok');
        $param['group'] = 12;        
        $model = (new Santri())->getAllSantri($param);
        $count_filter = $this->countQuartersFilter($param['pondok_id']);
        if(isset($_POST) && !empty($_POST)){
            $count_filter = $this->countQuartersFilter($_POST['pondok']);
            echo json_encode($count_filter);
            Yii::app()->end();
        }

        $registration_data = new RegistrationForm();
        $this->render('index', array(
            'model' => $model,
            'registration_data' => $registration_data,
            'count_filter' => $count_filter,
                ));
    }
/**
 * Fungsi untuk menghitung jumlah ustadz per asrama
 *
 * Menampilkan jumlah ustadz
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $quarter_id id asrama
 *
 * @return array
 * @return count_putra jumlah ustadz putra
 * @return count_putri jumlah ustadz putri
 * @return quarters_name nama asrama
 *
 */
    private function countQuartersFilter($quarter_id){
        $result = array();
        $result['count_putra'] = (new Santri())->getCount($quarter_id,1,12);
        $result['count_putri'] = (new Santri())->getCount($quarter_id,2,12);
        $quarters = Pondokan::model()->findByPk($quarter_id);
        $result['quarters_name'] = !empty($quarters)?$quarters->nama_pondok:'seluruh asrama';
        return $result;
    }
/**
 * Fungsi untuk menyimpan data ustadz
 *
 * Menyimpan data ustadz sesuai atribut baru yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array['Santri']
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 *
 */
    public function actionSave() {
        if (isset($_POST)) {
            $message = array();
            $post = $_POST;
            foreach ($post as $index => $form) {
                $attribute = array();
                foreach ($form as $model_attr => $value) {
                    $model_array = explode('[', $model_attr);
                    $attribute[$model_array[1]] = $value;
                }
                $model = new $model_array[0]();
                $model->attributes = $attribute;
                switch ($model_array[0]) {
                    case 'Santri':
                        $model->group = 12;
                        $model->photo_id = $attribute['photo_id'];
                        $result = $this->finalFalidateForm($model, $model_array[0]);
                        $message[$model_array[0]][] = $result['message'];
                        $santri_id = $result['santri_id'];
                        $new_path = $this->movePhotoProfile($model->photo_id, $santri_id);
                        break;
                    default:
                        $model->santri_id = $santri_id;
                        $message[$model_array[0]][] = $this->finalFalidateForm($model, $model_array[0])['message'];
                        break;
                }
            }
            echo json_encode($message);
        }
    }
/**
 * Fungsi untuk menambahkan data ustadz
 *
 * Menambahkan data ustadz sesuai atribut baru yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param $_POST['Santri'], $_POST['SantriOrangtua'], $_POST['SantriRiwayatPendidikan']
 * $_POST['SantriPenyakit'], $_POST['SantriPrestasi']
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 *
 */
    public function actionCreate() {
        $array_sent = array();
        $array_model = array(
            'model_santri' => 'Santri',
            'model_parent' => 'SantriOrangtua',
            'model_education' => 'SantriRiwayatPendidikan',
            'model_diseae' => 'SantriPenyakit',
            'model_achievement' => 'SantriPrestasi'
        );
        foreach ($array_model as $name => $model) {
            ${$name} = new $model();
            if (isset($_POST[$model])) {
                ${$name}->attributes = $_POST[$model];
                if (!array_key_exists('Santri', $_POST)) {
                    ${$name}->santri_id = 0;
                }
                else{
                    ${$name}->setScenario('full');
                }
                if (${$name}->validate()) {
                    echo json_encode(array('success' => 1, 'messages' => ''));
                    Yii::app()->end();
                } else {
                    echo json_encode(array('success' => 0, 'messages' => ${$name}->errors));
                    Yii::app()->end();
                }
            }
            $array_sent[$name] = ${$name};
        }
        foreach ($array_model as $name => $model) {
            $array_sent[$name] = ${$name};
        }
        $this->render('create', $array_sent);
    }
/**
 * Action untuk halaman detail data ustadz sekaligus mengubah data diri ustadz
 * Menampilkan detail
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['search-santri'] (opsional-filter) keyword nama santri
 * @param int $_GET['gender'] (opsional-filter)
 * @param int $_GET['pondok'] (opsional-filter) pondok id
 *
 * @param int $_POST data ustadz sesuai model
 *
 * @return page kelola santri
 */ 
    public function actionView($id) {
        if (isset($_POST) && !empty($_POST)) {
            $success = 1;
            $message = array();
            $post = $_POST;
            foreach ($post as $index => $form) {
                $attribute = array();
                foreach ($form as $model_attr => $value) {
                    $model_array = explode('[', $model_attr);
                    $attribute[$model_array[1]] = $value;
                }
                if (array_key_exists('id', $attribute)) {
                    $model = (new $model_array[0])->loadModelId($attribute['id']);
                } else {
                    $model = new $model_array[0]();
                }
                //get_class($model)
                $model->attributes = $attribute;
                switch ($model_array[0]) {
                    case 'Santri':
                        $result = $this->finalFalidateForm($model, $model_array[0]);
                        $success = $success && $result['message']['success'];
                        $message['success'] = $success;
                        $message[$model_array[0]][] = $result['message'];
                        break;
                    default:
                        $fieldset = '';
                        $model->santri_id = $id;
                        $result = $this->finalFalidateForm($model, $model_array[0]);
                        $success = $success && $result['message']['success'];
                        if($success){
                            ob_start();
                            $model_saved = $model_array[0]::model()->findAll("santri_id = $id");
                            $this->renderPartial("_$model_array[0]", array('model' => $model_saved, 'hide' => 0));
                            $fieldset = ob_get_contents();
                            ob_end_clean();
                        }
                        // = $regenerate_fieldset;
                        $message['success'] = $success;
                        $message['fieldset'] = $fieldset;
                        $message[$model_array[0]][] = $result['message'];
                        break;
                }
            }
            echo json_encode($message);
            Yii::app()->end();
        }

        $model = (new Santri())->loadModel($id);

        $new_parent = new SantriOrangtua();
        $model_parent = (new SantriOrangtua())->loadModel($id);

        $new_education = new SantriRiwayatPendidikan();
        $model_education = (new SantriRiwayatPendidikan())->loadModel($id);

        $new_diseae = new SantriPenyakit();
        $model_diseae = (new SantriPenyakit())->loadModel($id);

        $new_achievement = new SantriPrestasi();
        $model_achievement = (new SantriPrestasi())->loadModel($id);

        $model_group = (new RiwayatKelompok())->getGroupHistory($id);

        $this->render('view', array('model' => $model, 'model_parent' => $model_parent,
            'model_education' => $model_education, 'model_diseae' => $model_diseae,
            'model_achievement' => $model_achievement, 'new_parent' => $new_parent,
            'new_education' => $new_education, 'new_diseae' => $new_diseae,
            'new_achievement' => $new_achievement,
            'model_group' => $model_group));
    }
/**
 * Fungsi untuk memvalidasi model data diri ustadz
 *
 * Menampilkan detail
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param model $model model yang akan divalidasi
 * @param string $model_name nama model sesuai kelas modelnya
 *
 * @return page kelola ustadz
 */ 
    protected function finalFalidateForm($model, $model_name) {
        $santri_id = NULL;
        $message = array();
        if ($model_name == 'Santri') {
            $model->create_user = TRUE;
            $model->setScenario('full');
        }
        if ($model->validate()) {
            $model->save();
            $message = array('success' => 1, 'message' => '');
            if ($model_name == 'Santri') {
                $santri_id = $model->id;
            }
        } else {
            $message = array('success' => 0, 'message' => $model->errors);
        }
        return array('message' => $message, 'santri_id' => $santri_id);
    }

    protected function formValidate($model) {
        $model_parent->attributes = $_POST['SantriOrangtua'];
        if ($model_parent->save()) {
            Yii::app()->user->setFlash('suksess', 'Data Orangtua Santri berhasil ditambahkan');
//                $this->redirect(array('view', 'id' => $model->id));
        }
    }
/**
 * Action untuk upload foto ustadz
 *
 * Menyimpan data foto dan memindahkan/mengunggah foto ustadz ke penyimpanan (sekaligus di ubah ukurannya)
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param $_POST['avatar_src'] nama foto
 * @param $_POST['avatar_data'] nama foto 
 * @param $_FILES['avatar_file'] source foto
 *
 * @return string json array status
 *      @return int state kode response
 *      @return string message keterangan error (optional) 
 */
    public function actionPhotoUpload($id) {
        $photo_id = null;
        //set destination
        $user_path = !empty($id)?$id.'/':'';
        $photo_location = 'images/user/'.$user_path;
        Utility::checkPathExist($photo_location);
        $crop = new CropMaster(
                isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null, isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null, isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null, $photo_location
        );

        $message = $crop->getMsg();
        $result = $crop->getResult();
        if (empty($message)) {
            $model = new Foto();
            $model->lokasi = str_replace(Yii::app()->baseUrl . '/', '', $result);
            $model->aktif = 1;
            $model->tipe = 1;
            $model->tanggal_dibuat = date('Y-m-d H:i:s', time());
            if(!empty($id)){
                $model->user_id = $id;
            }

            if ($model->validate()) {
                $model->save();
                $photo_id = $model->id;
            }
        }

        $response = array(
            'state' => 200,
            'message' => $message,
            'result' => $result,
            'photo_id' => $photo_id,
        );
        echo json_encode($response);
    }
/**
 * Fungsi untuk mengubah lokasi upload foto
 *
 * Mengubah data foto dan memindahkan/mengunggah foto ustadz ke penyimpanan (sekaligus di ubah ukurannya)
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param $photo_id id foto
 * @param $user_id id pengguna
 *
 * @return string lokasi/path foto baru
 */
    protected function movePhotoProfile($photo_id, $user_id) {
        $new_photo_location = '';
        $model_photo = Foto::model()->findByPk($photo_id);
        if (!empty($model_photo)) {
            $base_name = basename($model_photo->lokasi);
            $save_to = "images/user/{$user_id}";
            $old_photo_location = "images/user/{$base_name}";
            $new_photo_location = "{$save_to}/{$base_name}";
            Utility::checkPathExist($save_to);
            rename($old_photo_location, $new_photo_location);
            Foto::model()->updateByPk($photo_id, array('user_id' => $user_id, 'lokasi' => $new_photo_location));
        }
        return $new_photo_location;
    }
/**
 * Action untuk menghapus data tambahan akun ustadz
 *
 * Menghapus data tambahan ustadz
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id ustadz
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */ 
    public function actionDeleteAdditional() {
        $message = array();
        $message['success'] = 0;
        if (!empty($_POST['model']) && !empty($_POST['id'])) {
            $model = new $_POST['model']();
            if ($model->loadModelId($_POST['id'])->delete()) {
                $message['success'] = 1;
            };
            echo json_encode($message);
        }
        Yii::app()->end();
    }
/**
 * Action untuk menghapus data akun ustadz
 *
 * Menghapus data ustadz
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id ustadz
 *
 * @return bool kondisi sukses
 */
    public function actionDelete($id){
        if(!empty($id)){
            (new User())->loadModelId($id)->delete();
        }
    }    
/**
 * Action untuk menghapus beberapa data akun ustadz berdasarkan id
 *
 * Menghapus baris data pada tabel santri
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id ustadz (multi)
 *
 * @return string json jumlah ustadz yang berhasil dihapus
 */
    public function actionDeleteAll(){
        $result = array('total_delete'=>0);
        if(isset($_POST['id'])){
            $result['total_delete'] = User::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
/**
 * Action untuk mendapatkan status daftar ulang ustadz
 *
 * Mendapatkan status daftar ulang ustadz
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id ustadz
 *
 * @return html dialog status daftar ulang
 */
    public function actionRegistration($id) {
        $registration = new RegistrationForm();
        $registration->user_id = $id;
        $registration_status = User::model()->getRegistrationStatus($id);
        $model_santri = Santri::model()->findByPk($id);
        if ($registration_status == 3) {
            $register = (new RiwayatRegistrasiUlang())->getLast($id);
            if (!empty($register)) {
                $registration->pendidikan_id = $register->pendidikan_id;
                $registration->tingkat = $register->tingkat;
                $registration->tanggal_registrasi_ulang = $register->tanggal_registrasi_ulang;
            }
        }
        $pondokan = (new RiwayatPondokan())->getLast($id);
        if (!empty($pondokan)) {
            $registration->pondok_id = $pondokan->pondok_id;
            $registration->keterangan_pindah = $pondokan->keterangan_pindah;
            $registration->tanggal_pindah_pondok = $pondokan->tanggal_pindah_pondok;
        }
        $halaqoh = (new RiwayatKelompok())->getLast($id);
        if (!empty($halaqoh)) {
            $registration->kelompok = $halaqoh->kelompok;
            $registration->tanggal_dibuat = $halaqoh->tanggal_dibuat;
        }
        $form = $this->renderPartial('_registrationForm', array('santri'=>$model_santri, 'user_id'=>$id, 'registration_status' => $registration_status, 'registration_data' => $registration));
        echo $form;
        Yii::app()->end();
    }
/**
 * Action untuk mengubah status daftar ulang ustadz
 *
 * Mengubah status daftar ulang ustadz
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['RegistrationForm']
 * @param int ['RegistrationForm']['pendidikan_id'] (2=sd, 3=smp, 4=sma, 8=mahasiswa)
 * @param string ['RegistrationForm']['tingkat'] kelas/semester
 * @param int ['RegistrationForm']['pondok_id']
 * @param string ['RegistrationForm']['keterangan_pindah'] alasan pindah
 * @param int ['RegistrationForm']['kelompok'] id kelompok
 *
 * @return string json array status
 *      @return string message keterangan error (optional) 
 */
    public function actionRegistrationSave() {
        $result = array();
        if (isset($_POST) && !empty($_POST)) {
            $registration = new RegistrationForm();
            $registration->attributes = $_POST['RegistrationForm'];
            if (!empty($registration->pendidikan_id)) {
                $register = new RiwayatRegistrasiUlang();
                $register->tanggal_registrasi_ulang = date('Y-m-d', time());
                $register->user_id = $registration->user_id;
                $register->pendidikan_id = $registration->pendidikan_id;
                $register->tingkat = $registration->tingkat;
                $register->aktif = 1;
                if ($register->validate()) {
                    $register->save();
                } else {
                    $result['register']['message'] = $register->errors;
                }
            }
            if (!empty($registration->pondok_id)) {
                $last_pondok = (new RiwayatPondokan())->getLast($registration->user_id);
                if (!empty($last_pondok)) {
                    if ($registration->pondok_id != $last_pondok->pondok_id) {
                        $result = $this->createRiwayatPondok($registration);
                    }
                } else {
                    $result = $this->createRiwayatPondok($registration);
                }
            }
            if (!empty($registration->kelompok)) {
                $last_halaqoh = (new RiwayatKelompok())->getLast($registration->user_id);
                if (!empty($last_halaqoh)) {
                    if ($registration->kelompok != $last_halaqoh->kelompok) {
                        $result = $this->createRiwayatKelompok($registration);
                    }
                } else {
                    $result = $this->createRiwayatKelompok($registration);
                }
            }
        }
        echo json_encode($result);
    }
/**
 * Function untuk menambah riwayat pondok ustadz
 *
 * Menambah riwayat pondok ustadz
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param RiwayatPondokan $registration
 *
 * @return string json array status
 *      @return string message keterangan error (optional) 
 */
    private function createRiwayatPondok($registration) {
        $pondokan = new RiwayatPondokan();
        $pondokan->pondok_id = $registration->pondok_id;
        $pondokan->tanggal_pindah_pondok = date('Y-m-d', time());
        $pondokan->user_id = $registration->user_id;
        $pondokan->keterangan_pindah = $registration->keterangan_pindah;
        $pondokan->aktif = 1;
        if ($pondokan->validate()) {
            $pondokan->save();
        } else {
            $result['pondokan']['message'] = $pondokan->errors;
        }
    }
/**
 * Function untuk menambah riwayat kelompok
 *
 * Menambah riwayat kelompok ustadz
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param RiwayatKelompok $registration
 *
 * @return string json array status
 *      @return string message keterangan error (optional) 
 */
    private function createRiwayatKelompok($registration) {
        $halaqoh = new RiwayatKelompok();
        $halaqoh->kelompok = $registration->kelompok;
        $halaqoh->tanggal_dibuat = date('Y-m-d', time());
        $halaqoh->user_id = $registration->user_id;
        $halaqoh->aktif = 1;
        if ($halaqoh->validate()) {
            $halaqoh->save();
        } else {
            $result['halaqoh']['message'] = $halaqoh->errors;
        }
    }

}
