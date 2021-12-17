<?php
    session_start();
    session_destroy();
    //Cerrar o borrar las cookies del navegador del usuario
    //Al pasarle un tiempo en negativo a la cookie esta se borra del navegador del usuario
    setcookie('email','',time()-1);
    setcookie('password','',time()-1);
    setcookie('nombre','',time()-1);
    setcookie('apellido','',time()-1);
    setcookie('perfil','',time()-1);
    setcookie('avatar','',time()-1);
    //Enviamos al usuario a donde yo quiera
    header('location: index.php');
    //exit;
?>    