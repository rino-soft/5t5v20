<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of estadisticas
 *
 * @author POMA RIVERO
 */
class generar_grafica_estadisticas extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct(); //echo 'constructor';
        // $this->load->model('vehiculo_model');
        // $this->load->model('proyecto_model');
        $this->load->model('generar_grafica_model');
        $this->load->model('menu_model');
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function vehiculos_alqui_prop($fechainiO, $fechafinO) {
     // echo 'funcionaaa'; 
        $fechaini = "2015-08-01";
        $fechafin = date('Y-m-d');
        if ($fechainiO != 0 and $fechafinO != 0) {
            $fechaini = $fechainiO;
            $fechafin = $fechafinO;
            echo "entro";
        }
       //  echo $fechafin."....".$fechaini;
        $fecha = date('Y-m-d', strtotime($fechaini));
      //  echo $fecha.",,,,,,".$fechafin;
        $i = 0;
        $vecfec = "";
        $vecCanP = "";
        $vecCanA = "";
        while ($fecha != $fechafin and $i < 500) {

            $cdiaP = $this->generar_grafica_model->cantidad_vehiculo_dia_contrato($fecha, "Propio");
            $cdiaA = $this->generar_grafica_model->cantidad_vehiculo_dia_contrato($fecha, "alquilado");
           // echo $fecha."---".$cdiaP."---".$cdiaA."<br>";
            if ($i > 0) {
                $vecfec.="|";
                $vecCanP.="|";
                $vecCanA.="|";
            }
            $vecfec.=$fecha;
            $vecCanP.=$cdiaP;
            $vecCanA.=$cdiaA;

            $fecha = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));
            $i++;
        }
        $data['fechasG'] = $vecfec;
        $data['canPropG'] = $vecCanP;
        $data['canAlqG'] = $vecCanA;
        $data['fec1'] = $fechaini;
        $data['fec2'] = $fechafin;
        $this->load->view('graficas_estadisticas/alquilado_propio_empresa_view', $data);
    }

    // asignaciones por proyecto / alquilados propios
    function asig_proyecto_alquilado_propio() 
    {
        // echo 'entraa';
        //listado de proyectos asignados
        $resultado_listado = $this->generar_grafica_model->listado_asignaciones_proyecto();
        $data['listado_proyecto'] = $resultado_listado;

       
        $this->load->view('graficas_estadisticas/asignado_proyecto_pro_alq_view', $data);
    }

    // grafica asig departamento por proyecto
    function asig_depar_por_proyecto() {
        $lista_vehiculo = $this->generar_grafica_model->listar_vehiculo_estado_activo();
        $vector = array('Santa Cruz' => array(), 'La Paz' => array(), 'Cochabamba' => array(), 'Potosi' => array(), 'Oruro' => array(), 'Pando' => array(), 'Beni' => array(), 'Tarija' => array(), 'Sucre' => array(), 'Sin asignacion' => array());
        $sitio = array('Santa Cruz', 'La Paz', 'Cochabamba', 'Potosi', 'Oruro', 'Pando', 'Beni', 'Tarija', 'Sucre', 'Sin asignacion');
        // $vector2=array();
        $vector_cant = array('Santa Cruz' => array(), 'La Paz' => array(), 'Cochabamba' => array(), 'Potosi' => array(), 'Oruro' => array(), 'Pando' => array(), 'Beni' => array(), 'Tarija' => array(), 'Sucre' => array(), 'Sin asignacion' => array());
        $gran_total = $lista_vehiculo->num_rows();
        foreach ($lista_vehiculo->result()as $reg) {
            $city = $this->generar_grafica_model->buscar_departamento_asignado_proy($reg->id_vehiculo);
            array_push($vector[$city[0]], $city);
        }
         $data['deptos']="";
         $data['totales']="";
        $data['proyectos']="";
        $data['porcentajes_proy']="";
        for ($i = 0; $i < count($sitio); $i++) {
            $vec = $vector[$sitio[$i]];
            echo "sitio ".$sitio[$i]."<br>";
            for($a=0;$a<count($vec);$a++)
            {
                $vec1 = $vec[$a];
                echo $a.")".$vec1[0]." | ".$vec1[1]." | ".$vec1[2]." | ".$vec1[3]."<br>";
            }
            echo "******************************************<br>";
            $res_nom = array();
            $res_pct = array();
			
            for ($j = 0; $j < count($vec); $j++) {
                $vec1 = $vec[$j];
                $sw = 0;
				//echo "<br>";
				//print_r($res_nom);
				//echo "<br>";
				//echo "for k=0 hasta ".count($res_nom)."<br>";
				
                for ($k = 0; $k < count($res_nom); $k++) {
                    if ($res_nom[$k] == $vec1[2]) {
                        $res_pct[$k] ++;
                        //$res_pct[$k] = $res_pct[$k] + count($vec);
						//$res_pct[$k] = round($res_pct[$k] + (100 / (count($vec))),2);
                        $sw = 1;
                    }
					
                }
				/*print_r ($res_nom);
				echo " <br>";
				print_r ($res_pct);
				echo "termina for <br>";
				echo "--------------------------------------<br>";
                */if ($sw == 0) {
                    array_push($res_nom, $vec1[2]);
                    array_push( $res_pct, 1);
                    //array_push( $res_pct, count($vec));
					//array_push( $res_pct, round(100 / (count($vec)),2));
                }
            }
         /* $vector_cant[$sitio[$i]][0] = count($vec) * 100 / $gran_total; 
            $vector_cant[$sitio[$i]][1] = $res_nom;
            $vector_cant[$sitio[$i]][2] = $res_pct;
        */
         $data['deptos'].=$sitio[$i].",";
         $data['totales'].=count($vec).",";
         
         for($k=0;$k<count($res_nom);$k++)
         {
             $data['proyectos'].=$res_nom[$k].",";
             $data['porcentajes_proy'].=$res_pct[$k].",";
         }
         $data['proyectos'].="*";
         $data['porcentajes_proy'].="*";
       }
       $this->load->view('graficas_estadisticas/asignado_departa_por_proy_view', $data);
        
    }

    function estadistica() 
    {
        $lista_vehiculo = $this->generar_grafica_model->listar_vehiculo_estado_activo();
        $vector = array('Santa Cruz' => 0, 'La Paz' => 0, 'Cochabamba' => 0, 'Potosi' => 0, 'Oruro' => 0, 'Pando' => 0, 'Beni' => 0, 'Tarija' => 0, 'Sucre' => 0, 'Sin asignacion' => 0);
        $sitio = array('Santa Cruz', 'La Paz', 'Cochabamba', 'Potosi', 'Oruro', 'Pando', 'Beni', 'Tarija', 'Sucre', 'Sin asignacion');

        foreach ($lista_vehiculo->result()as $reg) {

            $city = $this->vehiculo_model->buscar_departamento_asignado($reg->id_vehiculo);
            $vector[$city]++;
            //  echo '<br>'.$city.'--'.$vector[$city];
        }
        $total = $lista_vehiculo->num_rows();
        $grafica = array();
        for ($i = 0; $i < count($vector); $i++) {
            $grafica[$i] = array($sitio[$i], ($vector[$sitio[$i]] * 100) / $total);
            // echo '<br>tot'.$vector[$sitio[$i]].'*****conversion ' .$sitio[$i].'----'.($vector[$sitio[$i]]*100)/$total;
        }
        $this->load->library('highcharts');
        $serie['data'] = $grafica;
        $callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
        @$tool->formatter = $callback;
        @$plot->pie->dataLabels->formatter = $callback;
        $this->highcharts
                ->set_type('pie')
                ->set_serie($serie)
                ->set_tooltip($tool)
                ->set_plotOptions($plot);
        $data['charts'] = $this->highcharts->render();
        $this->load->view('vehiculos/charts', $data);
    }
    function alquilado_propio()
    {
                $this->load->library('highcharts');
                $listar_vehiculos_propio_alq=  $this->generar_grafica_model->listar_vehiculo_propio_alquilado();
               
                 $can_a=$listar_vehiculos_propio_alq->row(0)->cant;
                 $can_p=$listar_vehiculos_propio_alq->row(1)->cant;
                 $total=$can_a+$can_p;
                 $con_can_a=($can_a*100)/$total;
                 $con_can_p=($can_p*100)/$total;
                 $serie['data']= array(
			array('Vehiculos Alquilados',$con_can_a), 
                        array('Vehiculos Propios',$con_can_p)
                    
                 );
		$callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
		@$tool->formatter = $callback;
		@$plot->pie->dataLabels->formatter = $callback;
		$this->highcharts
			->set_type('pie')
			->set_serie($serie)
			->set_tooltip($tool)
			->set_plotOptions($plot);
		$data['charts'] = $this->highcharts->render();
		$this->load->view('vehiculos/charts', $data);
    }
    function asignacion_proyecto()
    {
                $this->load->library('highcharts');
                $resultado_listado=  $this->generar_grafica_model->listado_asignaciones_proyecto();
                $serie['data']= $resultado_listado;
		$callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
		@$tool->formatter = $callback;
		@$plot->pie->dataLabels->formatter = $callback;
		$this->highcharts
			->set_type('pie')
			->set_serie($serie)
			->set_tooltip($tool)
			->set_plotOptions($plot);
		$data['charts'] = $this->highcharts->render();
		$this->load->view('vehiculos/charts', $data);
     }
        
    function fusionado($fechainiO, $fechafinO)
    {
        //asig_proyecto_alquilado_propio
        $resultado_listado = $this->generar_grafica_model->listado_asignaciones_proyecto();
        $data['listado_proyecto'] = $resultado_listado;
        //$this->load->view('graficas_estadisticas/asignado_proyecto_pro_alq_view', $data);  
        ////finish function
        
        //asig_depar_por_proyecto
        $lista_vehiculo = $this->generar_grafica_model->listar_vehiculo_estado_activo();
        $vector = array('Santa Cruz' => array(), 'La Paz' => array(), 'Cochabamba' => array(), 'Potosi' => array(), 'Oruro' => array(), 'Pando' => array(), 'Beni' => array(), 'Tarija' => array(), 'Sucre' => array(), 'Sin asignacion' => array());
        $sitio = array('Santa Cruz', 'La Paz', 'Cochabamba', 'Potosi', 'Oruro', 'Pando', 'Beni', 'Tarija', 'Sucre', 'Sin asignacion');
        // $vector2=array();
        $vector_cant = array('Santa Cruz' => array(), 'La Paz' => array(), 'Cochabamba' => array(), 'Potosi' => array(), 'Oruro' => array(), 'Pando' => array(), 'Beni' => array(), 'Tarija' => array(), 'Sucre' => array(), 'Sin asignacion' => array());
        $gran_total = $lista_vehiculo->num_rows();
        foreach ($lista_vehiculo->result()as $reg) {
            $city = $this->generar_grafica_model->buscar_departamento_asignado_proy($reg->id_vehiculo);
            array_push($vector[$city[0]], $city);
        }
         $data['deptos']="";
         $data['totales']="";
        $data['proyectos']="";
        $data['porcentajes_proy']="";
        for ($i = 0; $i < count($sitio); $i++) {
            $vec = $vector[$sitio[$i]];
            //echo "sitio ".$sitio[$i]."<br>";
            //for($a=0;$a<count($vec);$a++)
           // {
            //    $vec1 = $vec[$a];
            //    echo $a.")".$vec1[0]." | ".$vec1[1]." | ".$vec1[2]." | ".$vec1[3]."<br>";
           // }
           // echo "******************************************<br>";
            $res_nom = array();
            $res_pct = array();
			
            for ($j = 0; $j < count($vec); $j++) {
                $vec1 = $vec[$j];
                $sw = 0;
				//echo "<br>";
				//print_r($res_nom);
				//echo "<br>";
				//echo "for k=0 hasta ".count($res_nom)."<br>";
				
                for ($k = 0; $k < count($res_nom); $k++) {
                    if ($res_nom[$k] == $vec1[2]) {
                        $res_pct[$k] ++;
                        //$res_pct[$k] = $res_pct[$k] + count($vec);
						//$res_pct[$k] = round($res_pct[$k] + (100 / (count($vec))),2);
                        $sw = 1;
                    }
					
                }
				/*print_r ($res_nom);
				echo " <br>";
				print_r ($res_pct);
				echo "termina for <br>";
				echo "--------------------------------------<br>";
                */if ($sw == 0) {
                    array_push($res_nom, $vec1[2]);
                    array_push( $res_pct, 1);
                    //array_push( $res_pct, count($vec));
					//array_push( $res_pct, round(100 / (count($vec)),2));
                }
            }
         /* $vector_cant[$sitio[$i]][0] = count($vec) * 100 / $gran_total; 
            $vector_cant[$sitio[$i]][1] = $res_nom;
            $vector_cant[$sitio[$i]][2] = $res_pct;
        */
         $data['deptos'].=$sitio[$i].",";
         $data['totales'].=count($vec).",";
         
         for($k=0;$k<count($res_nom);$k++)
         {
             $data['proyectos'].=$res_nom[$k].",";
             $data['porcentajes_proy'].=$res_pct[$k].",";
         }
         $data['proyectos'].="*";
         $data['porcentajes_proy'].="*";}
     
   /////////////finish function
       
       //vehiculos_alqui_prop
        $fechaini = date('Y-01-01');
        $fechafin = date('Y-m-d');
        if ($fechainiO != 0 and $fechafinO != 0) {
            $fechaini = $fechainiO;
            $fechafin = $fechafinO;
        }
       //  echo $fechafin."....".$fechaini;
        $fecha = date('Y-m-d', strtotime($fechaini));
      //  echo $fecha.",,,,,,".$fechafin;
        $i = 0;
        $vecfec = "";
        $vecCanP = "";
        $vecCanA = "";
        while ($fecha != $fechafin and $i < 500) {

            $cdiaP = $this->generar_grafica_model->cantidad_vehiculo_dia_contrato($fecha, "Propio");
            $cdiaA = $this->generar_grafica_model->cantidad_vehiculo_dia_contrato($fecha, "alquilado");
           // echo $fecha."---".$cdiaP."---".$cdiaA."<br>";
            if ($i > 0) {
                $vecfec.="|";
                $vecCanP.="|";
                $vecCanA.="|";
            }
            $vecfec.=$fecha;
            $vecCanP.=$cdiaP;
            $vecCanA.=$cdiaA;

            $fecha = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));
            $i++;
        }
        $data['fechasG'] = $vecfec;
        $data['canPropG'] = $vecCanP;
        $data['canAlqG'] = $vecCanA;
        $data['fec1'] = $fechaini;
        $data['fec2'] = $fechafin;
        //$this->load->view('graficas_estadisticas/alquilado_propio_empresa_view', $data);
        ///fin
        
        //function alquilado_propio
         $this->load->library('highcharts');
         $listar_vehiculos_propio_alq=  $this->generar_grafica_model->listar_vehiculo_propio_alquilado();
               
                 $can_a=$listar_vehiculos_propio_alq->row(0)->cant;
                 $can_p=$listar_vehiculos_propio_alq->row(1)->cant;
                 $total=$can_a+$can_p;
                 $con_can_a=($can_a*100)/$total; // cantidad de vehiculos alquilados
                 $con_can_p=($can_p*100)/$total;  // cantidad de vehiculos propios 
              
                 $data['can_a']=$con_can_a;
                 $data['can_p']=$con_can_p;
                 $data['total']=$total;
                
         //finish function
          
         //function asignacion_proyecto
         
                $resultado_listado=  $this->generar_grafica_model->listado_asignaciones_proyecto();
                $serie_dos['data']= $resultado_listado;
		$callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
		@$tool->formatter = $callback;
		@$plot->pie->dataLabels->formatter = $callback;
		$this->highcharts
			->set_type('pie')
			->set_serie($serie_dos)
			->set_tooltip($tool)
			->set_plotOptions($plot);
		$data['charts_dos'] = $this->highcharts->render();
		//$this->load->view('vehiculos/charts', $data);

            //finish function
        $this->load->view('graficas_estadisticas/vistas_fusionadas_graficas_view', $data);
    }

}

?>
