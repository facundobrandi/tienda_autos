<?php
    include("./manejoSesion.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>ABM</title>
</head>
<body>

    <!-- estilo de la pagina principal -->
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body
        {
            background-color: #32312f;
            font-family: sans-serif;
        }

        /* TABLA */
        .table
        {
            width: 100%;
            border-collapse: collapse;
        }
        .table thead
        {
            background-color: #ee2828;
        }
        .table thead tr th
        {
            font-size: 14px;
            font-weight: medium;
            letter-spacing: 0.35px;
            color:#ffffff;
            opacity: 1;
            padding: 12px;
            vertical-align: top;
            border: 1px solid #dee2e685;
            
        }
        .table tbody tr td
        {
            font-size: 14px;
            width : 1%;
            letter-spacing: 0.35px;
            font-weight: normal;
            color: #f1f1f1;
            background-color: #3c3f44;
            padding: 8px;
            text-align: center;
            border: 1px solid #dee2e685;
        }

        .table tbody tr td .btn
        {
            width: 80px;
            text-decoration: none;
            line-height: 35px;
            display: inline-block;
            background-color: #FF1046;
            font-weight: medium;
            color: white;
            text-align: center;
            vertical-align:middle;
            border: 1px solid transparent;
            font-size: 14px;
            border-radius: 7px;
            cursor: pointer;
        }

        .table .btn:hover
        {
            background-color: #5a0a1d;
        }


        /*CABECERA*/
        .conter
        {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ee2828;
            height: 100px;
            font-size: 15px;
        }
        .conter select,.conter button , .conter  input ,.conter label
        {
            font-size: 15px;
            padding: 10px;
            margin: 0 20px;
            border-radius: 15px;
            cursor: pointer;
        }

        .conter button:hover
        {
            background-color: #3c3f44;
        }
        .footer {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ee2828;
            height: 100px;
            font-size: 15px;
        }

        .CUR
        {
            cursor: pointer;
        }

    </style>

    <!-- Pagina principal -->
    <div class="conter">
        Autos <?php echo $_SESSION["persona"] ?>
        <button  id="cargar">Cargar Datos</button> 
        <button  id="meter">Ingresar</button> 
        <a href="../destruir.php"><button id="btnCierraSesion">Cerrar sesión</button></a>
        <label for=""> Orden:</label>
        <select name="" id="orden">
            <option value="MODELO">Modelo</option>
            <option value="PATENTE">Patente</option>
            <option value="PRECIO">Precio</option>
            <option value="FECHA">Fecha</option>
            <option value="PAIS">Pais</option>
            <option value="CANT">Cantidad de Puertas</option>
        </select>
    </div>
    <div class="table_container">
    <table class="table">
        <thead class="head">
        <tr>
          <th id="mod">Modelo</th>
          <th id="pre" class="data_1">Precio</th>
          <th id="pat" class="data_2">Patente</th>
          <th id="fecha" class="data_2">Fecha de alta</th>
          <th id="pais" class="data_2">Pais</th>
          <th id="cant" class="data_2">Cant de puertas</th>
          <th id="cant" class="btn">Imagen</th>
          <th id="cant" class="btn">Modificar</th>
          <th id="cant" class="btn">Eliminar</th>
        </tr>
        <tr class="CUR">
          <th><input type="text" id="f_modelo"></th>
          <th class="data_1"><input type="text" id="f_precio"></th>
          <th class="data_2"><input type="text" id="f_patente"></th>
          <th class="data_2"><input type="text" id="f_fecha"></th>
          <th class="data_2"><input type="text" id="f_pais"></th>
          <th class="data_2"><input type="text" id="f_cantidad"></th>
        </tr>
         </thead>
        <tbody id="tabla">  

        </tbody>
      </table>

    </div>
    <div class="footer"><p id="recuento"></p> <h3>Pie de pagina</h3></div>


    <!-- estilo de la ventana modal -->
    <style>


        *{
            margin:0;
            padding:0;
            box-sizing:border-box;    
            font-size: 8px;
            font-size:100%;
        }

        .modal_iframe
        {
            visibility: hidden;
        }
        .modal , .mostra ,.modal_modi , .mostra_modi , .modal_iframe
        {
            display:none;
            position:fixed;
            top: 5%;
            left: 5%;
            background-color: #b1b6ba;
            width: 60%;
            border: 5px solid #3c3f44;
            border-radius: 25px;
        }

        .mostra , .mostra_modi
        {
            left: 67%;
            width: 30%;
        }

        .container
        {
            width: 100%;
            height: auto;
            background-color: #b1b6ba;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: 25px;
        }

        .div
        {
            height: 100px;
            width: 300px;
            border: 1px solid black;
            border-radius: 15px;
            margin-bottom: 20px;
            margin-right: 20px;
            float: left;
        }

        .container input ,.container p ,.container select 
        {
            margin-top: 14px;
            margin-left: 14px;
            font-size: larger;
        }

        .div_button ,.container button
        {   

            padding: 10px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .div_button:hover , .container button:hover
        {
            background-color: #3c3f44;
        }

        .cerrar , .cerrar_abajo
        {
            height: auto;
            width: 2%;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: red;
            float:right;
            border-top-right-radius: 15px;
        }

        .cerrar_abajo
        {
            border-bottom-right-radius: 15px;
            border-top-right-radius: 0px;
        }
        
    </style>

    <!--ventana modal -->
    <div class="modal">
        <div class="cerrar">
            <h2>X</h2>
        </div>
        <div class="container">
        <form id="formArticulosAlta" method="post" enctype="multipart/form-data">
            <div class="div"> 
            <p>Modelo</p>
            <input type="text" name="modelo_carga" id="modelo_carga" >
            </div>
            <div class="div"> 
            <p >Precio</p>
            <input type="number" name="precio_carga" id="precio_carga">
        </div>
            <div class="div"> 
            <p >Patente</p>
            <input type="text" name="patente_carga" id="patente_carga">
        </div>
            <div class="div"> 
            <p >Fecha de Alta</p>
            <input type="date" name="fecha_carga" id="fecha_carga">
        </div>
        <div class="div"> 
            <p >Pais</p>
            <input type="text" name="pais_carga" id="pais_carga">
        </div>
            <div class="div"> 
            <p >Numero de Puertas</p>
            <select name="puertas_carga" id="puertas">
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>
        <div class="div">
            <label>Link de Imagen</label>
            <input type="text" id="ruta_carga" name="ruta_carga">
            </div>
        </form>
        <div class="div div_button"> 
            <button type="submit" id="enviar">Boton para subir</button>   
        </div>
        </div>
    </div>
    <div class="mostra">
        <div class="cerrar">
            <h2>X</h2>
        </div>
        <div class="container_alta">

        </div>
    </div>

    <!--ventana modal de modificacion -->
    <div class="modal_modi">
        <div class="cerrar">
            <h2>X</h2>
        </div>
        <div class="container">
            <form id="formArticulosModi" method="post" enctype="multipart/form-data">

            <div class="div"> 
            <p>Modelo</p>
            <input type="text" name="modelo_modi" id="modelo_modi" >
            </div>
            <div class="div"> 
            <p >Precio</p>
            <input type="number" name="precio_modi" id="precio_modi">
        </div>
            <div class="div"> 
            <p >Patente</p>
            <input type="text" name="patente_modi" id="patente_modi">
        </div>
            <div class="div"> 
            <p >Fecha de Alta</p>
            <input type="date" name="fecha_modi" id="fecha_modi">
        </div>
            <div class="div"> 
            <p >Pais</p>
            <input type="text" name="pais_modi" id="pais_modi">
        </div>
            <div class="div"> 
            <p >Numero de Puertas</p>
            <select name="puertas_modi" id="puertas_modi">
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>
        <div class="div">
            <label>Link de Imagen: </label>
            <input type="text" id="ruta_modi" name="ruta_modi">
            </div>
            </form>
        <div class="div div_button"> 
            <button type="submit" id="enviar_modi">Boton para subir</button>   
        </div>
        </div>
    </div>
    <div class="mostra_modi">
        <div class="cerrar">
            <h2>X</h2>
        </div>
        <div class="container_alta_modi">

        </div>
    </div>

    <!--ventana modal iframe -->
    <div class="modal_iframe">
        <div class="iframe"></div>
        <div class="cerrar_abajo">
            <h2>X</h2>
        </div>
    </div>



    <script>

        let objTbDatos = document.getElementById("tabla");

        $(document).ready(function (){

            cargaTabla();

            $("#cargar").click(function()
                {
                    cargaTabla();
                });

                $("#meter").click (function()
                {
                    $(".modal").css({"display":"block"}); 
                    $(".mostra").css({"display":"block"});
                    
                    $(".table_container").css("visibility","hidden");
                    $(".conter").css("visibility","hidden");
                    $(".footer").css("visibility","hidden");
                })

                $(".cerrar").click (function()
                {
                    $(".modal").css({"display":"none"}); 
                    $(".mostra").css({"display":"none"});

                    $(".modal_modi").css({"display":"none"}); 
                    $(".mostra_modi").css({"display":"none"});

                    $(".modal_iframe").css({"display":"none"}); 
                    $(".modal_iframe").css("visibility","invisible");


                                    $("#modelo_modi").val("");
                                    $("#precio_modi").val("");
                                    $("#patente_modi").val("");
                                    $("#fecha_modi").val("");
                                    $("#pais_modi").val("");
                                    $("#puertas_modi").val("");
                                    $(".container_alta_modi").html("");

                                    $("#modelo_carga").val("");
                                    $("#precio_carga").val("");
                                    $("#patente_carga").val("");
                                    $("#fecha_carga").val("");
                                    $("#pais_carga").val("");
                                    $("#puertas_carga").val("");
                                    $(".container_alta").html("");
                    
                    $(".table_container").css("visibility","visible");
                    $(".conter").css("visibility","visible");
                    $(".footer").css("visibility","visible");
                })

                $(".cerrar_abajo").click (function()
                {
                    $(".modal").css({"display":"none"}); 
                    $(".mostra").css({"display":"none"});

                    $(".modal_modi").css({"display":"none"}); 
                    $(".mostra_modi").css({"display":"none"});

                    $(".modal_iframe").css({"display":"none"}); 
                    $(".modal_iframe").css("visibility","invisible");

                                    $("#modelo_modi").val("");
                                    $("#precio_modi").val("");
                                    $("#patente_modi").val("");
                                    $("#fecha_modi").val("");
                                    $("#pais_modi").val("");
                                    $("#puertas_modi").val("");
                                    $(".container_alta_modi").html("");

                                    $("#modelo_carga").val("");
                                    $("#precio_carga").val("");
                                    $("#patente_carga").val("");
                                    $("#fecha_carga").val("");
                                    $("#pais_carga").val("");
                                    $("#puertas_carga").val("");
                                    $(".container_alta").html("");
                    

                    $(".table_container").css("visibility","visible");
                    $(".conter").css("visibility","visible");
                    $(".footer").css("visibility","visible");
                })

                //BOTON PARA ENVIAR ALTA DE FORMULARIO
                $("#enviar").click(function()
                {
                    //aca se llama a la funcion de cargarun dato que manda el ajax y eso
                    alta();
                })

                $("#enviar_modi").click(function()
                {
                    //aca se llama a la funcion de cargarun dato que manda el ajax y eso

                    modi();
                    
                })

                $("#mod").click(function()
                {
                    $("#orden").val("MODELO");
                    cargaTabla();
                })

                $("#pre").click(function()
                {
                    $("#orden").val("PRECIO");
                    cargaTabla();
                })

                $("#pat").click(function()
                {
                    $("#orden").val("PATENTE");
                    cargaTabla();
                })

                $("#fecha").click(function()
                {
                    $("#orden").val("FECHA");
                    cargaTabla();
                })

                $("#pais").click(function()
                {
                    $("#orden").val("PAIS");
                    cargaTabla();
                })

                $("#cant").click(function()
                {
                    $("#orden").val("CANT");
                    cargaTabla();
                })

                function cerrar_abajo()
                        {
                            $(".modal_iframe").css({"display":"none"}); 
                        }

        

        function modi()
        {
            $(".container_alta_modi").html("<p>modificando</p>");    
            
            var data = new FormData($("#formArticulosModi")[0]);


                    var objAjax = $.ajax({
                    type: 'post',
                    method: 'post',
                    enctype: 'multipart/form-data',
                    url: "./modi.php",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    success: function(respuestaDelServer,estado)
                    {
                        $(".container_alta_modi").html(respuestaDelServer);
                    }

            }); 
        }

        function alta()
        {

            $(".container_alta").html("<p>Dando de alta</p>");
            var data = new FormData($("#formArticulosAlta")[0]);


            var objAjax = $.ajax({
            type: 'post',
            method: 'post',
            enctype: 'multipart/form-data',
            url: "./alta.php",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function(respuestaDelServer,estado)
            {
                $(".container_alta").html(respuestaDelServer);
            }

            }); 
        }

        function cargaTabla(){

            $("#tabla").empty();
            $("#tabla").html("<p>Esperando respuesta ....</p>");
                var objAjax = $.ajax({
                type:"get",
                url:"./repuesta.php",
                    data: {
                        orden: $("#orden").val(),
                        f_modelo: $("#f_modelo").val(),
                        f_precio: $("#f_precio").val(),
                        f_patente: $("#f_patente").val(),
                        f_fecha: $("#f_fecha").val(),
                        f_pais:$("#f_pais").val(),
                        f_cantidad:$("#f_cantidad").val()

                    },
                    success: function(respuestaDelServer,estado) {

                            $("#tabla").empty();
                            objJson=JSON.parse(respuestaDelServer);
                            objJson.articulos.forEach(function(argValor,argIndice) {
                            var objTr= document.createElement("tr");
                            var objTd_MOD=document.createElement("td");
                            var objTd_PRE=document.createElement("td");
                            var objTd_PAT=document.createElement("td");
                            var objTd_FEC=document.createElement("td");
                            var objTd_PAIS=document.createElement("td");
                            var objTd_CANT=document.createElement("td");

                            var button_1 = document.createElement("td");
                            var button_2 = document.createElement("td");
                            var button_3 = document.createElement("td");

                            var a_1 = document.createElement("a");
                            var a_2 = document.createElement("a");
                            var a_3 = document.createElement("a");

                            objTd_MOD.innerHTML=argValor.MODELO;
                            objTd_PRE.innerHTML = "$" +argValor.PRECIO ;
                            objTd_PAT.innerHTML = argValor.PATENTE;
                            objTd_FEC.innerHTML = argValor.FECHA;
                            objTd_PAIS.innerHTML = argValor.PAIS;
                            objTd_CANT.innerHTML = argValor.CANT;
                            a_1.innerHTML = "Imagen";
                            a_2.innerHTML = "Modificar";
                            a_3.innerHTML = "Eliminar";


                            button_1.appendChild(a_1);
                            button_2.appendChild(a_2);
                            button_3.appendChild(a_3);

                            
                            objTd_MOD.setAttribute("data-label","Modelo");
                            objTd_MOD.setAttribute("class","auto");
                            objTd_PRE.setAttribute("data-label","Precio");
                            objTd_PAT.setAttribute("data-label","Patente");
                            objTd_FEC.setAttribute("data-label","Fecha");
                            objTd_PAIS.setAttribute("data-label","Pais");
                            objTd_CANT.setAttribute("data-label","Cantidad de Puertas");
                            a_1.setAttribute("class","btn imagen");
                            a_2.setAttribute("class","btn modi");
                            a_3.setAttribute("class","btn eli");

                            a_3.setAttribute("value",objTd_MOD.textContent);
                            a_2.setAttribute("value",objTd_MOD.textContent);
                            a_1.setAttribute("value",objTd_MOD.textContent);


                            objTr.appendChild(objTd_MOD);
                            objTr.appendChild(objTd_PRE);
                            objTr.appendChild(objTd_PAT);
                            objTr.appendChild(objTd_FEC);
                            objTr.appendChild(objTd_PAIS);
                            objTr.appendChild(objTd_CANT);
                            objTr.appendChild(button_1);
                            objTr.appendChild(button_2);
                            objTr.appendChild(button_3);


                            objTbDatos.appendChild(objTr);


                    });//cierra el forEach

                    $("#recuento").html("Nro de registros: " + objJson.articulos.length + " ");

                    swal({
                        title: "Tabla Cargada",
                        text: "la Tabla se cargo con "+ objJson.articulos.length + " autos" ,
                        icon: "success",
                        });
                        //ACA SE RECARGA EL JS Y PONGO LAS FUNCIONES DE LOS BOTONES

                        $(".modi").click(function()
                        {
                            
                            let val = $(this).attr("value");

                            $(".modal_modi").css({"display":"block"}); 
                            $(".mostra_modi").css({"display":"block"});
                            
                            $(".table_container").css("visibility","hidden");
                            $(".conter").css("visibility","hidden");
                            $(".footer").css("visibility","hidden");

                            $(".container_alta_modi").html("<p>Agarrando informacion ...    </p>");  


                            let obj_ajax = $.ajax({
                                type: "get",
                                url:"./repuesta.php",
                                data:{                        
                                    orden: $("#orden").val(),
                                    f_modelo: val,
                                    f_precio: $("#f_precio").val(),
                                    f_patente: $("#f_patente").val(),
                                    f_fecha: $("#f_fecha").val(),
                                    f_pais:$("#f_pais").val(),
                                    f_cantidad:$("#f_cantidad").val()
                                    },
                                success: function(respuestaDelServer,estado)
                                {
                                    objetoDato = JSON.parse(respuestaDelServer);

                                    objetoDato.articulos.forEach(function(argValor,argIndice)
                                    {

                                    $("#modelo_modi").val(argValor.MODELO);
                                    $("#precio_modi").val(argValor.PRECIO);
                                    $("#patente_modi").val(argValor.PATENTE);
                                    $("#fecha_modi").val(argValor.FECHA);
                                    $("#pais_modi").val(argValor.PAIS);
                                    $("#puertas_modi").val(argValor.CANT);
                                    $("#ruta_modi").val(argValor.RUTA);

                                    $(".container_alta_modi").html("<p></p>");  

                                    swal({
                                    title: "Modificacion cargada",
                                    icon: "success"
                                    });
                                    });

                                }
                            });


                        })

                        $(".imagen").click(function()
                        {
                            let val = $(this).attr("value");
                            $(".modal_iframe").css({"display":"block"}); 
                            $(".modal_iframe").css("visibility","visible");
                            $(".iframe").html("<p>Esperando Respuesta ...");


                            let obj_ajax=$.ajax({
                                type:"get",
                                url:"./mostrar.php",
                                data:
                                {
                                    modelo:val
                                },
                                success:function(respuestaDelServer,estado)
                                {
                                    $(".modal_iframe").css({"display":"block"}); 

                                    objetoDato = JSON.parse(respuestaDelServer);

                                   // console.log(objetoDato);
                                    $(".modal_iframe").css("visibility","visible");
                                    $(".iframe").html("<img width='100%' height='500px' src='" +objetoDato.RUTA + "'>");
                                                                    
                                }
                            });

                                
                        })

                        $(".cerrar_abajo").click (function()
                        {
                            $(".modal_iframe").css({"display":"none"}); 
                        })

                        $(".eli").click(function()
                        {
                            let val = $(this).attr("value");
                            swal({
                            title: "Estas seguro?",
                            text: "Vas a eliminar a "+val,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                            })
                            .then((willDelete) => {
                            if (willDelete) {
                                var obj_ajax = $.ajax({
                                    type:"get",
                                     url:"./baja.php",
                                     data: {Modelo:val},
                                     success: function(respuestaDelServer,estado)
                                     {
                                        swal("Eliminamos a "+ respuestaDelServer);
                                     }
                                });
                            } else {
                                swal("No eliminamos a "+ val);
                            }
                            });

                        })

                        
                    
                }//cierra funcion asignada al success

            }); //cierra objeto de parametros y funcion ajax

        }//cierra funcion cargaTabla
        })

      </script>
</body>
</html>