<?php 

include_once("common/base.php");

$inv_id =  $_GET["id"];
$year = $_GET['year'];
$period = $_GET['period'];
delete('invoice',$inv_id);
to("main.php?target=list&year=$year&period=$period");

?>