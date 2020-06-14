<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 發票清單</title>
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

        .table-responsive {
            border-radius: 15px;
            padding-left: 0;
            padding-right: 0;
        }

        #list table td{
            width: 50%;
        }

        #list td:first-child {
            font-weight: bolder;
            color: red;
            padding-left: 3rem;
        }

        #list td:last-child{
            text-align: center;
            padding-right: 2rem;
        }



        #list tr:nth-child(2) td:first-child {
            border-top-left-radius: 10px;
        }

        #list tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        #list tr:nth-child(2) td:last-child {
            border-top-right-radius: 10px;
        }

        #list tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        form input[type="submit"]:hover {
            background-color: #00ffff !important;
        }



    </style>
</head>

<body>
    <div class="container">
        <div class="row flex-column justify-content-start align-items-center">
            <form action="?" method="get">
                <h4 class="h4 my-3 text-center">獎號列表</h4>
                <h6 class="h6 text-dark">請選擇獎號年月份</h6>
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
                    <input type="hidden" name="target" value="numbersList">
                    <input type="submit" value="查詢" class="form-control form-control-sm ml-4 w-25">
                </div>
            </form>
            <?php
            if (isset($_GET["year"]) && isset($_GET["period"])) {
            ?>
                <div id="list" class="table-responsive w-25">
                    <table class="table table-sm  table-borderless">
                        <?php
                        $arr = ["", "01-02月", "03-04月", "05-06月", "07-08月", "09-10月", "11-12月"];
                        $rows = all("numbers", ["year" => $_GET['year'], "period" => $_GET['period']]);
                        if (count($rows) == 0) {
                            echo "<p class='text-center text-danger'>尚無獎號資料</p>";
                            exit();
                        }
                        ?>
                        <tr>
                            <td>年度</td>
                            <td><?= $rows[0]["year"] ?></td>
                        </tr>
                        <tr>
                            <td>月份</td>
                            <td><?= $arr[$rows[0]["period"]] ?></td>
                        </tr>
                        <tr>
                            <td>特別獎</td>
                            <td><?= $rows[0]["special"] ?></td>
                        </tr>
                        <tr>
                            <td>特獎</td>
                            <td><?= $rows[0]["top"] ?></td>
                        </tr>
                        <tr>
                            <td>頭獎</td>
                            <td><?= $rows[0]["first_prize1"]."<br>".$rows[0]["first_prize2"]."<br>".$rows[0]["first_prize3"] ?></td>
                        </tr>
                        <tr>
                            <td>增開六獎</td>
                            <td><?= $rows[0]["addprize"] ?></td>
                        </tr>
                        <tr>
                            <td>操作</td>
                            <td><a href="main.php?target=del_nums&id=<?= $rows[0]['id'] ?>">刪除</a> <a href="main.php?target=update_numbers&id=<?= $rows[0]['id'] ?>" >編輯</a> </td>
                        </tr>         
                    </table>
                <?php
            }
                ?>
                </div>
        </div>
    </div>
</body>

</html>