<p align="center">
  <a href="https://www.figma.com/design/1QxlmVCE78YkhfKIla1wd1/Cambios-de-web-stock?node-id=126-2&t=gJVkOSGm86gt911B-1">
    <img src="https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white" alt="Figma">
  </a>
  
  &nbsp;
  &nbsp;
  &nbsp;
  
  <a href="https://trello.com/invite/b/6a13bb0d013dc2d27faa5f31/ATTIc1bdd8c0875fa677ac20a2acc6654c8f77BF3D59/trabajo-php">
    <img src="https://img.shields.io/badge/Trello-0052CC?style=for-the-badge&logo=trello&logoColor=white" alt="Trello">
  </a>
</p>

# Sistema de Producción Diaria

Sistema web para el control de salida de productos, desarrollado para facilitar el almacenamiento del registro diario de producción. Proyecto final programado en PHP con estructura MVC.

---

## Descripción del Proyecto

| Campo | Detalle |
|-------|---------|
| **Nombre** | Panadería y Pastelería Renzo |
| **Giro** | Venta de panificados, bocaditos, tortas y servicio de cafetería |
| **Tamaño** | Pequeña empresa, operación individual |

### Contexto

La empresa registra actualmente su producción de forma manual en hojas de papel. En estos registros se anota la cantidad de panes elaborados en cada turno y la hora en que se terminan. La producción de pan se controla por latas, donde cada lata contiene varios panes del mismo tipo, pero cada pan pertenece únicamente a una lata.

La panadería elabora diferentes tipos de pan: ciabatta, carioca, francés y coliza. Esta variedad hace que la información de producción se vuelva difícil de organizar cuando se maneja en papel.

Además, la empresa produce tortas y bocaditos, los cuales se registran en hojas separadas. Estos productos también se clasifican por tipos, aunque su producción se realiza en un solo turno.

### Justificación

Se necesita un sistema que permita gestionar los datos de stock del día y del turno correspondiente, eliminando el riesgo de pérdida o deterioro de la información registrada en papel.

---

## Imágenes de la Empresa

| Vista cercana | Vista panorámica |
|:--:|:--:|
| ![Foto cercana](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/foto_empresa.jpeg) | ![Foto panorámica](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/foto_empresa_2.jpeg) |

---

## Imágenes del Problema Actual

| Control de bocaditos | Control de pan | Control de tortas |
|:--:|:--:|:--:|
| ![Bocaditos](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/bocaditos_control.jpeg) | ![Pan](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/pan_control.jpeg) | ![Tortas](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/tortas_control.jpeg) |

---

## Gestión del Proyecto

![Tablero Trello](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/Trello_PHP.png)

---

## Identificación del Problema y Propuesta de Solución

### Problemática

El registro manual en hojas de papel presenta riesgos de deterioro, pérdida o daños imprevistos. Además, dificulta la consulta histórica de la producción y puede generar errores al transcribir datos.

### Solución

Implementar un sistema web que permita registrar y gestionar los datos diarios de producción. El sistema almacenará información de la fecha, hora y turno de producción, permitiendo realizar operaciones de agregar, editar y eliminar registros.

---

## Requerimientos Funcionales

### 1. Gestión de Tipos de Productos
- [ ] Registrar nuevos tipos de productos
- [ ] Editar información de tipos existentes
- [ ] Eliminar tipos de productos
- [ ] Mostrar listado de tipos registrados

### 2. Gestión de Productos
- [ ] Registrar nuevos productos
- [ ] Editar información de productos
- [ ] Eliminar productos
- [ ] Mostrar listado de productos registrados

### 3. Registro de Producción
- [ ] Registrar la producción diaria
- [ ] Registrar la cantidad producida
- [ ] Registrar la fecha de producción
- [ ] Registrar la hora de agotamiento del producto

### 4. Gestión de Turnos
- [ ] Registrar el turno de producción (mañana o noche)
- [ ] Consultar producción por turno
- [ ] Mostrar listado de turnos registrados

---

## Requerimientos No Funcionales

### 1. Usabilidad
- Interfaz sencilla e intuitiva para los trabajadores
- Información mostrada de forma clara y organizada
- Mensajes claros al realizar operaciones (éxito, error, confirmación)

### 2. Rendimiento
- Registro de producción en menos de 3 segundos
- Consulta de producción de forma rápida
- Capacidad para manejar múltiples registros simultáneos

### 3. Almacenamiento
- Información almacenada en base de datos
- Registros de producción diaria guardados de forma persistente
- Base de datos manteniendo la información ordenada y estructurada

### 4. Mantenibilidad
- Código desarrollado de forma estructurada
- Facilidad para realizar modificaciones sin afectar el funcionamiento general
- Documentación del código para futuras actualizaciones

---

## Base de Datos

```sql
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

```
### Diagrama Entidad-Relacion (DER)
#### POR INGRESAR 

### Modelo Relacional (MR)
#### POR INGRESAR 

### Cardinalidades
#### POR INGRESAR
