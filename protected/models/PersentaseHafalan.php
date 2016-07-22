<?php

/**
 * This is the model class for table "persentase_hafalan".
 *
 * The followings are the available columns in table 'persentase_hafalan':
 * @property string $id
 * @property string $semester_id
 * @property string $tanggal
 * @property integer $setoran_juz
 * @property integer $setoran_halaman
 * @property string $nilai
 * @property string $keterangan
 * @property string $catatan
 * @property string $tanggal_catatan
 * @property string $ustadz_id
 * @property string $santri_id
 * @property string $persen
 */
class PersentaseHafalan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'persentase_hafalan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('semester_id, setoran_juz, setoran_halaman, nilai, ustadz_id, santri_id', 'required'),
			array('setoran_juz, setoran_halaman', 'numerical', 'integerOnly'=>true),
			array('id, semester_id, ustadz_id, santri_id', 'length', 'max'=>10),
			array('nilai, persen', 'length', 'max'=>5),
			array('tanggal, keterangan, catatan, tanggal_catatan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, semester_id, tanggal, setoran_juz, setoran_halaman, nilai, keterangan, catatan, tanggal_catatan, ustadz_id, santri_id, persen', 'safe', 'on'=>'search'),
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
			'semester_id' => 'Semester',
			'tanggal' => 'Tanggal',
			'setoran_juz' => 'Setoran Juz',
			'setoran_halaman' => 'Setoran Halaman',
			'nilai' => 'Nilai',
			'keterangan' => 'Keterangan',
			'catatan' => 'Catatan',
			'tanggal_catatan' => 'Tanggal Catatan',
			'ustadz_id' => 'Ustadz',
			'santri_id' => 'Santri',
			'persen' => 'Persen',
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
		$criteria->compare('semester_id',$this->semester_id,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('setoran_juz',$this->setoran_juz);
		$criteria->compare('setoran_halaman',$this->setoran_halaman);
		$criteria->compare('nilai',$this->nilai,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('catatan',$this->catatan,true);
		$criteria->compare('tanggal_catatan',$this->tanggal_catatan,true);
		$criteria->compare('ustadz_id',$this->ustadz_id,true);
		$criteria->compare('santri_id',$this->santri_id,true);
		$criteria->compare('persen',$this->persen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PersentaseHafalan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function primaryKey()
        {
            return "id";
        }
}
