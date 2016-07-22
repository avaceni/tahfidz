<?php

class FinanceController extends Controller {
    public function actionGetDonation() {
        $user_id = Yii::app()->request->getPost('user_id');
        $month = Yii::app()->request->getPost('month');
        $year = Yii::app()->request->getPost('year');
        $offset = Yii::app()->request->getPost('offset', 0);
        $limit = Yii::app()->request->getPost('limit', 25);
        $search = Yii::app()->request->getPost('search');
        echo json_encode(Donasi::model()->getDonasi($user_id, $month, $year, $offset, $limit, $search));
    }
    public function actionGetExpenditure() {
        $month = Yii::app()->request->getPost('month');
        $year = Yii::app()->request->getPost('year');
        $offset = Yii::app()->request->getPost('offset', 0);
        $limit = Yii::app()->request->getPost('limit', 25);
        $quarters = Yii::app()->request->getPost('quarters');
        $search = Yii::app()->request->getPost('search');
        echo json_encode(Pengeluaran::model()->getExpenditure($month, $year, $offset, $limit, $quarters, $search));
    }
    protected function beforeAction($action) {
        ob_clean(); // clear output buffer to avoid rendering anything else
        header('Content-type: application/json'); // set content type header as json
        return parent::beforeAction($action);
    }
    public function actionGetFinanceReport(){
        $result = array('donasi'=>'0','pengeluaran'=>'0');
        $month = Yii::app()->request->getPost('month');
        $year = Yii::app()->request->getPost('year');
        $count_donation = (new Donasi())->getTotalDonation($month, $year);
        if(!empty($count_donation->donation_total)){
            $result['donasi'] = $count_donation->donation_total;
        }
        $count_expenditure = (new Pengeluaran())->getTotalExpenditure($month, $year);
        if(!empty($count_expenditure->expenditure_total)){
            $result['pengeluaran'] = $count_expenditure->expenditure_total;
        }
        echo json_encode($result);
    }
    public function actionGetDonationPerMonth(){
        $year = Yii::app()->request->getPost('year');
        echo json_encode(Donasi::model()->getMonthlyDonation($year));
    }
    public function actionGetExpenditurePerMonth(){
        $year = Yii::app()->request->getPost('year');
        echo json_encode(Pengeluaran::model()->getMonthlyExpenditure($year));
    }
}
