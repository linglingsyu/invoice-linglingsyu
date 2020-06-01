<?php include_once("common/base.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票中獎號碼</title>
    <?php include("include/link.php") ?>
    <style>
        select {
            text-align-last: center;
        }

        .form-control {
            display: inline-block;
            width: 25%;
        }

        a:hover {
            color: lightskyblue;
        }

        .nav a {
            color: #F3D5AD;
        }

        .nav a:hover {
            color: #F5B895;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <form action="?" method="post">
                <div class="pl-5 ml-5">
                    <nav class="nav mb-3">
                        <a class="nav-link active" href="index.php">回首頁</a>
                        <a class="nav-link" href="winning_numbers_list.php">查詢中獎號碼</a>
                        <a class="nav-link" href="winning_numbers_award.php">快速對獎</a>
                    </nav>
                    <h1 class="h3">請輸入統一發票中獎號碼</h1>
                    <p>可參考<a href="https://www.etax.nat.gov.tw/etw-main/web/ETW183W1/" target="_blank">財政部統一發票中獎號碼</a></p>

                    <div class="form-group">
                        <label for="year">年月份</label>
                        <select name="year" id="year" class="form-control form-control-sm w-25">
                            <?php
                            include_once("common/base.php");
                            $year = date("Y") - 1911;
                            $ny = $year - 1;
                            echo "<option value='$ny'>" . $ny . "</option>";
                            echo "<option value='$year' selected>" . $year . "</option>";
                            ?>
                        </select>
                        <select name="period" id="period" class="form-control form-control-sm w-25">
                            <option value='1'>01-02月</option>
                            <option value='2'>03-04月</option>
                            <option value='3'>05-06月</option>
                            <option value='4'>07-08月</option>
                            <option value='5'>09-10月</option>
                            <option value='6'>11-12月</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="special">特別獎</label>
                        <input type="text" name="special" id="special" class="form-control form-control-sm">
                        <small class="text-white-50 d-block">同期統一發票收執聯8位數號碼與特別獎號碼相同者金1,000萬元</small>
                    </div>
                    <div class="form-group">
                        <label for="top">特　獎</label>
                        <input type="text" name="top" id="top" class="form-control form-control-sm">
                        <small class="text-white-50 d-block">同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元</small>
                    </div>
                    <div class="form-group">
                        <label for="first_prize1">頭　獎</label>
                        <input type="text" name="first_prize1" id="first_prize1" class="form-control form-control-sm">
                        <input type="text" name="first_prize2" id="first_prize2" class="form-control form-control-sm">
                        <input type="text" name="first_prize3" id="first_prize3" class="form-control form-control-sm">
                        <small class="text-white-50 d-block">同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元</small>
                    </div>
                    <p class="mb-0">二　獎<small class="text-white-50 px-3">同期統一發票收執聯末7位數號碼與頭獎中獎號碼末7 位相同者各得獎金4萬元</small></p>
                    <p class="mb-0">三　獎<small class="text-white-50 px-3">同期統一發票收執聯末6 位數號碼與頭獎中獎號碼末6 位相同者各得獎金1萬元</small></p>
                    <p class="mb-0">四　獎<small class="text-white-50 px-3">同期統一發票收執聯末5 位數號碼與頭獎中獎號碼末5 位相同者各得獎金4千元</small></p>
                    <p class="mb-0">五　獎<small class="text-white-50 px-3">同期統一發票收執聯末4 位數號碼與頭獎中獎號碼末4 位相同者各得獎金1千元</small></p>
                    <p>六　獎<small class="text-white-50 px-3">同期統一發票收執聯末3 位數號碼與 頭獎中獎號碼末3 位相同者各得獎金2百元</small></p>
                    <div class="form-group">
                        <label for="addprize">增開六獎</label>
                        <input type="text" name="addprize" id="addprize" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <input type="reset" value="重填" class="btn btn-info w-25 ml-4">
                        <input type="submit" value="送出" class="btn btn-info w-25 mx-3">
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST["special"]) && isset($_POST["top"]) && isset($_POST["first_prize1"]) && isset($_POST["first_prize2"]) && isset($_POST["first_prize3"]) && isset($_POST["addprize"])) {

                $data = [
                    "year" => $_POST["year"],
                    "period" => $_POST["period"],
                    "special" => $_POST["special"],
                    "top" => $_POST["top"],
                    "first_prize1" => $_POST["first_prize1"],
                    "first_prize2" => $_POST["first_prize2"],
                    "first_prize3" => $_POST["first_prize3"],
                    "addprize" => $_POST["addprize"]
                ];

                if (empty($data["year"]) || empty($data["period"]) || empty($data["special"]) || empty($data["top"]) || empty($data["first_prize1"]) || empty($data["first_prize2"]) || empty($data["first_prize3"]) || empty($data["addprize"])) {
                    echo "資料不得為空";
                    exit();
                }
                $check = ["year" => $data["year"], "period" => $data["special"]];
                $res = find('winning numbers', $check);
                if ($res != null) {
                    echo "<span style='color:red;'>資料庫已有資料，請至對獎頁面進行對獎</span>";
                    exit();
                }
                $res = save("winning numbers", $data);
                if ($res >= 1) {
                    echo "<span class='text-success'>新增成功</span>";
                } else {
                    echo "<span class='text-danger'>新增失敗</span>";
                }
            }
            ?>
        </div>
    </div>

</body>

</html>