<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 對獎頁面</title>
</head>

<body>
    <form action="?" method="post">
        <div class="year">
            請選擇對獎年月份
            <select name="year" id="year">
                <?php
                include("common/base.php");
                $year = date("Y") - 1911;
                $ny = $year - 1;
                echo "<option value='$year' selected>" . $year . "</option>";
                echo "<option value='$ny'>" . $ny . "</option>";
                ?>
            </select>
            <select name="period" id="period">
                <option value='1'>01-02月</option>
                <option value='2'>03-04月</option>
                <option value='3'>05-06月</option>
                <option value='4'>07-08月</option>
                <option value='5'>09-10月</option>
                <option value='6'>11-12月</option>
            </select>
            <input type="submit" value="送出">
        </div>
    </form>
</body>
<?php 

    if(isset($_POST["year"]) && isset($_POST["period"])){
        $user_id = $_SESSION["id"];
        $data = [
            "user_id"=>$user_id,
            "period" =>$_POST["period"],
            "year" => $_POST["year"]
        ];
        $inv_rows = all("invoice", $data);
        $data2 = [
            "period" =>$_POST["period"],
            "year" => $_POST["year"]
        ];
        $win_rows = all("winning numbers",$data2);
        if($win_rows != null){
            $list = check_winnums($win_rows,$inv_rows);
            if(count($list)==0){
                echo "您沒有任何發票中獎";
            }else{
                foreach($list as $value){
                    echo $value;
                }
            }
        }else{
            echo "請先新增中獎號碼資料";
        }
    }

?>

</html>