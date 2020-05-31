<?php include_once("common/base.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?= "請更新您的發票資訊，" . $_SESSION['name']; ?></h1>
    <?php
    if(isset($_GET["id"])){
        $res = find("invoice",$_GET["id"]);
        print_r($res);
    }
    ?>

    <form action="?" method="POST">
        <label for="year">*民國年</label>
        <select name="year" id="year">
            <?php
            $year = date("Y") - 1911;
            $ny = $year - 1;
            echo "<option value='$ny'>" . $ny . "</option>";
            echo "<option value='$year' selected>" . $year . "</option>";
            ?>
        </select>
        <label for="period">*期別</label>
        <select name="period" id="period">
            <option value="1">01-02月</option>
            <option value="2">03-04月</option>
            <option value="3">05-06月</option>
            <option value="4">07-08月</option>
            <option value="5">09-10月</option>
            <option value="6">11-12月</option>
        </select>
        <input type="hidden" name="id" id="id" value="<?= $res['id']?>">
        <label for="inv_date">發票日期</label>
        <input type="date" name="inv_date" id="inv_date" value="<?= $res['inv_date']?>">
        <label for="code">字軌</label>
        <input type="text" name="code" id="code" value="<?= $res['code']?>">
        <label for="num">*發票號碼</label>
        <input type="text" name="num" id="num" value="<?= $res['num']?>" require>
        <label for="spend">金額</label>
        <input type="text" name="spend" id="spend" value="<?= $res['spend']?>">
        <label for="note">備註</label>
        <textarea name="note" id="note" cols="30" rows="3" value="<?= $res['note']?>"></textarea>
        <input type="submit" value="update">
        </div>
        </div>
    </form>

    <?php 
if(isset($_POST['id'])){
    $data = [
        "id"=>$_POST['id'],
        "year"=>$_POST['year'],
        "period"=>$_POST['period'],
        "inv_date"=>$_POST["inv_date"],
        "code"=>$_POST["code"],
        "num"=>$_POST["num"],
        "spend"=>$_POST["spend"],
        "note"=>$_POST["note"],
    ];
    $res = save("invoice",$data);
    to("list.php");
}
  
    ?>

</body>

</html>