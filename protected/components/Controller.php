<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
    
    public $result = array();
    public $head_title = 'SwaraIkadi';
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

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

    public function init() {
        $public = Site::model()->getDefaultTheme();
        if (isset($public)) {
            Yii::app()->theme = $public['template'];
            $this->layout = $public['default_template_layout'];
        }
        //default meta-tag
        Yii::app()->clientScript->registerMetaTag(
                'text/html;charset=UTF-8', NULL, 'Content-Type', NULL, 'meta-char'
        );
        Yii::app()->clientScript->registerMetaTag(
                'swaraikadi.com media informasi dan konsultasi', 'description', NULL, array('lang' => 'id'), 'meta-des'
        );
        Yii::app()->clientScript->registerMetaTag(
                'swaraikadi, ikadi, konsultasi, dakwah, spotky.com,', 'keywords', NULL, array('lang' => 'id'), 'meta-key'
        );
        Yii::app()->clientScript->registerMetaTag(
                'redaksi swaraikadi', 'author', NULL, array('lang' => 'id'), 'meta-aut'
        );
    }

}
