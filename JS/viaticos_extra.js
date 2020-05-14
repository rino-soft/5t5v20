function imprimir_reporte_vsupproy()
{
     burl = $('#b_url').val();
    mes=$("#mesrep :selected").val();
    anio=$("#aniorep :selected").val();
    proy=$("#proyrep :selected").val();
    
    direccion = burl + 'impresiones_pdf/reporte_viaticos_extraordinarios_proyecto/' + mes+"/"+anio+"/"+proy;
    miven = window.open(direccion, "reporte" + mes+anio, "menubar=0,location=1,status=1,scrollbars=0, width=900,height=600");

}