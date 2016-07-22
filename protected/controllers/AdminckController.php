<?php

class AdminckController extends CkltController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actionIndex() {
        $this->layout = "login";
        $model = new LoginForm;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->createUrl(Yii::app()->user->dashboard_url));
            }
        }
        // display the login form
        if (Yii::app()->user->isGuest)
            $this->render('login', array('model' => $model));
        else {
//            $this->redirect(Yii::app()->createUrl(Yii::app()->user->dashboard_url));
            $this->redirect(array(Yii::app()->user->dashboard_url));
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
//        $this->redirect(Yii::app()->homeUrl);
        $this->init();
        $this->redirect("index");
    }

    public function actionDashboard() {
        $total_santri = (new Santri())->getSantriDashboard();
        $top_reciter =  (new Santri())->getTopTenReciter();
        $santri_perquarters =  (new Santri())->getSantriPerquarters();        
//        $finance = (new Donasi())->getMonthlyDonationReport(date('m',time()), date('Y',time()));        
        $finance = (new Donasi())->getDashboardDonationReport();        
        $this->render("dashboard", array(
            'total_santri'=>$total_santri, 
            'top_reciter'=>$top_reciter, 
            'finance'=>$finance,
            'santri_perquarters'=>$santri_perquarters['santri'],
            'academic_year'=>$santri_perquarters['academic_year'],
            ));
    }
    
    public function actionFinanceChart() {
        $donation = array();
        $month = date('m',time());
        $year = date('Y',time());
        $credit = (new Donasi())->getDashboardDonationReport();
        if(!empty($credit)){
            foreach ($credit as $donasi) {
                $donation[] = array(
                    'x' =>   strtotime($donasi->tanggal)*1000,//(int)substr($donasi->tanggal,8),
                    'y' =>  (int)$donasi->perhari
                );
            }
        }
        $debet = (new Pengeluaran())->getDashboardExpenditureReport();
        if(!empty($debet)){
            foreach ($debet as $pengeluaran) {
                $expenditure[] = array(
                    'x' =>   strtotime($pengeluaran->tanggal)*1000,//(int)substr($donasi->tanggal,8),
                    'y' =>   (int)$pengeluaran->perhari
                );
            }
        }
        $result = array(
            array(
                'key'       => 'Donasi (Rp)',
                'values'    => $donation,
                'color'     => /*'#5698C6'*/ '#B699D0'
            ),
            array(
                'key'       => 'Pengeluaran (Rp)',
                'values'    => $expenditure,
                'color'     => /*'#D52A2B'*/ '#E68BC9'
            )
        );
        echo json_encode($result);
    }

    public function actionAdminDashboard() {
        $criteria = new CDbCriteria;
        $criteria->order = "id DESC";
        $groupProvider = new CActiveDataProvider('Group', array("criteria" => array("select" => "id,name", "with" => array("template" => array("template->name"))), "pagination" => array("pagesize" => 5)));
        $userProvider = new CActiveDataProvider('User', array("criteria" => array("select" => "id,full_name", "with" => array("group" => array("group->name"))), "pagination" => array("pagesize" => 5)));
        $menuProvider = new CActiveDataProvider('Menu', array("criteria" => array("select" => "id,title,url"), "pagination" => array("pagesize" => 5)));
        $this->render("index", array(
            "groupProvider" => $groupProvider,
            "userProvider" => $userProvider,
            "menuProvider" => $menuProvider,
        ));
    }

}

?>
