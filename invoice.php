<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 首頁</title>
    <style>
    </style>
</head>

<body class="d-flex justify-content-end align-items-center ">
    <?php
    include_once "common/base.php";
    include "include/link.php";
    ?>
    <div class="container w-25 ">
        <div class="row justify-content-center align-items-center">
            <?php
            if (isset($_GET["status"]) && $_GET["status"] == 1) {
                echo "<div>新增成功，請繼續輸入下一筆資料</div>";
            }
            ?>
            <form action="save_invoice.php" method="POST" class="w-75">
                <h2 class="h4"><?= "請輸入您的發票資訊，" . $_SESSION['name']; ?></h2>
                <div class="form-group">
                    <label for="year">*民國年</label>
                    <select name="year" id="year" class="form-control form-control-sm">
                        <?php
                        $year = date("Y") - 1911;
                        $ny = $year - 1;
                        echo "<option value='$ny'>" . $ny . "</option>";
                        echo "<option value='$year' selected>" . $year . "</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="period">*期別</label>
                    <select name="period" id="period" class="form-control form-control-sm">
                        <option value="1">01-02月</option>
                        <option value="2">03-04月</option>
                        <option value="3">05-06月</option>
                        <option value="4">07-08月</option>
                        <option value="5">09-10月</option>
                        <option value="6">11-12月</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inv_date">發票日期</label>
                    <input type="date" name="inv_date" id="inv_date" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="code">字軌</label>
                    <input type="text" name="code" id="code" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                <label for="num">*發票號碼</label>
                <input type="text" name="num" id="num" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                <label for="spend">金額</label>
                <input type="text" name="spend" class="form-control form-control-sm" id="spend">
                </div>
                <div class="form-group">
                <label for="note">備註</label>
                <textarea name="note" class="form-control form-control-sm" id="note" cols="30" rows="3"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="save">
            </form>
        </div>
    </div>
</body>

</html>