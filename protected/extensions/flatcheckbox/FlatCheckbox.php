<?php
class FlatCheckbox extends CWidget {
    private $assets = "assets";
    private $url = null;
    private $assetsFolder = null;
    public $model = null;
    public $attribute = null;
    public $htmlOptions = array();
    public function init() {
        $this->assetsFolder = dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->assets;
        $this->url = CHtml::asset($this->assetsFolder);
//        Yii::app()->getClientScript()->registerCoreScript("jquery");
//        Yii::app()->getClientScript()->registerScriptFile($this->url . "/js/script.js");
        Yii::app()->getClientScript()->registerCssFile($this->url . "/css/style.css");
    }
    public function run() {
        $this->render("index", array("model"=>  $this->model, "attribute"=>  $this->attribute, "htmlOptions"=>  $this->htmlOptions));
    }
}
?>
