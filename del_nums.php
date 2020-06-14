<?php 

include_once("common/base.php");

$nums_id =  $_GET["id"];
delete('numbers',$nums_id);
to("main.php?target=numbersList");

?>