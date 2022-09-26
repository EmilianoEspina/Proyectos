<?php

include "app.php";
if(isset($_GET["id"])){
      
    $g = new app; //instancio
    $pos=intval($_GET["id"]);// guardo el entero dentro de $pos
    $g->borrar($pos); // accedo al metodo borrar desde app y elimino $pos
    header ("location:index.php?op=BORRADO");
    exit();

}
if(isset($_GET["di"])){ 
    $g = new app; //instancio

    $g->borrartodo(); // accedo al metodo borrartodo desde app y elimino gastos.txt
    header ("location:index.php?op=BORRADOPLUS");
    exit();
}
    header("location:index.php");
?>