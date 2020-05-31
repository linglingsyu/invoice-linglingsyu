<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票對獎系統 - 發票管理</title>
</head>
<body>
<?php  
include_once "common/base.php";

$sql = "select * from `user` where `id` = :id";
$statement = $pdo -> prepare($sql);
$id = $_SESSION['id'];
$result = $statement->execute(["id" => $id ]);
if(!$result){
    echo "可能是資料庫出錯囉";
    exit();
}
$user = $statement->fetch();

?>
<div class="welcome">
    <p>歡迎您回來！<?= $user["name"]; ?> </p>
</div>
    <div class="container">
    <a href="invoice.php">輸入發票</a>
    <a href="list.php">發票列表</a>
    <a href="award.php">發票對獎</a>
    <a href="idv.php">變更個人資訊</a>
    <a href="logout.php">登出</a>
    </div>
<?php
    $_SESSION["name"] = $user["name"];
?> 
</body>
</html>