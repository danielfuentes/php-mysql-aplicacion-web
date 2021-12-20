<?php
    require_once('controladores/funciones.php');
    require_once('helpers/dd.php');
    $id = intval($_GET['id']);
    //dd($id);
    $bd = conexion('localhost','mascotas','root','');
    $animalito = buscar($bd,'animalitos',$id);    
    //dd($animalito);
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Detalle del animalito</title>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>
    <div class="container-fluid">
        <?php require('partials/navegacion.php')  ?>        <section>
        <h1 class="text-center bg-info text-white p-3" >Detalle de la mascota</h1>
        <section class="row">
                <article class="col-12">
                    <div class="card" >
                        <img  src="imagenes/<?=$animalito['imagen'] ?>" class="card-img-top w-50 m-auto" alt="Perrita">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?=$animalito['nombre'] ?></h5>
                            <p class="card-text"><?=$animalito['descripcion'] ?></p>
                            <p class="card-text">Donación: $<?=$animalito['aporte'] ?></p>
                            <a href="index.php" class="btn btn-success">Volver</a>
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
