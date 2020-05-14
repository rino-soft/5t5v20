<?php

class qr_cod_model extends CI_Model {

    function __construct() {
        // include (base_url() . 'utilidades/phpqrcode/phpqrcode.php');
        //echo "BASE URL ======>>>> require ".base_url() . 'utilidades/phpqrcode/phpqrcode.php';
    }

    function generar_firma_QR($codigo) {
        $datos =explode('?', $codigo, 2);
        echo "nombre :".$datos[0]."<br>";
        echo "Codigo :".$datos[1]."<br>";
        $direccion = str_replace("application\models", "imagenesweb\\firmas_QR\\", __DIR__);
        echo 'direccion :'. $direccion;
        $PNG_WEB_DIR = 'archivosPng/';
        include "phpqrcode.php";
        QRcode::png($datos[1], $direccion .$datos[0].".png", "L", 3, 2);//jpg, png tipo de imagen
              
    }
    function generar_QR_factura_venta($codigo) {
        $datos =explode('?', $codigo, 2);
        echo "nombre :".$datos[0]."<br>";
        echo "Codigo :".$datos[1]."<br>";
        $direccion = str_replace("application\models", "imagenesweb\\factura_venta_QR\\", __DIR__);
        echo 'direccion :'. $direccion;
        $PNG_WEB_DIR = 'archivosPng/';
        include "phpqrcode.php";
        QRcode::png($datos[1], $direccion .$datos[0].".png", "M", 3, 2);//jpg, png tipo de imagen
              
    }
    function generar_QR_nota_fiscal($codigo) {
        $datos =explode('?', $codigo, 2);
        echo "nombre :".$datos[0]."<br>";
        echo "Codigo :".$datos[1]."<br>";
        $direccion = str_replace("application\models", "imagenesweb\\nota_fiscal_QR\\", __DIR__);
        echo 'direccion :'. $direccion;
        $PNG_WEB_DIR = 'archivosPng/';
        include "phpqrcode.php";
        QRcode::png($datos[1], $direccion .$datos[0].".png", "M", 3, 2);//jpg, png tipo de imagen
              
    }
    function generar_QR_credencial($codigo) {
        $datos =explode('?', $codigo, 2);
        echo "<br>nombre :".$datos[0]."<br>";
        echo "Codigo :".$datos[1]."<br>";
        $direccion = str_replace("application\models", "imagenesweb\\credencial_QR\\", __DIR__);
        echo 'direccion :'. $direccion;
        $PNG_WEB_DIR = 'archivosPng/';
        include "phpqrcode.php";
        QRcode::png($datos[1], $direccion .$datos[0].".png", "M", 3, 2);//jpg, png tipo de imagen
              
    }

}

?>
