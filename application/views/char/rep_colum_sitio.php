<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Highcharts Example</title>

        <style type="text/css">

            #container {
                height: 400px; 
            }

            .highcharts-figure, .highcharts-data-table table {
                min-width: 310px; 
                max-width: 100%;
                margin: 1em auto;
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

        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">

            </p>
        </figure>



        <script type="text/javascript">
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: null
                },
//    subtitle: {
//        text: 'Source: WorldClimate.com'
//    },
                xAxis: {
                    categories: [
<?= "'" . str_replace(",", "','", $mesesg) . "'" ?>
//            'Apr',
//            'May',
//            'Jun',
//            'Jul',
//            'Aug',
//            'Sep',
//            'Oct',
//            'Nov',
//            'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    title: {
                        text: 'Monto (Bs)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table style="font-size:10px;" >',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                            
                            
                        }
                    }
                },
                series: [
<?php
echo " 
{
name: 'PO',
data: [$posdata]
      

}, {
name: 'REND',
data: [$rendiciones]

}, {
name: 'UTIL',
data: [$utilidad]


}";
?>
                ]
            });
        </script>
    </body>
</html>
