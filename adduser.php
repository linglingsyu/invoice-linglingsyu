<?php

include_once "common/base.php";

foreach ($_POST as $value){
    if (empty($value)) {
        header("location:reg.php?status=5");
        exit();
    }
}

$acc = $_POST["acc"];
$pw = $_POST["pw"];
$name = $_POST["name"];
$email = $_POST["email"];
$bir = $_POST["bir"];

$sqlacc = "select count(`acc`) from `user` where `acc`=:acc";
$statement = $pdo -> prepare($sqlacc);
$result = $statement->execute(["acc"=>$acc]);
if(!$result){
    to("reg.php?status=1");
    exit();
}
$user = $statement->fetchColumn();

if ($user == 1) {
    to("reg.php?status=2");
    exit();
}

$sql = "insert into `user` (`acc`,`pw`,`name`,`birthday`,`email`) values (:acc,:pw,:name,:bir,:email)";

$statement = $pdo->prepare($sql);
$result = $statement -> execute(['acc'=>$acc,'pw'=>$pw,'name'=>$name,'bir'=>$bir,'email'=>$email]);

if ($result) {
    to("reg.php?status=3");
    exit();
} else {
    to("reg.php?status=4");
}





