<?php
sleep(1);
$json=array(); //primeros pasos, declaro el array de transporte...
$json["status"]="error";//...y de status para poder medirlo.

$numeros=array();


while(count($numeros)<4){
    $nuevo=rand(0,99);
    if(in_array($nuevo,$numeros)===false){ // con 3 iguales declaro q esto es falso booleano, es estricto a la hora de comparar. para php el 0 es falso y tdos los positivos son verdaderos.
                                            //el booleano distingue solo de true o false, literal en palabras. no en 0s y 1s
        $numeros[]=$nuevo;                  //{ significa objeto} [significa array]
    }
}
sort($numeros);
header("Content-Type: application/json"); // esto le dice al navegador q son datos dinamicos q no lo cachee. porq probablemnte hay q actualizarlo. para indicarle al navegador que NO es una web, sinó un dataset.
$json["numeros"]=$numeros;                  //cachear es q quede almacenado en tu navegador.
$json["status"]="ok";


echo json_encode($json);//muestro el status.




?>