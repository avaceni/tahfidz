<?php

/**
 * This is the model class for table "foto".
 *
 * The followings are the available columns in table 'foto':
 * @property string $id
 * @property string $lokasi
 * @property integer $aktif
 * @property integer $tipe
 * @property string $tanggal_dibuat
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property CkltUser $user
 */
class Foto extends CActiveRecord
{    
        public $temp_image;
        public $current_image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'foto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lokasi, aktif', 'required'),
			array('aktif, tipe', 'numerical', 'integerOnly'=>true),
			array('lokasi', 'length', 'max'=>255),
			array('user_id', 'length', 'max'=>10),
			array('tanggal_dibuat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lokasi, aktif, tipe, tanggal_dibuat, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'CkltUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lokasi' => 'Lokasi',
			'aktif' => 'Aktif',
			'tipe' => 'Tipe',
			'tanggal_dibuat' => 'Tanggal Dibuat',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('aktif',$this->aktif);
		$criteria->compare('tipe',$this->tipe);
		$criteria->compare('tanggal_dibuat',$this->tanggal_dibuat,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Foto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    public function beforeSave() {
        parent::beforeSave();
        if ($this->aktif == 1 && !empty($this->user_id)) {
            Foto::model()->updateAll(array('aktif' => 0), "user_id = $this->user_id AND tipe = $this->tipe");
        }
        return TRUE;
    }
    
    public function afterSave() {
        parent::afterSave();
        if ($this->tipe == 1 && !empty($this->user_id)) {
            $path = Yii::getPathOfAlias("webroot.images.user.$this->user_id");
            list($width,$height) = getimagesize(Yii::app()->createAbsoluteUrl($this->lokasi));
            $pathPhoto = $path.'/'.$this->getFileName()[0];
            Yii::import('application.extensions.ImageEditor.ImageEditor');
            $width_ratio = array('icon'=>array(64,64));
            foreach ($width_ratio as $size_name => $new_size) {
                $image = ImageEditor::createFromFile($pathPhoto);
                ${$size_name.'FileName'} = Yii::getPathOfAlias("webroot.images.user.$this->user_id") . "/{$this->getFileName()[1]}_{$size_name}.png";
                if($width/$height > $new_size[0]/$new_size[1]){//landscape
                    if($height > $new_size[1]){//bigger
                        $resize_width = $width/$height*$new_size[1];
                        $image->resize($resize_width, $new_size[1]);
                    }
                    $croped_width = $new_size[0]/$new_size[1]*$image->getHeight();
                    $crop_size = ($image->getWidth() - $croped_width)/2;
                    $image->crop($crop_size, 0, $crop_size + $croped_width, $image->getHeight());
                }
                else{//potrait
                    if($width > $new_size[0]){//bigger                                           
                        $resize_height = $height/$width*$new_size[0];
                        $image->resize($new_size[0],$resize_height);
                    }
                    $croped_height = $new_size[1]/$new_size[0]*$image->getWidth();
                    $crop_size = ($image->getHeight() - $croped_height)/2;
//                    $image->crop(0, $crop_size, $image->getWidth(), $crop_size + $croped_height);
                    $image->crop(0, 0, $image->getWidth(), $croped_height);//get from top
                }
                $image->saveToFile(${$size_name.'FileName'}, "png");
                chmod(${$size_name.'FileName'}, 0777);
            }
        }
        return TRUE;
    }
    
    public function getFileName(){
        $explode = explode('/', $this->lokasi);
        $explode_nd = explode('.', $explode[3]);
        return array($explode[3],$explode_nd[0],$explode_nd[1]);
    }
    
}
