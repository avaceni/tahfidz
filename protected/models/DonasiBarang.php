<?php

/**
 * This is the model class for table "donasi_barang".
 *
 * The followings are the available columns in table 'donasi_barang':
 * @property string $id
 * @property string $nama_donatur
 * @property string $nama_barang
 * @property string $detail_barang
 * @property string $tanggal
 * @property string $pembuat
 * @property integer $pondok_id
 * @property string $donatur
 *
 * The followings are the available model relations:
 * @property CkltUser $pembuat0
 * @property Pondokan $pondok
 * @property CkltUser $donatur0
 */
class DonasiBarang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'donasi_barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_donatur, nama_barang, tanggal', 'required'),
			array('pondok_id', 'numerical', 'integerOnly'=>true),
			array('nama_donatur', 'length', 'max'=>80),
			array('nama_barang', 'length', 'max'=>255),
			array('pembuat, donatur', 'length', 'max'=>10),
			array('detail_barang', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_donatur, nama_barang, detail_barang, tanggal, pembuat, pondok_id, donatur', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'pembuat'),
			'pondok' => array(self::BELONGS_TO, 'Pondokan', 'pondok_id'),
			'donatur' => array(self::BELONGS_TO, 'User', 'donatur'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama_donatur' => 'Nama Donatur',
			'nama_barang' => 'Nama Barang',
			'detail_barang' => 'Detail Barang',
			'tanggal' => 'Tanggal',
			'pembuat' => 'Pembuat',
			'pondok_id' => 'Pondok',
			'donatur' => 'Donatur'
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
		$criteria->compare('nama_donatur',$this->nama_donatur,true);
		$criteria->compare('nama_barang',$this->nama_barang,true);
		$criteria->compare('detail_barang',$this->detail_barang,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('pembuat',$this->pembuat,true);
		$criteria->compare('pondok_id',$this->pondok_id);
		$criteria->compare('donatur',$this->donatur,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DonasiBarang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAllDonation($param,$month=null,$year=null, $pageSize = 5){
		$criteria = new CDbCriteria();
		if(!empty($param['donation_year'])){
			if($param['donation_year'] != 'all'){
				if($param['donation_month'] == 'all'){
					$start_time = "{$param['donation_year']}-1-1 00:00:00";
					$end_time = "{$param['donation_year']}-12-31 23:59:59";
				}
				else{
					$date = Utility::getNumberOfDate($param['donation_month'],$param['donation_year']);
					$start_time = "{$param['donation_year']}-{$param['donation_month']}-1 00:00:00";
					$end_time = "{$param['donation_year']}-{$param['donation_month']}-{$date} 23:59:59";
				}
				$criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
				$criteria->params[':start_time'] = $start_time;
				$criteria->params[':end_time'] = $end_time;
			}
		}
		else{
			$date = Utility::getNumberOfDate($month,$year);
			$start_time = "{$year}-{$month}-1 00:00:00";
			$end_time = "{$year}-{$month}-{$date} 23:59:59";
			$criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
			$criteria->params[':start_time'] = $start_time;
			$criteria->params[':end_time'] = $end_time;
		}
		$criteria->order = 't.tanggal DESC';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $pageSize,
				),
			));
	}
	public function beforeSave() {
		parent::beforeSave();
		if(preg_match('/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i',  $this->tanggal)){
			$this->tanggal = date('Y-m-d', strtotime(Utility::convertDateId($this->tanggal)));
		}
		return TRUE;
	}
	public function loadModelId($id) {
		$model = $this->model()->findByPk($id);
		return $model;
	}	

}
