<?php
//Activar las variables de sessiones
session_start();
//----------------------------------

//Estamos importando las funcionalidades de poder enviar un correo electrónico
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'librerias/PHPMailer/src/Exception.php';
require 'librerias/PHPMailer/src/PHPMailer.php';
require 'librerias/PHPMailer/src/SMTP.php';

//----------------------------------


require ('helpers/dd.php');
function saludar($nom){
    return 'Bienvenido a nuestro sitio web '.$nom;
}
//Crear una función llamada sumar() que retorne la sumatoria de dos valores
function validarUsuarioRegistro($datos,$imagen){
    $errores =[];
    if (trim($datos['nombre']) === '') {
        $errores['nombre']  = "El campo nombre no puede estar vacio";
    }
    if (empty(trim($datos['apellido']))) {
        $errores['apellido']  = "El campo apellido no puede estar vacio";
    }
    if (trim($datos['email']) === '') {
        $errores['email']  = "El campo email no puede estar vacio";
    }
    if (trim($datos['password']) === '') {
        $errores['password']  = "El campo clave no puede estar vacio";
    }else if (strlen(trim($datos['password']))<6) {
        $errores['password']  = "El campo clave no puede tener menos de 6 caracteres";
    }
     

    if (trim($datos['repassword']) === '') {
        $errores['repassword']  = "El campo de rectificación no puede estar vacio";
    }else if (strlen(trim($datos['repassword'])) < 6) {
        $errores['repassword'] = "El campo de rectificación no puede tener menos de 6 caracteres";
    }

    //comprobar si password y repassword son iguales
    if (trim($datos['password']) != trim($datos['repassword'])) {
        $errores['repassword']  = "El campo de rectificacion no es igual al campo clave";
    }
    //Validar la imagen - Avatar
    if(isset($imagen)){
        //dd($imagen);
        $avatar = $imagen['avatar']['name'];
        //dd($avatar);
        $ext = pathinfo($avatar,PATHINFO_EXTENSION);
        //dd($ext);
        if($imagen['avatar']['error'] !=0){
            $errores['avatar'] = "Debe subir su avatar";
        }elseif($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png'){
            $errores['avatar'] = "Debe seleccionar un archivo de tipo JPG ó PNG ó JPEG";
        }

    }

    return $errores;
}

//Función que arma el registro del usuario
function armarUsuario($datos){
    //dd($datos);
    $usuario = [
        "nombre" => $datos['nombre'],
        "apellido" => $datos['apellido'],
        "email" => $datos['email'],
        "password" => $datos['password'],
        "perfil" => 1
    ];
    //dd($usuario);
    return $usuario;
}
//Armar imagen
function armarImagen($imagen){
    //dd($imagen);
    $avatar = $imagen['avatar']['name'];
    $ext = pathinfo($avatar,PATHINFO_EXTENSION);
    $archivoOrigen = $imagen['avatar']['tmp_name'];
    $archivoDestino = dirname(__DIR__).'/imagenes/';
    $avatar = uniqid('avatar-').'.'.$ext;
    //dd($avatar);
    $archivoDestino = $archivoDestino.$avatar;
    //Voy a guardar en el servidor la imagen o el archivo
    move_uploaded_file($archivoOrigen,$archivoDestino);
    //dd($avatar);
    return $avatar;
}    


//Función para guardar el usuario armado 
function guardarUsuario($usuario){
    //dd($usuario);
    //Como recibimos un archivo en formato array asociativo, debemos convertirlo a un archivo en formato JSON
    $archivoJSON = json_encode($usuario);
    //dd($archivoJSON);
    file_put_contents("datos.json", $archivoJSON.PHP_EOL,FILE_APPEND); 
}

//Función para conectar con la Base de Datos
//                Servidor(locahost) ,Base de Datos(mascotas), Usuario(root), password("")
function conexion($host,$dbname,$usuario,$password){
    try{
        $dsn = "mysql:host=$host;dbname=$dbname";
        $bd = new PDO($dsn, $usuario, $password);
        return $bd;
    }catch(PDOException $error){
        echo "<h2 style='color:white; text-align:center; background-color:tomato; padding:20px'> Upps ! Ocurrio un error " . $error->getMessage() ."</h2>";
        exit;
    }
    
}

//Crear función para guardar los datos en la Base de Datos
function guardarUsuarioBD($bd,$tabla,$datos,$imagen){
    //1.- Organizar los datos a guardar
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $email = $datos['email'];
    $password = password_hash($datos['password'],PASSWORD_DEFAULT) ;
    $perfil = 1; 
    $avatar = $imagen;   
    //2.- Armar la consulta
    //                            Nombres de los campos en la tabla
    $sql = "insert into $tabla (nombre,apellido,email,password,perfil,avatar) values (:nombre,:apellido,:email,:password,:perfil,:avatar)";
    //3.- Preparar la consulta
    $query = $bd->prepare($sql);
    //4.- Continuo con la preparación de la consulta de manera blindada
    $query->bindValue(':nombre', $nombre);
    $query->bindValue(':apellido', $apellido);
    $query->bindValue(':email', $email);
    $query->bindValue(':password', $password);
    $query->bindValue(':perfil', $perfil);
    $query->bindValue(':avatar',$avatar);
    //5.- Ejecutar la consulta
    $query->execute();
}
//Función para Listar los usuarios registrados en la tabla ( usuarios ) de la Base de datos

function listarUsuarios($bd,$tabla){
    //1.- Armar la consulta
    $sql = "select * from  $tabla";
    //2.- Preparar la consulta
    $query = $bd->prepare($sql);
    //3.- Ejecutar la consulta
    $query->execute();
    //4.- Traer los datos de la consulta
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    //dd($usuarios);
    return $usuarios;
}


//------------------------------------------------------
//Aquí dispongo las funciones del Login
//------------------------------------------------------
function validarUsuarioLogin($datos){
    $errores =[];
    if (trim($datos['email']) === '') {
        $errores['email']  = "El campo email no puede estar vacio";
    }
    if (trim($datos['password']) === '') {
        $errores['password']  = "El campo clave no puede estar vacio";
    }else if (strlen(trim($datos['password']))<6) {
        $errores['password']  = "El campo clave no puede tener menos de 6 caracteres";
    }

    return $errores;
}

//Buscamos por email al usuario que se está logueando
function buscarPorEmail($bd,$tabla,$email){
    //1.- Armar la consulta
    $sql = "select * from $tabla where email = '$email'";
    //2.- Preparar la consulta
    $query = $bd->prepare($sql);
    //3.- Ejecutar la consulta
    $query->execute();
    //4.- Traer los datos de la consulta
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    //dd($usuario);
    return $usuario;
}

//Función para setear el usuario (Session - Cookies)
function seteoUsuario($usuario,$datos){
    //dd($datos);
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['apellido'] = $usuario['apellido'];
    $_SESSION['perfil'] = $usuario['perfil'];
    $_SESSION['avatar'] = $usuario['avatar'];
    if(isset($datos['recordarme'])){
        //dd('El usuario pidio que lo redordaramos en su navegador');
        // Tiempo de la cookie a razon de 10 años 60*60*24*365*10
        setcookie('email',$datos['email'], time()+ 3600);
        setcookie('password',$datos['password'], time() + 3600);
        setcookie('nombre',$usuario['nombre'], time() + 3600);
        setcookie('apellido',$usuario['apellido'], time() + 3600);
        setcookie('perfil',$usuario['perfil'], time() + 3600);
        setcookie('avatar',$usuario['avatar'], time() + 3600);
    }
    //dd('No hay cookies');
}

//Función encgada de determin el ingreso o no al usuario

function ingresarUsuario(){
    if(isset($_SESSION['email'])){
        return true;
    }else{
        if(isset($_COOKIE['email'])){
            $_SESSION['email'] = $_COOKIE['email'];
            $_SESSION['password'] = $_COOKIE['password'];
            $_SESSION['nombre'] = $_COOKIE['nombre'];
            $_SESSION['apellido'] = $_COOKIE['apellido'];
            $_SESSION['perfil'] = $_COOKIE['perfil'];
            $_SESSION['avatar'] = $_COOKIE['avatar'];
            return true;
        }
        return false;
    }

}


//Función que se enge enviar el email al usuario
function enviarEmail($datos){
    //Aquí debo disponer los datos de la persona a la cual se le enviará el corro
    $email = $datos['email'];
    $nombreCompleto = $datos['nombre'].' '.$datos['apellido'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'angel.daniel.fuentes.segura@gmail.com';                     // SMTP username
        //Aquí deben colocar la clave de su correo electrónico
        $mail->Password   = 'MiSuperClaveSecreta';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('angel.daniel.fuentes.segura@gmail.com', 'Angel Daniel Fuentes');
        $mail->addAddress($email, $nombreCompleto);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Gracias por registrarte en nuestro sitio web';
        $mail->Body    = 'Muy pronto nos estaremos contactando y te haremos llegar nuevos recursos y eventos que vamos a realizar <b>Muchas gracias por preferirnos!</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Correo enviado de manera satisfactoria';
        //exit;
    } catch (Exception $e) {
        echo "El correo no se logro enviar: {$mail->ErrorInfo}";
        //exit;
    }
}
































