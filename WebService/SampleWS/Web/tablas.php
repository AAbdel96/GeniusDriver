<html>

    <head>
        <link rel="stylesheet" type="text/css" href="estilos/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="estilos/Botones.css">




        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="js/people.js"></script>
        <script type="text/javascript" src="js/cars.js"></script>
        <script type="text/javascript" src="js/images.js"></script>


       

    </head>
    <body>
    </div>
    
    <br>
    <br>
    <table id="example" class="display" cellspacing="0" width="100%">
        
        
        
        
        
        
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>localidad</th>
                <th>Codigo postal</th>
                <th>Pais</th>
                <th>Telefono</th>
                <th>Matricula</th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>localidad</th>
                <th>Codigo postal</th>
                <th>Pais</th>
                <th>Telefono</th>
                <th>Matricula</th>
            </tr>
        </tfoot>
        <tbody>


            <?php
            //USUARIOS
            include_once '../PeopleDB.php';
            include_once '../Respuesta.php';


            $persona = new PeopleDB();
            $people2 = $persona->recuperar_usuarios();



            foreach ($people2 as $valor) {

                echo "<tr>";
                echo "<td>" .
                $valor['name'] . "</td>";
                echo "<td>" .
                $valor["email"] . "</td>";

                echo "<td>" .
                $valor["localidad"] . "</td>";
                echo "<td>" .
                $valor["codigo_postal"] . "</td>";

                echo "<td>" .
                $valor["pais"] . "</font></td>";

                echo "<td>" .
                $valor["telefono"] . "</td>";
                echo "<td>" .
                $valor["Matricula"] . "</td>";

                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
    <br>
    <br>

   
    <br>
    <br>
    <table id="cars" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Matricula</th>
                <th>Velocidad Maxima</th>
                <th>Capacidad Bateria</th>
                <th>Precio</th>


            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Matricula</th>
                <th>Velocidad Maxima</th>
                <th>Capacidad Bateria</th>
                <th>Precio</th>
            </tr>
        </tfoot>
        <tbody>


            <?php
            //USUARIOS
            include_once '../PeopleDB.php';
            include_once '../Respuesta.php';


            $persona = new PeopleDB();
            $people2 = $persona->recuperar_coches();

            foreach ($people2 as $valor) {

                echo "<tr>";
                echo "<td>" . $valor['Modelo'] . "</td>";
                echo "<td>" . $valor["Marca"] . "</td>";
                echo "<td>" . $valor["Matricula"] . "</td>";
                echo "<td>" . $valor["Vel_max"] . "</td>";
                echo "<td>" . $valor["Cap_bateria"] . "</td>";
                echo "<td>" . $valor["Precio"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <br>

    
    <br>
    <br>
    <table id="images" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Correo</th>
                <th>Nombre de la imagen</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Correo</th>
                <th>Nombre de la imagen</th>
            </tr>
        </tfoot>
        <tbody>


            <?php
            //USUARIOS
            include_once '../PeopleDB.php';
            include_once '../Respuesta.php';


            $persona = new PeopleDB();
            $people2 = $persona->recuperar_imagenes();



            foreach ($people2 as $valor) {

                echo "<tr>";
                echo "<td>" . $valor['id'] . "</td>";
                echo "<td>" . $valor["email"] . "</td>";
                echo "<td>" . $valor["nombre"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>


