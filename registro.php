<?php
//require_once('helpers/dd.php');
require('controladores/funciones.php');
/*$errores=[
        "nombre" => ''
    ];*/

//Declaro las varibales para lograr persistir los datos en el formulario
   

if ($_POST) {
    //dd($_POST);
    //dd($_FILES);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $errores = [];
    //dd($_POST);
    //Debo hacer una validación
    $errores = validarUsuarioRegistro($_POST,$_FILES);
    //dd($errores);
    if(count($errores)=== 0){
        /*
        Para guardar los datos dentro de un archivo de texto
        $archivo = fopen('archivo.txt','a+');
        foreach($_POST as $key => $valor){
            fwrite($archivo, "$key:$valor".PHP_EOL);
        }
        fclose($archivo);
        */

        //Guardar los datos en un arhivo en formato JSON
        //Armar los datos del usuario a guardar
        //$usuario = armarUsuario($_POST);
        //dd($usuario);
        //Guardar el usuario previamente armado
        //guardarUsuario($usuario);

        //Guardar los datos, pero en una Base de Datos
        //Conectar a la Base de Datos
        $bd = conexion('localhost','mascotas','root','');
        //dd($bd);
        //Guardar al usuario que se está registrando
        //dd($errores);
        $avatar = armarImagen($_FILES);
        //dd($avatar);
        guardarUsuarioBD($bd,'usuarios',$_POST,$avatar);
        //Aquí es donode debemos crear una función - para enviar el email al usuario
        enviarEmail($_POST);
        //Envio al usuario a donde yo desee
        header("location: index.php");
        
    }
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

    <title>Registro</title>
    <link rel="stylesheet" href="css/master.css">
</head>

<body>
    <div class="container-fluid">
        <?php require('partials/navegacion.php')  ?>
        <section>
            <h1 class="text-center p-3">Registro de usuario</h1>
        </section>
        <section class="formulario">
            <?php if(isset($errores)):?>
                <ul class="text-center alert alert-danger">

                    <?php foreach ($errores as $error) : ?>
                        <li><?= $error; ?></li>

                    <?php endforeach; ?>
                </ul>
            <?php endif;?>

            <form class="mx-auto w-50" action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"  value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : "" ;?>"/>
                    <!--<div><span class="text text-danger"><?= $errores['nombre']; ?></span></div>-->
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" value="<?= isset($_POST['apellido']) ? $_POST['apellido'] : "" ;?>"/> 
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : "" ;?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Clave</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="repassword" class="form-label">Rectifique la clave</label>
                        <input type="password" class="form-control" name="repassword" id="repassword">
                    </div>
                    <div class="form-group">
                        <input  class="form-control" type="file" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrarme</button>
                    <div class="mt-3 text-center">
                        <a href="login.php">Ya poseo una cuenta!</a>
                    </div>
            </form>
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