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


## Stack completo
1. Trello             = Gestión del proyecto (Kanban)
2. Draw.io            = Diagrama ER + Diagrama de Clases
3. Figma              = Wireframe + Diseño UI/UX
4. MySQL Workbench    = Diseñar y administrar BD
5. IntelliJ           = Frontend (HTML,CSS,JS) + Backend (Spring Boot)
6. XAMPP              = Servidor Tomcat para correr la app

## Tecnologias utilizadas
- Java 17
- Spring Boot 3
- MySQL 8
- HTML5, CSS3, JavaScript
- IntelliJ IDEA
- XAMPP (Tomcat)
- MySQL Workbench
- Figma (diseño UI/UX)
- Draw.io (diagramas)


## BASES DE DATOS ##
| Tabla | Descripcion |
|---|---|
| tipo | tipo del producto que se esta agregando añ historial|
| PRODUCTO | la cantidad de productos que se hizo en el dia |
| PRODUCCION | regstra la produccion que se creo en un turno respectivo |
| TURNO | Registro la produccion dividida por turno |

## Diagrama Entidad Relacion (DER)
![image alt](https://github.com/fuchsfoxi/proyectodatos/blob/258ddd765cf4ef7e6d57c1e368c8210241ef00a2/Diagrama%20sin%20t%C3%ADtulo.drawio.png)

## Cardinalidanes 
TIPO - PRODUCTO 
Un tipo  puede tener muchos productos 
PRODUCTO - PRODUCCION 
Un producto puede estar en muchas producciones
PRODUCCION - TURNO 
Muchas produccion pueden tener un turno 

| Entidad A | Relacion | Entidad B | Cardinalidad |
| --------- | -------- | --------- | ------------ |
| Tipo | Tiene | Producto | 1:N |
| Producto |  Tiene |Producción | 1:N |
|Producción | Tiene | Turno | N:1 |

## Base de Datos 
El sistema cuenta con 4 tablas 

```MySQL
CREATE DATABASE IF NOT EXISTS renzo;
USE renzo;

create table tipo (
id_tipo int primary key auto_increment,
tipo varchar (50)
 );

create table producto(
id_producto int primary key auto_increment,
nombre varchar (50),
precio decimal(10,2),
id_tipo int,
foreign key (id_tipo) references tipo(id_tipo)
);

create table produccion(
id_produccion int primary key auto_increment,
cantidad int,
fecha timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
id_producto int,
id_turno int,
foreign key (id_producto) references producto(id_producto),
foreign key( id_turno) references turno(id_turno)
);

create table turno (
id_turno int primary key auto_increment,
turno varchar (50),
hora_fin_pan time
);
```
## Correr el Proyecto con:


## Como correr el proyecto
 
### Requisitos previos
- Tener instalado IntelliJ IDEA
- Tener instalado XAMPP (para MySQL)
- Tener instalado MySQL Workbench
- Tener instalado JDK 21 o superior
 
### Backend
1. Abrir la carpeta `backend/` en IntelliJ IDEA
2. Configurar `application.properties` con los datos de MySQL
3. Iniciar XAMPP y activar MySQL
4. Ejecutar `GotagotaApplication.java`
5. El backend corre en: `http://localhost:8080`
 
### Frontend
1. Abrir la carpeta `frontend/` en VsCode
2. Abrir `index.html` con Live Server
3. El frontend se comunica con el backend via fetch()
 
> El frontend y el backend corren por separado.
> El backend debe estar iniciado antes de abrir el frontend.






