<?php

/**
 * This is the model class for table "tilawah_harian".
 *
 * The followings are the available columns in table 'tilawah_harian':
 * @property string $id
 * @property string $santri_id
 * @property string $surat_juz
 * @property string $ayat
 * @property string $keterangan
 */
class TilawahHarian extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tilawah_harian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('santri_id, surat_juz, ayat', 'required'),
			array('santri_id', 'length', 'max'=>10),
			array('surat_juz, ayat', 'length', 'max'=>255),
			array('keterangan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, santri_id, surat_juz, ayat, keterangan', 'safe', 'on'=>'search'),
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
			'surat_juz' => 'Surat Juz',
			'ayat' => 'Ayat',
			'keterangan' => 'Keterangan',
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
		$criteria->compare('surat_juz',$this->surat_juz,true);
		$criteria->compare('ayat',$this->ayat,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TilawahHarian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
