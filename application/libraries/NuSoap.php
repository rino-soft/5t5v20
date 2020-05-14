<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Elaborado por Ruben Payrumani Ino, Proyecto SAV (Sistema de Administracion vehicular)
 * Libreria para Logeo
 */

class NuSoap {

    function __construct() {
// Por si se ejecuta en un servidor Windows
// require_once(str_replace("\\", "/", APPPATH).'libraries/NuSOAP/lib/nusoap'.EXT);
        require_once('nuSoap_lib/nusoap' . EXT);
    }

// end Constructor

    function index($no_cache) {
        
    }

// end function
}

// end Class
?>
