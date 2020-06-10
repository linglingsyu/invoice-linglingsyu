<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票對獎系統 - 發票管理</title>
    <?php include 'include/link.php'; ?>
</head>

<body class="d-flex flex-column justify-content-center align-items-center">
    <?php

    $sql = "select * from `user` where `id` = :id";
    $statement = $pdo->prepare($sql);
    $id = $_SESSION['id'];
    $result = $statement->execute(["id" => $id]);
    if (!$result) {
        echo "可能是資料庫出錯囉";
        exit();
    }
    $user = $statement->fetch();
    ?>
    <div id="menu" class="container position-fixed">
        <h1 class="h1 text-center">歡迎您回來！<?= $user["name"]; ?> </h1>
        <div class="row justify-content-center align-items-center">
            <nav class="nav mb-4  ">
                <a class="nav-link active" href="?target=invoice">輸入發票</a>
                <a class="nav-link" href="?target=list">發票列表</a>
                <a class="nav-link" href="?target=award">發票對獎</a>
                <a class="nav-link" href="?target=idv">變更個人資訊</a>
                <a class="nav-link" href="?target=logout">登出</a>        
            </nav>
        </div>
    </div>


        <?php

            if (!empty($_GET["target"])) {
                $target = $_GET["target"];
            } else {
                $target = "invoice";
            }
            $file = $target . ".php";
            if (file_exists($file)) {
                include "$file";
            } else {
                include "invoice.php";
            }

        ?>


    <?php $_SESSION["name"] = $user["name"]; ?>

</body>

</html>