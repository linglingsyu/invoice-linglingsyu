<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統 - 首頁</title>
  <?php include 'include/link.php'; ?>
  <style>


    .form1,
    .award {
      margin: 0 auto;
      text-align: center;
    }

    .note {
      margin: 0 auto;
      text-align: left;
    }
    label {
      width: 100%;
      margin: 1% 0;
    }

    input{
      width:60%;
      margin: 1% 0;
      padding-left:3%;
    }

  </style>
</head>

<body>
  <div class="container w-50">
    <div class="row">
      <form action="checklogin.php" method="post" class="form1">
        <div class="col">
          <h1>登入帳號</h1>
          <label for="">帳號</label>
          <input type="text" name="acc" id="acc">
          <label for="">密碼</label>
          <input type="password" name="pw" id="pw">
        </div>
        <div class="col">
          <input type="reset" value="重填">
          <input type="submit" value="送出">
        </div>
        <div class="col">
          <a href="reg.php">註冊帳號</a>
          <span> | </span>
          <a href="">忘記密碼</a>
        </div>
      </form>
    </div>
    <div class="col">
      <div class="note w-50">
        <p>登入帳號即可享有個人專屬發票管理頁面！</p>
        <p>您可以：</p>
        <p>1.紀錄所有發票資訊</p>
        <p>2.查詢及編輯您所有紀錄過的發票</p>
        <p>3.一鍵快速對獎</p>
      </div>
    </div>
    <div class="col award">
      <a href="winning_numbers_award.php">不登入，進行快速對獎去！</a>
    </div>
    <div class="col award">
      <a href="winning_numbers.php">輸入中獎號碼</a>
    </div>
  </div>
</body>

</html>