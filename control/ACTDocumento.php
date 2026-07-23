<?php
/**
*@package pXP
*@file gen-ACTDocumento.php
*@author  (Jose)
*@date 14-04-2026 03:20:49
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/
require_once(dirname(__FILE__) . '/../../lib/tcpdf/tcpdf_barcodes_2d.php');
require_once(dirname(__FILE__) . '/../reporte/RReportes.php');

require_once(dirname(__FILE__) . '/../../lib/PHPWord-master/src/PhpWord/Autoloader.php');
\PhpOffice\PhpWord\Autoloader::register();


require_once(dirname(__FILE__).'/../reporte/RCodigoQRCORR.php');


class ACTDocumento extends ACTbase{    
			
	function listarDocumento(){
		$this->objParam->defecto('ordenacion','id_documento');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODDocumento','listarDocumento');
		} else{
			$this->objFunc=$this->create('MODDocumento');
			
			$this->res=$this->objFunc->listarDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarDocumento(){
		$this->objFunc=$this->create('MODDocumento');	
		if($this->objParam->insertar('id_documento')){
			$this->res=$this->objFunc->insertarDocumento($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarDocumento(){
			$this->objFunc=$this->create('MODDocumento');	
		$this->res=$this->objFunc->eliminarDocumento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	
	function subirDocumento()
    {
        //crea el objetoFunSeguridad que contiene todos los metodos del sistema de seguridad
        $this->objFunSeguridad = $this->create('MODDocumento');
        $this->res = $this->objFunSeguridad->subirDocumento($this->objParam);
        //imprime respuesta en formato JSON
        $this->res->imprimirRespuesta($this->res->generarJson());

    }
	function verDocumento()
    {
        $this->objFunc = $this->create('MODDocumento');
        $this->res = $this->objFunc->verDocumento();
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
}

?>