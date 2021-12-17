<?php
//require_once('helpers/dd.php');
require_once('controladores/funciones.php');
if(!isset($_SESSION['nombre'])){
    header('location: login.php');
}

?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Perfil del usuario</title>
    <link rel="stylesheet" href="css/master.css">
</head>

<body>
    <div class="container-fluid">
        <?php require('partials/navegacion.php')  ?>
        <section>
            <h1 class="text-center p-3">Perfil del usuario</h1>
        </section>
        <section>
            <div class="text-center">
                <img style="border-radius: 50%; width:20%" src="imagenes/<?=$_SESSION['avatar'] ;?>" alt="Avatar">
            </div>
            <div class="text-center text-white bg-info">
                <h1><?=$_SESSION['nombre']. ' '. $_SESSION['apellido'] ;?></h1>
            </div>
        </section>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="js/master.js"></script>
</body>

</html>