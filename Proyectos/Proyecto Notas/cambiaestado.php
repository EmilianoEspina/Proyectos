<?php
if(isset($_GET["id"])){
    include "../notas/conexion.php";
    $notaid=intval($_GET["id"]);//intval devuelve si hay un numero entero dentro del texto.

    if($notaid>0){

        $sql="UPDATE notas SET estado=1 WHERE nota_id=".$notaid;
        mysqli_query($link, $sql);
        header("location:index.php?op=CAMBIADO");
        exit();


    }

   
}

    header("location:index.php");

?>