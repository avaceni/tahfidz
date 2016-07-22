<?php

/**
 * This is the model class for table "riwayat_registrasi_ulang".
 *
 * The followings are the available columns in table 'riwayat_registrasi_ulang':
 * @property string $id
 * @property integer $tahun_ajaran_id
 * @property string $tanggal_registrasi_ulang
 * @property string $user_id
 * @property integer $pendidikan_id
 * @property string $tingkat
 * @property integer $aktif
 *
 * The followings are the available model relations:
 * @property CkltUser $user
 * @property TahunAjaranBaru $tahunAjaran
 */
class RiwayatRegistrasiUlang extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'riwayat_registrasi_ulang';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tahun_ajaran_id, tanggal_registrasi_ulang, user_id, aktif', 'required'),
            array('tahun_ajaran_id, pendidikan_id, aktif, status', 'numerical', 'integerOnly' => true),
            array('user_id', 'length', 'max' => 10),
            array('tingkat', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tahun_ajaran_id, tanggal_registrasi_ulang, user_id, pendidikan_id, tingkat, aktif, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'CkltUser', 'user_id'),
            'tahunAjaran' => array(self::BELONGS_TO, 'TahunAjaranBaru', 'tahun_ajaran_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tahun_ajaran_id' => 'Tahun Ajaran',
            'tanggal_registrasi_ulang' => 'Tanggal Registrasi Ulang',
            'user_id' => 'User',
            'pendidikan_id' => 'Pendidikan',
            'tingkat' => 'Tingkat',
            'aktif' => 'Aktif',
            'status' => 'Status'
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
        $criteria->compare('tahun_ajaran_id', $this->tahun_ajaran_id);
        $criteria->compare('tanggal_registrasi_ulang', $this->tanggal_registrasi_ulang, true);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('pendidikan_id', $this->pendidikan_id);
        $criteria->compare('tingkat', $this->tingkat, true);
        $criteria->compare('aktif', $this->aktif);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RiwayatRegistrasiUlang the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        parent::afterSave();
        if ($this->isNewRecord) {
            $criteria = new CDbCriteria();
            $criteria->condition = "id != {$this->id}";
            $criteria->compare('user_id', $this->user_id);
            $model = new RiwayatRegistrasiUlang();
            if (!empty($model)) {
                $model->updateAll(array('aktif' => 0), $criteria);
            }
        }
        return true;
    }

    public function getLast($user_id) {
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user_id);
        $criteria->compare('aktif', 1);
        $model = $this->model()->find($criteria);
        return $model;
    }

    public function beforeSave() {
        parent::beforeSave();
        if ($this->isNewRecord) {
            RiwayatRegistrasiUlang::model()->updateAll(array('aktif' => 0), "user_id = $this->user_id");
                        
            $criteria_graduate = new CDbCriteria();
            $criteria_graduate->condition = "status = 1 OR status = 2";
            $criteria_graduate->compare('user_id', $this->user_id);
            $model_graduate = new RiwayatRegistrasiUlang();
            if (!empty($model_graduate)) {
                $model_graduate->deleteAll($criteria_graduate);
            }

        }
        return TRUE;
    }
    
    public function beforeValidate() {
        parent::beforeValidate();
        if(empty($this->tahun_ajaran_id)){
            $criteria = new CDbCriteria();
            $criteria->order = 'tanggal_dimulai DESC';
            $academic_year = TahunAjaranBaru::model()->find($criteria);            
        }
        if(!empty($academic_year)){
            $this->tahun_ajaran_id = $academic_year->id;
        }
        return TRUE;
    }
    
    public function loadModelId($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }
    
    public function afterDelete() {
        parent::afterDelete();
        $model = $this->model()->find(array('condition'=>"user_id = $this->user_id", 'order' => 'id DESC'));
        if(!empty($model)){
            $model->aktif = 1;
            $model->save();
        }
    }

}
