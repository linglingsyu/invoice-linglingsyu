<?php  include_once "common/base.php";  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 首頁</title>
    <?php include 'include/link.php'; ?>
    <style>
        #invoice.container {
            padding-left: 0;
            padding-right: 0;
            border-radius: 15px;
            background-color: #00b4cc7a;
        }

        .h4 {
        color: #5B00AE !important;
    }
        label {
            display: inline !important;
            color: #000000;
            padding-left: 4rem !important;
            padding-right: 4rem !important;
        }

        small {
            color: red;
        }

        .form-control {
            display: inline-block !important;
            width: 60% !important;
            float: right;
        }
    </style>
</head>

<body>
    <div id="invoice" class="container w-50 ">
        <?php
        if (isset($_GET["status"]) && $_GET["status"] == 1) {
            echo "<div class='text-light bg-primary  mb-1 mt-0'>新增成功，請繼續輸入下一筆資料</div>";
        }
        ?>
        <form action="save_invoice.php" method="POST">
            <h4 class="h4 text-center py-3"><?= "請輸入您的發票資訊，" . $_SESSION['name']; ?></h4>
            <div class="form-group mb-4 mr-3">
                <label for="year">民國年<small> *(必填)</small></label>
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
                <label for="period">期別<small> *(必填)</small></label>
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
                <label for="inv_date">發票日期</label>
                <input type="date" name="inv_date" id="inv_date" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label for="code">字軌</label>
                <input type="text" name="code" id="code" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label for="num">發票號碼<small> *(必填)</small></label>
                <input type="text" name="num" id="num" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-4 mr-3">
                <label for="spend">金額</label>
                <input type="text" name="spend" class="form-control form-control-sm" id="spend">
            </div>
            <div class="form-group mb-4 mr-3">
                <label for="note">備註</label>
                <textarea name="note" class="form-control form-control-sm" id="note" cols="30" rows="3"></textarea>
            </div>
            <div class="clearfix"></div>
            <div class="cen d-flex justify-content-center align-items-center my-4">
                <input type="reset" class="btn btn-primary w-25 mb-4" value="reset">
                <input type="submit" class="btn btn-primary w-25 mb-4 ml-2" value="save">
            </div>
        </form>
    </div>
</body>

</html>