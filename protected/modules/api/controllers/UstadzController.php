<?php

class UstadzController extends Controller {
    public function actionUstadzList() {
        $offset = Yii::app()->request->getPost('offset', 0);
        $limit = Yii::app()->request->getPost('limit', 10);
        $search = Yii::app()->request->getPost('search');
        echo json_encode(User::model()->getUstadzList($offset, $limit, $search));
    }
    public function actionUstadzDetail() {
        $id = Yii::app()->request->getPost('id');
        echo json_encode(User::model()->getUstadzDetail($id));
    }
    protected function beforeAction($action) {
        ob_clean(); // clear output buffer to avoid rendering anything else
        header('Content-type: application/json'); // set content type header as json
        return parent::beforeAction($action);
    }
}
