CREATE OR REPLACE FUNCTION "biblio"."ft_documento_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema de Biblioteca
 FUNCION: 		biblio.ft_documento_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'biblio.tdocumento'
 AUTOR: 		 (admin)
 FECHA:	        14-04-2026 03:20:49
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				14-04-2026 03:20:49								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'biblio.tdocumento'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_documento	integer;
			    
BEGIN

    v_nombre_funcion = 'biblio.ft_documento_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'BIBLIO_docum_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:49
	***********************************/

	if(p_transaccion='BIBLIO_docum_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into biblio.tdocumento(
			id_ubicacion,
			nombre,
			codigo,
			fecha_documento,
			metadatos,
			estado_reg,
			url,
			id_documento_fk,
			campo_auxiliar,
			id_uo,
			id_deposito,
			contenedor,
			descripcion,
			tipo_documento,
			id_usuario_reg,
			fecha_reg,
			usuario_ai,
			id_usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.id_ubicacion,
			v_parametros.nombre,
			v_parametros.codigo,
			v_parametros.fecha_documento,
			v_parametros.metadatos,
			'activo',
			v_parametros.url,
			v_parametros.id_documento_fk,
			v_parametros.campo_auxiliar,
			v_parametros.id_uo,
			v_parametros.id_deposito,
			v_parametros.contenedor,
			v_parametros.descripcion,
			v_parametros.tipo_documento,
			p_id_usuario,
			now(),
			v_parametros._nombre_usuario_ai,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_documento into v_id_documento;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Documentos almacenado(a) con exito (id_documento'||v_id_documento||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_documento',v_id_documento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_docum_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:49
	***********************************/

	elsif(p_transaccion='BIBLIO_docum_MOD')then

		begin
			--Sentencia de la modificacion
			update biblio.tdocumento set
			id_ubicacion = v_parametros.id_ubicacion,
			nombre = v_parametros.nombre,
			codigo = v_parametros.codigo,
			fecha_documento = v_parametros.fecha_documento,
			metadatos = v_parametros.metadatos,
			url = v_parametros.url,
			id_documento_fk = v_parametros.id_documento_fk,
			campo_auxiliar = v_parametros.campo_auxiliar,
			id_uo = v_parametros.id_uo,
			id_deposito = v_parametros.id_deposito,
			contenedor = v_parametros.contenedor,
			descripcion = v_parametros.descripcion,
			tipo_documento = v_parametros.tipo_documento,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_documento=v_parametros.id_documento;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Documentos modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_documento',v_parametros.id_documento::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_docum_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:49
	***********************************/

	elsif(p_transaccion='BIBLIO_docum_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from biblio.tdocumento
            where id_documento=v_parametros.id_documento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Documentos eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_documento',v_parametros.id_documento::varchar);
              
            --Devuelve la respuesta
            return v_resp;

		end;
         
	else
     
    	raise exception 'Transaccion inexistente: %',p_transaccion;

	end if;

EXCEPTION
				
	WHEN OTHERS THEN
		v_resp='';
		v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
		v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
		v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
		raise exception '%',v_resp;
				        
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "biblio"."ft_documento_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
