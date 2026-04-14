<?php
/**
*@package pXP
*@file gen-MODUbicacion.php
*@author  (admin)
*@date 14-04-2026 03:20:53
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODUbicacion extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarUbicacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='biblio.ft_ubicacion_sel';
		$this->transaccion='BIBLIO_ubica_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_ubicacion','int4');
		$this->captura('id_lugar','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('observacion','varchar');
		$this->captura('oficina','varchar');
		$this->captura('nivel','varchar');
		$this->captura('estante','varchar');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_reg','int4');
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
			
	function insertarUbicacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='biblio.ft_ubicacion_ime';
		$this->transaccion='BIBLIO_ubica_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_lugar','id_lugar','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('observacion','observacion','varchar');
		$this->setParametro('oficina','oficina','varchar');
		$this->setParametro('nivel','nivel','varchar');
		$this->setParametro('estante','estante','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarUbicacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='biblio.ft_ubicacion_ime';
		$this->transaccion='BIBLIO_ubica_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_ubicacion','id_ubicacion','int4');
		$this->setParametro('id_lugar','id_lugar','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('observacion','observacion','varchar');
		$this->setParametro('oficina','oficina','varchar');
		$this->setParametro('nivel','nivel','varchar');
		$this->setParametro('estante','estante','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarUbicacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='biblio.ft_ubicacion_ime';
		$this->transaccion='BIBLIO_ubica_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_ubicacion','id_ubicacion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>