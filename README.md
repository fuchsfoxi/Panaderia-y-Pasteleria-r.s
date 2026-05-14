## sistema de produccion diaria 
sistema web para el control de salida de producto para falicitar el amacenamiento del control diaria. desarrollado como proyecto final de proyecto de java web de senati 

## descripcion de proyecto 
Nombre: Panaderia  y Pasteleria Renzo
Grio: venta de panificaciones, bocaditos, tortas y en una cafeteria <br>
Tamaño: Pequeña empresa, operacion individual <br>

Contexto: Actualmente la empresa registra su producción de manera manual en hojas de papel. En estos registros se anota la cantidad de panes producidos en cada turno y cuándo se terminan. La producción de pan se registra por latas, donde una lata puede contener varios panes del mismo tipo, pero cada pan pertenece únicamente a una lata. 
La panadería produce diferentes tipos de pan, como Ciabatti, carioco, francés y coliza, por lo que la información de producción puede volverse difícil de organizar cuando se registra manualmente. 
Además, la empresa también produce tortas y bocaditos, los cuales se registran de forma similar, pero en hojas de papel separadas. Estos productos también se clasifican por tipos, aunque su producción se realiza en un solo turno.  <br>

Justificacin: se nesecita un sistema para gestonar los datos del sotck del dia y turno 

## IDENTIFICAR EL PROBLEMA Y SOLUCION 

PROBLEMATICA: Actualmente la empresa registra su producción de manera manual en hojas de papel. En estos registros se anota la cantidad de panes producidos en cada turno y cuándo se terminan. lo cual tiene el peligro de dañarse, perderse o tener algun daño al que no se puede anticipar.

SOLUCIOÓN:  La solución que se planteo es hacer un sistema que permita gestionar o registrar los datos diarios de dicha empresa dicho sistema almacenara información relevante de la fecha de la producción, hora permitiendo además realizar operaciones como editar, eliminar y agregar.  

## REQUERIMIENTOS MUNCIONALES

1. TIPO DE PRODUCTOS
    1. El sistema debe de poder gestionar los tipos de productos
    2. El sistema debe de poder editar los tipos de productos
    3. El sistema debe poder eliminar el tipo de productos
    4. El sistema debe de mostrar la lista de tipos de productos
2. PRODUCTOS
   1. El sistema debe permitir registrar nuevos productos
   2. El sistema debe permitir editar la información de los productos
   3. El sistema debe permitir eliminar productos
   4. El sistema debe mostrar la lista de productos registrados
3. PRODUCCION
    1. El sistema debe registrar la  producción diaria
    2. El sistema debe registrar la  cantidad producida
    3. El sistema debe registrar la fecha de producción
    4. El sistema debe registrar la fecha de producción
 4. TURNOS 
    1. El sistema debe registrar el turno de producción
    2. El sistema debe permitir registrar turno mañana o  tarde
    3. El sistema debe permitir consultar producción por  turno
    4. El sistema debe mostrar los turnos registrados
   
## REQUERIMENTO NO FUNCIONALES 

1. USABILIDAD
   1. La interfaz del sistema debe ser sencilla e intuitiva para  los trabajadores
   2. El sistema debe mostrar la información de forma clara y organizada
   3. El 	sistema debe mostrar mensajes claros cuando
 4. RENDIMIENTO
    1. El sistema debe registrar la producción en menos de 3 segundos
    2. El sistema debe permitir consultar la producción rápidamente
    3. El 	sistema debe 	permitir manejar  múltiples registros 	de producción
 5. ALMACENAMIENTO
     1. El sistema debe almacenar la información en una base de datos
     2. El sistema debe guardar los registros de producción diaria
     3. La base de datos debe mantener la información ordenad
 
 4. MANTENIBILIDAD
     1. El sistema debe estar desarrollado de 	forma  estructurada
     2. El sistema debe permitir realizar modificaciones sin 	afectar 	el sistema
     3. El sistema debe permitir realizar modificaciones sin 	afectar 	el sistema 

## BASE DE DATOS

create database panaderia_rs;
use  panaderia_rs;

create table usuario(
id_usuario int auto_increment primary key,
roles enum('admin', 'superadmin') default 'admin',
nombre_usuario varchar (150) not null,
clave varchar(250) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table tipo(
id_tipo int auto_increment primary key,
tipo varchar(100)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table producto(
id_producto int auto_increment primary key,
nombre_prod varchar(150),
 id_tipo int not null,
 foreign key(id_tipo) references tipo(id_tipo)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table turno(
id_turno int auto_increment primary key,
nombre_turno enum('Mañana', 'Noche')
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table produccion(
id_produccion int auto_increment primary key,
cantidad_prod int,
hora_agotada DATETIME NULL DEFAULT NULL,
id_producto int not null,
id_turno int not null,
foreign key(id_producto) references producto(id_producto),
foreign key(id_turno) references turno(id_turno)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Usuarios
INSERT INTO usuario (roles, nombre_usuario, clave) VALUES
('admin', 'gerente', '1234'),
('superadmin', 'dueña', '1234');

-- Tipo
INSERT INTO tipo (tipo) VALUES
('Pan'),
('Torta'),
('Bocadito'),
('Pastel'),
('Galleta'),
('Empanada'),
('Croissant'),
('Queque');

-- Producto
INSERT INTO producto (nombre_prod, id_tipo) VALUES
('Pan de molde', 1),
('Torta de chocolate', 2),
('Bocadito de queso', 3),
('Pastel de manzana', 4),
('Galleta de avena', 5),
('Empanada de pollo', 6),
('Croissant de mantequilla', 7),
('Queque de vainilla', 8);

-- Turno
INSERT INTO turno (nombre_turno) VALUES
('Mañana'),
('Noche');

-- Produccion
INSERT INTO produccion (cantidad_prod, hora_agotada, id_producto, id_turno) VALUES
(100, NULL, 1, 1),
(50, '2026-05-11 10:30:00', 2, 1),
(80, NULL, 3, 2),
(60, '2026-05-11 21:00:00', 4, 2),
(120, NULL, 5, 1),
(45, '2026-05-11 09:15:00', 6, 1),
(90, NULL, 7, 2),
(30, '2026-05-11 22:45:00', 8, 2);





