<?php

/**
 * This is the model class for table "mutabaah_tahfidz".
 *
 * The followings are the available columns in table 'mutabaah_tahfidz':
 * @property string $id
 * @property string $semester_id
 * @property string $tanggal
 * @property integer $tipe
 * @property string $setoran
 * @property string $nilai
 * @property string $keterangan
 * @property string $catatan
 * @property string $tanggal_catatan
 * @property string $ustadz_id
 */
class MutabaahTahfidz extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $persentase_hafalan;
    public $nama_lengkap;
    public $jenis_kelamin;
    public $total;

    public function tableName() {
        return 'mutabaah_tahfidz';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tanggal, ustadz_id, santri_id', 'required', 'message' => '{attribute} tidak boleh kosong'),
            array('tipe, setoran_juz, setoran_halaman, nilai', 'required', 'on' => 'comeIn', 'message' => '{attribute} tidak boleh kosong'),
            array('tipe, setoran_surat, nilai, keterangan', 'required', 'on' => 'muqaddimah', 'message' => '{attribute} tidak boleh kosong'),
            array('tipe, setoran_juz, nilai', 'required', 'on' => 'foursurrah', 'message' => '{attribute} tidak boleh kosong'),
            array('tipe, setoran_juz, setoran_halaman, nilai', 'required', 'on' => 'juz', 'message' => '{attribute} tidak boleh kosong'),
            array('keterangan', 'required', 'on' => 'absent', 'message' => '{attribute} tidak boleh kosong'),
            array('tipe, setoran_juz, setoran_halaman, setoran_surat, yang_terbaru, absensi', 'numerical', 'integerOnly' => true),
            array('semester_id, ustadz_id, santri_id', 'length', 'max' => 10),
            array('nilai', 'length', 'max' => 50),
            array('keterangan, catatan, tanggal_catatan', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, semester_id, tanggal, tipe, setoran_juz, setoran_halaman, setoran_surat, nilai, keterangan, catatan, tanggal_catatan, ustadz_id, santri_id, yang_terbaru, absensi', 'safe', 'on' => 'search'),
            );
}

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user_santri' => array(self::BELONGS_TO, 'User', 'santri_id'),
            'user_ustadz' => array(self::BELONGS_TO, 'User', 'ustadz_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'semester_id' => 'Semester',
            'tanggal' => 'Tanggal',
            'tipe' => 'Tipe',
            'setoran_juz' => 'Setoran Juz',
            'setoran_halaman' => 'Setoran Halaman',
            'setoran_surat' => 'Setoran Surat',
            'nilai' => 'Nilai',
            'keterangan' => 'Keterangan',
            'catatan' => 'Catatan',
            'tanggal_catatan' => 'Tanggal Catatan',
            'ustadz_id' => 'Ustadz',
            'santri_id' => 'Santri',
            'yang_terbaru' => 'Yang Terbaru',
            'absensi' => 'Absensi',
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
        $criteria->compare('semester_id', $this->semester_id, true);
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('tipe', $this->tipe);
        $criteria->compare('setoran_juz', $this->setoran_juz);
        $criteria->compare('setoran_halaman', $this->setoran_halaman);
        $criteria->compare('setoran_surat', $this->setoran_surat);
        $criteria->compare('nilai', $this->nilai, true);
        $criteria->compare('keterangan', $this->keterangan, true);
        $criteria->compare('catatan', $this->catatan, true);
        $criteria->compare('tanggal_catatan', $this->tanggal_catatan, true);
        $criteria->compare('ustadz_id', $this->ustadz_id, true);
        $criteria->compare('santri_id', $this->santri_id, true);
        $criteria->compare('yang_terbaru', $this->yang_terbaru);
        $criteria->compare('absensi', $this->absensi);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MutabaahTahfidz2 the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        parent::afterSave();
        if ($this->isNewRecord) {
            $criteria = new CDbCriteria();
            $criteria->condition = "id != {$this->id}";
            if(!empty($this->tipe)){
                $criteria->compare('tipe', $this->tipe);
            }
            else{
                $criteria->addCondition('tipe IS NULL OR tipe = ""');
            }
            $criteria->compare('santri_id', $this->santri_id);
            $this->model()->updateAll(array('yang_terbaru' => 0), $criteria);
            // if (!empty($model)) {
            //     $model->updateAll(array('yang_terbaru' => 0));
            // }
        }
        return true;
    }

    public function beforeSave() {
        parent::beforeSave();
        if ($this->absensi != 1) {
            $this->nilai = '';
            $this->setoran_juz = '';
            $this->setoran_halaman = '';
            $this->setoran_surat = '';
        }
        return true;
    }

//    public function searchSantri() {
//        // @todo Please modify the following code to remove attributes that should not be searched.
//
//        $criteria = new CDbCriteria;
//        $criteria->with = array(
//            'user_santri' => array(),
//        );
//        $criteria->compare('user_santri.group_id', 13);
//        $criteria->compare('t.id', $this->id, true);
//        $criteria->compare('semester_id', $this->semester_id, true);
//        $criteria->compare('tanggal', $this->tanggal, true);
//        $criteria->compare('tipe', $this->tipe);
//        $criteria->compare('setoran_juz', $this->setoran_juz);
//        $criteria->compare('setoran_halaman', $this->setoran_halaman);
//        $criteria->compare('nilai', $this->nilai, true);
//        $criteria->compare('keterangan', $this->keterangan, true);
//        $criteria->compare('catatan', $this->catatan, true);
//        $criteria->compare('tanggal_catatan', $this->tanggal_catatan, true);
//        $criteria->compare('ustadz_id', $this->ustadz_id, true);
//        $criteria->compare('santri_id', $this->santri_id, true);
//        $criteria->compare('yang_terbaru', $this->yang_terbaru);
//
//        $criteria->order = 't.tanggal DESC';
//
//        return new CActiveDataProvider($this, array(
//            'criteria' => $criteria,
//            'pagination' => array(
//                'pageSize' => 5,
//            ),
//        ));
//    }

    public function filterDateHafalan($param, $month, $year) {
        $criteria = new CDbCriteria;
        if (!empty($param['tahun'])) {
            if ($param['tahun'] != 'all') {
                if ($param['bulan'] == 'all') {
                    $start_time = "{$param['tahun']}-1-1 00:00:00";
                    $end_time = "{$param['tahun']}-12-31 23:59:59";
                } else {
                    $date = Utility::getNumberOfDate($param['bulan'], $param['tahun']);
                    $start_time = "{$param['tahun']}-{$param['bulan']}-1 00:00:00";
                    $end_time = "{$param['tahun']}-{$param['bulan']}-{$date} 23:59:59";
                }
                $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
                $criteria->params[':start_time'] = $start_time;
                $criteria->params[':end_time'] = $end_time;
            }
        } else {
            $date = Utility::getNumberOfDate($month, $year);
            $start_time = "{$year}-{$month}-1 00:00:00";
            $end_time = "{$year}-{$month}-{$date} 23:59:59";
            $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
            $criteria->params[':start_time'] = $start_time;
            $criteria->params[':end_time'] = $end_time;
        }
        $criteria->compare('santri_id', $param['id']);
        $criteria->order = 't.tanggal DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
                ),
            ));
    }

    public function searchHafalan() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('semester_id', $this->semester_id, true);
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('tipe', $this->tipe);
        $criteria->compare('setoran_juz', $this->setoran_juz);
        $criteria->compare('setoran_halaman', $this->setoran_halaman);
        $criteria->compare('nilai', $this->nilai, true);
        $criteria->compare('keterangan', $this->keterangan, true);
        $criteria->compare('catatan', $this->catatan, true);
        $criteria->compare('tanggal_catatan', $this->tanggal_catatan, true);
        $criteria->compare('ustadz_id', $this->ustadz_id, true);
        $criteria->compare('santri_id', $this->santri_id, true);
        $criteria->compare('yang_terbaru', $this->yang_terbaru);
        $criteria->compare('absensi', $this->absensi);

        $criteria->order = 't.tanggal DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
                ),
            ));
    }

    public function getAllHafalan($param) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user_santri' => array('alias' => 'a'),
            'user_santri.santri' => array('alias' => 'b'),
//            'user_santri.riwayatPondokans' => array('alias' => 'c'),
//            'user_santri.riwayatKelompoks' => array('alias' => 'd'),
            );
        if (!empty($param['tahun'])) {
            $criteria->condition = "YEAR(tanggal) = {$param['tahun']} AND MONTH(tanggal) = {$param['bulan']}";
        }
        if (!empty($param['kelompok'])) {
            $criteria->compare('d.kelompok', $param['kelompok']);
            $criteria->compare('d.aktif', 1);
            $criteria->with['user_santri.riwayatKelompoks'] = array('alias' => 'd');
            $criteria->together = true;
        }
        if (!empty($param['jenis_kelamin'])) {
            $criteria->compare('b.jenis_kelamin', $param['jenis_kelamin']);
        }
        if (!empty($param['nama_lengkap'])) {
            $criteria->compare('b.nama_lengkap', $param['nama_lengkap'], true);
        }
        if (!empty($param['group'])) {
            $criteria->compare('a.group_id', $param['group']);
        }
        if (!empty($param['pondok_id'])) {
            $criteria->compare('c.pondok_id', $param['pondok_id']);
            $criteria->compare('c.aktif', 1);
            $criteria->with['user_santri.riwayatPondokans'] = array('alias' => 'c');
            $criteria->together = true;
        }
        $criteria->order = 't.tanggal DESC';

        return new CActiveDataProvider(new MutabaahTahfidz(), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
                ),
            ));
    }

    public function loadModelId($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }

    public function getSummary($param, $month = null, $year = null) {
        $criteria = new CDbCriteria;
        if (!empty($param['tahun'])) {
            if ($param['tahun'] != 'all') {
                if ($param['bulan'] == 'all') {
                    $start_time = "{$param['tahun']}-1-1 00:00:00";
                    $end_time = "{$param['tahun']}-12-31 23:59:59";
                } else {
                    $date = Utility::getNumberOfDate($param['bulan'], $param['tahun']);
                    $start_time = "{$param['tahun']}-{$param['bulan']}-1 00:00:00";
                    $end_time = "{$param['tahun']}-{$param['bulan']}-{$date} 23:59:59";
                }
                $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
                $criteria->params[':start_time'] = $start_time;
                $criteria->params[':end_time'] = $end_time;
            }
        } else {
            $date = Utility::getNumberOfDate($month, $year);
            $start_time = "{$year}-{$month}-1 00:00:00";
            $end_time = "{$year}-{$month}-{$date} 23:59:59";
            $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
            $criteria->params[':start_time'] = $start_time;
            $criteria->params[':end_time'] = $end_time;
        }
        $criteria->compare('santri_id', $param['id']);
        $criteria->order = 't.tanggal DESC';
        $model = $this->model()->findAll($criteria);
        $result = array();
        foreach ($model as $recitation) {
            $date_recitation = date('d', strtotime($recitation->tanggal));
            if ($recitation->absensi == '1') {
                if ($recitation->tipe == 4) {
                    $result[$date_recitation]['masuk'][1] = array(
                        'subtipe' => $recitation->tipe,
                        'surat' => $recitation->setoran_surat,
                        'ustadz' => $recitation->ustadz_id,
                        'keterangan' => $recitation->keterangan,
                        'nilai' => $recitation->nilai,
                        );
                } else {
                    $juz = '';
                    if(!empty($recitation->setoran_juz)){
                        if($recitation->setoran_juz < 0){
                            $juz = Utility::getFourSurahName($recitation->setoran_juz);
                        }
                        else{
                            $juz = $recitation->setoran_juz;
                        }
                    }
                    $result[$date_recitation]['masuk'][(int) $recitation->tipe] = array(
                        'subtipe' => $recitation->tipe,
                        'juz' => $juz,
                        'hal' => $recitation->setoran_halaman,
                        'ustadz' => $recitation->ustadz_id,
                        'keterangan' => $recitation->keterangan,
                        'nilai' => $recitation->nilai,
                        );
                }
            } else {
                $result[$date_recitation]['tidak_masuk'] = array(
                    'alasan' => $recitation->absensi,
                    'ustadz' => $recitation->ustadz_id,
                    'keterangan' => $recitation->keterangan,
                    );
            }
        }
//        file_put_contents('result', json_encode($result));
        return $result;
    }

    public static function getAbsentName($id) {
        $absent = '';
        switch ($id) {
            case '1'://telat 2 kali registrasi ulang
            $absent = 'Masuk';
            break;
            case '2':
            $absent = 'Izin Sakit';
            break;
            case '3':
            $absent = 'Izin Lain';
            break;
            case '4':
            $absent = 'Tanpa Keterangan';
            break;
            case '5':
            $absent = 'Lain-lain';
            break;
            default:
            break;
        }
        return $absent;
    }

    public static function getMuqaddimahSurahName($id) {
        $surah = '';
        switch ($id) {
            case '1'://telat 2 kali registrasi ulang
            $surah = 'Ar-Rahman';
            break;
            case '2':
            $surah = 'Al-Waqiah';
            break;
            case '3':
            $surah = 'Al-Mulk';
            break;
            case '4':
            $surah = 'Yasin';
            break;
            default:
            break;
        }
        return $surah;
    }

    public function afterDelete() {
        parent::afterDelete();
        if (!empty($this->tipe)) {
            $model = $this->model()->find(array('condition' => "santri_id = $this->santri_id && tipe = $this->tipe", 'order' => 'tanggal DESC'));
            if (!empty($model)) {
                $model->yang_terbaru = 1;
                $model->save();
            }
        }
    }

    public function getWellJsonSummary($param, $month = null, $year = null) {
        $criteria = new CDbCriteria;
        if (!empty($param['tahun'])) {
            if ($param['tahun'] != 'all') {
                if ($param['bulan'] == 'all') {
                    $start_time = "{$param['tahun']}-1-1 00:00:00";
                    $end_time = "{$param['tahun']}-12-31 23:59:59";
                } else {
                    $date = Utility::getNumberOfDate($param['bulan'], $param['tahun']);
                    $start_time = "{$param['tahun']}-{$param['bulan']}-1 00:00:00";
                    $end_time = "{$param['tahun']}-{$param['bulan']}-{$date} 23:59:59";
                }
                $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
                $criteria->params[':start_time'] = $start_time;
                $criteria->params[':end_time'] = $end_time;
            }
        } else {
            $date = Utility::getNumberOfDate($month, $year);
            $start_time = "{$year}-{$month}-1 00:00:00";
            $end_time = "{$year}-{$month}-{$date} 23:59:59";
            $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
            $criteria->params[':start_time'] = $start_time;
            $criteria->params[':end_time'] = $end_time;
        }
        $criteria->compare('santri_id', $param['id']);
        $criteria->order = 'DATE(t.tanggal) DESC, t.absensi ASC, t.tipe ASC, t.tanggal DESC';
        $model = $this->model()->findAll($criteria);
        $result = array();
        $dictionary_date = array();
        $date_attendance = array();
        $date_come_in = array();
        $date_type = array();
        $i = 0;
        foreach ($model as $recitation) {
            $date_recitation = date('d', strtotime($recitation->tanggal));
            //skip not come in
            if (!array_key_exists($date_recitation, $date_come_in) && $recitation->absensi == 1) {
                $date_come_in[$date_recitation] = 1;
            } elseif (array_key_exists($date_recitation, $date_come_in) && $recitation->absensi != 1) {
                continue;
            }
            //skip double type
            if (!array_key_exists($date_recitation, $date_type) && !empty($recitation->tipe)) {
                $date_type[$date_recitation] = array();
                $date_type[$date_recitation][$recitation->tipe] = 1;
            } elseif (array_key_exists($date_recitation, $date_come_in) && !empty($recitation->tipe)) {
                if ((!array_key_exists($recitation->tipe, $date_type[$date_recitation]))) {
                    $date_type[$date_recitation][$recitation->tipe] = 1;
                } else {
                    continue;
                }
            }
            //create date array
            if (!array_key_exists($date_recitation, $dictionary_date)) {
                $dictionary_date[$date_recitation] = $i;
                $i++;
            }
            //create type array
            if (!array_key_exists($date_recitation, $date_attendance)) {
                $date_attendance[$date_recitation] = 0;
            } else {
                $date_attendance[$date_recitation] ++;
            }

            if ($recitation->absensi == '1') {
                if ($recitation->tipe == 4) {
                    $full_detail = array(
                        'tipe' => $recitation->tipe,
                        'surat' => $recitation->setoran_surat,
                        'ustadz' => $recitation->ustadz_id,
                        'keterangan' => $recitation->keterangan,
                        'nilai' => $recitation->nilai,
                        'tanggal' => $recitation->tanggal,
                        );
                    $result[$dictionary_date[$date_recitation]]['tanggal'] = $date_recitation;
                    $result[$dictionary_date[$date_recitation]]['absensi'] = 'masuk';
                    $result[$dictionary_date[$date_recitation]]['absensi_detail'][$date_attendance[$date_recitation]] = $full_detail;
//                    $result[$dictionary_date[$date_recitation]]['absensi'][$j]['data'] = $full_detail;
                } else {
                    $full_detail = array(
                        'tipe' => $recitation->tipe,
                        'juz' => $recitation->setoran_juz,
                        'hal' => $recitation->setoran_halaman,
                        'ustadz' => $recitation->ustadz_id,
                        'keterangan' => $recitation->keterangan,
                        'nilai' => $recitation->nilai,
                        'tanggal' => $recitation->tanggal,
                        );
                    $result[$dictionary_date[$date_recitation]]['tanggal'] = $date_recitation;
                    $result[$dictionary_date[$date_recitation]]['absensi'] = 'masuk';
                    $result[$dictionary_date[$date_recitation]]['absensi_detail'][$date_attendance[$date_recitation]] = $full_detail;
                }
            } else {
                $full_detail = array(
                    'alasan' => $recitation->absensi,
                    'ustadz' => $recitation->ustadz_id,
                    'keterangan' => $recitation->keterangan,
                    'tanggal' => $recitation->tanggal,
                    );
                $result[$dictionary_date[$date_recitation]]['tanggal'] = $date_recitation;
                $result[$dictionary_date[$date_recitation]]['absensi'] = 'tidak masuk';
                $result[$dictionary_date[$date_recitation]]['absensi_detail'][$date_attendance[$date_recitation]] = $full_detail;
            }
        }
        return $result;
    }

    public function getFirstLastRecitationByGroup($group_id, $date_order = 'ASC') {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user_santri' => array(
                'alias' => 'a'
                ),
            );
        $criteria->compare('a.group_id', $group_id);
        $criteria->order = "tanggal $date_order";
        $criteria->together = TRUE;
        $model = $this->model()->find($criteria);
        return $model;
    }

    public function getAbsentDay($param, $month=null, $year=null) {
        $criteria = new CDbCriteria;
        $criteria->select = 'count(*) as total, absensi';
        if (!empty($param['tahun'])) {
            if ($param['tahun'] != 'all') {
                if ($param['bulan'] == 'all') {
                    $start_time = "{$param['tahun']}-1-1 00:00:00";
                    $end_time = "{$param['tahun']}-12-31 23:59:59";
                } else {
                    $date = Utility::getNumberOfDate($param['bulan'], $param['tahun']);
                    $start_time = "{$param['tahun']}-{$param['bulan']}-1 00:00:00";
                    $end_time = "{$param['tahun']}-{$param['bulan']}-{$date} 23:59:59";
                }
                $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
                $criteria->params[':start_time'] = $start_time;
                $criteria->params[':end_time'] = $end_time;
            }
        } else {
            $date = Utility::getNumberOfDate($month, $year);
            $start_time = "{$year}-{$month}-1 00:00:00";
            $end_time = "{$year}-{$month}-{$date} 23:59:59";
            $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
            $criteria->params[':start_time'] = $start_time;
            $criteria->params[':end_time'] = $end_time;
        }
        
        $criteria->compare('santri_id', $param['id']);
        $criteria->addCondition("absensi = '2' OR absensi = '3' OR absensi = '4'");
        $criteria->group = 'absensi';
        $criteria->order = 't.tanggal DESC';
        
        $model = $this->model()->findAll($criteria);
        return $model;
    }

    public function deleteHafalan($params){
        $message = array('success'=>'0');
        $model = (new MutabaahTahfidz)->loadModelId($params['id']);
        if(!empty($model)){
            $model->delete();
            $message = array('success'=>'1');
        }
        return $message;
    }

}
