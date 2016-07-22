<?php

class IconController extends CkltController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
//    aksi admin
    public function actionAdmin(){
        $icon_model = Icon::model()->findAll(array());
        $this->render('admin', array('icon_model'=>$icon_model));
    }

}
