<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票對獎系統- 重設密碼</title>
    <?php include 'include/link.php'; ?>
    <style>
        h1 {
            color: #5B00AE;
        }

        label {
            color: #000000;
        }

        html,
        body {
            height: 100%;
        }

        .form-control{
            display: inline-block;
            width: 60%;
            float:right;
        }

        input[type="reset"],input[type="submit"]{
            color:#5B00AE;
        }



        input[type="reset"]:hover,input[type="submit"]:hover{
            color:blueviolet;
            border-bottom: 1px solid #3b52ff;
        }



    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="container">
        <h1 class="h1 text-center py-3">重設密碼</h1>
        <div class="row justify-content-center align-items-center">
            <form action="resetpw.php" method="POST" class="ml-5">
                <div class="form-group">
                    <label for="acc">帳號</label>
                    <input type="text" name="acc" id="acc" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="email">信箱</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="bir">生日</label>
                    <input type="date" name="bir" id="bir" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="pw">新密碼</label>
                    <input type="password" name="pw" id="pw" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="chkpw">確認新密碼</label>
                    <input type="password" name="chkpw" id="chkpw" class="form-control form-control-sm">
                </div>
                <div class="form-group clearfix text-center">
                    <input type="reset" value="重寫" class="btn">
                    <input type="submit" value="送出" class="btn">
                </div>
                <a href="index.php" class="btn btn-outline-primary float-right">返回首頁</a>
                <div class="status text-danger font-weight-bolder clearfix">
                    <?php
                    if (isset($_GET['status'])) {
                        switch ($_GET['status']) {
                            case 1:
                                echo "請填寫完整資料";
                                break;
                            case 2:
                                echo "確認密碼錯誤";
                                break;
                            case 3:
                                echo "資料填寫錯誤，請重新輸入";
                                break;
                            case 4:
                                echo "密碼更新成功";
                                break;
                        }
                    }
                    ?>
                </div>
            </form>
        </div>

    </div>

</body>

</html>