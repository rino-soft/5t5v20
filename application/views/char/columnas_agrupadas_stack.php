<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Highcharts Example</title>

        <style type="text/css">
            .highcharts-figure, .highcharts-data-table table {
                min-width: 310px; 
                max-width: 100%;
                margin: 1em auto;
            }

            #<?= $contenedor ?> {
                height: 400px;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #EBEBEB;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }
            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }
            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }
            .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
                padding: 0.5em;
            }
            .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
            }
            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }

        </style>
    </head>
    <body>
        <script src="<?= base_url() ?>char/code/highcharts.js"></script>
        <script src="<?= base_url() ?>char/code/modules/exporting.js"></script>
        <script src="<?= base_url() ?>char/code/modules/export-data.js"></script>
        <script src="<?= base_url() ?>char/code/modules/accessibility.js"></script>

        <?php
        $codigo = "";
        for ($i = 0; $i < count($serie_nombre); $i++) {
            if ($codigo != "")
                $codigo.=",";
            $codigo .="{           
            name: '" . $serie_nombre[$i] . "',
          data: [" . $serie_data[$i] . "],
            stack:'TRA-A'       
            }";
        }
        //  echo $codigo;
//}
//echo "<br>";
//for ($i = 0; $i < count($items); $i++) {
//    
//    echo "{           
//            name: '".$items[$i]."',
//            data: [".$serieDatadetalle[$i]."],
//            stack:'TRA-A'       
//            },<br>";
//}
//        
        ?>

        <figure class="highcharts-figure">
            <div id="<?= $contenedor ?>"></div>

        </figure>



        <script type="text/javascript">
            Highcharts.chart('<?= $contenedor ?>', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '<?= $titulo ?>'
                },
                xAxis: {
                    categories: [<?= $categoria ?>]
                },
                yAxis: {
                    allowDecimals: true,
                    min: 0,
                    title: {
                        text: 'Monto (Bs)'
                    }
                },
                tooltip: {
                    formatter: function () {
                        return '<b>' + this.x + '</b><br/>' +
                                this.series.name + ': ' + this.y + '<br/>' +
                                'Total: ' + this.point.stackTotal;
                    }
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }

                },
                series: [
<?php
//for ($i = 0; $i < count($formularios); $i++) {
//    
//    echo "{           
//            name: '".$formularios[$i][2]."',
//            data: [".$serieData[$formularios[$i][2]]."],
//            stack:'TRA-A'       
//            },";
//}
echo $codigo;
?>
//    {
//        name: 'PEAJES',
//        data: [3, 4, 4, 2, 5],
//        stack:"TRA-A"
//    } 
                    //   {
//        name: 'PARCHADO',
//        data: [2, 5, 6, 2, 1]
//    }, {
//        name: 'GASOLINA',
//        data: [3, 0, 4, 4, 3]
//    },
//	{
//        name: 'HERRAMIENTAS',
//        data: [5, 2, 7, 8, 0]
//    },{
//        name: 'HERRAMIENTAS',
//        data: [3, 0, 4, 4, 3]
//    },
//	{
//        name: 'HERRAMIENTAS',
//        data: [5, 2, 7, 8, 0]
//    },{
//        name: 'RECARGAS',
//        data: [3, 0, 4, 4, 3]
//    },
//	{
//        name: 'INTERNET',
//        data: [5, 2, 7, 8, 0]
//    }
//	


                    /*
                     series: [{
                     name: 'TRA-A',
                     data: [5, 3, 4, 7, 2],
                     stack: 'Rendiciones'
                     }, {
                     name: 'TRA-B',
                     data: [3, 4, 4, 2, 5],
                     stack: 'Rendiciones'
                     }, {
                     name: 'SGR-A',
                     data: [2, 5, 6, 2, 1],
                     stack: 'Rendiciones'
                     }, {
                     name: 'SGR-B',
                     data: [3, 0, 4, 4, 3],
                     stack: 'Rendiciones'
                     },
                     {
                     name: 'SGR-C',
                     data: [5, 2, 7, 8, 0],
                     stack: 'Rendiciones'
                     },
                     */

                ]
            });
        </script>
    </body>
</html>
