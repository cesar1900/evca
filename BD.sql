
CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `fechacreada` datetime NOT NULL,
  `idusuario` varchar(45) COLLATE utf8_bin NOT NULL
);

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idtipousuario`, `nombre`, `descripcion`, `fechacreada`, `idusuario`) VALUES
(1, 'Administrador', 'Con priviliegios de gestionar todo el sistema', '2020-01-18 00:00:00', '1');
INSERT INTO `tipousuario` (`idtipousuario`, `nombre`, `descripcion`, `fechacreada`, `idusuario`) VALUES
(2, 'Super_Administrador', 'Con super priviliegios de gestionar todo el sistema', '2020-01-18 00:00:00', '2');

drop table usuarios;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_bin NOT NULL,
  `login` varchar(45) COLLATE utf8_bin NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(90) COLLATE utf8_bin NOT NULL,
  `celular` varchar(45) COLLATE utf8_bin NOT NULL,
  `sede` varchar(45) COLLATE utf8_bin DEFAULT NULL,
 `area` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `imagen` varchar(50) COLLATE utf8_bin NOT NULL,
  constraint idusuario primary key(idusuario)
);

INSERT INTO `usuarios` (`nombre`, `apellidos`, `login`, `idtipousuario`, `email`, `password`, `celular`, `cedula`, `sede`,`area`, `imagen`) VALUES
('Cesar eduardo', 'restrepo santacruz', 'admin', 1, 'esecuroccidente.sistemas@gmail.com.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '3148410065', '1061730711', 'Bordo','adm','default.jpg');
 
 INSERT INTO `usuarios` (`nombre`, `apellidos`, `login`, `idtipousuario`, `email`, `password`, `celular`, `cedula`, `sede`, `area`, `imagen`) VALUES
('sistemas', 'sistemas', 's_admin', 2, 'esecuroccidente.sistemas@gmail.com.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '3148410065', '1061730711', 'Bordo','adm','default.jpg');
 

INSERT INTO `usuarios` (`nombre`, `apellidos`, `login`, `idtipousuario`, `email`, `password`, `celular`, `cedula`, `sede`, `area`, `imagen`) VALUES
('argelia', 'UAS', 'argelia', 3, 'esecuroccidente.sistemas@gmail.com.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '3148410065', '1061730711', 'PUNTO DE ATENCION ARGELIA','Almacen','default.jpg');
 
INSERT INTO `usuarios` (`nombre`, `apellidos`, `login`, `idtipousuario`, `email`, `password`, `celular`, `cedula`, `sede`, `area`, `imagen`) VALUES
('florencia', 'UAS', 'florencia', 3, 'esecuroccidente.sistemas@gmail.com.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '3148410065', '1061730711', 'PUNTO DE ATENCION FLORENCIA','Almacen','default.jpg');









CREATE TABLE `reporte_as` (
  `idreporte_as` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_as` varchar(45) COLLATE utf8_bin NOT NULL,
  `fecha_ev_as` varchar(45) COLLATE utf8_bin NOT NULL,
  `hora_ev_as` varchar(45) COLLATE utf8_bin NOT NULL,
  `sede` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `lugar_evento` varchar(80) COLLATE utf8_bin NOT NULL,
  `relacion` varchar(80) COLLATE utf8_bin NOT NULL,
  `descripcion_as` varchar(1000) COLLATE utf8_bin NOT NULL,
  `hc_paciente` varchar(80) COLLATE utf8_bin NOT NULL, 
  `nombre_re` varchar(45) COLLATE utf8_bin NOT NULL,
  constraint idreporte_as primary key(idreporte_as)
);

CREATE TABLE `reporte_adm` (
  `idreporte_adm` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_adm` varchar(45) COLLATE utf8_bin NOT NULL,
  `fecha_ev_adm` varchar(45) COLLATE utf8_bin NOT NULL,
  `hora_ev_adm` varchar(45) COLLATE utf8_bin NOT NULL,
  `sede` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `lugar_evento` varchar(80) COLLATE utf8_bin NOT NULL,
  `relacion` varchar(80) COLLATE utf8_bin NOT NULL,
  `descripcion_adm` varchar(1000) COLLATE utf8_bin NOT NULL,
  `nombre_re` varchar(45) COLLATE utf8_bin NOT NULL,
  constraint idreporte_adm primary key(idreporte_adm)
);