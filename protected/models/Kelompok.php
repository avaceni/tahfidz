<?php

/**
 * This is the model class for table "kelompok".
 *
 * The followings are the available columns in table 'kelompok':
 * @property integer $id
 * @property string $nama_kelompok
 * @property integer $aktif
 *
 * The followings are the available model relations:
 * @property RiwayatKelompok[] $riwayatKelompoks
 */
class Kelompok extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kelompok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_kelompok, aktif', 'required'),
			array('aktif', 'numerical', 'integerOnly'=>true),
			array('nama_kelompok', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_kelompok, aktif', 'safe', 'on'=>'search'),
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
			'riwayatKelompoks' => array(self::HAS_MANY, 'RiwayatKelompok', 'kelompok'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama_kelompok' => 'Nama Kelompok',
			'aktif' => 'Aktif',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nama_kelompok',$this->nama_kelompok,true);
		$criteria->compare('aktif',$this->aktif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kelompok the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function searchGroup()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nama_kelompok',$this->nama_kelompok,true);
		$criteria->compare('aktif',$this->aktif);
                $criteria->order = 'nama_kelompok ASC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination' => array(
                            'pageSize' => 5,
                        ),
		));
	}
        
        public function loadModel($id) {
            $criteria = new CDbCriteria();
            $criteria->with = array(
                'riwayatKelompoks' => array(
                    'alias' => 'a'
                ),
                'riwayatKelompoks.user' => array(
                    'alias' => 'b'
                )
            );
//            $criteria->compare('a.aktif', 1);
//            $criteria->compare('b.group_id', 13);
            $criteria->compare('t.id', $id);
            $model = $this->model()->find($criteria);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }
        
        public static function getUstadz($id){
            $ustadz = array();
            $criteria = new CDbCriteria();
            $criteria->with = array(
                'user' => array(
                    'alias' => 'a'
                )
            );
            $criteria->compare('t.aktif', 1);
            $criteria->compare('a.group_id', 12);
            $criteria->compare('t.kelompok', $id);
            $model = RiwayatKelompok::model()->find($criteria);
//            if ($model === null)
//                throw new CHttpException(404, 'The requested page does not exist.');
            if(!empty($model)){
                $ustadz['id'] = $model->user->id;
                $ustadz['nama'] = $model->user->full_name;
            }            
            return $ustadz;
        }
        
    public static function getSantri($id){
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array(
                'alias' => 'a'
            )
        );
        $criteria->compare('t.aktif', 1);
        $criteria->compare('a.group_id', 13);
        $criteria->compare('t.kelompok', $id);
        $model = RiwayatKelompok::model()->findAll($criteria);
        return $model;
    }
        
    public static function getKelompokList() {
        $model = Kelompok::model()->findAll('aktif = 1');
        $pondokan = array_map("ucwords", CHtml::listData($model, 'id', 'nama_kelompok'));
        return $pondokan;
    }
    
    public function loadModelId($id) {
        $model = $this->model()->findByPk($id);
        return $model;
    }
}
