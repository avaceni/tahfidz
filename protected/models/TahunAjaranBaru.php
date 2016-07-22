<?php

/**
 * This is the model class for table "tahun_ajaran_baru".
 *
 * The followings are the available columns in table 'tahun_ajaran_baru':
 * @property integer $id
 * @property string $nama_tahun_ajaran
 * @property string $tanggal_dimulai
 *
 * The followings are the available model relations:
 * @property RiwayatRegistrasiUlang[] $riwayatRegistrasiUlangs
 */
class TahunAjaranBaru extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tahun_ajaran_baru';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nama_tahun_ajaran, tanggal_dimulai', 'required', 'message' => '{attribute} tidak boleh kosong'),
            array('nama_tahun_ajaran', 'length', 'max' => 255),
            array('tanggal_dimulai', 'match', 'pattern' => '/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i', 'message' => "Format {attribute} salah"),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama_tahun_ajaran, tanggal_dimulai', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'riwayatRegistrasiUlangs' => array(self::HAS_MANY, 'RiwayatRegistrasiUlang', 'tahun_ajaran_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama_tahun_ajaran' => 'Nama Tahun Ajaran',
            'tanggal_dimulai' => 'Tanggal Dimulai',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('nama_tahun_ajaran', $this->nama_tahun_ajaran, true);
        $criteria->compare('tanggal_dimulai', $this->tanggal_dimulai, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TahunAjaranBaru the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchAcademicYear() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nama_tahun_ajaran', $this->nama_tahun_ajaran, true);
        $criteria->compare('tanggal_dimulai', $this->tanggal_dimulai, true);
        $criteria->order = 'tanggal_dimulai DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
    }

    public function beforeSave() {
        parent::beforeSave();
        if (preg_match('/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i', $this->tanggal_dimulai)) {
            $this->tanggal_dimulai = date('Y-m-d', strtotime(Utility::convertDateId($this->tanggal_dimulai)));
        }
        return TRUE;
    }

    public function loadModelId($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }

}
