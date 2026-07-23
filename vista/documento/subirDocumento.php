<?php
/**
*@package pXP
*@file gen-Sensor.php
*@author  (jmita)
*@date 027-04-2026 11:45:42
*@description permites subir archivos  de imegenes a la tabla de personas
*/
header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.SubirDocumento=Ext.extend(Phx.frmInterfaz,{

	constructor:function(config)
	{
		
		
    	//llama al constructor de la clase padre
		Phx.vista.SubirDocumento.superclass.constructor.call(this,config);
		this.init();	
		this.loadValoresIniciales()	
		
	},
	

	
	loadValoresIniciales:function()
	{
		
		Phx.vista.SubirDocumento.superclass.loadValoresIniciales.call(this);
		this.getComponente('id_documento').setValue(this.id_documento);
		this.argumentExtraSubmit.nombre = this.nombre;
		this.argumentExtraSubmit.codigo = this.codigo;
		this.argumentExtraSubmit.id_ubicacion = this.id_ubicacion;		
	},
	
	
	successSave:function(resp){
        Phx.CP.loadingHide();
        Phx.CP.getPagina(this.idContenedorPadre).reload();
        this.panel.close();
    },
				
	
	Atributos:[
	    {
   	      config:{
			labelSeparator:'',
			inputType:'hidden',
			name: 'id_documento'

		   },
		  type:'Field',
		  form:true 
		
	    },
		{
			//configuracion del componente
		   config:{
					fieldLabel: "Archivo",
					gwidth: 130,
					labelSeparator:'',
					inputType:'file',
					name: 'file_correspondencia',
					maxLength:150,
					anchor:'100%',
					validateValue:function(archivo){
						var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
						if(extension!='.pdf' && extension!='.PDF'){
								this.markInvalid('solo se admiten archivos PDF');
								return false
						}
						else{
							this.clearInvalid();
						    return true
						}
					}	
			},
			type:'Field',
		    form:true 
		}		
	],
	title:'Subir archivo',
	ActSave:'../../sis_biblioteca/control/Documento/subirDocumento',
	fileUpload:true,	
	}
)
	
</script>