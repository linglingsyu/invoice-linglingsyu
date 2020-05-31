<?php 

include_once("common/base.php");

$inv_id =  $_GET["id"];
delete('invoice',$inv_id);
to("list.php");

?>