<?php

/**
 * This is the model class for table "pondokan".
 *
 * The followings are the available columns in table 'pondokan':
 * @property integer $id
 * @property string $nama_pondok
 *
 * The followings are the available model relations:
 * @property RiwayatPondokan[] $riwayatPondokans
 */
class Pondokan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pondokan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nama_pondok, status', 'required'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('nama_pondok', 'length', 'max'=>255),
            array('jangka_waktu', 'length', 'max'=>50),
            array('tanggal_mulai', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama_pondok, status, tanggal_mulai, jangka_waktu', 'safe', 'on'=>'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'donasis' => array(self::HAS_MANY, 'Donasi', 'pondok_id'),
            'donasiBarangs' => array(self::HAS_MANY, 'DonasiBarang', 'pondok_id'),
            'pengeluarans' => array(self::HAS_MANY, 'Pengeluaran', 'pondok_id'),
            'riwayatPondokans' => array(self::HAS_MANY, 'RiwayatPondokan', 'pondok_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama_pondok' => 'Nama Pondok',
            'status' => 'Status',
            'tanggal_mulai' => 'Tanggal Mulai',
            'jangka_waktu' => 'Jangka Waktu',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('nama_pondok',$this->nama_pondok,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('tanggal_mulai',$this->tanggal_mulai,true);
        $criteria->compare('jangka_waktu',$this->jangka_waktu,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pondokan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getPondokanList() {
        $model = Pondokan::model()->findAll();
        $pondokan = array_map("ucwords", CHtml::listData($model, 'id', 'nama_pondok'));
        return $pondokan;
    }

    //searchQuarters
    public function searchQuarters() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nama_pondok', $this->nama_pondok, true);
        $criteria->order = 'nama_pondok ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            ));
    }

    public function loadModel($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }

    public function beforeSave() {
        parent::beforeSave();
        if(preg_match('/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i',  $this->tanggal_mulai)){
            $this->tanggal_mulai = date('Y-m-d', strtotime(Utility::convertDateId($this->tanggal_mulai)));
        }
        else{
            $this->tanggal_mulai = null;
        }
        return TRUE;
    }
}
