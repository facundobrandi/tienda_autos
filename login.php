<?php 
    session_start();
    if(isset($_SESSION['usuario']))
    {
        header("Location: index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Login</title>
</head>
    <!--Stylesheet-->
    <style media="screen">
                *,
            *:before,
            *:after{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            body{
                background-color: #635f80;
            }
            .background{
                width: 430px;
                height: 520px;
                position: absolute;
                transform: translate(-50%,-50%);
                left: 50%;
                top: 50%;
            }
            .login{
                height: 610px;
                width: 400px;
                background-color: rgba(255,255,255,0.13);
                position: absolute;
                transform: translate(-50%,-50%);
                top: 50%;
                left: 50%;
                border-radius: 10px;
                backdrop-filter: blur(10px);
                border: 2px solid rgba(255,255,255,0.1);
                box-shadow: 0 0 40px rgba(8,7,16,0.6);
                padding: 50px 35px;
            }
            .login *{
                font-family: 'Poppins',sans-serif;
                color: #ffffff;
                letter-spacing: 0.5px;
                outline: none;
                border: none;
            }
            .login h3{
                font-size: 32px;
                font-weight: 500;
                line-height: 42px;
                text-align: center;
            }

            .show
            {
                display: none;
                background-color: #23a2f6;
                position: fixed;
                top: 5%;
                right: 5%;
                height: 300px;
                width: 500px;
                border: 10px solid #175c8a ;
                border-radius: 25px;
                padding: 10px;
                border: 2px solid rgba(255,255,255,0.1);
                box-shadow: 0 0 40px rgba(8,7,16,0.6);
                background-color: rgba(255,255,255,0.7);
            }
            

            .New
            {
                display: none;
                background-color: #23a2f6;
                position: fixed;
                top: 5%;
                right: 5%;
                height: 440px;
                width: 500px;
                border: 10px solid #175c8a ;
                border-radius: 25px;
                padding: 10px;
                border: 2px solid rgba(255,255,255,0.1);
                box-shadow: 0 0 40px rgba(8,7,16,0.6);
                background-color: rgba(255,255,255,0.7);

                font-family: 'Poppins',sans-serif;
                color: #ffffff;
                letter-spacing: 0.5px;
                font-size: 32px;
                font-weight: 500;
                line-height: 42px;
            }


            label{
                display: block;
                margin-top: 30px;
                font-size: 16px;
                font-weight: 500;
            }
            input{
                display: block;
                height: 50px;
                width: 100%;
                background-color: rgba(255,255,255,0.07);
                border-radius: 3px;
                padding: 0 10px;
                margin-top: 8px;
                font-size: 14px;
                font-weight: 300;
            }
            ::placeholder{
                color: #e5e5e5;
            }
            button{
                margin-top: 50px;
                width: 100%;
                background-color: #b1b6ba;
                color: #080710;
                padding: 15px 0;
                font-size: 18px;
                font-weight: 600;
                border-radius: 5px;
                cursor: pointer;
            }
            .social{
            margin-top: 30px;
            display: flex;
            }
            .social div{
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255,255,255,0.27);
            color: #eaf0fb;
            text-align: center;
            }
            .social div:hover{
            background-color: rgba(255,255,255,0.47);
            }
            .social .fb{
            margin-left: 25px;
            }
            .social i{
            margin-right: 4px;
            }

    </style>
<body>

    <div class="login">
    <form id="formlogin" method="post" enctype="multipart/form-data">
        <h3>Login de app</h3>

        <label for="username">Nombre</label>
        <input type="text" name="usuario" placeholder="Nombre" id="username">

        <label for="password">Contraseña</label>
        <input type="password" name="contra" placeholder="Contraseña" id="password">

    </form>

        <button id="enviar">Ingresar</button>
        <button id="nuevo">Hacer Nueva cuenta</button>
        </div>

        <div class="show">
            jdjdjdj
        </div>

        <div class = "New">
            <form id="formlogin_2" method="post" enctype="multipart/form-data">
                <h3>Nuevo usuario</h3>
                <label for="username">Nombre</label>
                <input type="text" name="usuario" placeholder="Nombre" id="username">

                <label for="password">Contraseña</label>
                <input type="password" name="contra" placeholder="Contraseña" id="password">
               
             
            </form>
            <button id="enviar_usuario">Ingresar nuevo usuario</button>
            <p class="respuesta"></p>
        </div>
    <script>


    $(document).ready(function()
    {
        $("#enviar").click(function()
        {
            alta();
        })

        $("#nuevo").click(function()
        {
            nuevo_usuario();
        })

        $("#enviar_usuario").click(function()
        {
            alta_usuario();
        })

    })

    function nuevo_usuario() {
        $(".New").css({"display":"block"});
        $(".show").css({"display":"none"});
    }
    

    
    function alta()
        {

            var data = new FormData($("#formlogin")[0]);
            var objAjax = $.ajax({
            type: 'post',
            method: 'post',
            enctype: 'multipart/form-data',
            url: "./ingreso.php",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function(respuestaDelServer,estado)
            {
                $(".show").css({"display":"block"});
                $(".New").css({"display":"none"}); 
                $(".show").html(respuestaDelServer);
            }

            }); 
        }

    function alta_usuario()
        {

            var data = new FormData($("#formlogin_2")[0]);
            var objAjax = $.ajax({
            type: 'post',
            method: 'post',
            enctype: 'multipart/form-data',
            url: "./alta_usuario.php",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function(respuestaDelServer,estado)
            {
                $(".New").css({"display":"block"});
                $(".show").css({"display":"none"});
                $(".respuesta").html(respuestaDelServer);
            }

            }); 
        }
    </script>
</body>
</html>