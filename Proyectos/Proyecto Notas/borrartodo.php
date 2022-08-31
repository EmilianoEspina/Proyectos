<?php require "../notas/conexion.php";

$sql="DELETE FROM notas WHERE estado=1";

mysqli_query($link,$sql);

header("location:papelera.php?op=vacio");