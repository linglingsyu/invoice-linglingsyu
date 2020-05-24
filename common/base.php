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
    $sql = "select * from $table ";

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
    echo $sql;
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
