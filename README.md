# php-mysql-aplicacion-web
Desarrollo de una aplicación muy sencilla, desarrollada con HTML - Bootstrap - PHP - (PDO)- Mysql. (Login - Registro - Create Read Update Delete)

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

