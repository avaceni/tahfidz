<?php

/**
 * This is the model class for table "hafalan_tengah_tahun".
 *
 * The followings are the available columns in table 'hafalan_tengah_tahun':
 * @property string $id
 * @property string $semester_id
 * @property string $kelas
 * @property string $jumlah_hafalan_tahun_lalu
 * @property string $jumlah_penambahan_satu_semester
 * @property string $total_jumlah_hafalan
 * @property string $rincian_hafalan
 * @property string $kendala_pembelajaran
 * @property string $pesan_untuk_orangtua
 * @property string $tanggal
 * @property string $ustadz_id
 */
class HafalanTengahTahun extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hafalan_tengah_tahun';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('semester_id, total_jumlah_hafalan, rincian_hafalan, kendala_pembelajaran, pesan_untuk_orangtua, tanggal, ustadz_id', 'required'),
			array('semester_id, ustadz_id', 'length', 'max'=>10),
			array('kelas', 'length', 'max'=>50),
			array('jumlah_hafalan_tahun_lalu, jumlah_penambahan_satu_semester', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, semester_id, kelas, jumlah_hafalan_tahun_lalu, jumlah_penambahan_satu_semester, total_jumlah_hafalan, rincian_hafalan, kendala_pembelajaran, pesan_untuk_orangtua, tanggal, ustadz_id', 'safe', 'on'=>'search'),
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
			'kelas' => 'Kelas',
			'jumlah_hafalan_tahun_lalu' => 'Jumlah Hafalan Tahun Lalu',
			'jumlah_penambahan_satu_semester' => 'Jumlah Penambahan Satu Semester',
			'total_jumlah_hafalan' => 'Total Jumlah Hafalan',
			'rincian_hafalan' => 'Rincian Hafalan',
			'kendala_pembelajaran' => 'Kendala Pembelajaran',
			'pesan_untuk_orangtua' => 'Pesan Untuk Orangtua',
			'tanggal' => 'Tanggal',
			'ustadz_id' => 'Ustadz',
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
		$criteria->compare('kelas',$this->kelas,true);
		$criteria->compare('jumlah_hafalan_tahun_lalu',$this->jumlah_hafalan_tahun_lalu,true);
		$criteria->compare('jumlah_penambahan_satu_semester',$this->jumlah_penambahan_satu_semester,true);
		$criteria->compare('total_jumlah_hafalan',$this->total_jumlah_hafalan,true);
		$criteria->compare('rincian_hafalan',$this->rincian_hafalan,true);
		$criteria->compare('kendala_pembelajaran',$this->kendala_pembelajaran,true);
		$criteria->compare('pesan_untuk_orangtua',$this->pesan_untuk_orangtua,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('ustadz_id',$this->ustadz_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HafalanTengahTahun the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
