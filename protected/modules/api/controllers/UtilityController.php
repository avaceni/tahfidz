<?php

class UtilityController extends Controller {
    public function actionGetQuartersList() {
        $quarters_list = array();
        $quarters = Pondokan::getPondokanList();
        foreach ($quarters as $id=>$quarters_name){
            $quarters_list[] = array('id' => $id, 'nama_pondok' => $quarters_name);
        }
        echo json_encode($quarters_list);
    }
    protected function beforeAction($action) {
        ob_clean(); // clear output buffer to avoid rendering anything else
        header('Content-type: application/json'); // set content type header as json
        return parent::beforeAction($action);
    }
}
