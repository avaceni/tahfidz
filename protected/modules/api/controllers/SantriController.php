<?php

class SantriController extends Controller {
    public function actionSantriList() {
        $search = Yii::app()->request->getPost('search');
        $offset = Yii::app()->request->getPost('offset', 0);
        $limit = Yii::app()->request->getPost('limit', 10);
        $halaqoh = Yii::app()->request->getPost('halaqoh');
        echo json_encode(User::model()->getSantriList($search, $offset, $limit, $halaqoh, 13));
    }
    public function actionSantriDetailBio() {
        $id = Yii::app()->request->getPost('id');
        echo json_encode(User::model()->getSantriDetailBio($id));
    }
    public function actionSantriDetailPendidikan() {
        $id = Yii::app()->request->getPost('id');
        echo json_encode(User::model()->getSantriDetailPendidikan($id));
    }
    public function actionSantriDetailOrangTua() {
        $id = Yii::app()->request->getPost('id');
        echo json_encode(User::model()->getSantriDetailOrangTua($id));
    }
    public function actionSetoranHafalan() {
        $params = array();
        $params['id'] = Yii::app()->request->getPost('id');
        $params['gender'] = Yii::app()->request->getPost('gender');
        $params['grade'] = Yii::app()->request->getPost('grade');
        $params['search'] = Yii::app()->request->getPost('search');
        $params['offset'] = Yii::app()->request->getPost('offset', 0);
        $params['limit'] = Yii::app()->request->getPost('limit', 10);
        $params['readmit'] = Yii::app()->request->getPost('readmit');
        echo json_encode(Santri::model()->getHafalan($params));
    }
    public function actionDetailHafalan() {
        $params = array();
        $params['id'] = Yii::app()->request->getPost('id');
        $params['month'] = Yii::app()->request->getPost('month');
        $params['year'] = Yii::app()->request->getPost('year');
        $params['type'] = Yii::app()->request->getPost('type');
        $params['offset'] = Yii::app()->request->getPost('offset', 0);
        $params['limit'] = Yii::app()->request->getPost('limit', 10);
        echo json_encode(Santri::model()->getDetailHafalan($params));
    }
    public function actionRingkasanHafalan() {
        $params = array();
        $params['id'] = Yii::app()->request->getPost('id');
        $params['bulan'] = Yii::app()->request->getPost('month');
        $params['tahun'] = Yii::app()->request->getPost('year');
        echo json_encode(Santri::model()->getRingkasanHafalan($params));
    }
    public function actionAddHafalan() {
        $params = $_POST;
        echo json_encode(Santri::model()->addHafalan($params));
    }
    protected function beforeAction($action) {
        ob_clean(); // clear output buffer to avoid rendering anything else
        header('Content-type: application/json'); // set content type header as json
        return parent::beforeAction($action);
    }
    
    public function actionLastHafalan() {
        $params = array();
        $params['id'] = Yii::app()->request->getPost('id');
        $params['tipe'] = Yii::app()->request->getPost('tipe');        
        echo json_encode(Santri::model()->getLastHafalan($params));
    }
    
    public function actionTotalSantri(){
        echo json_encode((new Santri())->getSantriDashboard());
    }
    
    public function actionDataSantriSD(){
        echo json_encode((new Santri())->getSantriListByGrade(2));
    }
    
    public function actionDataSantriSMP(){
        echo json_encode((new Santri())->getSantriListByGrade(3));
    }
    
    public function actionDataSantriSMA(){
        echo json_encode((new Santri())->getSantriListByGrade(4));
    }

    public function actionDataSantriKuliah(){
        echo json_encode((new Santri())->getSantriListByGrade(8));
    }

    public function actionHapusHafalan(){
        $params = array();
        $params['id'] = Yii::app()->request->getPost('id');
        echo json_encode((new MutabaahTahfidz())->deleteHafalan($params));
    }
}
