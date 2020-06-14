<?php include_once("common/base.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票中獎號碼</title>
    <?php include("include/link.php") ?>
    <style>

        .h4{
            color: #5B00AE;
        }

        .form-control{
            display: inline-block;
            width: 50%;
        }
        label{
            width: 15%;
            color:#000000;
        }

        .form-group{
            padding-left:5rem;
        }

        form input[type="submit"]:hover{
            background-color: #5B00AE !important;
        }

        #numbers.container{
            padding-left: 0;
            padding-right:0;
            border-radius: 15px;
            background-color: #00b4cc7a;
        }



    </style>
</head>

<body>
    <?php 
    $id = $_GET['id'];
    $row = find("numbers",$id);
    $arr = ["", "01-02月", "03-04月", "05-06月", "07-08月", "09-10月", "11-12月"];
    ?>
    <div id="numbers" class="container w-50">
            <form action="edit_nums.php" method="post" class="w-75 mx-auto">
                    <h4 class="h4 text-center py-3">編輯統一發票中獎號碼</h4>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label>年月份</label>
                        <input type="text" name="special" id="special" class="ml-3 form-control form-control-sm w-25" value="<?= $row['year'] ?>" readonly>
                        <input type="text" name="special" id="special" class="form-control form-control-sm w-25" value="<?= $arr[$row['period']] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="special">特 別 獎</label>
                        <input type="text" name="special" id="special" class="ml-3 form-control form-control-sm" value="<?= $row['special'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="top">特　　獎</label>
                        <input type="text" name="top" id="top" class="ml-3 form-control form-control-sm" value="<?= $row['top'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="first_prize1">頭　　獎</label>
                        <input type="text" name="first_prize1" id="first_prize1" class="ml-3 form-control form-control-sm w-25" value="<?= $row['first_prize1'] ?>">
                        <input type="text" name="first_prize2" id="first_prize2" class="form-control form-control-sm w-25" value="<?= $row['first_prize2'] ?>">
                        <input type="text" name="first_prize3" id="first_prize3" class="form-control form-control-sm w-25" value="<?= $row['first_prize3'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="addprize">增開六獎</label>
                        <input type="text" name="addprize" id="addprize" class="form-control form-control-sm ml-3" value="<?= $row['addprize'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="reset" value="重填" class="btn btn-info w-25 ml-5 ">
                        <input type="submit" value="送出" class="btn btn-info w-25 ml-3 ">
                    </div>
                    <p class="text-center text-muted">※若欲更改年月份請刪除此筆資料再進行新增資料，謝謝！</p>
                    <a href="main.php?target=numbersList" class="btn btn-outline-primary mb-3 float-right">回獎號列表</a>
                    <div class="clearfix"></div>
            </form>
            <div class="status text-center pb-3 text-danger font-weight-bolder">
                <?php
                if(isset($_GET['status'])){
                    if($_GET['status'] == 1){
                    echo "未更新：資料不得為空，請重新輸入要更改的資料";
                    }elseif ($_GET['status'] == 2) {
                        echo "更新成功";
                    }else{
                        echo "更新失敗";
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>