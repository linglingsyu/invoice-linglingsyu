
<?php
include_once "common/base.php";

$userid = $_SESSION['id'];
$pw = $_POST['pw'];
$name = $_POST['name'];
$birthday = $_POST['birthday'];
$email = $_POST['email'];
$chkpw = $_POST['chkpw'];

$chk_list =["name","birthday","email"];
foreach ($chk_list as $value){
    //驗證資料欄位
  if (empty($_POST[$value])) {
      to("main.php?target=idv&status=1");
      exit();
  }
}
  
$data = [
  "id" => $userid,
  "name" => $name,
  "birthday" => $birthday,
  "email"=> $email,
];

if(!empty($pw)){
  if($pw != $chkpw){
    //驗證確認密碼
    to("main.php?target=idv&status=2"); 
    exit();
  }  
  $data["pw"] = $pw;
}

 

save("user",$data);
to("main.php?target=idv&status=3");









?>