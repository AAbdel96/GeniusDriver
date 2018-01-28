<?PHP

include_once 'PeopleDB.php';
include_once 'PeopleAPI.php';
include_once 'Respuesta.php';

if (isset($_POST['image'])) {


    $imagen = $_POST['image'];
    $email = $_POST['email'];
    $name_photo = $_POST['nombre_imagen'];





    //insertamos la imagen en la tabla del usuario con solo el email
    $persona = new PeopleDB();


    $nombre_imagen_completo = $name_photo . ".jpeg";

    $ret = $persona->insert_image($nombre_imagen_completo, $email);


    //lo que vamos a hacer va a ser dividir el email desde la arroba

    $parts = explode('@', $email);

    $name_user = $parts[0];




    $carpeta = 'uploads/imagenes/'.$name_user;
    
    if (!file_exists($carpeta)) {

        mkdir($carpeta, 777, true);
        $upload_folder = "uploads/imagenes/" . $name_user;
        $path = "$upload_folder/$name_photo.jpeg";
        //file_put_contents('prueba_imagen.php', $path);
        
        if (file_put_contents($path, base64_decode($imagen)) != false) {

            
            //para poder hacr los graficos luego 
            $people2 = new PeopleDB;
            $date = date('Y/m/d H:i:s');
            $date_recortada = date('l', strtotime($$date));
            $ret = $people2->sumar_imagen($date_recortada);

            echo "upload_success";
            exit;
        } else {
            echo "upload_failed";
            exit;
        }
    } else {
        $upload_folder = "uploads/imagenes/" . $name_user;
        $path = "$upload_folder/$name_photo.jpeg";

        if (file_put_contents($path, base64_decode($imagen)) != false) {

            file_put_contents('filename55.php', "he entrado en el if");
            //para poder hacr los graficos luego 
            $people2 = new PeopleDB;
            $date = date('Y/m/d H:i:s');
            $date_recortada = date('l', strtotime($$date));
            $ret = $people2->sumar_imagen($date_recortada);

            echo "upload_success";
            exit;
        } else {
            echo "upload_failed";
            exit;
        }
    }
} else {
    echo "image_not_in";
    exit;
}
?>