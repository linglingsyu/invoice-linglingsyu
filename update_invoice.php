<?php include_once("common/base.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票對獎系統 - 更新發票資料</title>
    <?php include 'include/link.php'; ?>
    <style>
           #invoice.container{
            padding-left: 0;
            padding-right:0;
            border-radius: 15px;
            background-color: #00b4cc7a;
        }

        #invoice input[type="submit"]{
            margin-left: 50%;
            transform: translate(-50%);
        }

        .h4{
            color: #5B00AE;
        }

        label{
            display: inline !important;
            color:#000000;
            padding-left:4rem !important;
            padding-right:4rem !important;
        }
        small{
            color:red;
        }

        .form-control{
            display: inline-block !important;
            width:60% !important;
            float:right;

        }

    </style>
</head>

<body>
    <?php
    if (isset($_GET["id"])) {
        $res = find("invoice", $_GET["id"]);
    }
    ?>
    <div id="invoice" class="container w-50 ">
        <form action="?" method="POST">
            <h4 class="h4 text-center py-3"><?= "請更新您的發票資訊，" . $_SESSION['name']; ?></h4>
            <div class="form-group mb-4 mr-3">
                <label for="year">民國年<small>  *(必填)</small></label>
                <select name="year" id="year" class="form-control form-control-sm">
                    <?php
                    $year = date("Y") - 1911;
                    $ny = $year - 1;
                    echo "<option value='$ny'>" . $ny . "</option>";
                    echo "<option value='$year' selected>" . $year . "</option>";
                    ?>
                </select>
            </div>
            <div class="form-group mb-4 mr-3">
                <label for="period">期別<small>  *(必填)</small></label>
                <select name="period" id="period" class="form-control form-control-sm">
                    <option value="1">01-02月</option>
                    <option value="2">03-04月</option>
                    <option value="3">05-06月</option>
                    <option value="4">07-08月</option>
                    <option value="5">09-10月</option>
                    <option value="6">11-12月</option>
                </select>
            </div>
            <div class="form-group mb-4 mr-3">
                <input type="hidden" name="id" id="id" value="<?= $res['id'] ?>" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label  for="inv_date">發票日期</label>
                <input type="date" name="inv_date" id="inv_date" value="<?= $res['inv_date'] ?>" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label  for="code">字軌</label>
                <input type="text" name="code" id="code" value="<?= $res['code'] ?>" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label  for="num">發票號碼<small>  *(必填)</small></label>
                <input type="text" name="num" id="num" value="<?= $res['num'] ?>" require class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label  for="spend">金額</label>
                <input type="text" name="spend" id="spend" value="<?= $res['spend'] ?>" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label  for="note">備註</label>
                <textarea name="note" id="note" cols="30" rows="3" class="form-control form-control-sm"><?= $res['note'] ?></textarea>
            </div>
            <div class="clearfix"></div>
            <input type="submit" class="btn btn-primary w-25 my-4" value="update">
        </form>
    </div>
    <?php
    if (isset($_POST['id'])) {
        $data = [
            "id" => $_POST['id'],
            "year" => $_POST['year'],
            "period" => $_POST['period'],
            "inv_date" => $_POST["inv_date"],
            "code" => $_POST["code"],
            "num" => $_POST["num"],
            "spend" => $_POST["spend"],
            "note" => $_POST["note"],
        ];
        $res = save("invoice", $data);
        to("list.php");
    }

    ?>

</body>

</html>