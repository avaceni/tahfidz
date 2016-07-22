<?php

/**
 * This is the model class for table "pengeluaran".
 *
 * The followings are the available columns in table 'pengeluaran':
 * @property string $id
 * @property string $tanggal
 * @property string $keperluan
 * @property string $jumlah
 */
class Pengeluaran extends CActiveRecord
{
    public $perhari;
    public $year;
    public $month;
    public $expenditure_total;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pengeluaran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tanggal, keperluan, jumlah', 'required', 'message' => '{attribute} tidak boleh kosong'),
			array('jumlah', 'length', 'max'=>15),
                        array('jumlah', 'type', 'type'=>'float', 'message'=>'{attribute} harus angka'),
                        array('pembuat', 'length', 'max'=>10),
                        array('pondok_id', 'numerical', 'integerOnly' => true),
                        array('tanggal', 'match', 'pattern' => '/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i', 'message' => "Format {attribute} salah"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tanggal,pondok_id, keperluan, pembuat, jumlah', 'safe', 'on'=>'search'),
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
                    'quarters' => array(self::BELONGS_TO, 'Pondokan', 'pondok_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tanggal' => 'Tanggal',
			'keperluan' => 'Keperluan',
			'pembuat' => 'Pencatat',
			'jumlah' => 'Jumlah',
                        'pondok_id' => 'Pondok',
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
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('keperluan',$this->keperluan,true);
		$criteria->compare('pembuat',$this->pembuat,true);
		$criteria->compare('jumlah',$this->jumlah,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pengeluaran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getExpenditure($month, $year, $offset, $limit, $quarters, $search){
            $result = array();
            $selected = array(
                'jumlah', 'tanggal', 'keperluan', 'pondok_id'
                );

            $criteria = new CDbCriteria();
            if(!empty($year)){
                if($year != 'all'){
                    if($month == 'all'){
                        $start_time = "{$year}-1-1 00:00:00";
                        $end_time = "{$year}-12-31 23:59:59";
                    }
                    else{
                        $date = Utility::getNumberOfDate($month,$year);
                        $start_time = "{$year}-{$month}-1 00:00:00";
                        $end_time = "{$year}-{$month}-{$date} 23:59:59";
                    }
                    $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
                    $criteria->params[':start_time'] = $start_time;
                    $criteria->params[':end_time'] = $end_time;
                }
            }
//            if(!empty($month)){
//                if(empty($year)){
//                    $year = date("Y", time());
//                }
//                $date = Utility::getNumberOfDate($month,$year);
//                $start_time = "{$year}-{$month}-1 00:00:00";
//                $end_time = "{$year}-{$month}-{$date} 23:59:59";
//                $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
//                $criteria->params[':start_time'] = $start_time;
//		$criteria->params[':end_time'] = $end_time;
//            }
            $criteria->compare('keperluan', $search, true);
            $criteria->compare('pondok_id', $quarters);
            $criteria->offset = $offset;
            $criteria->limit = $limit;
            $criteria->order = 't.tanggal DESC';
            $criteria->together = TRUE;
            
            $model = Pengeluaran::model()->findAll($criteria);
            if(!empty($model)){
                $i=0;
                foreach($model as $pengeluaran){
                    foreach ($selected as $value){
                        $result[$i][$value] = $pengeluaran->$value;
                    }
                    $nama_pondok = '';
                    if(!empty($pengeluaran->quarters)){
                        $nama_pondok = $pengeluaran->quarters->nama_pondok;
                    }
                    $result[$i]['pondok'] = ucwords($nama_pondok);
                    $i++;
                }
            }
            return $result;
        }
        public function getMonthlyExpenditureReport($month, $year){
            $end_date = Utility::getNumberOfDate($month,$year);
            $start_time = "{$year}-{$month}-1 00:00:00";
            $end_time = "{$year}-{$month}-{$end_date} 23:59:59";
            $criteria = new CDbCriteria();
            $criteria->select = 'sum(jumlah) as perhari,tanggal';
//            $criteria->condition = 'tanggal >= :start_time AND t.tanggal <= :end_time';
            $criteria->condition = 't.tanggal >= "2015-08-01" AND t.tanggal <= "2015-08-31"';
            $criteria->params[':start_time'] = $start_time;
            $criteria->params[':end_time'] = $end_time;
            $criteria->group = 'DATE(tanggal)';
            $criteria->order = 'tanggal ASC';
            $model = $this->model()->findAll($criteria);
            return $model;
        }
        
        public function getAllExpenditure($param,$month=null,$year=null,$pageSize=5){
            $criteria = new CDbCriteria();
            if(!empty($param['expenditure_year'])){
                if($param['expenditure_year'] != 'all'){
                    if($param['expenditure_month'] == 'all'){
                        $start_time = "{$param['expenditure_year']}-1-1 00:00:00";
                        $end_time = "{$param['expenditure_year']}-12-31 23:59:59";
                    }
                    else{
                        $date = Utility::getNumberOfDate($param['expenditure_month'],$param['expenditure_year']);
                        $start_time = "{$param['expenditure_year']}-{$param['expenditure_month']}-1 00:00:00";
                        $end_time = "{$param['expenditure_year']}-{$param['expenditure_month']}-{$date} 23:59:59";
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
            
            if(!empty($param['expenditure_quarters']) && $param['expenditure_quarters'] != 'all'){
            $criteria->compare('pondok_id', $param['expenditure_quarters']);}
            $criteria->order = 't.tanggal DESC';

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => $pageSize,
                ),
            ));
        }
        
        public function getTotalExpenditure($month=null,$year=null){
            $criteria = new CDbCriteria();
            $criteria->select = 'sum(jumlah) as expenditure_total';
            if(!empty($year)){
                if($year != 'all'){
                    if($month == 'all'){
                        $start_time = "{$year}-1-1 00:00:00";
                        $end_time = "{$year}-12-31 23:59:59";
                    }
                    else{
                        $date = Utility::getNumberOfDate($month,$year);
                        $start_time = "{$year}-{$month}-1 00:00:00";
                        $end_time = "{$year}-{$month}-{$date} 23:59:59";
                    }
                    $criteria->condition = 't.tanggal >= :start_time AND t.tanggal <= :end_time';
                    $criteria->params[':start_time'] = $start_time;
                    $criteria->params[':end_time'] = $end_time;
                }
            }
            $model = $this->model()->find($criteria);
            return $model;
        }
        
        public function loadModelId($id) {
            $model = $this->model()->findByPk($id);
            return $model;
        }
        
        public function beforeSave() {
            parent::beforeSave();
            if(preg_match('/((\d{2,2})[^a-zA-Z0-9]*(jan|feb|mar|apr|mei|jun|jul|agu|sep|okt|nov|des)([^0-9]*)[^a-zA-Z0-9]*(19|20)(\d{2}))/i',  $this->tanggal)){
                $this->tanggal = date('Y-m-d', strtotime(Utility::convertDateId($this->tanggal)));
            }
            return TRUE;
        }
        
        public static function getMonthlyExpenditure($year=null){
            $criteria = new CDbCriteria();
            $criteria->select = 'MONTH (tanggal) AS month, YEAR (tanggal) AS year, sum(jumlah) AS expenditure_total';
            if(!empty($year)){
                $criteria->condition = "YEAR(tanggal) = $year";
            }
            $criteria->group = 'MONTH (tanggal), YEAR (tanggal)';
            $criteria->order = 'year DESC, month ASC';
            $model = Pengeluaran::model()->findAll($criteria);
            return $model;
        }
        
        public function getDashboardExpenditureReport(){
            $start_date = date('Y',  strtotime('-6 month')).'-'.date('m',  strtotime('-6 month')).'-01';
            $criteria = new CDbCriteria();
            $criteria->select = 'sum(jumlah) as perhari,tanggal';
            $criteria->condition = 'DATE(t.tanggal) >= :start_date AND DATE(t.tanggal) <= :end_date';
            $criteria->params[':start_date'] = $start_date;
            $criteria->params[':end_date'] = date('Y-m-d', time());
            $criteria->group = 'DATE(tanggal)';
            $criteria->order = 'tanggal ASC';
            $model = $this->model()->findAll($criteria);
            return $model;
        }
}
