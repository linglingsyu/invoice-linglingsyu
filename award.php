<?php include_once("common/base.php");  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 對獎頁面</title>
    <?php include 'include/link.php'; ?>
    <style>
        html {
            height: 100%;
        }

        .form-control {
            width: auto;
        }

        h4 {
            color: #5B00AE;
        }

        #list {
            background-color: #003377;
            border-radius: 15px;
            height: 500px;
            color:#ffffff;
        }

        #list h6{
            color:#ffff00;
        }

        #list p{
            margin-bottom: 0;
        }
        #list .numcolor{
            color:lightsalmon;
        }


        #list .bonus{
            color:#00ffff;
        }

        #list .spcbonus{
            color:#ff00ff;
        }

        #list .topbonus{
            color:#adff2f;
        }

        form input[type="submit"]:hover{
            background-color: #00ffff !important;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row flex-column justify-content-start align-items-center">
            <form action="?target=award" method="post">
                <h4 class="h4 my-1">請選擇要對獎的發票年月份</h4>
                <div class="form-group d-flex">
                    <select name="year" id="year" class="form-control form-control-sm mr-3">
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
                    <select name="period" id="period" class="form-control form-control-sm mr-3">
                        <option value='1' <?= $period == 1 ? " selected" : "" ?>>01-02月</option>
                        <option value='2' <?= $period == 2 ? " selected" : "" ?>>03-04月</option>
                        <option value='3' <?= $period == 3 ? " selected" : "" ?>>05-06月</option>
                        <option value='4' <?= $period == 4 ? " selected" : "" ?>>07-08月</option>
                        <option value='5' <?= $period == 5 ? " selected" : "" ?>>09-10月</option>
                        <option value='6' <?= $period == 6 ? " selected" : "" ?>>11-12月</option>
                    </select>
                    <input type="submit" value="對獎" class="form-control form-control-sm ml-4 w-25">
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div id="list" class="w-50 mx-auto">
            <h6 class="text-center pt-2 h6 mb-0">中獎號碼將會顯示於下方</h6>
            <hr class="border-light">
            <?php

            if (isset($_POST["year"]) && isset($_POST["period"])) {
                $user_id = $_SESSION["id"];
                $data = [
                    "user_id" => $user_id,
                    "period" => $_POST["period"],
                    "year" => $_POST["year"]
                ];
                $inv_rows = all("invoice", $data);
                $data2 = [
                    "period" => $_POST["period"],
                    "year" => $_POST["year"]
                ];
                $win_rows = all("numbers", $data2);
                if ($win_rows != null) {
                    $list = check_winnums($win_rows, $inv_rows);
                    if (count($list) == 0) {
                        echo "<p class='text-center'>您沒有任何發票中獎</p>";
                    } else {
                        foreach ($list as $value) {
                            echo "<p class='w-75 pl-5 mx-auto'>".$value."</p>";
                        }
                    }
                } else {
                    echo "<p class='text-center'>請先新增中獎號碼資料</p>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>