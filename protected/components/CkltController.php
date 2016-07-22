<?php

class CkltController extends CController {
    public $result = array();
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';
    public $arr_actions = array();
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    protected $cklt_user;
    protected $halaqoh_last;
    protected $halaqoh_member;
    protected $halaqoh_member_list;
    
    public function init() {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/lib/submit/submit-link.js");
        Yii::app()->user->loginUrl = array("adminck/index");
        $site_model = Site::model()->findByAttributes(array('is_actived'=>1));
        Yii::app()->theme = 'GREEN_ADMIN';
        $this->layout = "//layouts/rbacrt";
        if (!Yii::app()->user->isGuest) {
            $template = Template::model()->findGroupTemplate(Yii::app()->user->group);
            Yii::app()->theme = $template['theme'];
            $this->layout = "//layouts/{$template['layout']}";
            $this->cklt_user = User::model()->findByPk(Yii::app()->user->id);
            if($this->cklt_user->group_id == 12){
                $this->halaqoh_last = RiwayatKelompok::model()->getLast($this->cklt_user->id);
                if(!empty($this->halaqoh_last)){
                    $this->halaqoh_member = Kelompok::model()->getSantri($this->halaqoh_last->kelompok);
                    if(!empty($this->halaqoh_member)){
                        $this->halaqoh_member_list = array();
                        foreach ($this->halaqoh_member as $member_history){
                            $this->halaqoh_member_list[] = $member_history->user->id;
                        }
                    }
                }
            }
        }
    }

    public function accessRules() {
//        parent::accessRules();
        $actions = '';
        $group_id = isset (Yii::app()->user->group)?Yii::app()->user->group:"";
        $module_name = isset (Yii::app()->controller->module->id)?Yii::app()->controller->module->id:"";
        $controller = Yii::app()->controller->id;
        
        if(!empty($module_name)){
            $criteria = new CDbCriteria();
            $criteria->with = array(
                'accesses' => array(
                    'alias' => 'a'
                )
            );
            $criteria->compare('a.group_id', $group_id);
            $criteria->compare('a.controller', $controller);
            $criteria->compare('t.name', strtolower($module_name));
            $module = Module::model()->find($criteria);
            if(!empty($module)){
                foreach($module->accesses as $accesses){
                    $actions = $accesses->access_action;
                }
            }
        }
        else {
            $criteria = new CDbCriteria();
            $criteria->compare('t.group_id', $group_id);
            $criteria->compare('t.controller', $controller);
            $access = Access::model()->find($criteria);
            if(!empty($access)){
                $actions = $access->access_action;
            }
        }

//        $criteria = new CDbCriteria;
//        $criteria->with = array(
//            'module'=>array(
//                'ON'=>"name=$module_name"
//            )
//        );
//        $criteria->compare('group_id', $group_id);
//        $criteria->compare('controller', $controller);
//        $criteria->select = "access_action";
//        $access = Access::model()->find($criteria);

        $this->arr_actions = explode(",", $actions);
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('error',"login", "logout","try","index"),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => $this->arr_actions,
                'expression' => "$group_id",
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    
}

?>
