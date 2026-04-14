CREATE OR REPLACE FUNCTION "biblio"."ft_ubicacion_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema de Biblioteca
 FUNCION: 		biblio.ft_ubicacion_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'biblio.tubicacion'
 AUTOR: 		 (admin)
 FECHA:	        14-04-2026 03:20:53
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				14-04-2026 03:20:53								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'biblio.tubicacion'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_ubicacion	integer;
			    
BEGIN

    v_nombre_funcion = 'biblio.ft_ubicacion_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ubica_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:53
	***********************************/

	if(p_transaccion='BIBLIO_ubica_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into biblio.tubicacion(
			id_lugar,
			estado_reg,
			observacion,
			oficina,
			nivel,
			estante,
			usuario_ai,
			fecha_reg,
			id_usuario_reg,
			id_usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.id_lugar,
			'activo',
			v_parametros.observacion,
			v_parametros.oficina,
			v_parametros.nivel,
			v_parametros.estante,
			v_parametros._nombre_usuario_ai,
			now(),
			p_id_usuario,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_ubicacion into v_id_ubicacion;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Ubicación fisica almacenado(a) con exito (id_ubicacion'||v_id_ubicacion||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_ubicacion',v_id_ubicacion::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ubica_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:53
	***********************************/

	elsif(p_transaccion='BIBLIO_ubica_MOD')then

		begin
			--Sentencia de la modificacion
			update biblio.tubicacion set
			id_lugar = v_parametros.id_lugar,
			observacion = v_parametros.observacion,
			oficina = v_parametros.oficina,
			nivel = v_parametros.nivel,
			estante = v_parametros.estante,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_ubicacion=v_parametros.id_ubicacion;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Ubicación fisica modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_ubicacion',v_parametros.id_ubicacion::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ubica_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:53
	***********************************/

	elsif(p_transaccion='BIBLIO_ubica_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from biblio.tubicacion
            where id_ubicacion=v_parametros.id_ubicacion;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Ubicación fisica eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_ubicacion',v_parametros.id_ubicacion::varchar);
              
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
ALTER FUNCTION "biblio"."ft_ubicacion_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
