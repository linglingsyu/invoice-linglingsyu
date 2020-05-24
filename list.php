<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 發票清單</title>
    <style>
        tr,
        td {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <?php include_once "common/base.php";
    $user_id = $_SESSION["id"];
    $rows = all("invoice", $user_id);
    ?>

    <table>
        <tr>
            <td>年度</td>
            <td>月份</td>
            <td>發票日期</td>
            <td>字軌</td>
            <td>發票號碼</td>
            <td>花費</td>
            <td>備註</td>
            <td>操作</td>
        </tr>
        <?php
        $data = ["year", "period", "inv_date", "code", "num", "spend", "note","operation"];
        $arr = ["", "01-02月", "03-04月", "05-06月", "07-08月", "09-10月", "11-12月"];
        if (count($rows) == 0) {
            exit();
        }
        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($data as $value) {
                if ($value == "period") {
                    $tmp = $row[$value]!=null ? $row[$value] : 0;
                    echo "<td>" . $arr[$tmp] . "</td>";
                }elseif($value == "operation"){
                    echo "<td><a href='update_invoice.php?id=".$row['id']."'>編輯</a>";
                    echo "<a href='del_invoice.php?id=".$row['id']."'>刪除</a></td>";
                }else {
                    echo "<td>" . $row[$value] . "</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>