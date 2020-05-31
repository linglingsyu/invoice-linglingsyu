  
<?php

include_once  "common/base.php";
$num = 1000;
$char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
for ($i = 0; $i < $num; $i++) {
    $data = [
        'code' => $char[rand(0, strlen($char) - 1)] . $char[rand(0, strlen($char) - 1)],
        'period' => 1,
        'year' => 109,
        'user_id' => 4,
        'num' => sprintf("%08d",rand(0, 99999999)),
        'spend' => rand(100, 10000),
    ];
    echo  "已新增" . $data["code"] . $data['num'] . "<br>";
    save("invoice", $data);
}

?>