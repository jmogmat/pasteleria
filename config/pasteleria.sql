drop database if exists pasteleria;

create database pasteleria; 

use pasteleria; 


create table Roles(
id int(20) not null unique auto_increment,
nombre_rol varchar(50) not null unique,
primary key(id)
);

create table Estados(
id int(10) not null unique auto_increment,
nombre_estado varchar(30) not null unique,
primary key(id)
);

create table Tipo_producto (
id int(5) not null unique auto_increment,
tipo_producto varchar (30) not null unique,
primary key(id)
);



create table Usuarios (
id bigint(20) not null auto_increment,
nombre varchar(255) not null,
apellido varchar(255) not null,
email varchar(50) not null unique,
telefono varchar(9) not null,
direccion varchar(60) not null,
ciudad varchar(45) not null,
codigo_postal int(4) not null,
provincia varchar(50) not null,
imagen varchar(40) not null,
password varchar(255) not null,
rol_usuario int(20) not null,
fecha_registro datetime DEFAULT CURRENT_TIMESTAMP not null,
fecha_ultimo_acceso datetime DEFAULT CURRENT_TIMESTAMP not null,
estado int(10) not null,
primary key (id),
foreign key (rol_usuario) references Roles(id)
					on delete restrict
                    on update cascade,
foreign key (estado) references Estados(id)
                   on delete restrict
                   on update cascade,
index fk_rol_usuario(rol_usuario),
index fk_estado_usuario(estado)
);

create table Imagenes(
id bigint(20) not null auto_increment,
ruta varchar(255) not null,
primary key(id)
);

create table Productos(
id int(20) not null auto_increment,
nombre varchar(255) not null,
descripcion varchar(255) not null,
precio float(4) not null,
cantidad bigint(20) not null,
tipo_producto int(5) not null,
primary key (id),
foreign key (tipo_producto) references Tipo_producto(id)
                           on delete restrict
                           on update cascade,
index fk_estado_tipo_producto(tipo_producto)
);



create table Pedidos_Clientes(
id bigint(20) not null auto_increment,
fecha_pedido datetime DEFAULT CURRENT_TIMESTAMP not null,
cliente bigint(20) not null,
primary key (id),
foreign key(cliente) references Usuarios(id)
                    on delete restrict
                    on update cascade,
index fk_cliente_pedidos(cliente)
);

create table Pedidos_Productos(
producto int(20) not null,
pedido bigint(20) not null,
primary key(producto, pedido),
foreign key (producto) references Productos(id)
						on delete cascade
						on update cascade,
index fk_producto(producto),
foreign key (pedido) references Pedidos_Clientes(id)
						on delete restrict
						on update cascade,
index fk_pedido(pedido)
         
);

create table Productos_Imagenes(
id_imagen bigint(20) not null,
id_producto  int(20) not null,
primary key(id_imagen,id_producto),
foreign key (id_imagen) references Imagenes(id)
                     on delete cascade
					 on update cascade,
index fk_imagen(id_imagen),
foreign key (id_producto) references Productos(id)
					 on delete cascade
					 on update cascade,
index fk_producto_imagen(id_producto)
);



create table Registros_actualizaciones_usuarios (
id_registro bigint(10) not null auto_increment,
id_usuario bigint(20) not null,
nombre varchar(255) not null,
apellido varchar(255) not null,
email varchar(50) not null,
telefono varchar(9) not null,
direccion varchar(60) not null,
ciudad varchar(45) not null,
codigo_postal int(4) not null,
provincia varchar(50) not null,
rol_usuario int(20) not null,
fecha_actualizacion datetime DEFAULT CURRENT_TIMESTAMP not null,
index(id_registro)

);

create table Categorias (

id bigint(10) not null auto_increment,
nombre_categoria varchar(255) not null,
primary key (id)
);

create table Categorias_productos (
id_producto int(20) not null,
id_categoria bigint(10) not null,
primary key (id_producto,id_categoria),
foreign key (id_producto) references Productos (id)
                           on delete cascade
					       on update cascade,
foreign key (id_categoria) references Categorias (id)
                            on delete restrict
					        on update cascade
);

create table Solicitudes_de_baja (
id bigint(20) not null auto_increment,
id_usuario bigint(20) not null,
fecha_solicitud datetime DEFAULT CURRENT_TIMESTAMP not null,
primary key (id),
foreign key (id_usuario) references Usuarios(id)
                        on delete restrict
                        on update cascade,
index fk_id_usuario (id_usuario)
);


create trigger actualiza_productos_BU (
)


CREATE USER 'admin'@'localhost' IDENTIFIED BY 'oxx3HBIqvMDk4kKV';
GRANT ALL PRIVILEGES ON pasteleria.* TO 'admin'@'localhost';

CREATE USER 'estandar'@'localhost' IDENTIFIED BY 'EaqcaHFQhH7kOnZV';
GRANT select, insert ON pasteleria.* TO 'estandar'@'localhost';

CREATE USER 'conexion'@'localhost' IDENTIFIED BY '6BW6NNhchNTQKt3W';
GRANT select, insert, update, delete ON pasteleria.* TO 'conexion'@'localhost';
GRANT file on *.* to 'conexion'@'localhost';
flush privileges;








