<?php

class GridView extends CGridView{
    public $afterAjaxUpdate = 'function(id, data) {$(".c-santri-register").on("click", function () {alert("hehe")});}';
}