<?php

/**
 * This is the model class for table "cklt_user".
 *
 * The followings are the available columns in table 'cklt_user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $full_name
 * @property string $gender
 * @property string $email
 * @property string $group_id
 * @property string $is_active
 * @property string $active_date
 * @property string $log
 * @property string $photo
 * @property string $log_date
 *
 * The followings are the available model relations:
 * @property Group $group
 * @property SkilledAq $skilled_aq
 */
class User extends CActiveRecord {

    public $retypePassword;
    public $oldPassword;
    public $currentPassword;
    private $tempPhoto;
    public $currentPhoto;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cklt_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('group_id, full_name, username', 'required', 'message'=>'{attribute} tidak boleh kosong'),
            array('currentPassword, retypePassword', 'required', 'on' => 'create', 'message'=>'{attribute} tidak boleh kosong'),
            array('oldPassword, currentPassword', 'required', 'on' => 'updating', 'message'=>'{attribute} tidak boleh kosong'),
            array('gender, group_id, is_active', 'numerical', 'integerOnly' => true, 'message'=>'{attribute} harus berupa angka'),
            array('username', 'length', 'max' => 31, 'message'=>'Panjang {attribute} lebih dari 31 karakter'),
            // array('username','match', 'pattern'=> '/^[a-zA-Z0-9]\w{0,31}$/','message'=>"{attribute} harus merupakan kombinasi huruf atau angka antara 1-31 karakter"),
            array('password, oldPassword', 'length', 'max' => 71, 'message'=>'Panjang {attribute} lebih dari 71 karakter'),
            // array('currentPassword','match','pattern' => '/^(?=(.*[a-zA-Z].*){2,})(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{8,15}$/', 'message'=>'{attribute} minimal terdiri dari 2 karakter huruf, 1 karakter angka dan 1 karakter spesial bukan spasi dengan panjang 8-15 karakter'),
//            array('password','match','pattern' => '/^(?=.*\d).{8,15}$/', 'message'=>'{attribute} minimal terdiri dari 1 karakter angka dengan panjang 8-15 karakter'),
            array('full_name', 'length', 'max' => 80, 'message'=>'Panjang {attribute} lebih dari 80 karakter'),
            array('photo, retypePassword, currentPassword', 'length', 'max' => 255, 'message'=>'Panjang {attribute} lebih dari 255 karakter'),
            array('currentPhoto', 'file', 'types' => 'png, jpg, gif', 'allowEmpty' => 'true', 'message' => 'Format file tidak didukung'),
            array('email, username', 'unique'),
            array('email', 'length', 'max' => 50, 'message'=>'Panjang {attribute} lebih dari 50 karakter'),
//            array('email', 'checkMX'=> true),//online
            array('email','match', 'pattern'=> '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', 'message'=>'{attribute} tidak valid'),//offline
            array('log', 'length', 'max' => 1, 'message'=>'Panjang {attribute} lebih dari 1 karakter'),
            array('phone_one, phone_two', 'length', 'max'=>15),
            array('address, description, active_date, log_date', 'safe'),
//            array('oldPassword', 'required', 'on' => 'update'),
            array('oldPassword', 'validateOldPassword'),
            array('retypePassword', 'compare', 'compareAttribute' => 'currentPassword', 'message'=>'{attribute} belum benar'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, full_name, email, group_id, active, description, active_date, log, log_date, phone_one, phone_two', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'fotos' => array(self::HAS_MANY, 'Foto', 'user_id'),
            'hafalanTengahTahuns' => array(self::HAS_MANY, 'HafalanTengahTahun', 'santri_id'),
            'mutabaahLiburans' => array(self::HAS_MANY, 'MutabaahLiburan', 'santri_id'),
            'mutabaahTahfidzsMusrif' => array(self::HAS_MANY, 'MutabaahTahfidz', 'ustadz_id'),
            'mutabaahTahfidzsSantri' => array(self::HAS_MANY, 'MutabaahTahfidz', 'santri_id'),
            'attendance' => array(self::HAS_MANY, 'MutabaahTahfidz', 'santri_id', 'condition'=>'DATE(tanggal) = CURDATE()'),
            'persentaseHafalan' => array(self::HAS_ONE, 'PersentaseHafalan', array('santri_id' => 'id')),
            'riwayatPondokans' => array(self::HAS_MANY, 'RiwayatPondokan', 'user_id'),
            'riwayatPondokanOne' => array(self::HAS_ONE, 'RiwayatPondokan', 'user_id', 'condition'=>'riwayatPondokanOne.aktif=1'),
            'riwayatRegistrasiUlangs' => array(self::HAS_MANY, 'RiwayatRegistrasiUlang', 'user_id'),
            'riwayatRegistrasiUlangOne' => array(self::HAS_ONE, 'RiwayatRegistrasiUlang', 'user_id', 'condition'=>'riwayatRegistrasiUlangOne.aktif=1'),
            'riwayatKelompoks' => array(self::HAS_MANY, 'RiwayatKelompok', 'user_id'),
            'riwayatKelompokOne' => array(self::HAS_ONE, 'RiwayatKelompok', 'user_id', 'condition'=>'riwayatKelompokOne.aktif=1'),
            'santri' => array(self::HAS_ONE, 'Santri', 'id'),
            'santriKesukaans' => array(self::HAS_MANY, 'SantriKesukaan', 'santri_id'),
            'santriOrangtuas' => array(self::HAS_MANY, 'SantriOrangtua', 'santri_id'),
            'santriPenyakits' => array(self::HAS_MANY, 'SantriPenyakit', 'santri_id'),
            'santriPrestasis' => array(self::HAS_MANY, 'SantriPrestasi', 'santri_id'),
            'santriRiwayatPendidikans' => array(self::HAS_MANY, 'SantriRiwayatPendidikan', 'santri_id'),
            'semesters' => array(self::HAS_MANY, 'Semester', 'santri_id'),
            'tilawahHarians' => array(self::HAS_MANY, 'TilawahHarian', 'santri_id'),
            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'full_name' => 'Nama Lengkap',
            'gender' => 'Jenis kelamin',
            'address' => 'Alamat',
            'photo' => 'Foto',
            'currentPhoto' => 'Foto',
            'description' => 'Deskripsi',
            'email' => 'Email',
            'group_id' => 'Group',
            'is_active' => 'Aktif',
            'active_date' => 'Tanggal aktif',
            'log' => 'Log',
            'log_date' => 'Log Date',
            'oldPassword' => 'Password lama',
            'newPassword' => 'Password baru',
            'retypePassword' => 'Ulangi password',
            'phone_one' => 'No Telepon',
            'phone_two' => 'No Telepon 2',
            'currentPassword' => 'Password baru',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('group_id', $this->group_id, true);
        $criteria->compare('is_active', $this->is_active, true);
        $criteria->compare('active_date', $this->active_date, true);
        $criteria->compare('log', $this->log, true);
        $criteria->compare('log_date', $this->log_date, true);
        $criteria->compare('phone_one',$this->phone_one,true);
        $criteria->compare('phone_two',$this->phone_two,true);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

//dibuat oleh rizqi, 13-03-2014
//    untuk mendapatkan administrator
    public function searchAdministrator() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('group_id', 10, true);
        $criteria->compare('is_active', $this->is_active, true);
        $criteria->compare('active_date', $this->active_date, true);
        $criteria->compare('log', $this->log, true);
        $criteria->compare('log_date', $this->log_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

//dibuat oleh rizqi, 13-03-2014
//    untuk mendapatkan da'i
    public function getAllUser($param) {
        $criteria = new CDbCriteria();
//        $criteria->with = array(
//            'user_santri'=> array('alias' => 'a'),
//        );
//        if (!empty($param['kelompok'])) {
//            $criteria->compare('d.kelompok', $param['kelompok']);
//            $criteria->compare('d.aktif', 1);
//            $criteria->together = true;
//        }
        if(!empty($param['group_id'])){
        $criteria->compare('t.group_id', $param['group_id']);}
        $criteria->order = 't.full_name DESC';
        
        return new CActiveDataProvider(new User(), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
    }

//    awal geter
//    mendapatkan username
    public function getUsername() {
        return $this->username;
    }

//    mendapatkan full name
    public function getFullName() {
        return ucfirst($this->full_name);
    }

//    mendapatkan url photo
    public static function getPhotoUrl($user_id) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.user_id', $user_id);
        $criteria->compare('t.aktif', 1);
        $criteria->compare('t.tipe', 1);
        $criteria->order='id DESC';
        $model = Foto::model()->find($criteria);
        if(!empty($model)){
            $path = Yii::getPathOfAlias("webroot");
            $pathImage = $path .'/'. $model->lokasi;
            if (is_file($pathImage)) {
                return Yii::app()->createAbsoluteUrl($model->lokasi);
            } else {
                return Yii::app()->createAbsoluteUrl("/images/resource/no-profile-image-2x3.jpg");
            }
        }
        else {
            return Yii::app()->createAbsoluteUrl("/images/resource/no-profile-image-2x3.jpg");
        }
    }
    
    public static function getPhotoIconUrl($user_id) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.user_id', $user_id);
        $criteria->compare('t.aktif', 1);
        $criteria->compare('t.tipe', 1);
        $criteria->order='id DESC';
        $model = Foto::model()->find($criteria);
        if(!empty($model)){
            $path = Yii::getPathOfAlias("webroot.images.user.$model->user_id");
            $pathImage = $path .'/'. $model->getFileName()[1].'_icon.png';
            if (is_file($pathImage)) {
                return Yii::app()->createAbsoluteUrl('/images/user/'.$model->user_id.'/'.$model->getFileName()[1].'_icon.png');
            } else {
                return Yii::app()->createAbsoluteUrl("/images/resource/no-profile-image.jpg");
            }
        }
        else {
            return Yii::app()->createAbsoluteUrl("/images/resource/no-profile-image.jpg");
        }
    }

//    mendapatkan email
    public function getEmail() {
        if ($this->email == NULL || count($this->email) == 0)
            return 'Email belum tersedia';
        else
            return $this->email;
    }

//    mendapatkan icon is active
    public function getIsactiveIcon() {
        return Utility::convertCheckedToIcon($this->is_active);
    }

//    mendapatkan active date
    public function getActiveDate() {
        if ($this->active_date == NULL)
            return 'User belum diaktivasi';
        else
            return date('d-m-Y | H:i:s', strtotime($this->active_date));
    }

//    mendapatkan sedang login atau tidak
    public function getLog() {
        return Utility::convertCheckedToIcon($this->log);
    }

//    mendaptkan terakhir kali login
    public function getLogDate() {
        if ($this->log_date == NULL)
            return 'Belum pernah login';
        else
            return date('d-m-Y | H:i:s', strtotime($this->log_date));
    }

//    akhir geter
    public function md5Cklt($password) {
        $alt = md5("cklt");
        $md5Cklt = $alt . md5($password);
        return $md5Cklt;
    }

    public function getNameUser() {
        $user = $this->model()->findByPk(Yii::app()->user->id);
        return $user->full_name;
    }

    public function validateOldPassword($params, $attribute) {
        if (isset($this->oldPassword) && ($this->oldPassword != "")) {
            $hash = $this->md5Cklt($this->oldPassword);
            if ($hash != $this->password)
                $this->addError("oldPassword", "Password lama salah");
        }
    }

//    dibuat oleh rizqi 26-02-2014
//    dilakukan sebelum validasi
    protected function beforeValidate() {
        $this->tempPhoto = CUploadedFile::getInstance($this, 'currentPhoto');
        if ($this->isNewRecord) {
            $this->active_date = date("Y-m-d h:i:s", time());
        }
//        return true;
        return parent::beforeValidate();
    }

//    dibuat oleh rizqi 26-02-2014
//    dilakukan setelah validasi berhasil
    protected function afterValidate() {
        if ($this->currentPassword != "")
            $this->password = $this->md5Cklt($this->currentPassword);
//        return true;
        return parent::afterValidate();
    }

//    dibuat oleh rizqi, 20-04-2014
//    dilakukan setelah data tersimpan
    protected function afterSave() {
        parent::afterSave();
        if ($this->tempPhoto != Null) {
            $path = Yii::getPathOfAlias("webroot.images.users");
            if (!is_readable($path))
                mkdir($path, 0777, true);
            $pathPhoto = $path . "/$this->id.{$this->tempPhoto->extensionName}";
            $this->updateByPk($this->id, array('photo' => "/images/users/$this->id.{$this->tempPhoto->extensionName}"));
            $this->tempPhoto->saveAs($pathPhoto);
        }
        if (!$this->isNewRecord && !empty(Santri::model()->findByPk($this->id))) {
            $model_santri = Santri::model()->findByPk($this->id);
            $model_santri->nama_lengkap = $this->full_name;
            $model_santri->save();
        }
        return true;
    }
    
    //API ubah password
    public function changePassword($id, $old_pass, $new_pass){
        $result = array();

        if (isset($old_pass) && isset($new_pass)) {
            $model_user = $this->model()->findByPk($id);
            if(!empty($model_user)){
                if ($model_user->password == User::model()->md5Cklt($old_pass)) {
                    $model_user->password = User::model()->md5Cklt($new_pass);
                    $model_user->validate();
                    if($model_user->save()){
                        $result['success'] = '1';
                        $result['message'] = 'password berhasil diubah';
                    }
                } else {
                    $result['success'] = '0';
                    $result['message'] = 'password lama anda salah';
                }
            }
        }
        return $result;
    }
    
    //API mendapatkan daftar ustadz
    public function getUstadzList($offset=0, $limit=10, $search){
        $result = array();
        $selected = array('id','full_name');
        
        $criteria = new CDbCriteria();
        $criteria->select = $selected;
        if(!empty($search)) {
            $criteria->condition = 't.full_name LIKE :match';
            $criteria->params[':match'] = '%' . $search . '%';
        }
        $criteria->compare('group_id', '12');
        $criteria->offset = $offset;
        $criteria->limit = $limit;
        $model = User::model()->findAll($criteria);
        
        if(!empty($model)){
            $i = 0;
            foreach ($model as $list_ustadz) {
                foreach ($selected as $value){
                    $result[$i][$value] = $list_ustadz->$value;
                }
                $result[$i]['photo'] = $list_ustadz->getPhotoUrl($list_ustadz->id);
                $i++;
            }
        }
        return $result;
    }
    
    //API mendapatkan detail ustadz
    public function getUstadzDetail($id){
        $result = array();
        $selected = array('full_name', 'gender', 'address', 'email', 'phone_one', 'phone_two');
        
        $criteria = new CDbCriteria();
        $criteria->select = $selected;
        $model = User::model()->findByPk($id);
        
        if(!empty($model)){
            foreach ($selected as $value){
                $result[$value] = $model->$value;
            }
            $result['photo'] = $model->getPhotoUrl($id);
        }
        return $result;
    }

    //API mendapatkan daftar santri
    public function getSantriList($search, $offset=0, $limit=10, $halaqoh, $group_id=13){
        $result = array();
        $selected = array('id','nama_lengkap');

        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array(
                'alias' => 'a'
            ),
            'user.riwayatKelompokOne' => array(
                'alias' => 'riwayatKelompokOne'
            ),
        );
        $criteria->together=TRUE;
        $criteria->select = $selected;
        if(!empty($search)) {
            $criteria->condition = 't.nama_lengkap LIKE :match';
            $criteria->params[':match'] = '%' . $search . '%';
        }
        if(!empty($halaqoh)) {
            $criteria->compare('riwayatKelompokOne.kelompok', $halaqoh);
        }
        $criteria->compare('a.group_id', $group_id);
        $criteria->offset = $offset;
        $criteria->limit = $limit;
        $model = Santri::model()->findAll($criteria);

        if(!empty($model)){
            $i = 0;
            foreach ($model as $list_santri) {
//                foreach ($selected as $value){
//                    $result[$i][$value] = $list_santri->$value;
//                }
                $result[$i]['id'] = $list_santri->id;
                $result[$i]['nama_lengkap'] = ucwords($list_santri->nama_lengkap);
                $result[$i]['photo'] = $list_santri->user->getPhotoIconUrl($list_santri->id);
                $result[$i]['absensi'] = $list_santri->user->getAttendance();
                $result[$i]['juz'] = Santri::getJuz($list_santri->id);
                $result[$i]['hafalan_terakhir'] = Santri::getLastHafalan(array('id'=>$list_santri->id));
                $result[$i]['status_registrasi'] = Utility::getReregistrationStatus(User::getRegistrationStatus($list_santri->id));
//                Utility::getReregistrationStatus(User::getRegistrationStatus($santri->id));
                $i++;
            }
        }
        return $result;
    }
    
    //API mendapatkan detail biodata santri
    public function getSantriDetailBio($id){
        $result = array();
        $selected = array(
            'nama_lengkap', 'nama_panggilan', 'tempat_lahir',
            'golongan_darah', 'jumlah_saudara', 'anak_ke', 'jenis_kelamin',
            'no_telepon_rumah', 'alamat_keluarga_yogya', 'no_telepon_keluarga_yogya',
            'cita_cita', 'hobi', 'motivasi_masuk_rtqu', 'prestasi_hafalan',
            'tanggal_lahir', 'tanggal_masuk_rtqu'
        );
        $selected_kesukaan = array(
            'minat_bakat_potensi'
        );
        $selected_penyakit = array(
            'nama_penyakit', 'tahun'
        );
        
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user.santriKesukaans' => array(
                'alias' => 'b'
            ),
            'user.santriPenyakits' => array(
                'alias' => 'c'
            )
        );
        $criteria->select = $selected;
        $criteria->together = TRUE;
        $model = Santri::model()->findByPk($id);
        
        if(!empty($model)){
            foreach ($selected as $value){
                $result[$value] = $model->$value;
            }
            $result['status_registrasi'] = Utility::getReregistrationStatus(User::model()->getRegistrationStatus($model->id));
            $result['golongan_darah'] = Utility::getBloodType($model->golongan_darah);
            $result['photo'] = $model->user->getPhotoUrl($id);
            $result['tanggal_lahir'] = Utility::getDateFormat($model->tanggal_lahir);
            $result['tanggal_masuk_rtqu'] = Utility::getDateFormat($model->tanggal_masuk_rtqu);
            $result['kesukaan'] = array();
            $i = 0;
            foreach ($model->user->santriKesukaans as $kesukaan){
                foreach ($selected_kesukaan as $value){
                    $result['kesukaan'][$i][$value] = $kesukaan->$value;
                }
                $i++;
            }
            $result['penyakit'] = array();
            $j = 0;
            foreach ($model->user->santriPenyakits as $penyakit){
                foreach ($selected_penyakit as $value){
                    $result['penyakit'][$j][$value] = $penyakit->$value;
                }
                $j++;
            }
        }
        return $result;
    }
    
    //API mendapatkan detail pendidikan santri
    public function getSantriDetailPendidikan($id){
        $result = array();
        $selected_pendidikan = array(
            'jenjang_id', 'nama_sekolah', 'tahun_masuk', 'tahun_lulus',
            'nilai_rata_rata'
        );
        $selected_prestasi = array(
            'prestasi', 'juara', 'tahun'
        );
        
        $criteria_pendidikan = new CDbCriteria();
        $criteria_pendidikan->select = $selected_pendidikan;
        $criteria_pendidikan->compare('santri_id', $id);
        $criteria_pendidikan->order = 'tahun_masuk DESC';
        $model_pendidikan = SantriRiwayatPendidikan::model()->findAll($criteria_pendidikan);

        $criteria_prestasi = new CDbCriteria();
        $criteria_prestasi->select = $selected_prestasi;
        $criteria_prestasi->compare('santri_id', $id);
        $criteria_prestasi->order = 'tahun DESC';
        $model_prestasi = SantriPrestasi::model()->findAll($criteria_prestasi);
        
        $result['pendidikan'] = array();
        if(!empty($model_pendidikan)){
            $i = 0;
            foreach ($model_pendidikan as $pendidikan) {
                foreach ($selected_pendidikan as $value){
                    $result['pendidikan'][$i][$value] = $pendidikan->$value;
                    $result['pendidikan'][$i]['jenjang_id'] = Utility::getSantriEducation($pendidikan->jenjang_id);
                }
                $i++;
            }
        }
        $result['prestasi'] = array();
        if(!empty($model_prestasi)){
            $j = 0;
            foreach ($model_prestasi as $prestasi) {
                foreach ($selected_prestasi as $value){
                    $result['prestasi'][$j][$value] = $prestasi->$value;
                }
                $j++;
            }
        }
        
        return $result;
    }
    
    //API mendapatkan detail biodata orangtua santri
    public function getSantriDetailOrangTua($id){
        $result = array();
        $selected = array(
            'nama', 'tanggal_lahir', 'agama', 'tempat_lahir', 'pekerjaan',
            'penghasilan', 'alamat', 'pendidikan_id', 'hubungan_orangtua');
        
        $criteria = new CDbCriteria();
        $criteria->select = $selected;
        $criteria->compare('santri_id', $id);
        $model = SantriOrangtua::model()->findAll($criteria);
        if(!empty($model)){
            $i=0;
            foreach($model as $orang_tua){
                foreach ($selected as $value){
                    $result[$i][$value] = $orang_tua->$value;
                }
                $result[$i]['tanggal_lahir'] = Utility::getDateFormat($orang_tua->tanggal_lahir);
                $result[$i]['agama'] = Utility::getReligion($orang_tua->agama);
                $result[$i]['pendidikan_id'] = Utility::getEducation($orang_tua->pendidikan_id);
                $result[$i]['hubungan_orangtua'] = Utility::getKinship($orang_tua->hubungan_orangtua);
                $i++;
            }
        }
        return $result;
    }

    public function getPondokan(){
        $pondokan = '';
//        $criteria = new CDbCriteria();
//        $criteria->with = array(
//            'riwayatPondokanOne'
//        );
//        $criteria->together = TRUE;
//        $model = User::model()->find($criteria);
//        if(!empty($model)){
//            $pondokan = $model->riwayatPondokanOne->pondok->nama_pondok;
//        }
//        return $pondokan;
        if(!empty($this->riwayatPondokanOne)){
            if(!empty($this->riwayatPondokanOne->pondok)){
                $pondokan = $this->riwayatPondokanOne->pondok->nama_pondok;
            }
        }
        return $pondokan;
    }
    
    public function getSantriEducation(){
        $education = '';
        if(!empty($this->riwayatRegistrasiUlangOne)){
            $education = Utility::getSantriEducation($this->riwayatRegistrasiUlangOne->pendidikan_id);
        }
        return $education;
    }
    
    public function searchUstadz() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        
        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('group_id', 12);
        $criteria->compare('is_active', $this->is_active, true);
        $criteria->compare('active_date', $this->active_date, true);
        $criteria->compare('log', $this->log, true);
        $criteria->compare('log_date', $this->log_date, true);
        $criteria->compare('phone_one',$this->phone_one,true);
        $criteria->compare('phone_two',$this->phone_two,true);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function getActiveGroup(){
        $group = '';
        if(!empty($this->riwayatKelompokOne)){
            $group = $this->riwayatKelompokOne->kelompoknya->nama_kelompok;
        }
        return ucwords($group);
    }
    
    public function getActiveGroupId(){
        $group_id = '';
        if(!empty($this->riwayatKelompokOne)){
            $group_id = $this->riwayatKelompokOne->kelompoknya->id;
        }
        return ucwords($group_id);
    }
    
    public static function getMusyrifList(){
        $criteria = new CDbCriteria();
        $criteria->compare('group_id', 12);
        $model = User::model()->findAll($criteria);
        return array_map('ucwords',CHtml::listData($model,'id','full_name'));
    }
    
    public static function getRegistrationStatus($id){
        //status
        //1=lama nggak registrasi lagi, 2=lulus, 3=sudah registrasi, 4=belum registrasi, 5=tahun ajaran belum ada
        $academic_year = array();
        $criteria_academic_year = new CDbCriteria();
        $criteria_academic_year->limit = 2;
        $criteria_academic_year->order = 'tanggal_dimulai DESC';
        $model_academic_year = TahunAjaranBaru::model()->findAll($criteria_academic_year);
        foreach ($model_academic_year as $data_academic_year) {
            $academic_year[] = $data_academic_year->tanggal_dimulai;
        }
        if(count($academic_year) == 1 ){
            $academic_year[] = NULL;
        }
        elseif (count ($academic_year) == 0) {
            $academic_year[] = NULL;
            $academic_year[] = NULL;
        }
        
        $last_registration = NULL;
        $status = NULL;
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $id);
        $criteria->order = 't.tanggal_registrasi_ulang DESC';
        $model = RiwayatRegistrasiUlang::model()->find($criteria);
        if(!empty($model)){
            $last_registration = $model->tanggal_registrasi_ulang;
            $status = $model->status;
        }

        $registration_status = '';
        if($status == 1){
            $registration_status = 6;
        }
        elseif($status == 2){
            $registration_status = 2;
        }        
        //sudah registrasi ulang => 3
        elseif((strtotime($last_registration) >= strtotime($academic_year[0])) && !is_null($academic_year[0])) {
            $registration_status = 3;
        }
        //belum registrasi ulang => 4
        elseif((strtotime($last_registration) < strtotime($academic_year[0]) && is_null($academic_year[1]))
            || (strtotime($last_registration) < strtotime($academic_year[0]) && strtotime($last_registration) >= strtotime($academic_year[1]) && !is_null($academic_year[1])) ){
            $registration_status = 4;
        }
        //telat 2 kali registrasi ulang => 1
        elseif(strtotime($last_registration) < strtotime($academic_year[1])){
            $registration_status = 1;
        }
        //belum ada tahun ajaran baru => 5
        elseif (is_null($academic_year[0])) {
            $registration_status = 5;
        }
//        file_put_contents('regis'.$id, json_encode(array($registration_status, $last_registration,$academic_year[0],$academic_year[1])));        
        return $registration_status;
        
    }
    
    public function getUstadz(){
        $ustadz = array();
        if(!empty($this->riwayatKelompokOne)){
            $active_group = $this->riwayatKelompokOne->kelompok;
            if(!empty($active_group)){
                $criteria_ustadz = new CDbCriteria();
                $criteria_ustadz->with = array(
                    'user' => array(
                        'alias' => 'a'
                    )
                );
                $criteria_ustadz->compare('t.kelompok', $active_group);
                $criteria_ustadz->compare('a.group_id', 12);
                $model_ustadz = RiwayatKelompok::model()->find($criteria_ustadz);
                if(!empty($model_ustadz)){
                    $ustadz['id'] = $model_ustadz->user->id;
                    $ustadz['name'] = $model_ustadz->user->full_name;
                }
            }
        }
        return $ustadz;
    }
    
    public function loadModelId($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }
    
    public function getAttendance(){
        $attendance = array('z'=>'','b'=>'','m'=>'','a'=>'');
        if(!empty($this->attendance)){
            foreach ($this->attendance as $mutabaah){
//                if($mutabaah->tipe == 1 || $mutabaah->tipe == 4)
//                $attendance[$mutabaah->tipe] = $mutabaah->tanggal;
                switch ($mutabaah->tipe) {
                    case 1:
                        $attendance['z'] = date('H:i:s', strtotime($mutabaah->tanggal));
                        break;
                    case 2:
                        $attendance['b'] = date('H:i:s', strtotime($mutabaah->tanggal));
                        break;
                    case 3:
                        $attendance['m'] = date('H:i:s', strtotime($mutabaah->tanggal));
                        break;
                    case 4:
                        $attendance['z'] = date('H:i:s', strtotime($mutabaah->tanggal));
                        break;
                    default:
                        $attendance['a'] = date('H:i:s', strtotime($mutabaah->tanggal));
                        break;
                }
            }
        }
        return $attendance;
    }
}
