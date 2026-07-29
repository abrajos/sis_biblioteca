<?php
/**
*@package pXP
*@file gen-Documento.php
*@author  (Jose)
*@date 14-04-2026 03:20:49
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Documento=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Documento.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})

		/*this.addButton('SubirDocumento', {
				text: 'Subir Documento',
				iconCls: 'bupload',
				disabled: false,
				handler: this.BSubirDocumento,
				tooltip: '<b>Subir archivo</b><br/>Permite actualizar el documento escaneado'
		    });
		
		this.addButton('VerDocumento', {
				grupo : [0, 1],
				text : 'Ver Documento',
				iconCls : 'bsee',
				disabled : false,
				handler : this.BVerDocumento,
				tooltip : '<b>Ver archivo</b><br/>Permite visualizar el documento escaneado'
			});*/

			this.addButton('archivo', {
                    argument: {imprimir: 'archivo'},
                    text: '<i class="fa fa-thumbs-o-up fa-2x"></i> archivo', /*iconCls:'' ,*/
                    disabled: false,
                    handler: this.archivo
                });
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_documento'
			},
			type:'Field',
			form:true 
		},
		
		{
			config:{
				name: 'nombre',
				fieldLabel: 'Nombre Documento',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:500
			},
				type:'TextField',
				filters:{pfiltro:'docum.nombre',type:'string'},
				id_grupo:1,
				grid:true,
				form:true,
				bottom_filter : true
		},
		{
			config:{
				name: 'codigo',
				fieldLabel: 'Código',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:500
			},
				type:'TextField',
				filters:{pfiltro:'docum.codigo',type:'string'},
				id_grupo:1,
				grid:true,
				form:true,
				bottom_filter : true
		},
		{
			config:{
				name: 'fecha_documento',
				fieldLabel: 'Fecha Documento',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				filters:{pfiltro:'docum.fecha_documento',type:'date'},
				id_grupo:1,
				grid:true,
				form:true,
				bottom_filter : true
		},
		{
			config: {
				name: 'id_uo',
				fieldLabel: 'Organigrama',
				allowBlank: false,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_organigrama/control/Uo/listarUo',
					id: 'id_uo',
					root: 'datos',
					sortInfo: {
						field: 'nombre_unidad',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_uo', 'nombre_unidad', 'codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'uo.nombre_unidad#uo.codigo'}
				}),
				valueField: 'id_uo',
				displayField: 'nombre_unidad',
				gdisplayField: 'desc_uo',
				hiddenName: 'id_uo',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_uo']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'uo.nombre_unidad',type: 'string'},
			grid: true,
			form: true
		},
		{
			config: {
				name: 'id_ubicacion',
				fieldLabel: 'Ubicación',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_biblioteca/control/Ubicacion/listarUbicacion',
					id: 'id_ubicacion',
					root: 'datos',
					sortInfo: {

						field: 'id_ubicacion',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_ubicacion', 'oficina','nombre'],
					remoteSort: true,
					baseParams: {par_filtro: 'ubica.oficina#ubica.estante'}
				}),
				valueField: 'id_ubicacion',
				displayField: 'oficina',
				gdisplayField: 'oficina',
				tpl:'<tpl for="."><div class="x-combo-list-item"><p>Oficina: {oficina}</p><p>Lugar:{nombre}</p> </div></tpl>',
				hiddenName: 'id_ubicacion',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['oficina']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'ubica.oficina',type: 'string'},
			grid: true,
			form: true
		},
		{
			config:{
				name: 'metadatos',
				fieldLabel: 'Metadatos',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:600
			},
				type:'TextField',
				filters:{pfiltro:'docum.metadatos',type:'string'},
				id_grupo:1,
				grid:true,
				form:true,
				bottom_filter : true
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'docum.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'url',
				fieldLabel: 'Enlace Documento',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:500
			},
				type:'TextField',
				filters:{pfiltro:'docum.url',type:'string'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config: {
				name: 'id_documento_fk',
				fieldLabel: 'id_documento_fk',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_/control/Clase/Metodo',
					id: 'id_',
					root: 'datos',
					sortInfo: {
						field: 'nombre',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_', 'nombre', 'codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
				}),
				valueField: 'id_',
				displayField: 'nombre',
				gdisplayField: 'desc_',
				hiddenName: 'id_documento_fk',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'movtip.nombre',type: 'string'},
			grid: false,
			form: false
		},
		{
			config:{
				name: 'campo_auxiliar',
				fieldLabel: 'campo_auxiliar',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:600
			},
				type:'TextField',
				filters:{pfiltro:'docum.campo_auxiliar',type:'string'},
				id_grupo:1,
				grid:false,
				form:false
		},
		
		{
			config: {
				name: 'id_deposito',
				fieldLabel: 'id_deposito',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_/control/Clase/Metodo',
					id: 'id_',
					root: 'datos',
					sortInfo: {
						field: 'nombre',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_', 'nombre', 'codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
				}),
				valueField: 'id_',
				displayField: 'nombre',
				gdisplayField: 'desc_',
				hiddenName: 'id_deposito',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'movtip.nombre',type: 'string'},
			grid: false,
			form: false
		},
		{
			config:{
				name: 'contenedor',
				fieldLabel: 'contenedor',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:500
			},
				type:'TextField',
				filters:{pfiltro:'docum.contenedor',type:'string'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'descripcion',
				fieldLabel: 'Descripción',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:500
			},
				type:'TextField',
				filters:{pfiltro:'docum.descripcion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'tipo_documento',
				fieldLabel: 'Tipo Documento',
				allowBlank: false,
				anchor: '80%',
				origen: 'CATALOGO',
				gdisplayField: 'accion',
				gwidth: 100,
				baseParams:{
						cod_subsistema:'BIBLIO',
						catalogo_tipo:'tdocumento__tipo_documento'
				},
				renderer:function (value, p, record){return String.format('{0}', record.data['accion']);}
			},
			type: 'ComboRec',
			id_grupo: 6,
			filters:{pfiltro:'docum.tipo_documento',type:'string'},
			grid: true,
			form: true
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'docum.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'docum.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'docum.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha Modif.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'docum.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Documentos',
	ActSave:'../../sis_biblioteca/control/Documento/insertarDocumento',
	ActDel:'../../sis_biblioteca/control/Documento/eliminarDocumento',
	ActList:'../../sis_biblioteca/control/Documento/listarDocumento',
	id_store:'id_documento',
	fields: [
		{name:'id_documento', type: 'numeric'},
		{name:'id_ubicacion', type: 'numeric'},
		{name:'nombre', type: 'string'},
		{name:'codigo', type: 'string'},
		{name:'fecha_documento', type: 'date',dateFormat:'Y-m-d'},
		{name:'metadatos', type: 'string'},
		{name:'estado_reg', type: 'string'},
		{name:'url', type: 'string'},
		{name:'id_documento_fk', type: 'numeric'},
		{name:'campo_auxiliar', type: 'string'},
		{name:'id_uo', type: 'numeric'},
		{name:'id_deposito', type: 'numeric'},
		{name:'contenedor', type: 'string'},
		{name:'descripcion', type: 'string'},
		{name:'tipo_documento', type: 'string'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'oficina', type: 'string'},
		{name:'desc_uo', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_documento',
		direction: 'ASC'
	},
	bdel:true,
	bsave:true,

	/*loadValoresIniciales : function() {

	Phx.vista.Documento.superclass.loadValoresIniciales.call(this);
		},*/
	
	/*BSubirDocumento: function () {
		var rec = this.sm.getSelected();
	      if (confirm('El documento a subir es: ?'+rec.data.codigo)){

				Phx.CP.loadWindows('../../../sis_biblioteca/vista/documento/subirDocumento.php',
				'Subir Documento',
				{
					modal: true,
					width: 500,
					height: 250
				}, rec.data, this.idContenedor, 'subirDocumento')
			}
	},
	
	
	BVerDocumento : function() {
				var rec = this.sm.getSelected();
				console.log('rec', 'ingresa aqui');
	
				Ext.Ajax.request({
					// form:this.form.getForm().getEl(),
					url : '../../sis_biblioteca/control/Documento/verDocumento',
					params : {
						id_documento : rec.data.id_documento
					},
					success : this.successVer,
					failure : this.conexionFailure,
					timeout : this.timeout,
					scope : this
				});
	
			},*/

	/*successVer : function(resp) {
			var reg = Ext.util.JSON.decode(Ext.util.Format.trim(resp.responseText));
			console.log(reg.datos[0].url);
			window.open(reg.datos[0].url);
			},*/
	
	archivo: function () {


					var rec = this.getSelectedData();

					//enviamos el id seleccionado para cual el archivo se deba subir
					rec.datos_extras_id = rec.id_documento;
					//enviamos el nombre de la tabla
					rec.datos_extras_tabla = 'tdocumento';
					//enviamos el codigo ya que una tabla puede tener varios archivos diferentes como ci,pasaporte,contrato,slider,fotos,etc
					rec.datos_extras_codigo = 'documen';

					//esto es cuando queremos darle una ruta personalizada
					//rec.datos_extras_ruta_personalizada = './../../../uploaded_files/favioVideos/videos/';

					Phx.CP.loadWindows('../../../sis_parametros/vista/archivo/Archivo.php',
						'Archivo',
						{
							width: 900,
							height: 400
						}, rec, this.idContenedor, 'Archivo');

			},		
	}
)
</script>
		
		
