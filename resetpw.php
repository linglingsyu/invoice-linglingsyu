<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票對獎系統- 重設密碼</title>
</head>

<body>

    <?php
    foreach ($_POST as $value) {
        if (empty($value)) {
            to("forget.php?status=1");
            exit();
        }
    }
    if($_POST['pw'] != $_POST['chkpw']){
        to("forget.php?status=2");
        exit();
    }
    $data = [
        "acc" => $_POST['acc'],
        "email" => $_POST['email'],
        "birthday" => $_POST['bir'],
    ];
    $row = find('user', $data);
    if ($row == null) {
        to("forget.php?status=3");
        exit();
    } 
    $data = ["id"=>$row['id'],'pw'=>$_POST['pw']];
        save("user",$data);
        to("forget.php?status=4");

    ?>

</body>

</html>