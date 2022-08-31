<?php require "../notas/conexion.php"; 

if(isset($_GET["op"])){

    $msj=$_GET["op"];
}else{
    $msj="";
}

$sql="SELECT * FROM notas WHERE estado=1 ORDER BY nota_id DESC";
$recordset=mysqli_query($link,$sql) or die (mysqli_error($link));

$notas=mysqli_fetch_all($recordset,MYSQLI_ASSOC);

//print_r($notas);



?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>PAPLERA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1 align="center"> PAPELERA </h1>
         
<p>
        <table border="1" width=80% celpadding="5" celspacing="0">
            
    <thead>
                <tr>
                    <th>ID</th>
                    <th>Texto</th>
                    <th>Fecha</th>
                    
                    <th>RESTAURE SU NOTA</th>
                </tr>
    </thead>

    <tbody>

    <?php foreach($notas as $n){ ?>

            <tr>
            <td align="center"><?php echo $n['nota_id']; ?></td>
            <td align="center"><?php echo $n['texto']; ?></td>
            <td align="center"><?php echo $n['fecha']; ?></td>
           
            <td align="center"> <a href="restaurar.php?id=<?php echo $n["nota_id"];?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-playstation" viewBox="0 0 16 16">
            <path d="M15.858 11.451c-.313.395-1.079.676-1.079.676l-5.696 2.046v-1.509l4.192-1.493c.476-.17.549-.412.162-.538-.386-.127-1.085-.09-1.56.08l-2.794.984v-1.566l.161-.054s.807-.286 1.942-.412c1.135-.125 2.525.017 3.616.43 1.23.39 1.368.962 1.056 1.356ZM9.625 8.883v-3.86c0-.453-.083-.87-.508-.988-.326-.105-.528.198-.528.65v9.664l-2.606-.827V2c1.108.206 2.722.692 3.59.985 2.207.757 2.955 1.7 2.955 3.825 0 2.071-1.278 2.856-2.903 2.072Zm-8.424 3.625C-.061 12.15-.271 11.41.304 10.984c.532-.394 1.436-.69 1.436-.69l3.737-1.33v1.515l-2.69.963c-.474.17-.547.411-.161.538.386.126 1.085.09 1.56-.08l1.29-.469v1.356l-.257.043a8.454 8.454 0 0 1-4.018-.323Z"/>
            </svg>
            </a>
            </td>
            </tr>
            
        <?php } ?> 
</p>

    </tbody>
    </table>

    <a href="borrartodo.php">BORRAR TODO</a>
    <br>
    <a href="index.php">VOLVER A NOTAS</a>
    </p>
    
    </fieldset>

    
    </body>
</html>