<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票對獎系統 - 發票管理</title>
    <?php include 'include/link.php'; ?>
    <style>
        #menu nav a {
            width: 16.66%;
            color: #000000;
        }

        #menu nav a:hover {
            opacity: 0.7;
            color: #000000;
            border: #000000 2px solid;
        }

        #menu nav .bg-inv {
            background-color: #B15BFF !important;
        }

        #menu nav .bg-awd {
            background-color: #00DB00 !important;
        }

        #menu nav .bg-idv {
            background-color: #46A3FF !important;
        }

        #menu nav .bg-list {
            background-color: #FFE153 !important;
        }

        #menu nav .bg-logout {
            background-color: #E0E0E0 !important;
        }

        #menu nav .bg {
            background-color: #ffa500;
        }

        #menu h1 {
            color: #D9006C;
            text-shadow: #FFD9EC 0px 0px 10px;
        }
    </style>
</head>

<body class="mb-0">
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
    <div id="menu" class="container">
        <h1 class="h1 text-center my-0 mt-3">歡迎您回來！<?= $user["name"]; ?> </h1>
        <nav class="navbar navbar-dark w-100 px-0 text-center">
            <a class="bg-inv nav-link active" href="?target=invoice">輸入發票</a>
            <a class="bg-list nav-link" href="?target=list">發票列表</a>
            <a class="bg-awd nav-link" href="?target=award">發票對獎</a>
            <a class="bg nav-link" href="?target=numbers">發票獎號</a>
            <a class="bg-idv nav-link" href="?target=idv">變更個人資訊</a>
            <a class="bg-logout nav-link" href="?target=logout">登出</a>
        </nav>
    </div>

    <?php
    $_SESSION["id"] =  $user["id"];
    $_SESSION["name"] = $user["name"];

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



</body>

</html>