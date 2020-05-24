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
    <form action="?" method="post">
        <div class="year">
            請選擇查詢年月份
            <select name="year" id="year">
                <?php
                include("common/base.php");
                $year = date("Y") - 1911;
                $ny = $year + 1;
                echo "<option value='$year' selected>" . $year . "</option>";
                echo "<option value='$ny'>" . $ny . "</option>";
                ?>
            </select>
            <select name="period" id="period">
                <option value='1'>01-02月</option>
                <option value='2'>03-04月</option>
                <option value='3'>05-06月</option>
                <option value='4'>07-08月</option>
                <option value='5'>09-10月</option>
                <option value='6'>11-12月</option>
            </select>
            <input type="submit" value="送出">
            <h1>中獎號碼列表</h1>
            <a href="index.php">回首頁</a>
            <a href="winning_numbers.php">輸入中獎號碼</a>
            <a href="winning_numbers_award.php">對獎</a>
        </div>
    </form>
    <?php
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        switch ($status) {
            case 1:
                echo "更新成功";
                break;
            case 0:
                echo "更新失敗";
                break;
            case 2:
                echo "您還沒有更動數字唷！";
                break;
        }
    }

    if (isset($_POST["year"]) && isset($_POST["period"])) {
        $year = $_POST["year"];
        $period = $_POST["period"];
        $sql = "select * from `winning numbers` where `year`='$year' && `period`='$period'";
        $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        if ($row == null) {
            echo "尚未建立資料";
            exit();
        }
    }
    ?>
    <div class="container">
        <div class="title">
            <div class="item title_item">特別獎</div>
            <div class="item title_item">特獎</div>
            <div class="item title_item">頭獎</div>
            <div class="item title_item">二獎</div>
            <div class="item title_item">三獎</div>
            <div class="item title_item">四獎</div>
            <div class="item title_item">五獎</div>
            <div class="item title_item">六獎</div>
            <div class="item title_item">增開六獎</div>
        </div>
        <?php
        $_SESSION["id"] = $row["id"];
        $special = $row["special"];
        $top = $row["top"];
        $first_prize1 = $row["first_prize1"];
        $first_prize2 = $row["first_prize2"];
        $first_prize3 = $row["first_prize3"];
        $addprize = $row["addprize"];
        ?>
        <div class="number">
            <div class="item num_item"><?= $special ?></div>
            <div class="item num_item"><?= $top ?></div>
            <div class="item num_item"><?= $first_prize1 . " , " .  $first_prize2 . " , " . $first_prize3 ?> </div>
            <div class="item num_item">與頭獎中獎號碼末7 位相同</div>
            <div class="item num_item">與頭獎中獎號碼末6 位相同</div>
            <div class="item num_item">與頭獎中獎號碼末5 位相同</div>
            <div class="item num_item">與頭獎中獎號碼末4 位相同</div>
            <div class="item num_item">與頭獎中獎號碼末3 位相同</div>
            <div class="item num_item"><?= $addprize ?></div>
        </div>
        <div class="bonus">
            <div class="item bonus_item">獎金1000萬元</div>
            <div class="item bonus_item">獎金200萬元</div>
            <div class="item bonus_item">獎金20萬元</div>
            <div class="item bonus_item">獎金4萬元</div>
            <div class="item bonus_item">獎金1萬元</div>
            <div class="item bonus_item">獎金4千元</div>
            <div class="item bonus_item">獎金1千元</div>
            <div class="item bonus_item">獎金2百元</div>
            <div class="item bonus_item">獎金2百元</div>
        </div>
        <div class="edit">
            <div class="item"><a href="winning_numbers_edit.php"> 編輯</a></div>
        </div>
    </div>


</body>

</html>