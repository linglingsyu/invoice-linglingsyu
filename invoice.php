<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 首頁</title>
    <style>

        html,body{
            height:100%;
        }

        .form1{
            width: 50%;
        }

        label{
            margin: 1% 0;  
        }
        input {
            width: 100%;
        }

        input[type="submit"]{
            margin:5% 0;
        }

        select{
            width:100%;
            text-align-last: center;
        }
        textarea{
            width: 100%;
        }







    </style>
</head>

<body class="d-flex justify-content-center align-items-center ">
<?php
    include_once "common/base.php";
    include "include/link.php";

?>
<div class="container w-50">
    <div class="row">
    <div class="col">
        <?php
    if( isset($_GET["status"]) && $_GET["status"] == 1){
        echo "<div>新增成功，請繼續輸入下一筆資料</div>";
    }
    ?>
        <h1><?= "請輸入您的發票資訊，".$_SESSION['name'];?></h1>
        <form action="save_invoice.php" method="POST" class="form1">
            <label for="year">*民國年
            </label>
            <input type="text" name="year" id="year" require>
            <label for="period">*期別</label>
            <select name="period" id="period">
                <option value="1">01-02月</option>
                <option value="2">03-04月</option>
                <option value="3">05-06月</option>
                <option value="4">07-08月</option>
                <option value="5">09-10月</option>
                <option value="6">11-12月</option>
            </select>
            <label for="inv_date">發票日期</label>
            <input type="date" name="inv_date" id="inv_date">
            <label for="code">字軌</label>
            <input type="text" name="code" id="code" >
            <label for="num">*發票號碼</label>
            <input type="text" name="num" id="num" require>
            <label for="spend">金額</label>
            <input type="text" name="spend" id="spend">
            <label for="note">備註</label>
            <textarea name="note" id="note" cols="30" rows="3"></textarea>
            <input type="submit" value="save">
    </div>
    </div>
     </form>
     <div class="row">
         <div class="col">
             <a href="list.php">查看發票列表</a>
         </div>
     </div>
</div>
<?php 


?>
</body>

</html>