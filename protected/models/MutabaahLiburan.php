<?php

/**
 * This is the model class for table "mutabaah_liburan".
 *
 * The followings are the available columns in table 'mutabaah_liburan':
 * @property string $id
 * @property string $santri_id
 * @property string $tanggal
 * @property string $surat
 * @property string $ayat
 * @property string $belajar
 * @property integer $sholat_subuh
 * @property integer $sholat_dhuhur
 * @property integer $sholat_ashar
 * @property integer $sholat_maghrib
 * @property integer $sholat_isya
 * @property integer $rawatib_subuh
 * @property integer $rawatib_dhuhur
 * @property integer $rawatib_ashar
 * @property integer $rawatib_maghrib
 * @property integer $rawatib_isya
 * @property integer $qiyamul_lail
 * @property integer $dhuha
 * @property integer $puasa
 * @property string $catatan
 * @property string $tanggal_catatan
 */
class MutabaahLiburan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mutabaah_liburan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('santri_id, tanggal', 'required'),
			array('sholat_subuh, sholat_dhuhur, sholat_ashar, sholat_maghrib, sholat_isya, rawatib_subuh, rawatib_dhuhur, rawatib_ashar, rawatib_maghrib, rawatib_isya, qiyamul_lail, dhuha, puasa', 'numerical', 'integerOnly'=>true),
			array('santri_id', 'length', 'max'=>10),
			array('surat, ayat, catatan', 'length', 'max'=>255),
			array('belajar, tanggal_catatan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, santri_id, tanggal, surat, ayat, belajar, sholat_subuh, sholat_dhuhur, sholat_ashar, sholat_maghrib, sholat_isya, rawatib_subuh, rawatib_dhuhur, rawatib_ashar, rawatib_maghrib, rawatib_isya, qiyamul_lail, dhuha, puasa, catatan, tanggal_catatan', 'safe', 'on'=>'search'),
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
			'tanggal' => 'Tanggal',
			'surat' => 'Surat',
			'ayat' => 'Ayat',
			'belajar' => 'Belajar',
			'sholat_subuh' => 'Sholat Subuh',
			'sholat_dhuhur' => 'Sholat Dhuhur',
			'sholat_ashar' => 'Sholat Ashar',
			'sholat_maghrib' => 'Sholat Maghrib',
			'sholat_isya' => 'Sholat Isya',
			'rawatib_subuh' => 'Rawatib Subuh',
			'rawatib_dhuhur' => 'Rawatib Dhuhur',
			'rawatib_ashar' => 'Rawatib Ashar',
			'rawatib_maghrib' => 'Rawatib Maghrib',
			'rawatib_isya' => 'Rawatib Isya',
			'qiyamul_lail' => 'Qiyamul Lail',
			'dhuha' => 'Dhuha',
			'puasa' => 'Puasa',
			'catatan' => 'Catatan',
			'tanggal_catatan' => 'Tanggal Catatan',
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
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('surat',$this->surat,true);
		$criteria->compare('ayat',$this->ayat,true);
		$criteria->compare('belajar',$this->belajar,true);
		$criteria->compare('sholat_subuh',$this->sholat_subuh);
		$criteria->compare('sholat_dhuhur',$this->sholat_dhuhur);
		$criteria->compare('sholat_ashar',$this->sholat_ashar);
		$criteria->compare('sholat_maghrib',$this->sholat_maghrib);
		$criteria->compare('sholat_isya',$this->sholat_isya);
		$criteria->compare('rawatib_subuh',$this->rawatib_subuh);
		$criteria->compare('rawatib_dhuhur',$this->rawatib_dhuhur);
		$criteria->compare('rawatib_ashar',$this->rawatib_ashar);
		$criteria->compare('rawatib_maghrib',$this->rawatib_maghrib);
		$criteria->compare('rawatib_isya',$this->rawatib_isya);
		$criteria->compare('qiyamul_lail',$this->qiyamul_lail);
		$criteria->compare('dhuha',$this->dhuha);
		$criteria->compare('puasa',$this->puasa);
		$criteria->compare('catatan',$this->catatan,true);
		$criteria->compare('tanggal_catatan',$this->tanggal_catatan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MutabaahLiburan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
