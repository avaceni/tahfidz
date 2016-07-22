<?php

/**
 * This is the model class for table "santri_orangtua".
 *
 * The followings are the available columns in table 'santri_orangtua':
 * @property string $id
 * @property string $santri_id
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property integer $agama
 * @property string $no_telepon
 * @property integer $pendidikan_id
 * @property string $pekerjaan
 * @property integer $penghasilan_id
 * @property string $alamat
 * @property integer $hubungan_orangtua
 */
class SantriOrangtua extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'santri_orangtua';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('santri_id, nama, tempat_lahir, tanggal_lahir, agama, pendidikan_id, pekerjaan, alamat, hubungan_orangtua', 'required', 'message'=>'{attribute} tidak boleh kosong'),
			array('agama, pendidikan_id, penghasilan, hubungan_orangtua', 'numerical', 'integerOnly'=>true),
                        array('tanggal_lahir','match', 'pattern'=> '/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i','message'=>"Format {attribute} salah"),
			array('santri_id', 'length', 'max'=>10),
			array('nama', 'length', 'max'=>80),
			array('tempat_lahir', 'length', 'max'=>50),
			array('no_telepon', 'length', 'max'=>15),
			array('pekerjaan', 'length', 'max'=>255),
			array('tanggal_lahir, alamat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, santri_id, nama, tempat_lahir, tanggal_lahir, agama, no_telepon, pendidikan_id, pekerjaan, penghasilan, alamat, hubungan_orangtua', 'safe', 'on'=>'search'),
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
			'nama' => 'Nama',
			'tempat_lahir' => 'Tempat Lahir',
			'tanggal_lahir' => 'Tanggal Lahir',
			'agama' => 'Agama',
			'no_telepon' => 'No Telepon',
			'pendidikan_id' => 'Pendidikan',
			'pekerjaan' => 'Pekerjaan',
			'penghasilan' => 'Penghasilan',
			'alamat' => 'Alamat',
			'hubungan_orangtua' => 'Hubungan Orangtua',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir,true);
		$criteria->compare('tanggal_lahir',$this->tanggal_lahir,true);
		$criteria->compare('agama',$this->agama);
		$criteria->compare('no_telepon',$this->no_telepon,true);
		$criteria->compare('pendidikan_id',$this->pendidikan_id);
		$criteria->compare('pekerjaan',$this->pekerjaan,true);
		$criteria->compare('penghasilan',$this->penghasilan);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('hubungan_orangtua',$this->hubungan_orangtua);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SantriOrangtua the static model class
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
        if(preg_match('/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i',  $this->tanggal_lahir)){
            $this->tanggal_lahir = date('Y-m-d', strtotime(Utility::convertDateId($this->tanggal_lahir)));
        }
        return TRUE;
    }
    
}
