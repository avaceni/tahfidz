<?php

/**
 * This is the model class for table "riwayat_pondokan".
 *
 * The followings are the available columns in table 'riwayat_pondokan':
 * @property string $id
 * @property integer $pondok_id
 * @property string $tanggal_pindah_podok
 * @property string $user_id
 * @property string $keterangan_pindah
 * @property integer $aktif
 *
 * The followings are the available model relations:
 * @property CkltUser $user
 * @property Pondokan $pondok
 */
class RiwayatPondokan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'riwayat_pondokan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pondok_id, tanggal_pindah_pondok, user_id, aktif', 'required'),
            array('pondok_id, aktif', 'numerical', 'integerOnly' => true),
            array('user_id', 'length', 'max' => 10),
            array('keterangan_pindah', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pondok_id, tanggal_pindah_pondok, user_id, keterangan_pindah, aktif', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'CkltUser', 'user_id'),
            'pondok' => array(self::BELONGS_TO, 'Pondokan', 'pondok_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pondok_id' => 'Pondok',
            'tanggal_pindah_pondok' => 'Tanggal Pindah Podok',
            'user_id' => 'User',
            'keterangan_pindah' => 'Keterangan Pindah',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('pondok_id', $this->pondok_id);
        $criteria->compare('tanggal_pindah_pondok', $this->tanggal_pindah_pondok, true);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('keterangan_pindah', $this->keterangan_pindah, true);
        $criteria->compare('aktif', $this->aktif);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RiwayatPondokan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        parent::afterSave();
        if ($this->isNewRecord) {
            $criteria = new CDbCriteria();
            $criteria->condition = "id != {$this->id}";
            $criteria->compare('user_id', $this->user_id);
            $model = new RiwayatPondokan();
            if (!empty($model)) {
                $model->updateAll(array('aktif' => 0), $criteria);
            }
        }
        return true;
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
        if ($this->isNewRecord) {
            RiwayatPondokan::model()->updateAll(array('aktif' => 0), "user_id = $this->user_id");
        }
        return TRUE;
    }

}
