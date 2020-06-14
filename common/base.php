<?php

$dsn = "mysql:host=localhost;charser=utf8;dbname=invoice";
$pdo = new PDO($dsn, 'root', "");
date_default_timezone_set("Asia/Taipei");
session_start();

//尋找單筆資料
function find($table, $arg)
{
    global $pdo;
    $sql = "select * from `$table`";
    if (is_array($arg)) {
        $arr = [];
        foreach ($arg as $key => $value) {
            $arr[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql . " where " . implode(" && ", $arr);
    } else {
        $sql = $sql . " where `id`='$arg'";
    }
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

// 尋找多筆資料
function all($table,...$condition){
    global $pdo;
    $sql = "select * from `$table` ";

    if(isset($condition[0]) && is_array($condition[0])){
        $tmp=[];
        foreach($condition[0] as $key => $value){
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }
    if(isset($condition[1])){
        $sql = $sql . $condition[1];
    }
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function to($url){
    header("location:".$url);
}

function delete($table,$arg){
    global $pdo;
    $sql = "delete from $table ";
    if(is_array($arg)){
        $tmp=[];
        foreach($arg as $key => $value){
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }else{
        $sql = $sql . "where `id`='$arg'";
    }
     return $pdo->exec($sql);
}

function save($table,$arg){
    global $pdo;
    if(isset($arg['id'])){
        //update
        $sql = "update $table ";
        foreach ($arg as $key => $value){
            if($key != 'id'){
            $tmp[] = sprintf("`%s`='%s'",$key,$value);
            }
        }
        $sql = "update `$table` set " . implode(',', $tmp ) . " where `id`='" . $arg['id']."'";
        // echo $sql;
         return $pdo->exec($sql);
    }else{
        //insert
        $sql = "insert into `$table`" . "(`".implode("`,`",array_keys($arg)) ."`) values ". "('".implode("','",$arg) ."')";
        // echo $sql;
        return $pdo->exec($sql);  
    }
}

function  nums ( $table ,... $condition ){
    global  $pdo ;
    $sql = "select count(*) from $table " ;
    if ( isset ( $condition [ 0 ]) && is_array ( $condition [ 0 ])){
        $tmp =[];
        foreach ( $condition [ 0 ] as  $key => $value ){
            $tmp [] = sprintf ( "`%s` = '%s'" , $key , $value );
        }
       $sql = $sql . "where" . implode ( " && " , $tmp );
    }
    if ( isset ( $condition [ 1 ])){
        $sql = $sql . $condition [ 1 ];
    }
     return  $pdo -> query ( $sql )-> fetchColumn ();
}



function check_winnums($win_rows,$inv_rows){
    $special = $win_rows[0]["special"];
    $top = $win_rows[0]["top"];
    $first = [
         $win_rows[0]["first_prize1"],
         $win_rows[0]["first_prize2"],
         $win_rows[0]["first_prize3"]
    ];
    $second = [
        mb_substr($win_rows[0]["first_prize1"], 1, 7), mb_substr($win_rows[0]["first_prize2"], 1, 7), mb_substr($win_rows[0]["first_prize3"], 1, 7)
    ];
    $third = [
        mb_substr($win_rows[0]["first_prize1"], 2, 6),
        mb_substr($win_rows[0]["first_prize2"], 2, 6), mb_substr($win_rows[0]["first_prize3"], 2, 6)
    ];
    $fourth = [
        mb_substr($win_rows[0]["first_prize1"], 3, 5), mb_substr($win_rows[0]["first_prize2"], 3, 5), mb_substr($win_rows[0]["first_prize3"], 3, 5)
    ];
    $fifth = [
        mb_substr($win_rows[0]["first_prize1"], 4, 4), mb_substr($win_rows[0]["first_prize2"], 4, 4), mb_substr($win_rows[0]["first_prize3"], 4, 4)
    ];
    $sixth = [
        mb_substr($win_rows[0]["first_prize1"], 5, 3), mb_substr($win_rows[0]["first_prize2"], 5, 3), mb_substr($win_rows[0]["first_prize3"], 5, 3), $win_rows[0]["addprize"]
    ];
    $list = [];
    foreach ($inv_rows as $rows){
        $num = $rows["num"];
        if($num == $special){
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了特別獎，獎金<span class='spcbonus'>10,000,000</span>元<br>";
            continue;
        }elseif ($num == $top) {
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了特獎，獎金<span class='topbonus'>2,000,000</span>元<br>";
            continue;
        }
        if (!in_array(mb_substr($num, 5, 3), $sixth)) {
            continue;
        }
        if (in_array($num, $first)){
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了頭獎，獎金<span class='bonus'>20,0000</span>元<br>";
        }elseif (in_array(mb_substr($num, 1, 7), $second)){
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了二獎，獎金<span class='bonus'>40,000</span>元<br>";
        }elseif (in_array(mb_substr($num, 2, 6), $third)){
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了三獎，獎金<span class='bonus'>10,000</span>元<br>";
        }elseif (in_array(mb_substr($num, 3, 5), $fourth)){
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了四獎，獎金<span class='bonus'>4,000</span>元<br>";
        }elseif (in_array(mb_substr($num, 4, 4), $fifth)){
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了五獎，獎金<span class='bonus'>1,000</span>元<br>";
        }else {
            $list[] = "發票號碼<span class='numcolor'>" . $num . "</span>中了六獎，獎金<span class='bonus'>200</span>元<br>";
        }
    }
    return $list;
}
?>