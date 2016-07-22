<?php

/**
 * This is the model class for table "santri".
 *
 * The followings are the available columns in table 'santri':
 * @property string $id
 * @property string $nama_lengkap
 * @property string $nama_panggilan
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property integer $golongan_darah
 * @property integer $jumlah_saudara
 * @property integer $anak_ke
 * @property integer $jenis_kelamin
 * @property string $no_telepon_rumah
 * @property string $alamat_keluarga_yogya
 * @property string $no_telepon_keluarga_yogya
 * @property string $cita_cita
 * @property string $hobi
 * @property string $motivasi_masuk_rtqu
 * @property string $prestasi_hafalan
 * @property string $tanggal_masuk_rtqu
 */
class Santri extends CActiveRecord {

    public $photo_id;
    public $name_search;
    public $group;
    public $create_user;
    public $total;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'santri';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nama_lengkap', 'required', 'message' => '{attribute} tidak boleh kosong'),
            array('nama_panggilan, tempat_lahir, tanggal_lahir, jumlah_saudara, anak_ke, jenis_kelamin, tanggal_masuk_rtqu', 'required', 'on' => 'full', 'message' => '{attribute} tidak boleh kosong'),
            array('golongan_darah, jumlah_saudara, anak_ke, jenis_kelamin', 'numerical', 'integerOnly' => true, 'message' => '{attribute} harus angka'),
            array('tanggal_lahir, tanggal_masuk_rtqu', 'match', 'pattern' => '/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i', 'message' => "Format {attribute} salah"),
            array('nama_lengkap', 'length', 'max' => 80),
            array('nama_panggilan, tempat_lahir', 'length', 'max' => 50),
            array('no_telepon_rumah, no_telepon_keluarga_yogya', 'length', 'max' => 15),
            array('cita_cita, hobi', 'length', 'max' => 255),
            array('alamat_keluarga_yogya, motivasi_masuk_rtqu, prestasi_hafalan', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('photo_id,id, nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir, golongan_darah, jumlah_saudara, anak_ke, jenis_kelamin, no_telepon_rumah, alamat_keluarga_yogya, no_telepon_keluarga_yogya, cita_cita, hobi, motivasi_masuk_rtqu, prestasi_hafalan, tanggal_masuk_rtqu', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama_lengkap' => 'Nama Lengkap',
            'nama_panggilan' => 'Nama Panggilan',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'golongan_darah' => 'Golongan Darah',
            'jumlah_saudara' => 'Jumlah Saudara',
            'anak_ke' => 'Anak Ke',
            'jenis_kelamin' => 'Jenis Kelamin',
            'no_telepon_rumah' => 'No Telepon Rumah',
            'alamat_keluarga_yogya' => 'Alamat Keluarga Yogya',
            'no_telepon_keluarga_yogya' => 'No Telepon Keluarga Yogya',
            'cita_cita' => 'Cita Cita',
            'hobi' => 'Hobi',
            'motivasi_masuk_rtqu' => 'Motivasi Masuk Rumah Tahfidz',
            'prestasi_hafalan' => 'Prestasi Hafalan',
            'tanggal_masuk_rtqu' => 'Tanggal Masuk Rumah Tahfidz',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('nama_lengkap', $this->nama_lengkap, true);
        $criteria->compare('nama_panggilan', $this->nama_panggilan, true);
        $criteria->compare('tempat_lahir', $this->tempat_lahir, true);
        $criteria->compare('tanggal_lahir', $this->tanggal_lahir, true);
        $criteria->compare('golongan_darah', $this->golongan_darah);
        $criteria->compare('jumlah_saudara', $this->jumlah_saudara);
        $criteria->compare('anak_ke', $this->anak_ke);
        $criteria->compare('jenis_kelamin', $this->jenis_kelamin);
        $criteria->compare('no_telepon_rumah', $this->no_telepon_rumah, true);
        $criteria->compare('alamat_keluarga_yogya', $this->alamat_keluarga_yogya, true);
        $criteria->compare('no_telepon_keluarga_yogya', $this->no_telepon_keluarga_yogya, true);
        $criteria->compare('cita_cita', $this->cita_cita, true);
        $criteria->compare('hobi', $this->hobi, true);
        $criteria->compare('motivasi_masuk_rtqu', $this->motivasi_masuk_rtqu, true);
        $criteria->compare('prestasi_hafalan', $this->prestasi_hafalan, true);
        $criteria->compare('tanggal_masuk_rtqu', $this->tanggal_masuk_rtqu, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Santri the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    //API mendapatkan daftar hafalan santri
    public function getHafalan($params) {
        $result = array();
        $selected = array(
            'nama_lengkap', 'jenis_kelamin'
        );
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array(
                'alias' => 'd'
            ),
            'user.riwayatPondokans' => array(
                'alias' => 'a'
            ),
            'user.riwayatRegistrasiUlangs' => array(
                'alias' => 'b'
            ),
            'user.persentaseHafalan' => array(
                'alias' => 'c'
            ),
            'user.riwayatPondokans.pondok' => array(
                'alias' => 'e'
            ),
        );
        $criteria->select = $selected;
        if (!empty($params['search'])) {
            $criteria->condition = 't.nama_lengkap LIKE :match';
            $criteria->params[':match'] = '%' . $params['search'] . '%';
        }
        if (!empty($params['id'])) {
            $criteria->compare('t.id', $params['id']);
        }
        if (!empty($params['gender'])) {
            $criteria->compare('t.jenis_kelamin', $params['gender']);
        }
        if (!empty($params['grade'])) {
            $criteria->addCondition("b.pendidikan_id = {$params['grade']}"
            /* . "AND b.aktif = 1" */);
        }
        if (!empty($params['readmit'])) {
            $criteria->addCondition("b.aktif = 1");
        }
        $criteria->compare('d.group_id', 13);
        $criteria->compare('a.aktif', 1);
        $criteria->offset = $params['offset'];
        $criteria->limit = $params['limit'];
        $criteria->order = 'c.persen';
        $criteria->together = TRUE;

        $model = Santri::model()->findAll($criteria);
        if (!empty($model)) {
            $i = 0;
            foreach ($model as $santri) {
                foreach ($selected as $value) {
                    $result[$i][$value] = $santri->$value;
                }
                $result[$i]['jenis_kelamin'] = Utility::getGender($santri->jenis_kelamin);
                $result[$i]['pendidikan'] = '';
                if (!empty($santri->user->riwayatRegistrasiUlangs)) {
                    foreach ($santri->user->riwayatRegistrasiUlangs as $registrasi_ulang) {
                        $result[$i]['pendidikan'] = Utility::getSantriEducation($registrasi_ulang->pendidikan_id);
                    }
                }
                if (!empty($santri->user->riwayatPondokans)) {
                    foreach ($santri->user->riwayatPondokans as $riwayat_pondokan) {
                        $result[$i]['pondok'] = $riwayat_pondokan->pondok->nama_pondok;
                    }
                }
                if (!empty($santri->user->persentaseHafalan)) {
                    $result[$i]['persentase'] = $santri->user->persentaseHafalan->persen;
                }
                $i++;
            }
        }
        return $result;
    }

    //API mendapatkan detail hafalan santri
    public function getDetailHafalan($params) {
        $result = array();
        $selected = array(
            'semester_id', 'tanggal', 'tipe', 'setoran_juz', 'setoran_halaman',
            'nilai', 'keterangan', 'catatan', 'tanggal_catatan', 'ustadz_id'
        );

        $criteria = new CDbCriteria();
        if (!empty($params['month'])) {
            if (empty($params['year'])) {
                $params['year'] = date("Y", time());
            }
            $date = Utility::getNumberOfDate($params['month'], $params['year']);
            $start_time = "{$params['year']}-{$params['month']}-1 00:00:00";
            $end_time = "{$params['year']}-{$params['month']}-{$date} 23:59:59";
            $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
            $criteria->params[':start_time'] = $start_time;
            $criteria->params[':end_time'] = $end_time;
        }
        if (!empty($params['id'])) {
            $criteria->compare('t.santri_id', $params['id']);
        }
        if (!empty($params['type'])) {
            $criteria->compare('t.tipe', $params['type']);
        }
        $criteria->offset = $params['offset'];
        $criteria->limit = $params['limit'];
        $criteria->order = 't.tanggal DESC';
        $criteria->together = TRUE;

        $model = MutabaahTahfidz::model()->findAll($criteria);
        if (!empty($model)) {
            $i = 0;
            foreach ($model as $hafalan) {
                foreach ($selected as $value) {
                    $result[$i][$value] = $hafalan->$value;
                }
                $i++;
            }
        }
        return $result;
    }

    /*
      $params['id']
      $params['tanggal']
      $params['tipe']
      $params['setoran_juz']
      $params['setoran_halaman']
      $params['nilai']
      $params['keterangan']
      $params['catatan']
      $params['tanggal_catatan']
      $params['ustadz_id']
      $params['santri_id']
     */

    public function addHafalan($params) {
        $valid = TRUE;
        $message = array();
        $model = new MutabaahTahfidz();
        $model->attributes = $params;
        if (!empty($params['tipe'])) {
            if ($params['tipe'] == 4) {
                $model->setScenario('muqaddimah');
            } else {
                $model->setScenario('comeIn');
            }
        } else {
            $model->setScenario('absent');
        }
        $model->semester_id = Santri::model()->getActiveSemester($params['santri_id']);
        $model->yang_terbaru = 1;
        $valid = $model->validate() && $valid;
        if ($model->validate()) {
            $model->save();
            $message['success'] = '1';
            $message['message'] = '';
        } else {
            $message['success'] = '0';
            $message['message'] = $model->errors;
        }
        return $message;
    }

    public function getActiveSemester($id) {
        $semester_id = 0;
        $criteria = new CDbCriteria();
        $criteria->select = 'id';
        $criteria->compare('santri_id', $id);
        $criteria->limit = 1;
        $criteria->order = 'tanggal_dibuat';
        $model = Semester::model()->find($criteria);
        if (!empty($model)) {
            $semester_id = $model->id;
        }
        return $semester_id;
    }

    public function beforeSave() {
        parent::beforeSave();
        if (preg_match('/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i', $this->tanggal_lahir)) {
            $this->tanggal_lahir = date('Y-m-d', strtotime(Utility::convertDateId($this->tanggal_lahir)));
        }
        if (preg_match('/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i', $this->tanggal_masuk_rtqu)) {
            $this->tanggal_masuk_rtqu = date('Y-m-d', strtotime(Utility::convertDateId($this->tanggal_masuk_rtqu)));
        }

        if ($this->isNewRecord && $this->create_user == TRUE) {
            $model_user = new User();
            if (!empty($this->group)) {
                $model_user->group_id = $this->group;
            } else {
                $model_user->group_id = 13;
            }
            $model_user->full_name = $this->nama_lengkap;
            $model_user->username = substr(Utility::replaceNotAlphanumeric($this->nama_lengkap), 0, 10) . time();
            $explode_name = explode(" ", $this->nama_lengkap);
            $model_user->username = $explode_name[0].date("d", strtotime($this->tanggal_lahir)).date("m", strtotime($this->tanggal_lahir));
            $model_user->currentPassword = $model_user->username;
            $model_user->retypePassword = $model_user->username;
            $model_user->is_active = 1;
            if ($model_user->validate()) {
                $model_user->save();
                $this->id = $model_user->id;
            } else {
                // file_put_contents('error', json_encode($model_user->errors));
                return FALSE;
            }
        }
        return TRUE;
    }

    public function afterSave() {
        parent::afterSave();
        if (!$this->isNewRecord) {
            $model_user = User::model()->findByPk($this->id);
            $model_user->full_name = $this->nama_lengkap;
            $model_user->save();
        }
        return TRUE;
    }

    public function getSantriDashboard() {
        $total = array();
        $grade = array('2' => 'sd', '3' => 'smp', '4' => 'sma', '8' => 'mahasiswa');
        $gender = array('1' => 'putra', '2' => 'putri');
        foreach ($grade as $grade_code => $grade_name) {
            foreach ($gender as $gender_code => $gender_name) {
                $criteria = new CDbCriteria();
                $criteria->with = array(
                    'user.riwayatRegistrasiUlangs' => array(
                        'alias' => 'a'
                    )
                );
                $criteria->compare('t.jenis_kelamin', $gender_code);
                $criteria->compare('a.aktif', 1);
                $criteria->compare('a.pendidikan_id', $grade_code);
                $criteria->together = TRUE;
                $total[$grade_name . '_' . $gender_name] = $this->model()->count($criteria);
            }
        }
        return $total;
    }

    public function getTopTenReciter() {
        $top = array();
        $grade = array('2' => 'sd', '3' => 'smp', '4' => 'sma', '8' => 'mahasiswa');
        foreach ($grade as $grade_code => $grade_name) {
            $criteria = new CDbCriteria();
            $criteria->with = array(
                'user.riwayatRegistrasiUlangs' => array(
                    'alias' => 'a'
                ),
                'user.persentaseHafalan' => array(
                    'alias' => 'b'
                ),
            );
            $criteria->limit = 10;
            $criteria->compare('a.aktif', 1);
            $criteria->compare('a.pendidikan_id', $grade_code);
            $criteria->together = TRUE;
            $criteria->order = 'b.persen DESC';
            $model = Santri::model()->findAll($criteria);
            $top[$grade_name] = array();
            foreach ($model as $topten) {
                $top[$grade_name][] = array(
                    'nama' => $topten->nama_lengkap,
                    'foto' => $topten->user->getPhotoIconUrl($topten->id),
                    'persen' => !empty($topten->user->persentaseHafalan) ? $topten->user->persentaseHafalan->persen : '0',
                    'url_profil' => Yii::app()->createAbsoluteUrl('santri/data/view/', array('id' => $topten->id)),
                );
            }
        }
        return $top;
    }

    public function searchSantri() {
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array(
//            'user.riwayatRegistrasiUlangOne' => array(                
//            )
            'user' => array(
//                'alias' => a
            )
        );
//        $criteria->compare('a.aktif',1);
        $criteria->compare('user.group_id', 13);
        $criteria->compare('id', $this->id, true);
        $criteria->compare('nama_lengkap', $this->nama_lengkap, true);
        $criteria->compare('nama_panggilan', $this->nama_panggilan, true);
        $criteria->compare('tempat_lahir', $this->tempat_lahir, true);
        $criteria->compare('tanggal_lahir', $this->tanggal_lahir, true);
        $criteria->compare('golongan_darah', $this->golongan_darah);
        $criteria->compare('jumlah_saudara', $this->jumlah_saudara);
        $criteria->compare('anak_ke', $this->anak_ke);
        $criteria->compare('jenis_kelamin', $this->jenis_kelamin);
        $criteria->compare('no_telepon_rumah', $this->no_telepon_rumah, true);
        $criteria->compare('alamat_keluarga_yogya', $this->alamat_keluarga_yogya, true);
        $criteria->compare('no_telepon_keluarga_yogya', $this->no_telepon_keluarga_yogya, true);
        $criteria->compare('cita_cita', $this->cita_cita, true);
        $criteria->compare('hobi', $this->hobi, true);
        $criteria->compare('motivasi_masuk_rtqu', $this->motivasi_masuk_rtqu, true);
        $criteria->compare('prestasi_hafalan', $this->prestasi_hafalan, true);
        $criteria->compare('tanggal_masuk_rtqu', $this->tanggal_masuk_rtqu, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
    }

    public function loadModel($id) {
        $model = $this->model()->findByPk($id);
//        if ($model === null)
//            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public static function getJuz($id) {
        $recitation = "";
        $criteria = new CDbCriteria();
        $criteria->select = 'id, persen_hafalan(setoran_juz, setoran_halaman) as persentase_hafalan';
        $criteria->compare('santri_id', $id);
        $criteria->compare('tipe', 1);
        $criteria->compare('yang_terbaru', 1);
        $model = MutabaahTahfidz::model()->find($criteria);
        if (!empty($model)) {
            $recitation = $model->persentase_hafalan;
        }
        return $recitation;
    }

    public static function getLastRecitation($id, $type = 1) {
        $recitation = array();
        $criteria = new CDbCriteria();
        $criteria->with = 'user_ustadz';
        $criteria->together = TRUE;
        $criteria->select = 'setoran_juz, setoran_halaman, nilai';
        $criteria->compare('santri_id', $id);
        $criteria->compare('tipe', $type);
        $criteria->compare('yang_terbaru', 1);
        $model = MutabaahTahfidz::model()->find($criteria);
        if (!empty($model)) {
            $recitation = array(
                'juz' => $model->setoran_juz,
                'halaman' => $model->setoran_halaman,
                'musyrif' => $model->user_ustadz->full_name,
                'nilai' => $model->nilai,

            );
        }
        return $recitation;
    }

    public function loadModelId($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }

    public function getAllSantri($param) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array('alias' => 'a'),
            'user.riwayatPondokans' => array('alias' => 'b'),
        );
        if (!empty($param['jenis_kelamin'])) {
            $criteria->compare('t.jenis_kelamin', $param['jenis_kelamin']);
        }
        if (!empty($param['nama_lengkap'])) {
            $criteria->compare('t.nama_lengkap', $param['nama_lengkap'], true);
        }
        if (!empty($param['pondok_id'])) {
            $criteria->compare('b.pondok_id', $param['pondok_id']);
            $criteria->compare('b.aktif', 1);
            $criteria->together = true;
        }
        if (!empty($param['group'])) {
            $criteria->compare('a.group_id', $param['group']);
        } else {
            $criteria->compare('a.group_id', 13);
        }

        $criteria->order = 't.nama_lengkap ASC';

        return new CActiveDataProvider(new Santri(), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
    }

    public function getFullName() {
        return $this->nama_lengkap;
    }

    public function getCount($quarters, $gender, $group) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array('alias' => 'a'),
            'user.riwayatPondokans' => array('alias' => 'b'),
        );
        $criteria->compare('t.jenis_kelamin', $gender);
        if (!empty($quarters)) {
            $criteria->compare('b.pondok_id', $quarters);
            $criteria->compare('b.aktif', 1);
            $criteria->together = true;
        }
        $criteria->compare('a.group_id', $group);
        return $this->model()->count($criteria);
    }

    public function afterDelete() {
        parent::afterDelete();
        $delete = User::model()->findByPk($this->id)->delete();
        file_put_contents('assets/delete', json_encode($delete));
    }

    public function isMyStudent($id, $member) {
        $is_my_student = FALSE;
        if (isset($member)) {
            if (in_array($id, $member)) {
                $is_my_student = TRUE;
            }
        } else {
            
        }
        return $is_my_student;
    }

    public static function getLastHafalan($params) {
        $result = array();
        $selected = array(
            'id', 'tipe', 'tanggal', 'setoran_juz', 'setoran_halaman'
            , 'setoran_surat', 'nilai', 'keterangan'
        );
        $criteria = new CDbCriteria();
//        $criteria->compare('santri_id', $params['id']);
        $criteria->condition = "tipe IS NOT NULL AND santri_id = {$params['id']}";
        $criteria->order = 'tanggal DESC';
        if(!empty($params['tipe'])){
            $criteria->compare('tipe', $params['tipe']);
        }
        $model = MutabaahTahfidz::model()->find($criteria);
        if (!empty($model)) {
            $i = 0;
            foreach ($selected as $value) {
                $result[$i][$value] = $model->$value;
            }
            $result[$i]['setoran_surat'] = MutabaahTahfidz::getMuqaddimahSurahName($model->setoran_surat);
        }
//        else{
//            $result = (object) $result;
//        }
        return $result;
    }

//    public static function getFullName($id){
//        return $this->loadModelId($id)->nama_lengkap;
//    }

    public function getRingkasanHafalan($params) {
//        $param['bulan']
//        $param['tahun']
//        $param['id']
        $data = (new MutabaahTahfidz())->getWellJsonSummary($params);
        return $data;
    }

    public function getSantriListByGrade($grade_code) {
        $result = array();
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user.riwayatRegistrasiUlangs' => array(
                'alias' => 'a'
            )
        );
        $criteria->compare('a.aktif', 1);
        $criteria->compare('a.pendidikan_id', $grade_code);
        $criteria->together = TRUE;
        $model = $this->model()->findAll($criteria);
        if (!empty($model)) {
            $i = 0;
            foreach ($model as $santri) {
                $result[$i]['id'] = $santri->id;
                $result[$i]['nama'] = ucwords($santri->nama_lengkap);
                $result[$i]['jenis_kelamin'] = ucwords(Utility::getGender($santri->jenis_kelamin));
                $result[$i]['sekolah'] = $santri->user->getSantriEducation();
                $result[$i]['status_registrasi'] = Utility::getReregistrationStatus(User::getRegistrationStatus($santri->id));
                $result[$i]['foto'] = (new User())->getPhotoIconUrl($santri->id);
                $result[$i]['asrama'] = $santri->user->getPondokan();
                $result[$i]['juz'] = Santri::getJuz($santri->id);
                $i++;
            }
        }
        return $result;
    }

    public function getSantriActiveByQuarters($quarters) {
        $academic_year = '2211-11-22';
        $last_academic_year = TahunAjaranBaru::model()->find(array('order' => 'tanggal_dimulai DESC'));
        if (!empty($last_academic_year)) {
            $academic_year = $last_academic_year->tanggal_dimulai;
        }
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array(
                'alias' => 'a'
            ),
//            'user.riwayatPondokans' => array(
//                'alias' => 'b'
//            ),
            'user.riwayatRegistrasiUlangs' => array(
                'alias' => 'c'
            ),
        );
        $criteria->condition = "c.tanggal_registrasi_ulang >= '{$academic_year}'";
        $criteria->compare('c.aktif', 1);
        $criteria->compare('a.group_id', 13);
        if (!empty($quarters)) {
            $criteria->with['user.riwayatPondokans'] = array(
                'alias' => 'b'
            );
            $criteria->compare('b.pondok_id', $quarters);
            $criteria->compare('b.aktif', 1);
        }
        $criteria->together = TRUE;
        $model = Santri::model()->findAll($criteria);
        return $model;
    }

    public function getSantriPerquarters() {
        $academic_year = '2211-11-22';
        $last_academic_year = TahunAjaranBaru::model()->find(array('order' => 'tanggal_dimulai DESC'));
        if (!empty($last_academic_year)) {
            $academic_year = $last_academic_year->tanggal_dimulai;
        }
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array('alias' => 'a'),
            'user.riwayatPondokanOne' => array('alias' => 'riwayatPondokanOne'),
            'user.riwayatRegistrasiUlangs' => array('alias' => 'c'),
            'user.riwayatPondokanOne.pondok' => array('alias' => 'd'),
        );
        $criteria->select = 'a.jenis_kelamin, count(*) as total';
        $criteria->condition = "c.tanggal_registrasi_ulang >= '{$academic_year}'";
        $criteria->compare('c.aktif', 1);
//        $criteria->compare('b.aktif', 1);
        $criteria->compare('a.group_id', 13);
        $criteria->group = "riwayatPondokanOne.pondok_id, t.jenis_kelamin";
        $criteria->together = true;
        return array('santri'=>$this->model()->findAll($criteria),'academic_year'=>$last_academic_year);
    }

}
