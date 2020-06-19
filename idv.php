<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 首頁</title>
    <?php include 'include/link.php'; ?>
    <style>
        .h4 {
            color: #5B00AE !important;
        }

        #idv.container {
            border-radius: 15px;
            background-color: #00b4cc7a;
            width:30%
        }

        label {
            color: #000000;
        }
    </style>

</head>

<body>

    <?php

    $userid = $_SESSION['id'];

    $row = find("user", $userid);

    ?>

    <div id="idv" class="container pb-4">
        <form action="edit_idv.php" method="post">
            <h4 class="h4 text-center py-3"><?= "這是" . $_SESSION['name'] . "的個人資訊"; ?></h4>
            <div class="form-group">
                <label for="pw">密碼</label>
                <input type="password" name="pw" class="form-control">
            </div>
            <div class="form-group ">
                <label for="chkpw">請再次輸入密碼</label>
                <input type="password" name="chkpw" class="form-control ">
            </div>
            <div class="form-group">
                <label for="name">暱稱</label>
                <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>">
            </div>
            <div class="form-group">
                <label for="birthday">生日</label>
                <input type="date" name="birthday" class="form-control" value="<?= $row['birthday'] ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary w-25 float-right" value="確認修改">
            </div>
            <div class="clearfix"></div>
        </form>

        <div class="text-center text-danger font-weight-bolder">
            <?php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 1) {
                    echo "資料不得為空";
                }
                if ($_GET['status'] == 2) {
                    echo "確認密碼錯誤，請重新輸入";
                }
                if ($_GET['status'] == 3) {
                    echo "更新成功";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>