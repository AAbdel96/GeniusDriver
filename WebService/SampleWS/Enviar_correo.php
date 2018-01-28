<?php


// Building headers.
$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859';
$headers[] = 'X-Mailer: PHP/'. phpversion();


mail('pchack1996@gmail.com','Genius Driver Inc.','<html>
     <head>
        <title>Restablece tu contraseña</title>
     </head>
     <body>
       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
       <p>
         <strong>Enlace para restablecer tu contraseña</strong><br>
         
       </p>
     </body>
    </html>', implode(PHP_EOL, $headers));
?>

