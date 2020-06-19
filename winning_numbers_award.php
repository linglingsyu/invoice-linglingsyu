<?php include("common/base.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>中獎號碼列表</title>
    <?php include "include/link.php" ?>
    <style>
        input::placeholder {
            font-size: 12px;
        }

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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <?php
            if (!isset($_POST["numlast3"])) {
            ?>
                <form action="?" method="post">
                    <nav class="nav mb-3">
                        <a class="nav-link active" href="index.php">回首頁</a>
                        <a class="nav-link" href="winning_numbers_list.php">查詢中獎號碼</a>
                        <a class="nav-link" href="winning_numbers.php">輸入中獎號碼</a>
                    </nav>
                    <h3 class="h3 my-3 text-center">對獎</h3>
                    <div class="form-group">
                        <label for="year" class="my-0">請選擇對獎年月份</label>
                        <select name="year" id="year" class="form-control my-2 ">
                            <?php
                            $year = date("Y") - 1911;
                            $ny = $year + 1;
                            echo "<option value='$year' selected>" . $year . "</option>";
                            echo "<option value='$ny'>" . $ny . "</option>";
                            ?>
                        </select>
                        <select name="period" class="form-control ">
                            <option value='1'>01-02月</option>
                            <option value='2'>03-04月</option>
                            <option value='3'>05-06月</option>
                            <option value='4'>07-08月</option>
                            <option value='5'>09-10月</option>
                            <option value='6'>11-12月</option>
                        </select>
                        <label for="numlast3" id="numlast3" class="mt-3 my-0">請輸入發票末三碼</label>
                        <input type="text" name="numlast3" id="numlast3" class="form-control  my-2" placeholder="輸入後三碼">
                        <input type="submit" class="form-control btn btn-success" value="對獎">
                    </div>
                    <div class="status text-danger">
                    <?php
                        if(isset($_GET['status'])){
                            if($_GET['status'] == 1){
                            echo "沒有統一發票號碼資料，請先至輸入頁面建立資料";
                            }

                        }

                    ?>
                    </div>
                </form>
        </div>
    <?php
            }

            if (isset($_GET["award"]) && $_GET["award"] == 0) {
                if (!empty($_GET["num"])) {
                    echo "<div class='text-center text-danger'>發票後三碼" . $_GET["num"] . "沒有中獎</div>";
                } else {
                    echo "<div class='text-center text-danger'>請輸入發票後三碼</div>";
                }
            }

    ?>
    <?php
    if (isset($_POST["year"]) && isset($_POST["period"])) {
        $data = ["year" => $_POST["year"], "period" => $_POST["period"]];
        $row = find("winning numbers", $data);
        if ($row == null) {
            to("?status=1");
            exit();
        }
        $special = $row["special"];
        $top = $row["top"];
        $first_prize1 = $row["first_prize1"];
        $first_prize2 = $row["first_prize2"];
        $first_prize3 = $row["first_prize3"];
        $addprize = $row["addprize"];
    }
    if (!isset($_POST["numlast3"]) && !isset($_POST["number5"])) {
        exit();
    } elseif (isset($_POST["numlast3"])) {
        if (empty($_POST["numlast3"])) {
            to("winning_numbers_award.php?award=0&num=$numlast3");
        }
        $lastthree = [substr($first_prize1, 5, 3), substr($first_prize2, 5, 3), substr($first_prize3, 5, 3), $addprize, substr($special, 5, 3), substr($top, 5, 3)];
        $numlast3 = $_POST["numlast3"];
        if (in_array($numlast3, $lastthree)) {
            echo '<form action="?" method="post">';
            echo '<label><input type="hidden" name="year" value="' . $_POST["year"] . '"  readonly></label>';
            echo '<label><input type="hidden" name="period" value="' . $_POST["period"] . '" readonly></label>';
            echo '<div class="w-75 mx-auto">';
            echo '<p class="text-dark">您很有可能中大獎！請繼續輸入發票前五碼</p>';
            echo '<input type="text" name="number5" id="number5" class=" d-inline-block form-control w-50 mb-3 ml-2">';
            echo '<input type="text" name="number3" class="d-inline-block form-control w-25 ml-2 mb-3" value="' . $numlast3 . '" readonly>';
            echo '<input type="submit" class="form-contorl btn btn-primary ml-2 w-75" value="送出">';
            echo '</div>';
            echo '</form>';
            exit();
        }
        to("winning_numbers_award.php?award=0&num=$numlast3");
    } else {
        $number5 = $_POST["number5"];
        $number3 = $_POST["number3"];
        $number = $number5 . $number3;
        $second = [substr($first_prize1, 1, 7), substr($first_prize2, 1, 7), substr($first_prize3, 1, 7)];
        $third = [substr($first_prize1, 2, 6), substr($first_prize2, 2, 6), substr($first_prize3, 2, 6)];
        $fourth = [substr($first_prize1, 3, 5), substr($first_prize2, 3, 5), substr($first_prize3, 3, 5)];
        $fifth = [substr($first_prize1, 4, 4), substr($first_prize2, 4, 4), substr($first_prize3, 4, 4)];
        $sixth = [substr($first_prize1, 5, 3), substr($first_prize2, 5, 3), substr($first_prize3, 5, 3), $addprize];
        echo "<div class='text-center text-dark'>";
        if ($number == $special) {
            echo "<img src='img/q20.gif' class='rounded'>";
            echo "發票號碼" . $number . "中了<span class='text-danger'>特別獎</發票號碼>，獎金<span class='text-danger'>10,000,000</span>元";
            exit();
        } elseif ($number == $top) {
            echo "<img src='img/q20.gif' class='rounded'>";
            echo "發票號碼" . $number . "中了<span class='text-danger'>特獎</span>，獎金<span class='text-danger'>2,000,000</span>元";
            exit();
        } elseif ($number == $first_prize1 || $number == $first_prize2 || $number == $first_prize3) {
            echo "發票號碼" . $number . "中了<span class='text-danger'>頭獎</span>，獎金<span class='text-danger'>200,000</span>元";
            exit();
        } elseif (in_array(substr($number, 1, 7), $second)) {
            echo "<img src='img/q20.gif' class='rounded'>";
            echo "發票號碼" . $number . "中了<span class='text-danger'>二獎</span>，獎金<span class='text-danger'>40,000</span>元";
            exit();
        } elseif (in_array(substr($number, 2, 6), $third)) {
            echo "<img src='img/q20.gif' class='rounded'>";
            echo "發票號碼" . $number . "中了<span class='text-danger'>三獎</span>，獎金<span class='text-danger'>10,000</span>元";
            exit();
        } elseif (in_array(substr($number, 3, 5), $fourth)) {
            echo "<img src='img/q20.gif' class='rounded'>";
            echo "發票號碼" . $number . "中了<span class='text-danger'>四獎</span>，獎金<span class='text-danger'>4000</span>元";
            exit();
        } elseif (in_array(substr($number, 4, 4), $fifth)) {
            echo "<img src='img/q20.gif' class='rounded'>";
            echo "發票號碼" . $number . "中了<span class='text-danger'>五獎</span>，獎金<span class='text-danger'>1000</span>元";
            exit();
        } elseif (in_array($number3, $sixth)) {
            echo "<img src='img/q20.gif' class='rounded'>";
            echo "發票號碼" . $number . "中了<span class='text-danger'>六獎</span>，獎金<span class='text-danger'>200</span>元";
        } else {
            echo "<span class='text-danger'>很可惜，發票號碼" . $number . "沒有中獎</span>";
        }
        echo "</div>";
    }
    ?>
    </div>
</body>

</html>