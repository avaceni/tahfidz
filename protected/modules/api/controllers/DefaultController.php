<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
//		$this->render('index');
        echo json_encode("RumahTahfidzQu API v0.1");
    }
        
    protected function beforeAction($action) {
        ob_clean(); // clear output buffer to avoid rendering anything else
        header('Content-type: application/json'); // set content type header as json
        return parent::beforeAction($action);
    }        
}