<?php

echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['QUERY_STRING'];
echo "<br>";

parse_str($_SERVER['QUERY_STRING'], $query_arr);
$page = isset($_GET["page"])?$_GET["page"]:1;
$query_arr['page'] = $page+1;
$new_query_str = http_build_query($query_arr);
?>
<a href="<?= $_SERVER['PHP_SELF']."?".$new_query_str?>">next</a>

