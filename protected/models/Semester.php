<?php

/**
 * This is the model class for table "semester".
 *
 * The followings are the available columns in table 'semester':
 * @property string $id
 * @property string $santri_id
 * @property integer $semester
 * @property string $jumlah_hafalan_tahun_lalu
 * @property string $jumlah_hafalan_tahun_ini
 */
class Semester extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'semester';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('santri_id, semester', 'required'),
			array('semester', 'numerical', 'integerOnly'=>true),
			array('santri_id', 'length', 'max'=>10),
			array('jumlah_hafalan_tahun_lalu, jumlah_hafalan_tahun_ini', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, santri_id, semester, jumlah_hafalan_tahun_lalu, jumlah_hafalan_tahun_ini', 'safe', 'on'=>'search'),
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
			'semester' => 'Semester',
			'jumlah_hafalan_tahun_lalu' => 'Jumlah Hafalan Tahun Lalu',
			'jumlah_hafalan_tahun_ini' => 'Jumlah Hafalan Tahun Ini',
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
		$criteria->compare('semester',$this->semester);
		$criteria->compare('jumlah_hafalan_tahun_lalu',$this->jumlah_hafalan_tahun_lalu,true);
		$criteria->compare('jumlah_hafalan_tahun_ini',$this->jumlah_hafalan_tahun_ini,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Semester the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
