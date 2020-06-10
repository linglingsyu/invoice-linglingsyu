<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 發票清單</title>
    <style>

        .form-control {
            width: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row flex-column justify-content-end align-items-center">
            <form action="?" method="get">
                <h4 class="h4 mb-3">請選擇要查詢的發票年月份</h4>
                <div class="form-group d-flex">
                    <select name="year" id="year" class="form-control form-control-sm mr-3">
                        <?php
                        $year = date("Y") - 1911;
                        $ny = $year - 1;
                        echo "<option value='$year' selected>" . $year . "</option>";
                        echo "<option value='$ny'>" . $ny . "</option>";
                        ?>
                    </select>
                    <select name="period" id="period" class="form-control form-control-sm mr-3">
                        <option value='1'>01-02月</option>
                        <option value='2'>03-04月</option>
                        <option value='3'>05-06月</option>
                        <option value='4'>07-08月</option>
                        <option value='5'>09-10月</option>
                        <option value='6'>11-12月</option>
                    </select>
                    <input type="hidden" name="target" value="list">
                    <input type="submit" value="查詢" class="form-control form-control-sm ml-4">
                </div>
            </form>
            <?php
            if (isset($_GET["year"]) && isset($_GET["period"])) {
                $user_id = $_SESSION["id"];
                $data = [
                    "user_id" => $user_id,
                    "year" => $_GET["year"],
                    "period" => $_GET["period"]
                ];
                $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                $total = nums("invoice", $data);
                $page_show = 25;
                $limitStart = ($page - 1) * $page_show;
                $rows = all("invoice", $data, "limit  $limitStart,$page_show");
                $page_total = ceil($total / $page_show);
                parse_str($_SERVER['QUERY_STRING'], $query_arr);

                if ($page > 1) {
                    $query_arr['page'] = $page - 1;
                    $new_query_str = http_build_query($query_arr);
                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $new_query_str . "'>上一頁</a>";
                }
                echo "第" . $page . "頁" . "，共" . $page_total . "頁";
                if ($page < $page_total) {
                    $query_arr['page'] = $page + 1;
                    $new_query_str = http_build_query($query_arr);
                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $new_query_str . "'>下一頁</a>";
                }


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
                    $data = ["year", "period", "inv_date", "code", "num", "spend", "note", "operation"];
                    $arr = ["", "01-02月", "03-04月", "05-06月", "07-08月", "09-10月", "11-12月"];
                    if (count($rows) == 0) {
                        exit();
                    }
                    foreach ($rows as $row) {
                        echo "<tr>";
                        foreach ($data as $value) {
                            if ($value == "period") {
                                $tmp = $row[$value] != null ? $row[$value] : 0;
                                echo "<td>" . $arr[$tmp] . "</td>";
                            } elseif ($value == "operation") {
                                echo "<td><a href='update_invoice.php?id=" . $row['id'] . "'>編輯</a>";
                                echo "<a href='del_invoice.php?id=" . $row['id'] . "'>刪除</a></td>";
                            } else {
                                echo "<td>" . $row[$value] . "</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>