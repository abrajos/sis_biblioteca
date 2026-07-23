--------------- SQL ---------------

CREATE OR REPLACE FUNCTION biblio.ft_documento_sel (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema de Biblioteca
 FUNCION: 		biblio.ft_documento_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'biblio.tdocumento'
 AUTOR: 		 (admin)
 FECHA:	        14-04-2026 03:20:49
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				14-04-2026 03:20:49								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'biblio.tdocumento'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'biblio.ft_documento_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'BIBLIO_docum_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:49
	***********************************/

	if(p_transaccion='BIBLIO_docum_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						docum.id_documento,
						docum.id_ubicacion,
						docum.nombre,
						docum.codigo,
						docum.fecha_documento,
						docum.metadatos,
						docum.estado_reg,
						docum.url,
						docum.id_documento_fk,
						docum.campo_auxiliar,
						docum.id_uo,
						docum.id_deposito,
						docum.contenedor,
						docum.descripcion,
						docum.tipo_documento,
						docum.id_usuario_reg,
						docum.fecha_reg,
						docum.usuario_ai,
						docum.id_usuario_ai,
						docum.fecha_mod,
						docum.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
                        ubica.oficina,
                        uo.descripcion as desc_uo
                      from biblio.tdocumento docum
                        inner join segu.tusuario usu1 on usu1.id_usuario = docum.id_usuario_reg
                        inner join biblio.tubicacion ubica on ubica.id_ubicacion = docum.id_ubicacion
                        inner join orga.tuo uo on uo.id_uo = docum.id_uo
                        left join segu.tusuario usu2 on usu2.id_usuario = docum.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

 /*********************************
#TRANSACCION:  'CO_CORDOC_SEL'
#DESCRIPCION:	Ver Archivo de correspondencia con id_origen
#AUTOR:		    Favio Figueroa
#FECHA:		    11-03-2016
***********************************/
  elsif(p_transaccion='CO_CORDOC_SEL')then

    begin


      --Sentencia de la consulta
      v_consulta:='  select
      							docum.url
      							 from biblio.tdocumento docum
     								 where docum.id_documento = ';

			v_consulta:=v_consulta||v_parametros.id_documento;

      --Devuelve la respuesta
      return v_consulta;

    end;
    
      /*********************************
 #TRANSACCION:  'CO_CORDOC_CONT'
 #DESCRIPCION:	Conteo de registros de ver Documento
 #AUTOR:
 #FECHA:		    11-03-2016 16:13:21
***********************************/

  elsif(p_transaccion='CO_CORDOC_CONT')then

    begin
      --Sentencia de la consulta de conteo de registros
      v_consulta:='select count(*) from biblio.tdocumento docum
     								 where docum.id_documento = ';

      --Definicion de la respuesta
      v_consulta:=v_consulta||v_parametros.id_documento;

      --Devuelve la respuesta
      return v_consulta;

    end;
	/*********************************    
 	#TRANSACCION:  'BIBLIO_docum_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		admin	
 	#FECHA:		14-04-2026 03:20:49
	***********************************/

	elsif(p_transaccion='BIBLIO_docum_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_documento)
					    from biblio.tdocumento docum
                        inner join segu.tusuario usu1 on usu1.id_usuario = docum.id_usuario_reg
                        inner join biblio.tubicacion ubica on ubica.id_ubicacion = docum.id_ubicacion
                        inner join orga.tuo uo on uo.id_uo = docum.id_uo
                        left join segu.tusuario usu2 on usu2.id_usuario = docum.id_usuario_mod
					    where ';
			
			--Definicion de la respuesta		    
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;
					
	else
					     
		raise exception 'Transaccion inexistente';
					         
	end if;
					
EXCEPTION
					
	WHEN OTHERS THEN
			v_resp='';
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
			v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
			v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
			raise exception '%',v_resp;
END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;