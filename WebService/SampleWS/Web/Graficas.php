


<html>

    <head>
        <!--scripts para poder hacer los graficos-->

        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
        <script src="http://code.highcharts.com/stock/highstock.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>


        <script type="text/javascript">
            var chart;
            $(document).ready(function () {

                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'Registros_semanales', // Le doy el nombre a la gráfica
                        defaultSeriesType: 'line'	// Pongo que tipo de gráfica es
                    },
                    title: {
                        text: 'Numero de registros semanales'	// Titulo (Opcional)
                    },
                    
                    // Pongo los datos en el eje de las 'X'
                    xAxis: {
                        categories: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                        // Pongo el título para el eje de las 'X'
                        title: {
                            text: 'Dias'
                        }
                    },
                    yAxis: {
                        // Pongo el título para el eje de las 'Y'
                        title: {
                            text: 'Nº de registros'
                        }
                    },
                    // Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
                    tooltip: {
                        enabled: true,
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                    this.x + ': ' + this.y + ' ' + this.series.name;
                        }
                    },
                    // Doy opciones a la gráfica
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: true
                        }
                    },
                    // Doy los datos de la gráfica para dibujarlas
                    series: [                         
                        {
                            name: 'Visitas a la semana',
                            
                            
                            <?php
                                include_once '../PeopleDB.php';
                                include_once '../Respuesta.php';
                                
                                $persona = new PeopleDB();
                                $people2 = $persona->getregistros();
                                ?>
                            data: [<?php echo $people2[0]["numero"];?>, <?php echo $people2[1]["numero"];?>, <?php echo $people2[2]["numero"];?>, <?php echo $people2[3]["numero"];?>, <?php echo $people2[4]["numero"];?>,
                                <?php echo $people2[5]["numero"];?>, <?php echo $people2[6]["numero"];?>]
                        }],
                });
            });
        </script>
        
         <script type="text/javascript">
            var chart;
            $(document).ready(function () {

                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'Imagenes_semana', // Le doy el nombre a la gráfica
                        defaultSeriesType: 'line'	// Pongo que tipo de gráfica es
                    },
                    title: {
                        text: 'Numero de imaganes subidas semanales'	// Titulo (Opcional)
                    },
                    
                    // Pongo los datos en el eje de las 'X'
                    xAxis: {
                        categories: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                        // Pongo el título para el eje de las 'X'
                        title: {
                            text: 'Dias'
                        }
                    },
                    yAxis: {
                        // Pongo el título para el eje de las 'Y'
                        title: {
                            text: 'Nº de registros'
                        }
                    },
                    // Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
                    tooltip: {
                        enabled: true,
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                    this.x + ': ' + this.y + ' ' + this.series.name;
                        }
                    },
                    // Doy opciones a la gráfica
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: true
                        }
                    },
                    // Doy los datos de la gráfica para dibujarlas
                    series: [                         
                        {
                            name: 'Imagenes por semana',
                            
                            
                            <?php
                                include_once '../PeopleDB.php';
                                include_once '../Respuesta.php';
                                
                                $persona5 = new PeopleDB();
                                $people2 = $persona5->getimagenes_subidas();
                                
                                file_put_contents('filename.txt', print_r($people2, true));
                                ?>
                            data: [<?php echo $people2[0]["numero"];?>, <?php echo $people2[1]["numero"];?>, <?php echo $people2[2]["numero"];?>, <?php echo $people2[3]["numero"];?>, <?php echo $people2[4]["numero"];?>,
                                <?php echo $people2[5]["numero"];?>, <?php echo $people2[6]["numero"];?>]
                        }],
                });
            });
        </script>
        
        
        <script type="text/javascript">
            var chart;
            $(document).ready(function () {

                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'Modelo_semana', // Le doy el nombre a la gráfica
                        defaultSeriesType: 'line'	// Pongo que tipo de gráfica es
                    },
                    title: {
                        text: 'Numero de modelos alquilados por semana'	// Titulo (Opcional)
                    },
                    
                    // Pongo los datos en el eje de las 'X'
                    xAxis: {
                        categories: ['Captur', 'Golf', 'Q3', 'Megane', 'Clio', 'A6', 'Scirocco','Passat','Polo','R8','Iibiza','Toledo','Leon','Ateca','A1'],
                        // Pongo el título para el eje de las 'X'
                        title: {
                            text: 'Dias'
                        }
                    },
                    yAxis: {
                        // Pongo el título para el eje de las 'Y'
                        title: {
                            text: 'Nº de modelos'
                        }
                    },
                    // Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
                    tooltip: {
                        enabled: true,
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                    this.x + ': ' + this.y + ' ' + this.series.name;
                        }
                    },
                    // Doy opciones a la gráfica
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: true
                        }
                    },
                    // Doy los datos de la gráfica para dibujarlas
                    series: [                         
                        {
                            name: 'Numero de modelos alquilados',
                            
                            
                            <?php
                                include_once '../PeopleDB.php';
                                include_once '../Respuesta.php';
                                
                                $persona5 = new PeopleDB();
                                $people2 = $persona5->getmodelos_semana();
                                
                                file_put_contents('filename.txt', print_r($people2, true));
                                ?>
                            data: [<?php echo $people2[0]["numero"];?>, <?php echo $people2[1]["numero"];?>, <?php echo $people2[2]["numero"];?>, <?php echo $people2[3]["numero"];?>, <?php echo $people2[4]["numero"];?>,
                                <?php echo $people2[5]["numero"];?>, <?php echo $people2[6]["numero"]?>, <?php echo $people2[7]["numero"];?>, <?php echo $people2[8]["numero"];?>,<?php echo $people2[9]["numero"];?>,<?php echo $people2[10]["numero"];?>,
                                    <?php echo $people2[11]["numero"];?>,<?php echo $people2[12]["numero"];?>,<?php echo $people2[13]["numero"];?>,<?php echo $people2[14]["numero"];?>]
                        }],
                });
            });
        </script>
    </head>

    <body>
        <div id="Registros_semanales" style="width: 100%; height: 500px; margin: 0 auto"></div>
            <br>
            <br>
            <div id="Imagenes_semana" style="width: 100%; height: 500px; margin: 0 auto">   </div>
       
            <br>
            <br>
        <div id="Modelo_semana" style="width: 100%; height: 500px; margin: 0 auto"></div>
    </body>
</html>
