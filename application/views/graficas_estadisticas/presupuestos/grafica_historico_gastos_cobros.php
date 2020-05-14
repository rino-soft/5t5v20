<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Monthly Average Temperature'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Bs'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
             credits: {
                enabled: false
            },
            series: [{
                    name: 'Gastos',
                    data: [745122.0, 56465.9, 979987.5, 143214.5, 18498.4, 26981.5, 294985.2, 69426.5, 24993.3, 16468.3, 441013.9, 98769.6]
                }, {
                    name: 'Cobros',
                    data: [38789.9, 46134.2, 32165.7, 89878.5, 16541.9, 118765.2, 17879.0, 11616.6, 116544.2, 18704.3, 611165.6, 454544.8]
                },{
                    name: 'ganancias',
                    data: [465563.9, 654644.2, 874455.7, 645258.5, 655411.9, 165445.2, 198577.0, 131664.6, 195874.2, 1198440.3, 949486.6,949444.8]
                }]
        });
    });
</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>