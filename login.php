<?php
//require_once('helpers/dd.php');
require_once('controladores/funciones.php');
   

if ($_POST) {
    //dd($_POST);
    //dd($_FILES);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errores = [];
    //dd($_POST);
    //Debo hacer una validación
    $errores = validarUsuarioLogin($_POST);
    //dd($errores);
    if(count($errores)=== 0){        
        //Conectar a la Base de Datos
        $bd = conexion('localhost','mascotas','root','');
        //Debemos buscar al usuario por el email
        $usuario = buscarPorEmail($bd, 'usuarios', $email);
        //dd($usuario);
        if($usuario === false){
            $errores['email'] = 'El usuario o contraseña son inválidos';
        }else{
            if(password_verify($password,$usuario['password'])=== false){
                $errores['password'] = 'El usuario o contraseña son inválidos';
            }else{
                //dd($usuario);
                //Guardar los datos del usuario en variables de sesion
                seteoUsuario($usuario,$_POST);
                //$_SESSION['nombre'] = $usuario['nombre'];
                //$_SESSION['apellido'] = $usuario['apellido'];
                //$_SESSION['perfil'] = $usuario['perfil'];
                //$_SESSION['avatar'] = $usuario['avatar'];
                //dd($_SESSION['nombre']);
                //Envio al usuario a donde yo desee
                //dd(ingresarUsuario());
                header("location: perfil.php");
            }
        }
        //dd($usuario);


        
        
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

    <title>Inciar sesión</title>
    <link rel="stylesheet" href="css/master.css">
</head>

<body>
    <div class="container-fluid">
        <?php require('partials/navegacion.php')  ?>
        <section>
            <h1 class="text-center p-3">Iniciar sesión</h1>
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
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : "" ;?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Clave</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="recordarme">
                        <label class="form-check-label" for="recordarme">
                            Recordarme
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Inciar sesión</button>
                    <div class="mt-3 text-center">
                        <a href="registro.php">Aun no poseo una cuenta!</a>
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