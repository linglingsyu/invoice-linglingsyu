<?php 
    include("common/base.php");
    $update = save("winning_numbers", $_POST);
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