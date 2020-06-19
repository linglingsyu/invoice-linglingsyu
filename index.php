<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統 - 首頁</title>
  <?php include 'include/link.php'; ?>
  <style>

    .h1{
      color:#5B00AE;
    }

    label{
      color:#000000;
    }

    html,body{
      height: 100%;
    }
    button{
      width: 45%;
      margin-left:8px;
    }

    p{
      color:#000000;
    }

  </style>
</head>

<body class="d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <?php
      $show = 0;
      session_start();
      if (isset($_SESSION["status"])) {
        if ($_SESSION["status"]) {
          $show = 1;
        } else {
          echo "<script>alert('帳號密碼錯誤，請重新輸入')</script>";
        }
      }
      ?>

      <?php if (!$show) { ?>

        <form action="checklogin.php" method="post" class="form1">
          <h1 class="h1 text-center">登入帳號</h1>
          <div class="form-group">
            <label for="acc">帳號</label>
            <input type="text" name="acc" id="acc" class="form-control" placeholder="admin">
          </div>
          <div class="form-group">
            <label for="pw">密碼</label>
            <input type="password" name="pw" id="pw" class="form-control" placeholder="123">
          </div>
          <button type="reset" class="btn btn-primary">重寫</button>
          <button type="submit" class="btn btn-primary">登入</button>
          <div class="inline-block  text-center mt-3 mb-3">
            <a href="reg.php" class="text-info">註冊帳號</a>
            <span> | </span>
            <a href="forget.php" class="text-info">忘記密碼</a>
          </div>
          <p>登入帳號即可享有個人專屬發票管理頁面！</p>
          <p>您可以：</p>
          <p>1.紀錄所有發票資訊</p>
          <p>2.查詢及編輯您所有紀錄過的發票</p>
          <p>3.一鍵快速對獎</p>
          <a href="winning_numbers_award.php" class="btn alert-success">不登入，進行快速對獎去！</a>
          <a href="winning_numbers.php" class="btn alert-warning">輸入中獎號碼</a>
        </form>
    </div>
  </div>
<?php
      } else {
        header("location:main.php");
      }

?>
</body>

</html>