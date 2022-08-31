<?php
    if(isset($_GET["id"])){
        include "../notas/conexion.php";
        $fijar=intval($_GET["id"]);
        
        if($fijar>=0){

            $sql="UPDATE notas SET estado=2 WHERE nota_id=".$fijar;
            mysqli_query($link,$sql);
            $n['color']=$n['#ADD8E6'];
            header("location:index.php?op=FIJADO");
            exit();
        }
    }
        header("location:index.php");

?>


  