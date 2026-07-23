<?php
/**
*@package pXP
*@file gen-MODDocumento.php
*@author  (Jose)
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
		$this->captura('oficina','varchar');
		$this->captura('desc_uo','varchar');
		
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
		
	function subirCorrespondencia()
    {
		    $cone = new conexion();
			$this->link = $cone->conectarpdo();
			$copiado = false;	
			$sql = "SELECT tamano FROM param.ttipo_archivo WHERE codigo='BIBLIOT'";
			$res = $this->link->prepare($sql);
			$res->execute();
			$result = $res->fetchAll(PDO::FETCH_ASSOC);
			$tamano_archivo=$result[0]['tamano'];
			  
			try{
				
                $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		  	    $this->link->beginTransaction();
                //var_dump($tamano_archivo);
				
				  if((($this->arregloFiles['file_correspondencia']['size'] / 1000) / 1024) > $tamano_archivo  ){
	                throw new Exception("El tamaño del Archivo supera a la configuración");
	
	            }
			    if ($this->arregloFiles['file_correspondencia']['name'] == "") {
					throw new Exception("El archivo no puede estar vacio");
				}
				
				$this->procedimiento='corres.ft_documento_ime';
		        $this->transaccion='BIBLIO_ARCH_MOD';
		        $this->tipo_procedimiento='IME';
				
				$version = $this->arreglo['nombre'] + 1;
		        $this->arreglo['nombre'] = $version;
				$this->arreglo['codigo']= str_replace('/','_',$this->arreglo['codigo']);
				$this->arreglo['codigo']= str_replace(' ','_',$this->arreglo['codigo']);
				//validar que no sea un archvo en blanco
				$file_name = $this->getFileName2('file_correspondencia', 'id_documento', '','_v'.$version);
				
			    //manda como parametro la url completa del archivo 
	            $this->aParam->addParametro('url', $file_name[2]);
	            $this->arreglo['url'] = $file_name[2];
	            $this->setParametro('url','url','varchar'); 
				
				
				//Define los parametros para la funcion	
		        $this->setParametro('id_documento','id_documento','integer');	
		        $this->setParametro('nombre','nombre','integer');
				
				      
	            //Ejecuta la instruccion
	            $this->armarConsulta();
				$stmt = $this->link->prepare($this->consulta);		  
			  	$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_ASSOC);				
				$resp_procedimiento = $this->divRespuesta($result['f_intermediario_ime']);
				
				
				if ($resp_procedimiento['tipo_respuesta']=='ERROR') {
					throw new Exception("Error al ejecutar en la bd", 3);
				}
				
	            
				  
	            if($resp_procedimiento['tipo_respuesta'] == 'EXITO'){
	              
				   //revisamos si ya existe el archivo la verison anterior sera mayor a cero
				   $respuesta = $resp_procedimiento['datos'];
				     //cipiamos el nuevo archivo 
	               $this->setFile('file_correspondencia','id_correspondencia', false,100000 ,array('doc','pdf','docx','jpg','jpeg','bmp','gif','png','PDF','DOC','DOCX','xls','xlsx','XLS','XLSX','rar'), $folder = '','_v'.$version);
	            }
				
				
				$this->link->commit();
				$this->respuesta=new Mensaje();
				$this->respuesta->setMensaje($resp_procedimiento['tipo_respuesta'],$this->nombre_archivo,$resp_procedimiento['mensaje'],$resp_procedimiento['mensaje_tec'],'base',$this->procedimiento,$this->transaccion,$this->tipo_procedimiento,$this->consulta);
				$this->respuesta->setDatos($respuesta);
			}
    		catch (Exception $e) {
		    		
								
		    	$this->link->rollBack(); 
				
				
		    	$this->respuesta=new Mensaje();
              if ($e->getCode() == 3) {//es un error de un procedimiento almacenado de pxp
					$this->respuesta->setMensaje($resp_procedimiento['tipo_respuesta'],$this->nombre_archivo,$resp_procedimiento['mensaje'],$resp_procedimiento['mensaje_tec'],'base',$this->procedimiento,$this->transaccion,$this->tipo_procedimiento,$this->consulta);
				} else if ($e->getCode() == 2) {//es un error en bd de una consulta
					$this->respuesta->setMensaje('ERROR',$this->nombre_archivo,$e->getMessage(),$e->getMessage(),'modelo','','','','');
				} else {//es un error lanzado con throw exception
					throw new Exception($e->getMessage(), 2);
				}
			
		}    
	   
				
	    return $this->respuesta;
	}

	function verDocumento(){

		//funcionon inserta correpondecia interna  y la esterna emitida
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='biblio.ft_documento_sel';
		$this->transaccion='CO_CORDOC_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		$this->setParametro('id_documento','id_documento','integer');

		//Definicion de la lista del resultado del query
		$this->captura('url','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;

	}
}
?>