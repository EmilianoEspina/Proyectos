<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Cronometro</title>
  </head>
  <body>
   

    <div class="container">
            <div class="row">
                <div class="col-12">

                    <h1 align="center">CRONOMETRO</h1>

                    <div class="card">
                        <div align= "center" class="card-body">

                             <h1><span id="hora">00</span>
                            <span id="minutos">:00</span>
                            <span id="segundos">:00</span>
                            <span id="cent">:00</span> </h1>

                        </div>
                    </div>             
                </div>
            </div>
     

            <div class="row">
                <div class="col-8">
                    <button type="button" class="btn btn-primary btn-block" id="start">START</button>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-secondary btn-block" id="RESET">RESET</button>
                </div>  
                <div class="col-2">
                <button type="submit" class="btn btn-secondary btn-block" id="pin"><i class="bi bi-alarm"></i></button>
                </div>    
            </div>

            <div class="row">
                <div class="col-12">
                    <ul class="list-group" id="lista">

                        <!-- <li class="list-group-item" > <span class="float-right"><i class="bi bi-trash-fill"></i></span></li> -->

                    </ul>
                </div>
            </div>



    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>

    $(document).ready(function(){    
        
        var tiempo = 0;

        var cent=0;
        var segundos=0;
        var minutos=0;
        var hora=0;

        $("#start").click(function(){
            if($(this).text() == "START"){ //con == compara, y con = asigna. 
                    $(this).text("PAUSE"); 

                tiempo = setInterval(function(){     // Funcion setInterval(<codigo>,<tiempo>): ejecuta periodicamente un <codigo>, cada <tiempo> en milesimas de seg.
                        
                        cent++;
                
                        if(cent>=100){                                             
                            cent=0;
                            segundos++;                                           
                        }

                        if(segundos>=60){
                            segundos=0;
                            minutos++;                       
                        }

                        if(minutos>=60){
                            minutos=0;
                            hora++;                          
                        }

                $("#hora").text(hora < 10 ? '0' + hora : hora);
                $("#minutos").text(minutos < 10 ? '0' + minutos : minutos);
                $("#segundos").text(segundos < 10 ? '0' + segundos : segundos);
                $("#cent").text(cent < 10 ? '0' + cent : cent);

                },10); 

            } else {

                     $(this).text("START");
                    clearInterval(tiempo);
                    }

            });

            $("#lista").on("click","i.borrar",function(){ 

$(this).closest("li").remove();

});


            $("#pin").click(function(e){
                e.preventDefault();
                var horat=$("#cent").val()
                $("#lista").prepend('<li class="list-group-item">'+hora+':'+minutos+':'+segundos+':'+cent+'<span class="float-right"><i class="bi bi-trash-fill borrar"></i></span></li>')

                console.log(centesima);
            })

      



            $("#RESET").click(function(){
                hora = 0;
                minutos = 0;
                segundos = 0;
                cent = 0;

                //Actualizar pantalla
                $("#hora").text(hora < 10 ? '0' + hora : hora);
                $("#minutos").text(minutos < 10 ? '0' + minutos : minutos);
                $("#segundos").text(segundos < 10 ? '0' + segundos : segundos);
                $("#cent").text(cent < 10 ? '0' + cent : cent);
                
                //detener el intervalo
                clearInterval(tiempo);

               
            })

        });

    </script>
   
  
  </body>
</html>