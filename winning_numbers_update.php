<?php 
    include("common/base.php");
    $data = [
        "id" => $_POST['id'],
        "special" => $_POST['special'],
        "top" => $_POST['top'],
        "first_prize1" => $_POST['first_prize1'],
        "first_prize2" => $_POST['first_prize3'],
        "first_prize3" => $_POST['first_prize3'],
        "addprize" => $_POST['addprize']   
    ];
    $update = save("winning numbers", $data);
    if ($update >= 1){
        $status = 1 ; 
        header("location:winning_numbers_list.php?status=$status");
    }elseif(empty($update)){
        $status = 2 ; 
        header("location:winning_numbers_list.php?status=$status");
    }
    else{
        $status = 0 ; 
        header("location:winning_numbers_list.php?status=$status");
    };
?>