
<?php
include "app.php";
$g = new app; //instanciacion

$errores=array(); //creo array para errores

if(isset($_GET["op"])){  //si existe el querystring "op"...
  $msj=$_GET["op"]; //.. creo la variable $msj.
}else{
  $msj="";
}

if(isset($_POST["desc"]) and isset($_POST["importe"])){

  if(empty(($_POST["importe"]))){ // uso funcion del lenguaje empty q combinada con el if me sirve para preguntar si la variable esta vacia.
    $errores[]="imp";
  }
  if(is_numeric($_POST["importe"])) {// uso funcion del lenguaje is_numeric para preguntar si la varibale es un numero (entero o decimal).
  
  $g->nuevo($_POST["desc"],$_POST["importe"]);//funct nuevo: carga los datos desde app.php
    
  header("location:index.php?op=OK");// no te podes quedar aca recarga la pagina
  exit();


}else{
  $msj="ERROR";
}
  }
$gastos=$g->listar(); //listo los datos de $gastos  en (class app) y los vuelco en $gastos (del lado de index.)

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-12">
            <form method="post" action="">
                <div class="form-group">
                  <label for="desc">Descripcion</label>
                  <input type="text" class="form-control" name="desc">
                </div>
                <div class="form-group">
                  <label for="importe">Importe</label>
                  <input type="text" class="form-control" name="importe">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </form>
              <br>
        </div><!-- cierre del primer col-12-->
      </div><!-- cierre del primer row-->

      <?php switch($msj){ //uso la estructura de control switch para mostrar en pantalla el texto correspondiente en cada caso.
            case "OK": 
                echo "<p><small><i>Guardado correctamente</i></small></p>";
                break;
            case "ERROR";
                echo "<p><small><b><i>Debe ingresar un dato numerico!</i></b></small></p>";
                break;
            default:
        }
        ?>

      <div class="row">
        <div class="col-12">
          <?php 
          if(count($gastos)){
          ?>
          <table class="table" id="tabla">
            <thead>
              <tr id="tere">
                <th scope="col">Fecha</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Gasto</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($gastos as $pos=>$fila){ ?> <!--// si lo agrego de esta forma ademas me devuele la posicion, foreach mas complejo -->
              <tr>
              <th> <?php  echo $fila["fecha"]; ?> </th>
               <th> <?php  echo $fila["desc"]; ?> </th>
               <th> $<?php  echo $fila["importe"]; ?> </th>
               <th class="text-right"><a class="borrar" href="borrar.php?id=<?php echo $pos ?>" ><i class="bi bi-trash-fill"></i></a></th>                    
              </tr>
              <?php  } ?>
            </tbody>
          </table>
                  <!--// CODIGO AGREGADO para mostrar en pantalla en total de gastos. -->
          <?php 

              
          ?><h5 align="center"> <?php echo "El total de gastos es = $ ",$g->sumar(); ?> </h5> 
       
          
          <br>
          <a class="borrarto" href="borrar.php?di"><button type="button" id="borrartodo" class="btn btn-danger btn-sm">Borrar Todo</button></a>
          <?php }else{ ?>
          
          <div class="alert alert-primary" role="alert">
           No hay gastos!
           </div>
           <?php } ?>  
          
        </div>
      </div>
    </div><!-- cierre del container-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- biblioteca Jquery-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> <!-- biblioteca Jquery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.min.js" integrity="sha512-U3Q2T60uOxOgtAmm9VEtC3SKGt9ucRbvZ+U3ac/wtvNC+K21Id2dNHzRUC7Z4Rs6dzqgXKr+pCRxx5CyOsnUzg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
          
              $(document).ready(function(){ 

                $("a.borrarto").click(function(e){ 
                  e.preventDefault(); 
                
                  var dir=$(this).prop("href") 

                  bootbox.confirm("Atencion! Desea borrar todo?", function(result){

                    if(result){
                      location.href=dir; 
                    }
    
                    });          
                      });
              
                $("a.borrar").click(function(e){ //detecto el elemento  y es toda la informacion del evento q clickie y tengo el control sobre ese elemento.
                  e.preventDefault(); // evito q recargue.
                
                  var dir=$(this).prop("href") // de esto seleciona la propiedad href y guarda como texto la direccion en dir.

                  bootbox.confirm("Usted esta seguro?", function(result){

                    if(result){
                      location.href=dir; //location tiene q ver con lo q que esta escrito arriba en el navegador. href redirecciona a dir.
                    }
    
                    });          
                      });
                        });
        </script>
  </body>
</html>
