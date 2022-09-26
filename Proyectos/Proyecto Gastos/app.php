<?php
class app{
//primero variables de negocios, depues..
    var $descripcion="";
    var $importe=0;
    var $total=0;
    //..var de soporte.
    var $gastos=array();
   

    function __construct(){// tmb puedo usar el mismo nombre de la clase pero se recomienda usar el nombre del metodo magico.

        if(file_exists("gastos.txt")){
            $this->gastos=unserialize(file_get_contents("gastos.txt")); //deserializar es tomar la estrutura preparada (.txt) y rearmarla para trabajr. siempre devuelve un array.
        }//DEVUELVE ARRAY
    }

    function guardar(){//dentro de las clases, las funciones se llaman metodos.
            file_put_contents("gastos.txt",serialize($this->gastos));//serialize devuelve un texto partiendo de un array. DEVULEVE :TXT
        }

    function nuevo($descripcion="",$importe=0){
            $dato=array();
            $dato["desc"]=$descripcion;
            $dato["importe"]=$importe;
            $dato["fecha"]=date("d/m/Y H:i");// la Y mayus devuelve el a;o en 4 digitos y la H devuelve la hora formato 24hs y en minuscula am y pm.
            $this->gastos[]=$dato;
            $this->guardar();
        }
    
    function listar(){
        return $this->gastos; //usar esto para sumar todos los gastos
    }

    function borrar($pos){
        if(isset($this->gastos[$pos])){
            unset($this->gastos[$pos]);
            $this->guardar();
        }
       
    }
    function borrartodo(){
        if(file_exists("gastos.txt")){ //funcion creada para borrar todo.
            unlink("gastos.txt");
        
    } 
  }

  function sumar(){
    $timportes=array();
    $this->timportes = array_column($this->gastos, "importe");
    $this->total=array_sum($this->timportes);
    return $this->total;
}


}//cierre de class app


 



   
     


?>