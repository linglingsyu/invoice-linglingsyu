<?php include_once("common/base.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票中獎號碼</title>
    <?php include("include/link.php") ?>
    <style>
        .h4 {
            color: #5B00AE;
        }

        .form-control {
            display: inline-block;
            width: 50%;
        }

        label {
            width: 15%;
            color: #000000;
        }

        .form-group {
            padding-left: 5rem;
        }

        #numbers .btn-outline-primary,#numbers .sub{
            margin-left: 50%;
            transform: translate(-50%);
        }

        form input[type="submit"]:hover,
        #numbers .btn-outline-primary:hover {
            background-color: #5B00AE !important;
        }

        #numbers.container {
            padding-left: 0;
            padding-right: 0;
            border-radius: 15px;
            background-color: #00b4cc7a;
        }

    </style>
</head>

<body>
    <div id="numbers" class="container w-50">
        <form action="main.php?target=numbers" method="post" class="w-75 mx-auto">
            <h4 class="h4 text-center pt-3">新增獎號資料</h4>
            <small class="d-block mb-3 text-muted text-center">可參考財政部<a href="https://www.etax.nat.gov.tw/etw-main/web/ETW183W1/" target="_black">統一發票中獎號碼單</a></small>
            <div class="form-group">
                <label for="year">年 月 份</label>
                <select name="year" id="year" class="form-control form-control-sm ml-3 w-25">
                    <?php
                    $this_year = date("Y") - 1911;
                    $year = isset($_POST["year"]) ? $_POST["year"] : $this_year;
                    $ly = $this_year - 1;
                    echo "<option value='$this_year'" . ($year == $this_year ? " selected" : "") . ">$this_year</option>";
                    echo "<option value='$ly'" . ($year == $ly ? " selected" : "") . ">$ly</option>";
                    $arr = [0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6];
                    $period = isset($_POST["period"]) ? $_POST["period"] : $arr[date("n")];
                    ?>
                </select>
                <select name="period" id="period" class="form-control form-control-sm  w-25">
                    <option value='1' <?= $period == 1 ? " selected" : "" ?>>01-02月</option>
                    <option value='2' <?= $period == 2 ? " selected" : "" ?>>03-04月</option>
                    <option value='3' <?= $period == 3 ? " selected" : "" ?>>05-06月</option>
                    <option value='4' <?= $period == 4 ? " selected" : "" ?>>07-08月</option>
                    <option value='5' <?= $period == 5 ? " selected" : "" ?>>09-10月</option>
                    <option value='6' <?= $period == 6 ? " selected" : "" ?>>11-12月</option>
                </select>
            </div>
            <div class="form-group">
                <label for="special">特 別 獎</label>
                <input type="text" name="special" id="special" class="ml-3 form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="top">特　　獎</label>
                <input type="text" name="top" id="top" class="ml-3 form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="first_prize1">頭　　獎</label>
                <input type="text" name="first_prize1" id="first_prize1" class="ml-3 form-control form-control-sm w-25">
                <input type="text" name="first_prize2" id="first_prize2" class="form-control form-control-sm w-25">
                <input type="text" name="first_prize3" id="first_prize3" class="form-control form-control-sm w-25">
            </div>
            <div class="form-group">
                <label for="addprize">增開六獎</label>
                <input type="text" name="addprize" id="addprize" class="form-control form-control-sm ml-3">
            </div>
            <div class="form-group sub pl-0 ">
                <input type="reset" value="重填" class="btn btn-info w-25 ml-5">
                <input type="submit" value="送出" class="btn btn-info w-25 ml-3 ">
            </div>
        </form>
        <a href="main.php?target=numbersList" class="btn btn-outline-primary mb-3">查詢及編輯中獎號碼列表</a>
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

        foreach ($_POST as $value){
          if (empty($value)) {
            echo "<span class='d-block w-100 text-center text-danger'>欄位不得為空</span>";
              exit();
          }
        }

        $check = ["year" => $_POST["year"], "period" => $_POST["period"]];
        $res = find('numbers', $check);
        if ($res != null) {
            echo "<span class='d-block w-100 text-center text-danger'>資料庫已有資料，請至對獎頁面進行對獎</span>";
            exit();
        }
        $res = save("numbers", $data);
        if ($res >= 1) {
            echo "<span class='d-block w-100 text-center text-success'>新增成功</span>";
        } else {
            echo "<span class='d-block w-100 text-center text-danger'>新增失敗</span>";
        }
    }
    ?>
        </div>
    </div>

</body>

</html>