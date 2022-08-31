<?php require "../notas/conexion.php"; 
$errores=array();

if(isset($_GET["op"])){

    $msj=$_GET["op"];
}else{
    $msj="";
}

if(isset($_POST["notas"])){
    $nota=trim($_POST["notas"]);
    $color=trim($_POST["color"]);

    if(strlen($nota)==0){
        $errores[]="notas";
    }

    if(count($errores)==0){

    $sql=sprintf("INSERT INTO notas(texto,color) VALUES('%s','%s')",$nota,$color);
    mysqli_query($link,$sql) or die(mysqli_error($link));

    if(mysqli_affected_rows($link)){

        header("location:index.php?op=OK");
        exit();
    
        }
    }else{
        $msj="ERROR";
    }
}

$sql="SELECT * FROM notas WHERE (estado=0) OR (estado=2) ORDER BY estado DESC, nota_id DESC";
$recordset=mysqli_query($link,$sql) or die (mysqli_error($link));

$notas=mysqli_fetch_all($recordset,MYSQLI_ASSOC);

//print_r($notas);



?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>NOTAS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1 align="center"> NOTAS </h1>
        <p><!-- form -->
        <fieldset width=70%>

        <?php switch($msj){
            case "OK": 
                echo "<p>LA NOTA SE GUARDO CORRECATMENTE </p>";
                break;
            case "ERROR";
                echo "<p> NO SE GUARDO NADA</p>";
                break;
            default:
        }
        ?>

        <form method="post" action="">
                <p>
                <label for="notas">SU NOTA AQUI</label>
                
           
               
                <br>
                <input type="text" name="notas" size="50">
                &nbsp;
                        <form method="post" action="">
                            <select name="color" id="">
                            <option value="#FF0000">INACTIVO</option>
                            <option value="#00FF00">ACTIVO</option>
                            <option value="#DFFF00">EN ESPERA</option>
                            </select> 
                        <input type="submit" name="boton" value="guardar">

                        <?php if(in_array("notas", $errores)){
                        echo "<small> la nota no puede estar vacia </small>";          
                        }
                        ?>
                        </form>
                </p>
            
            <br>
        
            </form>


       
<p>
        <table border="1" width=80% celpadding="5" celspacing="0">
            
    <thead>
                <tr>
                    <th>ID</th>
                    <th>Texto</th>
                    <th>Fecha</th>
                    <th>Archivar</th>
                    <th>Fijar</th>
                    <th>Estado</th>
                    
                </tr>
    </thead>

    <tbody>



    <?php foreach($notas as $n){ ?>
        

            <tr bgcolor="<?php echo $n['color']; ?>">
            <td align="center"><?php echo $n['nota_id']; ?></td>
            <td align="center"><?php echo $n['texto']; ?></td>
            <td align="center"><?php echo $n['fecha']; ?></td>
            <td align="center"> <a href= "cambiaestado.php?id=<?php echo $n["nota_id"];?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-playstation" viewBox="0 0 16 16">
            <path d="M15.858 11.451c-.313.395-1.079.676-1.079.676l-5.696 2.046v-1.509l4.192-1.493c.476-.17.549-.412.162-.538-.386-.127-1.085-.09-1.56.08l-2.794.984v-1.566l.161-.054s.807-.286 1.942-.412c1.135-.125 2.525.017 3.616.43 1.23.39 1.368.962 1.056 1.356ZM9.625 8.883v-3.86c0-.453-.083-.87-.508-.988-.326-.105-.528.198-.528.65v9.664l-2.606-.827V2c1.108.206 2.722.692 3.59.985 2.207.757 2.955 1.7 2.955 3.825 0 2.071-1.278 2.856-2.903 2.072Zm-8.424 3.625C-.061 12.15-.271 11.41.304 10.984c.532-.394 1.436-.69 1.436-.69l3.737-1.33v1.515l-2.69.963c-.474.17-.547.411-.161.538.386.126 1.085.09 1.56-.08l1.29-.469v1.356l-.257.043a8.454 8.454 0 0 1-4.018-.323Z"/></svg></a>
            </td>
            <td align="center"><a href="fijar.php?id=<?php echo $n["nota_id"];?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-angle-fill" viewBox="0 0 16 16">
            <path d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z"/></svg></a>
            </td>    
            <td align="center">
                <?php if($n['estado']==2){
                    echo "<small> nota fijada";
                }
                ?>
            </td> 
            </tr>
            
        <?php } ?> 
       
</p>
            
        
    </tbody>
    </table>

  
    
    </p>
    
    </fieldset>
    <p>
    <a href="papelera.php">Ir a Papelera</a>
    </p>

    
    </body>
</html>