<?php
$link=@mysqli_connect("localhost","root","") or die("con");
mysqli_select_db($link,"basenotas") or die("DB");
?>