<?php

/**
 * This is the model class for table "riwayat_kelompok".
 *
 * The followings are the available columns in table 'riwayat_kelompok':
 * @property string $id
 * @property integer $kelompok
 * @property string $tanggal_dibuat
 * @property integer $aktif
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property Kelompok $kelompok0
 * @property CkltUser $user
 */
class RiwayatKelompok extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'riwayat_kelompok';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('kelompok, tanggal_dibuat, aktif, user_id', 'required'),
            array('kelompok, aktif', 'numerical', 'integerOnly' => true),
            array('user_id', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, kelompok, tanggal_dibuat, aktif, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kelompoknya' => array(self::BELONGS_TO, 'Kelompok', 'kelompok'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'kelompok' => 'Kelompok',
            'tanggal_dibuat' => 'Tanggal Dibuat',
            'aktif' => 'Aktif',
            'user_id' => 'User',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('kelompok', $this->kelompok);
        $criteria->compare('tanggal_dibuat', $this->tanggal_dibuat, true);
        $criteria->compare('aktif', $this->aktif);
        $criteria->compare('user_id', $this->user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RiwayatKelompok the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchMember() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'user' => array(
                'alias' => 'a'
            ),
        );
        $criteria->compare('a.group_id', 13);
//                $criteria->together = TRUE;
        $criteria->compare('id', $this->id, true);
//		$criteria->compare('kelompok',$this->kelompok);
        $criteria->compare('tanggal_dibuat', $this->tanggal_dibuat, true);
        $criteria->compare('aktif', $this->aktif);
        $criteria->compare('user_id', $this->user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getLast($user_id) {
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user_id);
        $criteria->compare('aktif', 1);
        $model = $this->model()->find($criteria);
        return $model;
    }

    public function beforeSave() {
        parent::beforeSave();
        if ($this->aktif == 1) {
            RiwayatKelompok::model()->updateAll(array('aktif' => 0), "user_id = $this->user_id");
            $model_user = User::model()->findByPk($this->user_id);
            if($model_user->group_id == 12){
                $active_ustadz_id = (new Kelompok())->getUstadz($this->kelompok);
                if(!empty($active_ustadz_id)){
                    RiwayatKelompok::model()->updateAll(array('aktif'=>0), "user_id = {$active_ustadz_id['id']}");
                }
            }
        }
        return TRUE;
    }
    
    public function getGroupMember($param){
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array(
                'alias' => 'a'
            ),
        );
        $criteria->compare('t.kelompok', $param['kelompok']);
        $criteria->compare('t.aktif', 1);
        $criteria->compare('a.group_id', 13);
        $criteria->together = true;

        return new CActiveDataProvider(new RiwayatKelompok(), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
    }

    public function getGroupHistory($id){
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $id);

        return new CActiveDataProvider(new RiwayatKelompok(), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
    }    

}
