
/***********************************I-SCP-JMH-BIBLIO-0-22/07/2026****************************************/

CREATE TABLE biblio.tdocumento (
  id_documento SERIAL,
  codigo VARCHAR(500) NOT NULL,
  tipo_documento VARCHAR(500) NOT NULL,
  id_uo INTEGER NOT NULL,
  descripcion VARCHAR(500),
  metadatos VARCHAR(600) NOT NULL,
  nombre VARCHAR(500) NOT NULL,
  fecha_documento DATE NOT NULL,
  id_ubicacion INTEGER,
  id_deposito INTEGER,
  contenedor VARCHAR(500),
  id_documento_fk INTEGER,
  campo_auxiliar VARCHAR(600),
  url VARCHAR(500),
  CONSTRAINT tdocumento_pkey PRIMARY KEY(id_documento)
) INHERITS (pxp.tbase)
WITH (oids = false);

ALTER TABLE biblio.tdocumento
  OWNER TO postgres;


CREATE TABLE biblio.tubicacion (
  id_ubicacion SERIAL,
  id_lugar INTEGER NOT NULL,
  oficina VARCHAR(500) NOT NULL,
  estante VARCHAR(200),
  nivel VARCHAR(200),
  observacion VARCHAR(500),
  nombre VARCHAR(500),
  CONSTRAINT tubicacion_pkey PRIMARY KEY(id_ubicacion)
) INHERITS (pxp.tbase)
WITH (oids = false);

ALTER TABLE biblio.tubicacion
  OWNER TO postgres;
  
/***********************************F-SCP-JMH-BIBLIO-0-22/07/2026****************************************/