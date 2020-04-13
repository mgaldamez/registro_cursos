INSERT INTO `tb_opcion` (`OPC_ID`, `OPC_LABEL`, `OPC_ACTION`, `OPC_ID_PADRE`, `OPC_ORDEN`, `OPC_ESTADO`) VALUES
(8, 'Administracion', NULL, 2000, 0, 'A'),
(9, 'Agregar Usuario', 'users.php', 2000, 8, 'A');
INSERT INTO  `db_sys_cursos`.`tb_opcion_x_rol` (
`ROL_ID` ,
`OPC_ID`
)
VALUES (
'1',  '8'
), (
'1',  '9'
);

commit;