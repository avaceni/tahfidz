<?php
//http://cariprogram.blogspot.com
//nuramijaya@gmail.com

//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
//karena excel_reader2.php menggunakan fungsi split yg sudah deprecated di php5
require_once 'excel_reader2.php';
$data = new Spreadsheet_Excel_Reader("example.xls");

echo "CELL A,1 -> ".$data->val(1,'A')."<br/>";
echo "CELL B,2 -> ".$data->val(2,'B')."<br/>";
echo "CELL F,10 -> ".$data->val(10,'F')."<br/>";

echo "CELL D,3 -> ".$data->val(3,4)."<br/>";
echo "CELL E,2 -> ".$data->val(2,5)."<br/>";

echo "SHEET2 CELL A,1 -> ".$data->val(1,'A',1)."<br/>";
echo "SHEET2 CELL C,2 -> ".$data->val(2,3,1)."<br/>";
?>