<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票對獎系統- 註冊帳號</title>
    <?php include 'include/link.php'; ?>

    <style>
        h1 {
            color: #5B00AE;
        }

        html,
        body {
            height: 100%;
        }

        .form-control {
            display: inline-block;
            width: 60%;
        }
        .cen {
            margin-left: 50%;
            transform: translate(-50%);
        }

        label,
        p {
            color: #000000;
        }

        P {
            text-align: left;
            margin-left: 1.5rem;
        }

        form input[type="submit"]:hover {
            background-color: #00ffff;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="container w-50 px-0 text-center">
        <div class="row flex-column justify-content-center align-items-center">
            <h1 class="h1 text-center py-3">註冊帳號</h1>
            <form action="adduser.php" method="POST" class="ml-5">
                <div class="form-group">
                    <label for="acc">帳號</label>
                    <input type="text" name="acc" id="acc" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="pw">密碼</label>
                    <input type="password" name="pw" id="pw" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="name">暱稱</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="email">信箱</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="bir">生日</label>
                    <input type="date" name="bir" id="bir" class="form-control form-control-sm">
                </div>
                <div class="cen form-group clearfix">
                    <input type="reset" value="重寫" class="form-control form-control-sm w-25">
                    <input type="submit" value="註冊" class="form-control form-control-sm w-25">
                </div>
                <a href="index.php" class="btn btn-outline-primary float-right">返回首頁</a>
                <p>備註：</p>
                <p>1.資料不得為空</p>
                <p>2.信箱及生日作為重設密碼用，請填寫正確資料</p>
                <p>3.除了帳號，其他資料皆可登入後修改</p>
        </div>
        <div class="status text-danger font-weight-bolder">
            <?php
            if (isset($_GET['status'])) {
                switch ($_GET['status']) {
                    case 1:
                        echo "系統錯誤";
                        break;
                    case 2:
                        echo "此帳號已有人使用";
                        break;
                    case 3:
                        echo "註冊成功！";
                        break;
                    case 4:
                        echo "註冊失敗";
                        break;
                    case 5:
                        echo "請填寫完整註冊資料";
                        break;
                }
            }

            ?>

        </div>

        </form>
    </div>

</body>

</html>