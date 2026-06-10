## sistema de produccion diaria 
sistema web para el control de salida de producto para falicitar el amacenamiento del control diaria.

## descripcion de proyecto 
Nombre: Panaderia  y Pasteleria Renzo
Grio: venta de panificaciones, bocaditos, tortas y en una cafeteria <br>
Tamaño: Pequeña empresa, operacion individual <br>

Contexto: Actualmente la empresa registra su producción de manera manual en hojas de papel. En estos registros se anota la cantidad de panes producidos en cada turno y cuándo se terminan. 

La panadería produce diferentes tipos de pan, como Ciabatti, carioco, francés y coliza, por lo que la información de producción puede volverse difícil de organizar cuando se registra manualmente. 
Además, la empresa también produce tortas y bocaditos, los cuales se registran de forma similar pero en hojas de papel separadas. Estos productos también se clasifican por tipos, aunque su producción se realiza en un solo turno.  <br>

Justificacin: se nesecita un sistema para gestonar los datos del sotck del dia y turno 

## IMAGENES DE LA EMPRESA 
![empresa_cerca](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/foto_empresa.jpeg)
![empresa_lejos](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/foto_empresa_2.jpeg)

## IMAGENES DEL PROBLEMA 
![bocadito_ontrol](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/bocaditos_control.jpeg)
![pan_control](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/pan_control.jpeg)
![torta_control](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/tortas_control.jpeg)

## TRELLO 
![Trello](https://github.com/fuchsfoxi/Panaderia-y-Pasteleria-r.s/blob/main/img_empresa/Trello_PHP.png)
 #### - POR INGRESAR -

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
   3. El 	sistema debe mostrar mensajes claros cuando se guarde la informacion
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
```sql
create database panaderia_rs;
use panaderia_rs;

CREATE TABLE rol(
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(255),
    estado BOOLEAN DEFAULT TRUE
);

CREATE TABLE empleado(
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    dni CHAR(8) UNIQUE NOT NULL,
    telefono VARCHAR(15),
    estado BOOLEAN DEFAULT TRUE
);

CREATE TABLE usuario(
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    id_rol INT NOT NULL,
    id_empleado INT,
    estado BOOLEAN DEFAULT TRUE,

    FOREIGN KEY(id_rol) REFERENCES rol(id_rol),
    FOREIGN KEY(id_empleado) REFERENCES empleado(id_empleado)
);

CREATE TABLE turno(
    id_turno INT AUTO_INCREMENT PRIMARY KEY,
    nombre_turno VARCHAR(50) NOT NULL UNIQUE,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL
);

CREATE TABLE produccion(
    id_produccion INT AUTO_INCREMENT PRIMARY KEY,
    fecha_produccion DATE NOT NULL,
    id_turno INT NOT NULL,
    id_empleado INT NOT NULL,

    FOREIGN KEY(id_turno) REFERENCES turno(id_turno),
    FOREIGN KEY(id_empleado) REFERENCES empleado(id_empleado)
);

CREATE TABLE producto(
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(150) NOT NULL,
    tipo ENUM('PAN','TORTA','BOCADITO') NOT NULL
);

CREATE TABLE stock(
    id_stock INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    cantidad_actual DECIMAL(10,2) DEFAULT 0,

    FOREIGN KEY(id_producto) REFERENCES producto(id_producto)
);

CREATE TABLE detalle_produccion(
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_produccion INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,

    FOREIGN KEY(id_produccion) REFERENCES produccion(id_produccion),
    FOREIGN KEY(id_producto) REFERENCES producto(id_producto)
);


```
### Diagrama Entidad-Relacion (DER)
#### POR INGRESAR 

### Modelo Relacional (MR)
#### POR INGRESAR 

### Cardinalidades
#### POR INGRESAR
