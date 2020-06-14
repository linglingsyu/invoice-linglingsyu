<?php include_once "common/base.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯中獎號碼</title>
    <?php include("include/link.php") ?>
    <style>
        html,
        body {
            height: 100%;
        }

        .h3 {
            color: #5B00AE;
        }
        label {
            color: #000000;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <?php
    $id = $_SESSION["id"];
    $row = find("winning numbers", $id);
    $year = $row["year"];
    $period = $row["period"];
    $special = $row['special'];
    $top = $row['top'];
    $first_prize1 = $row['first_prize1'];
    $first_prize2 = $row['first_prize2'];
    $first_prize3 = $row['first_prize3'];
    $addprize = $row['addprize'];
    $arr = ["", "01-02月", "03-04月", "05-06月", "07-08月", "09-10月", "11-12月"];
    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <form action="winning_numbers_update.php" method="post" class="w-25">
                <nav class="nav mb-3">
                    <a class="nav-link pl-0 active" href="index.php">回首頁</a>
                    <a class="nav-link" href="winning_numbers_list.php">中獎號碼清單</a>
                </nav>
                <h3 class="h3">編輯中獎號碼</h3>
                <p class="text-secondary"><?= $year ?>年<?= $arr[$period] ?></p>
                <input type="hidden" name="id" value="<?= $row['id'] ?>" >
                <div class="form-group">
                    <label for="special" class="w-100">特別獎</label>
                    <input type="text" name="special" id="special" class="form-control form-control-sm" value="<?= $special ?>">
                </div>
                <div class="form-group">
                    <label for="top" class="w-100">特獎</label>
                    <input type="text" name="top" id="top" class="form-control form-control-sm" value="<?= $top ?>">
                </div>
                <div class="form-group">
                    <label for="first_prize1" class="mb-0 w-100">頭獎</label>
                    <input type="text" name="first_prize1" id="first_prize1" class="form-control form-control-sm mb-2" value="<?= $first_prize1 ?>">
                    <input type="text" name="first_prize2" id="first_prize2" class="form-control form-control-sm mb-2" value="<?= $first_prize2 ?>">
                    <input type="text" name="first_prize3" id="first_prize3" class="form-control form-control-sm" value="<?= $first_prize3 ?>">
                </div>
                <div class="form-group">
                    <label for="addprize" class="w-100">增開六獎</label>
                    <input type="text" name="addprize" id="addprize" class="form-control form-control-sm" value="<?= $addprize ?>">
                </div>
                <div class="form-group">
                    <a href="winning_numbers.php" class="btn btn-info">新增中獎號碼</a>
                    <input type="submit" class="btn btn-info" value="更新">
                </div>
        </div>
        </form>
    </div>
    </div>



</body>

</html>