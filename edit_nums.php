<?php
include_once "common/base.php";

$id = $_POST['id'];
$special = $_POST['special'];
$top = $_POST['top'];
$first_prize1 = $_POST['first_prize1'];
$first_prize2 = $_POST['first_prize2'];
$first_prize3 = $_POST['first_prize3'];
$addprize = $_POST['addprize'];

foreach ($_POST as $value){
  if (empty($value)) {
      to("main.php?target=update_numbers&id=$id&status=1");
      exit();
  }
}
 
$data = [
  "id" => $id,
  "special" => $special,
  "top" => $top,
  "first_prize1" => $first_prize1,
  "first_prize2" => $first_prize2,
  "first_prize3" => $first_prize3,
  "addprize"=> $addprize,
];
save("numbers",$data);
to("main.php?target=update_numbers&id=$id&status=2");









?>