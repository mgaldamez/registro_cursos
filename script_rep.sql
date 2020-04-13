DELETE FROM tb_empleados WHERE emp_id >10;
COMMIT ;
ALTER TABLE tb_departamentos MODIFY dpt_nombre VARCHAR( 150 ) ;
ALTER TABLE tb_departamentos MODIFY dpt_desc VARCHAR( 150 ) ;

ALTER TABLE tb_empleados AUTO_INCREMENT =8;

INSERT INTO tb_departamentos (dpt_nombre, dpt_desc) VALUES('DESPACHO MINISTERIAL','DESPACHO MINISTERIAL'),
('JEFATURA DE GABINETE','JEFATURA DE GABINETE'),
('COORDINACION GENERAL ADMINISTRATIVA Y FINANCIERA','COORDINACION GENERAL ADMINISTRATIVA Y FINANCIERA'),
('OFICINA DE ACCESO A LA INFORMACION PUBLICA','OFICINA DE ACCESO A LA INFORMACION PUBLICA'),
('UNIDAD DE COMUNICACIONES','UNIDAD DE COMUNICACIONES'),
('UNIDAD DE AUDITORIA INTERNA','UNIDAD DE AUDITORIA INTERNA'),
('IEESFORD','IEESFORD'),
('VICEMINISTERIO DE RELACIONES EXTERIORES, INTEGRACION Y PROMOCION ECONOMICA','VICEMINISTERIO DE RELACIONES EXTERIORES, INTEGRACION Y PROMOCION ECONOMICA'),
('DIRECCION GENERAL DE PROTOCOLO Y ORDENES','DIRECCION GENERAL DE PROTOCOLO Y ORDENES'),
('DIRECCION GENERAL DE POLITICA EXTERIOR','DIRECCION GENERAL DE POLITICA EXTERIOR'),
('DIRECCION GENERAL  DE ASUNTOS JURIDICOS','DIRECCION GENERAL  DE ASUNTOS JURIDICOS'),
('DIRECCION GENERAL DE SOBERANIA E INTEGRIDAD TERRITORIO','DIRECCION GENERAL DE SOBERANIA E INTEGRIDAD TERRITORIO'),
('DIRECCION GENERAL DE DESARROLLO SOCIAL INTEGRAL','DIRECCION GENERAL DE DESARROLLO SOCIAL INTEGRAL'),
('OFICINA NACIONAL DEL PROYECTO DE INTEGRACION Y DESARROLLO DE MESOAMERICA','OFICINA NACIONAL DEL PROYECTO DE INTEGRACION Y DESARROLLO DE MESOAMERICA'),
('VICEMINISTERIO DE COOPERACION PARA EL DESARROLLO','VICEMINISTERIO DE COOPERACION PARA EL DESARROLLO'),
('DIRECCION GENERAL DE COOPERACION  PARA EL DESARROLLO','DIRECCION GENERAL DE COOPERACION  PARA EL DESARROLLO'),
('DIRECCION GENERAL DE RELACIONES ECONOMICAS','DIRECCION GENERAL DE RELACIONES ECONOMICAS'),
('VICEMINISTERIO  PARA LOS SALVADOREÑOS EN EL EXTERIOR','VICEMINISTERIO  PARA LOS SALVADOREÑOS EN EL EXTERIOR'),
('DIRECCION GENERAL DEL SERVICIO EXTERIOR','DIRECCION GENERAL DEL SERVICIO EXTERIOR'),
('OFICINA DE ASUNTOS CULTURALES','OFICINA DE ASUNTOS CULTURALES'),
('DIRECCION GENERAL DE VINCULACION CON SALVADOREÑOS ','DIRECCION GENERAL DE VINCULACION CON SALVADOREÑOS '),
('DIRECCION GENERAL DE DERECHOS HUMANOS','DIRECCION GENERAL DE DERECHOS HUMANOS'),
('COMISION NACIONAL DE BUSQUEDA DE NIÑOS/AS DESAPARECIDOS','COMISION NACIONAL DE BUSQUEDA DE NIÑOS/AS DESAPARECIDOS'),
('UNIDAD DE TECNOLOGIAS DE LA INFORMACION Y TELECOMUNICACIONES','UNIDAD DE TECNOLOGIAS DE LA INFORMACION Y TELECOMUNICACIONES'),
('UNIDAD DE PLANIFICACION ,DESARROLLO INSTITUCIONAL ','UNIDAD DE PLANIFICACION ,DESARROLLO INSTITUCIONAL '),
('UNIDAD DE RECURSOS HUMANOS INSTITUCIONAL','UNIDAD DE RECURSOS HUMANOS INSTITUCIONAL'),
('UNIDAD FINANCIERA INSTITUCIONAL','UNIDAD FINANCIERA INSTITUCIONAL'),
('UNIDAD DE INFRAESTRUCTURAS Y SERVICIOS GENERALES','UNIDAD DE INFRAESTRUCTURAS Y SERVICIOS GENERALES'),
('UNIDAD DE ADQUISICIONES Y CONTRATACIONES INSTITUCIONAL','UNIDAD DE ADQUISICIONES Y CONTRATACIONES INSTITUCIONAL');

UPDATE  `tb_opcion` SET  `OPC_LABEL` =  'Organizador' WHERE  `OPC_ID` =  '4';
UPDATE  `tb_opcion` SET  `OPC_LABEL` =  'Ubicaciones' WHERE  `OPC_ID` =  '3';
/*Tb_cursos*/
ALTER TABLE  `tb_cursos` ADD  `crs_ponente` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER  `crs_jornada` ,
ADD  `crs_det_gasto` DECIMAL NULL AFTER  `crs_ponente` ,
ADD  `crs_form_pago` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER  `crs_det_gasto` ,
ADD  `crs_num_doc` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER  `crs_form_pago` ,
ADD INDEX (  `crs_ponente` );