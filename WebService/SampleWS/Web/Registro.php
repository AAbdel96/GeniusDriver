
<?php
include_once '../PeopleDB.php';
include_once '../PeopleAPI.php';
include_once '../Respuesta.php';

$name = "";
$apellidos = "";
$telefono = "";
$codigo_postal = "";
$pais = "";
$localidad = "";
$confirmar_contrasena = "";
$email = "";
$confirmar_email = "";
$contrasena = "";


if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["nombre"]) &&
        isset($_POST["apellidos"]) && isset($_POST["localidad"]) && isset($_POST["codigo_postal"]) && isset($_POST["pais"]) && isset($_POST["telefono"]) && isset($_POST['confirmar_contrasena']) && isset($_POST['email2']) && isset($_POST["condiciones"])) {

    $name = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $confirmar_email = $_POST['email2'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $localidad = $_POST['localidad'];
    $codigo_postal = $_POST['codigo_postal'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];


    $people = new PeopleDB();

    $ret = $people->insert($name, $apellidos, $email, md5($contrasena), $localidad, $codigo_postal, $pais, $telefono);

    if ($contrasena == $confirmar_contrasena) {
        if ($email == $confirmar_email) {

            if (!$ret == '1') {

                echo "<script>alert('Correo actual en uso!');
               
                </script>";
            } else {
                
                $people2 = new PeopleDB;
                
                $date = date('Y/m/d H:i:s');
                
                $date_recortada = date('l', strtotime($$date));
                $ret = $people2->sumar_registro($date_recortada);
                
                
                echo "<script>alert('Te has registrado correctamente');
               

                </script>";
                
                header('Location: https://www.google.es/?gfe_rd=cr&ei=UgczWaqUEcSp8wfe-oHoDg&gws_rd=ssl');
            }
        } else {
            echo "<script>alert('Los correos no son iguales!');
              
                </script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no son iguales');              
                </script>";
    }
} else if (!$_POST) {
    
} else {

    if (!isset($_POST['condiciones'])) {

        echo "<script>alert('Acepta las condiciones!');              
                </script>";

        $name = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $confirmar_email = $_POST['email2'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $localidad = $_POST['localidad'];
        $codigo_postal = $_POST['codigo_postal'];
        $pais = $_POST['pais'];
        $telefono = $_POST['telefono'];
        
    } else {


        echo "<script>alert('Revisa todos los campos!');              
                </script>";

        $name = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $confirmar_email = $_POST['email2'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $localidad = $_POST['localidad'];
        $codigo_postal = $_POST['codigo_postal'];
        $pais = $_POST['pais'];
        $telefono = $_POST['telefono'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Genius Driver - Login de usuario</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="estilos/estilos_index.css">

        <link rel="stylesheet" type="text/css" href="estilos/estilo-registro_dentro.css">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>

    <body>
        <header>
            <a href="#"><div id="centrologo"><img src="img/logopngmini.png" width="90px" height="90px" /></div><div id="nombrelogo">Genius Driver</div></a>

            <nav>
                <a href="#" class="enlaces">Inicio</a>
                <a href="#" class="enlaces">Acerca de</a>

                <a href="#" class="enlaces">Login</a>
                <a href="#" class="enlaces">Registro</a>
            </nav>
        </header>

        <section>
            <form class="login" method="POST" action="http://localhost/SampleWS/Web/Registro.php">
                <h1 class="login-title">Registro</h1>
                <input type="text" name="nombre" class="login-input" placeholder="Nombre" value="<?php echo $name ?>" autofocus>
                <input type="text" name="apellidos" class="login-input" placeholder="Apellidos" autofocus value="<?php echo $apellidos ?>">
                <input type="email" name="email" class="login-input" placeholder="Correo" value="<?php echo $email ?>">
                <input type="email" name="email2" class="login-input" placeholder="Confirmar correo" value="<?php echo $confirmar_email ?>">
                <input type="password" name = "contrasena" class="login-input" placeholder="Contraseña" value="<?php echo $contrasena ?>">
                <input type="password" name = "confirmar_contrasena" class="login-input" placeholder="Confirmar contraseña"value="<?php echo $confirmar_contrasena ?>">
                <input type="text" name="localidad" class="login-input" placeholder="Localidad" value="<?php echo $localidad ?>">               
                <input type="text" name="codigo_postal" class="login-input" placeholder="Codigo postal" value="<?php echo $codigo_postal ?>">
                <input type="text" name="pais" class="login-input" placeholder="Pais" value="<?php echo $pais ?>">
                <input type="text" name="telefono" class="login-input" placeholder="Telefono de contacto" value="<?php echo $telefono ?>">               
                <input class="condiciones"type="checkbox" name="condiciones" id="checkbox_id" value="value1"><label  class="condiciones"for="checkbox_id" >He leido y aceptado el  <a href="Politicas.php" target="_blank">Aviso legal y la Política de privacidad está página.</a> </label>               
                <input type="submit" value="Entrar" class="login-button"> 
            </form>
        </section>
    </body>
</html>