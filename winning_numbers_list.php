<?php include_once("common/base.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>中獎號碼列表</title>
    <?php include "include/link.php" ?>
    <style>
        .btn:hover {
            opacity: 1.5;
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
        .table-responsive {
            background-color: #003377;
            border-radius: 15px;
            padding-left: 0;
            padding-right: 0;
        }

        #list table th{
            text-align: center;
        }
        #list table td{
            padding-left: 2rem;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center align-items-center flex-column">
            <form action="?" method="post">
                <nav class="nav mb-3">
                    <a class="nav-link active" href="index.php">回首頁</a>
                    <a class="nav-link" href="winning_numbers.php">輸入中獎號碼</a>
                    <a class="nav-link" href="winning_numbers_award.php">對獎</a>
                </nav>
                <h3 class="h3 my-3 text-center">中獎號碼列表</h3>
                <div class="form-group">
                    <label for="year" class="my-0">請選擇查詢年月份</label>
                    <select name="year" id="year" class="form-control my-2 ">
                        <?php
                        $year = date("Y") - 1911;
                        $ny = $year + 1;
                        echo "<option value='$year' selected>" . $year . "</option>";
                        echo "<option value='$ny'>" . $ny . "</option>";
                        ?>
                    </select>
                    <select name="period" id="period" class="form-control my-2 ">
                        <option value='1'>01-02月</option>
                        <option value='2'>03-04月</option>
                        <option value='3'>05-06月</option>
                        <option value='4'>07-08月</option>
                        <option value='5'>09-10月</option>
                        <option value='6'>11-12月</option>
                    </select>
                    <input type="submit" class="form-control btn btn-info" value="查詢">
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
            ?>
                <?php
                $_SESSION["id"] = $row["id"];
                $special = $row["special"];
                $top = $row["top"];
                $first_prize1 = $row["first_prize1"];
                $first_prize2 = $row["first_prize2"];
                $first_prize3 = $row["first_prize3"];
                $addprize = $row["addprize"];
                ?>
                <div id="list" class="table-responsive w-50 mx-auto">
                    <table class="table text-light table-borderless table-sm ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">號碼</th>
                                <th scope="col">獎金</th>
                                <th scope="col" rowspan="8">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">特別獎</th>
                                <td><?= $special ?></td>
                                <td>1000萬元</td>
                            </tr>
                            <tr>
                                <th scope="row">特獎</th>
                                <td><?= $top ?></td>
                                <td>200萬元</td>
                            </tr>
                            <tr>
                                <th scope="row">頭獎</th>
                                <td><?= $first_prize1 . " , " .  $first_prize2 . " , " . $first_prize3 ?></td>
                                <td>20萬元</td>
                            </tr>
                            <tr>
                                <th scope="row">二獎</th>
                                <td>與頭獎中獎號碼末7 位相同</td>
                                <td>4萬元</td>
                            </tr>
                            <tr>
                                <th scope="row">三獎</th>
                                <td>與頭獎中獎號碼末6 位相同</td>
                                <td>1萬元</td>
                                <td class="border-top-0"><a href="winning_numbers_edit.php">更新</a></td>
                            </tr>
                            <tr>
                                <th scope="row">四獎</th>
                                <td>與頭獎中獎號碼末5 位相同</td>
                                <td>4千元</td>
                            </tr>
                            <tr>
                                <th scope="row">五獎</th>
                                <td>與頭獎中獎號碼末4 位相同</td>
                                <td>1千元</td>
                            </tr>
                            <tr>
                                <th scope="row">六獎</th>
                                <td>與頭獎中獎號碼末3 位相同</td>
                                <td>2百元</td>
                            </tr>
                            <tr>
                                <th scope="row">增開六獎</th>
                                <td><?= $addprize ?></td>
                                <td>2百元</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php   } ?>
        </div>
    </div>
</body>

</html>