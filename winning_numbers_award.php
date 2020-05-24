<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>中獎號碼列表</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
        }

        .title {
            margin-right: 50px;
            text-align: center;
        }

        .num_item {
            text-align: left;
        }

        .edit {
            margin: 0 50px;
        }

        .bonus {
            margin-left: 50px;
        }

        div {
            margin: 10px 0;
        }
    </style>
</head>

<body>
<?php include("common/base.php");?>
    <a href="index.php">回首頁</a>
    <a href="winning_numbers.php">輸入中獎號碼</a>
    <a href="winning_numbers_list.php" target="_blank">查詢中獎號碼</a>
    <?php  
    if(!isset($_POST["numlast3"])){
    ?>
    <form action="?" method="post">
        <h1>對獎</h1>
        <div class="year">請輸入對獎年月份
            <select name="year">
                <?php
                $year = date("Y") - 1911;
                $ny = $year + 1;
                echo "<option value='$year' selected>" . $year . "</option>";
                echo "<option value='$ny'>" . $ny . "</option>";
                ?>
            </select>
            <select name="period">
                <option value='1'>01-02月</option>
                <option value='2'>03-04月</option>
                <option value='3'>05-06月</option>
                <option value='4'>07-08月</option>
                <option value='5'>09-10月</option>
                <option value='6'>11-12月</option>
            </select>
            <label for="numlast3">請輸入發票末三碼
            <input type="text" name="numlast3"></label>
            <input type="submit" value="對獎">
        </div>
    </form>
    <?php  } ?>
    <?php
    if(isset($_POST["year"]) && isset($_POST["period"])){
    $data = [ "year"=> $_POST["year"] , "period" => $_POST["period"] ];
    $row = find("winning numbers",$data);
    if($row == null){
        echo "沒有統一發票號碼資料，請先至輸入頁面建立資料";
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
            echo "請輸入發票後三碼";
            exit();
        }
        $lastthree = [substr($first_prize1, 5, 3), substr($first_prize2, 5, 3), substr($first_prize3, 5, 3), $addprize, substr($special, 5, 3), substr($top, 5, 3)];
        $numlast3 = $_POST["numlast3"];
        if (in_array($numlast3, $lastthree)) {
            echo '<form action="?" method="post">';
            echo '<hr>';
            echo '<label><input type="hidden" name="year" value="' . $_POST["year"] . '"  readonly></label>';
            echo '<label><input type="hidden" name="period" value="' . $_POST["period"] . '" readonly></label>';
            echo '<label>請繼續輸入發票前五碼，不須理會上面表單：<input type="text" name="number5"></label>';
            echo '<label><input type="hidden" name="number3" value="' . $numlast3 . '" readonly></label>';
            echo '<input type="submit" value="送出">';
            echo '</form>';
            exit();
        }
        echo "發票後三碼" . $numlast3 . "沒有中獎";
    } else {
        $number5 = $_POST["number5"];
        $number3 = $_POST["number3"];
        $number = $number5 . $number3;
        $second = [substr($first_prize1, 1, 7), substr($first_prize2, 1, 7), substr($first_prize3, 1, 7)];
        $third = [substr($first_prize1, 2, 6), substr($first_prize2, 2, 6), substr($first_prize3, 2, 6)];
        $fourth = [substr($first_prize1, 3, 5), substr($first_prize2, 3, 5), substr($first_prize3, 3, 5)];
        $fifth = [substr($first_prize1, 4, 4), substr($first_prize2, 4, 4), substr($first_prize3, 4, 4)];
        $sixth = [substr($first_prize1, 5, 3), substr($first_prize2, 5, 3), substr($first_prize3, 5, 3), $addprize];
        if ($number == $special) {
            echo "發票號碼" . $number . "中了特別獎，獎金1000萬元";
            exit();
        } elseif ($number == $top) {
            echo "發票號碼" . $number . "中了特獎，獎金200萬元";
            exit();
        } elseif ($number == $first_prize1 || $number == $first_prize2 || $number == $first_prize3) {
            echo "發票號碼" . $number . "中了頭獎，獎金20萬元";
            exit();
        } elseif (in_array(substr($number, 1, 7), $second)) {
            echo "發票號碼" . $number . "中了二獎，獎金4萬元";
            exit();
        } elseif (in_array(substr($number, 2, 6), $third)) {
            echo "發票號碼" . $number . "中了三獎，獎金1萬元";
            exit();
        } elseif (in_array(substr($number, 3, 5), $fourth)) {
            echo "發票號碼" . $number . "中了四獎，獎金4千元";
            exit();
        } elseif (in_array(substr($number, 4, 4), $fifth)) {
            echo "發票號碼" . $number . "中了五獎，獎金1千元";
            exit();
        } elseif (in_array($number3, $sixth)) {
            echo "發票號碼" . $number . "中了六獎，獎金2百元";
        } else {
            echo "您沒有中獎";
        }
    }
    ?>


</body>

</html>