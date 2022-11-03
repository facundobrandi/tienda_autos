<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="app.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Tienda</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg "  style="background-color: #aacc9b;">
    <div class="container-fluid py-4">
        <h2 class="navbar-brand fs-1">Tienda de autos</h2>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <button type="button" id="ver" class="mx-3 fs-4 btn btn-primary">Ver autos</button>
            </li>
            <li class="nav-item">
                <button type="button" id="ver_carrito" class="mx-3 fs-4 btn btn-primary">Ver carrito</button>  
            </li>
            <li class="nav-item">
            <?php
                echo "<p><button class='mx-3 fs-4 btn btn-danger' onClick=\"location.href='../destruir.php'\">Terminar Sesion</button><p>";
                ?>
            </li>
            <li class="nav-item">
                <h2 class="pt-2" id="total">Total = $0</h2>
            </li>
        </ul>
        </div>
                <button type="button" id="Comprar_2" class=" mx-3 fs-4 btn btn-success">Comprar</button>
    </div>
    </nav>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ingrese sus datos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form  id="Email_send" >
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Su Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
      </div>
    </div>
  </div>
</div>

    <div class="page-content" id="tabla">
    
    </div>
    
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</body>
</html>