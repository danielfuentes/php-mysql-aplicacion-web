<?php 
    //require_once('helpers/dd.php');
    require('controladores/funciones.php');
    //if(ingresarUsuario() === true){
        if (!isset($_SESSION['nombre'])) {
            $nombre = "";  

        } else{
            $nombre = $_SESSION['nombre'].' '.$_SESSION['apellido'];
            //dd($_SESSION);
        }
        //header('location: perfil.php');
    //}else{
       // header('location: login.php');
    //}
    //dd($nombre);
    $saludo = saludar($nombre);
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Clase 12 - PHP -MYSQL</title>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>
    <div class="container-fluid">
        <?php require('partials/navegacion.php')  ?>
        <?php echo "<h2 class='text-center p-3 text-white bg-danger '> $saludo </h2>" ?>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="img/cat-g7c922204f_1280.jpg" class="d-block w-100" alt=".Gato">
        </div>
        <div class="carousel-item">
            <img src="img/puppy-g46618f5b8_1280.jpg" class="d-block w-100" alt="Perrito">
        </div>
        <div class="carousel-item">
            <img src="img/puppy-ge4d3c3954_1280.jpg" class="d-block w-100" alt="Perrito">
        </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div> 
        <section>
            <h1 class="text-center bg-info text-white p-3" >Tu mascota te está esperando</h1>
        </section>  
        <section class="row">
            <article class="col-12 col-md-6 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="imagenes/foto1.jpg" class="card-img-top" alt="Perrita">
                    <div class="card-body">
                        <h5 class="card-title">Lola</h5>
                        <p class="card-text">Perrita muy bonita.</p>
                        <p class="card-text">Aporte: $100</p>
                        <a href="#" class="btn btn-primary">Ver detalle</a>
                    </div>
                </div>
            </article>
            <article class="col-12 col-md-6 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="imagenes/foto2.jpg" class="card-img-top" alt="Gatita">
                    <div class="card-body">
                        <h5 class="card-title">Sofia</h5>
                        <p class="card-text">Es un gatita muy linda.</p>
                        <p class="card-text">Aporte: $200</p>
                        <a href="#" class="btn btn-primary">Ver detalle</a>
                    </div>
                </div>
            </article>
            <article class="col-12 col-md-6 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="imagenes/foto3.jpg" class="card-img-top" alt="Perrita">
                    <div class="card-body">
                        <h5 class="card-title">Pelusa</h5>
                        <p class="card-text">Es una perrita muy cariñosa.</p>
                        <p class="card-text">Aporte: $300</p>
                        <a href="#" class="btn btn-primary">Ver detalle</a>
                    </div>
                </div>
            </article>
            <article class="col-12 col-md-6 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="imagenes/foto4.jpg" class="card-img-top" alt="Perrita">
                    <div class="card-body">
                        <h5 class="card-title">Nala</h5>
                        <p class="card-text">Es una perrita muy chillona</p>
                        <p class="card-text">Aporte: $400</p>
                        <a href="#" class="btn btn-primary">Ver detalle</a>
                    </div>
                </div>
            </article>

        </section>          
        <?php require('partials/navegacion.php')  ?>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/master.js"></script>
  </body>
</html>
