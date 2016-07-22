<?php

/**
 * This is the model class for table "santri_penyakit".
 *
 * The followings are the available columns in table 'santri_penyakit':
 * @property string $id
 * @property string $santri_id
 * @property string $nama_penyakit
 * @property string $tahun
 */
class SantriPenyakit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'santri_penyakit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('santri_id, nama_penyakit', 'required', 'message'=>'{attribute} tidak boleh kosong'),
                        array('tahun', 'numerical', 'integerOnly'=>true, 'message'=>'{attribute} harus angka'),
                        array('tahun', 'match', 'pattern' => '/(19|20)\d{2}/i', 'message' => ' Format {attribute} salah'),
			array('santri_id', 'length', 'max'=>10),
			array('nama_penyakit', 'length', 'max'=>255),
			array('tahun', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, santri_id, nama_penyakit, tahun', 'safe', 'on'=>'search'),
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
			'nama_penyakit' => 'Nama Penyakit',
			'tahun' => 'Tahun',
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
		$criteria->compare('nama_penyakit',$this->nama_penyakit,true);
		$criteria->compare('tahun',$this->tahun,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SantriPenyakit the static model class
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
        if(!$this->tahun){
            $this->tahun = null;
        }
        return TRUE;
    }
}
