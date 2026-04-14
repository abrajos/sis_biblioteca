<?php
/**
*@package pXP
*@file gen-MODDocumento.php
*@author  (admin)
*@date 14-04-2026 03:20:49
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODDocumento extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarDocumento(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='biblio.ft_documento_sel';
		$this->transaccion='BIBLIO_docum_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_documento','int4');
		$this->captura('id_ubicacion','int4');
		$this->captura('nombre','varchar');
		$this->captura('codigo','varchar');
		$this->captura('fecha_documento','date');
		$this->captura('metadatos','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('url','varchar');
		$this->captura('id_documento_fk','int4');
		$this->captura('campo_auxiliar','varchar');
		$this->captura('id_uo','int4');
		$this->captura('id_deposito','int4');
		$this->captura('contenedor','varchar');
		$this->captura('descripcion','varchar');
		$this->captura('tipo_documento','varchar');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='biblio.ft_documento_ime';
		$this->transaccion='BIBLIO_docum_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_ubicacion','id_ubicacion','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('fecha_documento','fecha_documento','date');
		$this->setParametro('metadatos','metadatos','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('url','url','varchar');
		$this->setParametro('id_documento_fk','id_documento_fk','int4');
		$this->setParametro('campo_auxiliar','campo_auxiliar','varchar');
		$this->setParametro('id_uo','id_uo','int4');
		$this->setParametro('id_deposito','id_deposito','int4');
		$this->setParametro('contenedor','contenedor','varchar');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('tipo_documento','tipo_documento','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='biblio.ft_documento_ime';
		$this->transaccion='BIBLIO_docum_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_documento','id_documento','int4');
		$this->setParametro('id_ubicacion','id_ubicacion','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('fecha_documento','fecha_documento','date');
		$this->setParametro('metadatos','metadatos','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('url','url','varchar');
		$this->setParametro('id_documento_fk','id_documento_fk','int4');
		$this->setParametro('campo_auxiliar','campo_auxiliar','varchar');
		$this->setParametro('id_uo','id_uo','int4');
		$this->setParametro('id_deposito','id_deposito','int4');
		$this->setParametro('contenedor','contenedor','varchar');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('tipo_documento','tipo_documento','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='biblio.ft_documento_ime';
		$this->transaccion='BIBLIO_docum_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_documento','id_documento','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>