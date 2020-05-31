<?php
include_once("common/base.php");
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["status"]);
to("index.php");
?>