INSERT INTO `db_sys_cursos`.`tb_opcion` (`OPC_ID`, `OPC_LABEL`, `OPC_ACTION`, `OPC_ID_PADRE`, `OPC_ORDEN`, `OPC_ESTADO`) VALUES (NULL, 'Reporteria', NULL, '3000', '0', 'A'), (NULL, 'Reportes', 'rptMisc.php', '3000', '1', 'A');

INSERT INTO `db_sys_cursos`.`tb_opcion_x_rol` (`ROL_ID`, `OPC_ID`) VALUES ('1', '10'), ('1', '11');