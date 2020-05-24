<?php 
include "common/base.php";

$user_id= $_SESSION['id'];
$period = $_POST['period'];
//函數清除字串前後空白 查表單過濾(injection)
$year = trim($_POST["year"]);
$inv_date = $_POST["inv_date"];
$code = strtoupper($_POST['code']);
$num = $_POST["num"];
$spend = $_POST["spend"];
$note = $_POST["note"];

$data = [
"user_id"=>$user_id,
"year"=>$year,
"period"=>$period,
"inv_date"=>$inv_date,
"code"=>$code,
"num"=>$num,
"spend"=>$spend,
"note"=>$note,
];

$res = save("invoice",$data);

if($res>=1){
    to("invoice.php?status=1");
}else{
    echo "新增失敗";
}



?>