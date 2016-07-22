<?php

class BreadCrumb extends CWidget {
    public $crumbs = array();
//    public $delimiter = ' / ';

    public function run() {
        $this->renderBreadCrumb();
    }

    public function renderBreadCrumb() {
        ?>
        <ol class="breadcrumb">
            <?php
            foreach ($this->crumbs as $crumb) {
                echo "<li>";
                if (isset($crumb['url'])) {
                    $crumb_param = !empty($crumb['url'][1])?$crumb['url'][1]:array();
                    $href = Yii::app()->createAbsoluteUrl($crumb['url'][0],$crumb_param);
                    echo "<a href={$href}>{$crumb['name']}</a>";
                } else {
                    echo $crumb['name'];
                }
                echo "</li>";
            }
            ?>
        </ol>
        <?php
        /*
          <div id="breadCrumb">
          <?php
          foreach($this->crumbs as $crumb) {
          if(isset($crumb['url'])) {
          echo CHtml::link($crumb['name'], $crumb['url']);
          } else {
          echo $crumb['name'];
          }
          if(next($this->crumbs)) {
          echo $this->delimiter;
          }
          }
          ?>
          </div>
         */
        ?>
        <?php
    }

}
