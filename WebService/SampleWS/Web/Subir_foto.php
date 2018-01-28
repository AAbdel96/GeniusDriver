<!DOCTYPE html>
<html>
    <body>

        <form enctype="multipart/form-data" action="Subir_foto.php" method="POST">
            <input name="uploadedfile" type="file" />
            <input type="submit" value="Subir archivo" name="sumbit"/>
        </form>

    </body>
</html>


<?php
// Check if image file is a actual image or fake image

if (isset($_POST["sumbit"])) {
    
    $target_path = "../uploads/imagenes/";
    $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
        echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
    } else {
        echo "Ha ocurrido un error, trate de nuevo!";
    }
}
?>

