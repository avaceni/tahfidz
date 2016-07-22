<?php
class FilePicker extends CWidget{
    private $assets = "assets";
    private $assetsFolder = null;
    private $url = null;
    public $model;
    public $attribute;
    public $blankImage = null;
    private $defaultImage;
    public function init() {
        $this->assetsFolder = dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->assets;
        $this->url = CHtml::asset($this->assetsFolder);
        Yii::app()->getClientScript()->registerCoreScript("jquery");
        Yii::app()->getClientScript()->registerScriptFile($this->url . "/js/script.js");
        Yii::app()->getClientScript()->registerCssFile($this->url . "/css/style.css");
        $this->defaultImage = $this->url."/img/no_image.png";
    }
    public function run() {
        if(isset ($this->blankImage))
            $this->defaultImage = $this->blankImage;
        $this->render("index", array("model"=>  $this->model, "attribute"=>  $this->attribute, "defaultImage"=>  $this->defaultImage));
    }
}
?>
