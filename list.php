<?php include_once "common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統一發票管理系統 - 發票清單</title>
    <?php include 'include/link.php'; ?>
    <style>
        html {
            height: 100%;
        }

        .form-control {
            width: auto;
        }

        h4 {
            color: #5B00AE;
        }

        .table-responsive {
            background-color: #003377;
            border-radius: 15px;
            padding-left: 0;
            padding-right: 0;
        }


        #list td:nth-child(2) {
            width: 8%;
        }

        #list td:nth-child(3) {
            width: 15%;
        }

        #list td:nth-child(4) {
            width: 5%;
        }

        #list td:nth-child(5) {
            width: 15%;
        }

        #list td:nth-child(6) {
            width: 8%;
        }


        #list td:nth-child(7) {
            width: 23%;
        }


        #list tr:first-child {
            font-weight: bolder;
            color: red;
        }

        #list tr:not(:nth-child(1)) {
            background-color: white;
        }

        #list tr:nth-child(2) td:first-child {
            border-top-left-radius: 10px;
        }

        #list tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        #list tr:nth-child(2) td:last-child {
            border-top-right-radius: 10px;
        }

        #list tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        #page a {
            color: #770077;
            text-decoration: none;
            font-size: 1.5rem;
            padding: 0 10px;

        }
        form input[type="submit"]:hover {
            background-color: #00ffff !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row flex-column justify-content-start align-items-center">
            <form action="?" method="get">
                <h4 class="h4 my-1">請選擇要查詢的發票年月份</h4>
                <div class="form-group d-flex">
                    <select name="year" id="year" class="form-control form-control-sm mr-3">
                        <?php
                        $this_year = date("Y") - 1911;
                        $year = isset($_POST["year"]) ? $_POST["year"] : $this_year;
                        $ly = $this_year - 1;
                        echo "<option value='$this_year'" . ($year == $this_year ? " selected" : "") . ">$this_year</option>";
                        echo "<option value='$ly'" . ($year == $ly ? " selected" : "") . ">$ly</option>";
                        $arr = [0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6];
                        $period = isset($_POST["period"]) ? $_POST["period"] : $arr[date("n")];
                        ?>
                    </select>
                    <select name="period" id="period" class="form-control form-control-sm mr-3">
                        <option value='1' <?= $period == 1 ? " selected" : "" ?>>01-02月</option>
                        <option value='2' <?= $period == 2 ? " selected" : "" ?>>03-04月</option>
                        <option value='3' <?= $period == 3 ? " selected" : "" ?>>05-06月</option>
                        <option value='4' <?= $period == 4 ? " selected" : "" ?>>07-08月</option>
                        <option value='5' <?= $period == 5 ? " selected" : "" ?>>09-10月</option>
                        <option value='6' <?= $period == 6 ? " selected" : "" ?>>11-12月</option>
                    </select>
                    <input type="hidden" name="target" value="list">
                    <input type="submit" value="查詢" class="form-control form-control-sm ml-4 w-25">
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
                $page_show = 10;
                $limitStart = ($page - 1) * $page_show;
                $rows = all("invoice", $data, "limit  $limitStart,$page_show");
                $page_total = ceil($total / $page_show);
                parse_str($_SERVER['QUERY_STRING'], $query_arr);

                echo "<div id='page' class='d-flex justify-content-center align-items-center'>";
                if ($page > 1) {
                    $query_arr['page'] = $page - 1;
                    $new_query_str = http_build_query($query_arr);
                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $new_query_str . "'> " . "<i class='fas fa-arrow-alt-circle-left'></i>" . "</a>";
                }
                echo "第" . $page . "頁" . "，共" . $page_total . "頁";
                if ($page < $page_total) {
                    $query_arr['page'] = $page + 1;
                    $new_query_str = http_build_query($query_arr);
                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $new_query_str . "'> " . "<i class='fas fa-arrow-alt-circle-right'></i>" . "</a>";
                }
                echo "</div>";

            ?>
                <div id="list" class="table-responsive w-75 px-2">
                    <table class="table table-sm w-100 table-borderless text-center mt-3 ">
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
                                    echo "<td><a class='d-inline-block' href='main.php?target=update_invoice&id=" . $row['id'] . "'>編輯</a>";
                                    echo "<a class='d-inline-block ml-3' href='del_invoice.php?id=" . $row['id'] . "&year=" . $_GET["year"] . "&period=" . $_GET["period"] . "'" . ">刪除</a></td>";
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
    </div>
</body>

</html>