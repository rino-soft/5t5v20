/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//funciones para generar graficas ..... modulo de transportes
function recargar_grafica(el1,el2,url)
{
    //alert(url+"/"+$("#"+el1).val().replace(/\//g, "-")+"/"+$("#"+el2).val().replace(/\//g, "-"));
    
    window.location=url+"/"+$("#"+el1).val().replace(/\//g, "-")+"/"+$("#"+el2).val().replace(/\//g, "-");
}
function graf_cantidad_alq_prop_empresa(div,datos,serieP,serieA){
    datosSerie=datos.split("|");
    serP=serieP.split("|");
    serA=serieA.split("|");
   // alert(serieP+"---"+serieA)
   seriP=[];
   seriA=[];
    for( i=0;i<serP.length;i++)
    {
         seriP[i]= parseInt(serP[i]);   
         seriA[i]= parseInt(serA[i]);   
        }
       
    $('#'+div ).highcharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Vehiculos Propios/Alquilados'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 0,
            y: 0,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: datosSerie,
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {// para la línea vertical
                text: 'Cantidad vehiculo'
            }
        },
        tooltip: { // descripcion de los puntos
            shared: true,
            valueSuffix: ' vehiculos'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{ //con_can_a //con_can_p
            marker: {
                radius: 4
                    
            },
            lineWidth:1,
            name: 'Propios',
            data: seriP
        }, {
            marker: {
                radius: 4
            },
            lineWidth:1,
            name: 'Alquilados',
            data: seriA
        }]
    });

}
function asignado_proyecto_pro_alq(div,listado_proy){
    
 //alert(listado_proy);
    datosSerie=listado_proy.split("*");
  var datas = new Array(); 
  var drill= new Array(); 
    for(i=0;i<datosSerie.length-1;i++)
    {       
        datos=datosSerie[i].split("|");
        dato_drill=datos[0];
         if(datos[1]==0){
            dato_drill=null; 
         }
         
        datas[i]=({name:datos[0],y:parseFloat(datos[1]),drilldown:dato_drill});
        drill[i]=({
                name: datos[0],
                id: datos[0],
                data: [
                    ["Propio", parseFloat(datos[2])],
                    ["Alquilado", parseFloat(datos[3])]
                ]
            })
    }
    conca="";
    for(j=0;j<datas.length;j++){
        conca+=datas[j].name+' '+datas[j].y
        
    }
  
    $('#'+div ).highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Asignacion por Proyecto'
        },
        subtitle: {
            text: 'Propios - Alquilados'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },
        series: [{
            name: "Proyecto",
            colorByPoint: true,
            data:datas
				}],
        drilldown: {
            series: drill
        }
    });

}

function asignacion_depar_proyecto(div,dep,tot,proy,porc)
{
    //alert("entrs");
    deptos=dep.split(",")
    totales=tot.split(",");
    proyectos=proy.split("*");
    porcentajes=porc.split("*");
     var datas = new Array(); 
     var drill= new Array(); 
    for(i=0;i<deptos.length-1;i++)
    {       
        proys_depto=proyectos[i].split(",");
        pscts_depto=porcentajes[i].split(",");
        var p_d=new Array();
        for(j=0;j<proys_depto.length-1;j++)
        {
            p_d[j]= new Array(proys_depto[j],parseFloat(pscts_depto[j]))
        }
        
        datas[i]=({name:deptos[i],y:parseFloat(totales[i]),drilldown:deptos[i]});
        drill[i]=({
                name: deptos[i],
                id: deptos[i],
                data: p_d
            })
    }
    
     $('#'+div ).highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Asignacion por Departamento'
        },
        subtitle: {
            text: 'Asignacion por proyecto'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} vehiculos<br>{point.percentage:.2f}%</b> del total'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} vehiculos<br>{point.percentage:.2f}%</b> del total<br/>'
        },
        series: [{
            name: "Proyecto",
            colorByPoint: true,
            data:datas
				}],
        drilldown: {
            series: drill
        }
    });
    
}



///adi nuevo
function alquilado_propio(div,can_a,can_p){

       //alert('entra');
         $('#container_5').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Porcentaje de vehiculos alquilados y propios'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Vehiculos",
                colorByPoint: true,
                data: [{
                    name: "Cantidad de vehiculos alquilados",
                    y: can_a
                },  {
                    name: "Cantidad de vehiculos propios",
                    y: can_p
                }]
            }]
        });
      
}
