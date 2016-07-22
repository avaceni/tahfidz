<?php

/**
 * This is the model class for table "santri_riwayat_pendidikan".
 *
 * The followings are the available columns in table 'santri_riwayat_pendidikan':
 * @property string $id
 * @property string $santri_id
 * @property integer $jenjang_id
 * @property string $nama_sekolah
 * @property string $tahun_masuk
 * @property string $tahun_lulus
 * @property string $nilai_rata_rata
 */
class SantriRiwayatPendidikan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'santri_riwayat_pendidikan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('santri_id, jenjang_id, nama_sekolah, tahun_masuk', 'required', 'message'=>'{attribute} tidak boleh kosong'),
			array('jenjang_id, tahun_masuk, tahun_lulus', 'numerical', 'integerOnly'=>true, 'message'=>'{attribute} harus angka'),
			array('santri_id', 'length', 'max'=>10),
			array('nama_sekolah', 'length', 'max'=>255),
			array('tahun_masuk, tahun_lulus', 'length', 'max'=>4),
                        array('tahun_masuk, tahun_lulus', 'match', 'pattern' => '/(19|20)\d{2}/i', 'message' => ' Format {attribute} salah'),
			array('nilai_rata_rata', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, santri_id, jenjang_id, nama_sekolah, tahun_masuk, tahun_lulus, nilai_rata_rata', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'santri_id' => 'Santri',
			'jenjang_id' => 'Jenjang',
			'nama_sekolah' => 'Nama Sekolah',
			'tahun_masuk' => 'Tahun Masuk',
			'tahun_lulus' => 'Tahun Lulus',
			'nilai_rata_rata' => 'Nilai Rata Rata',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('santri_id',$this->santri_id,true);
		$criteria->compare('jenjang_id',$this->jenjang_id);
		$criteria->compare('nama_sekolah',$this->nama_sekolah,true);
		$criteria->compare('tahun_masuk',$this->tahun_masuk,true);
		$criteria->compare('tahun_lulus',$this->tahun_lulus,true);
		$criteria->compare('nilai_rata_rata',$this->nilai_rata_rata,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SantriRiwayatPendidikan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    public function loadModel($santri_id) {
        $model = $this->model()->findAllByAttributes(array('santri_id'=>$santri_id));
//        if ($model === null)
//            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    public function loadModelId($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }
    
    public function beforeSave() {
        parent::beforeSave();
        if(!$this->tahun_masuk){
            $this->tahun_masuk = null;
        }
        if(!$this->tahun_lulus){
            $this->tahun_lulus = null;
        }
        return TRUE;
    }
}
