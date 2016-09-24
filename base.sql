DROP DATABASE tienda;
CREATE database tienda;
USE tienda;

CREATE TABLE Cliente(
	id int not null auto_increment primary key,
	nombre varchar(400),
	direccion text,
	correo varchar(100),
	sexo varchar(15),
	telefono varchar(15),
	fechaAlta timestamp
);

CREATE TABLE Empleado(
	id int not null auto_increment primary key,
	nombre varchar(400),
	direccion text,
	correo varchar(100),
	sexo varchar(15),
	telefono varchar(15),
	password varchar(64),
	fechaAlta timestamp,
	estado varchar(20),
	tipo varchar(50)
);
INSERT INTO Empleado VALUES (null,'Saúl Gómez Navarrete','Santa Maria Endaré, Jocotitlán','minsau2@gmail.com','Masculino','7121675322','esasistemas',now(),'Activo','Superadmin');
INSERT INTO Empleado VALUES (null,'Saúl Gómez Navarrete','Santa Maria Endaré, Jocotitlán','minsau3@gmail.com','Masculino','7121675322','esasistemas',now(),'Activo','Administrador');
INSERT INTO Empleado VALUES (null,'Saúl Gómez Navarrete','Santa Maria Endaré, Jocotitlán','minsau4@gmail.com','Masculino','7121675322','esasistemas',now(),'Activo','Administrador');
CREATE TABLE Articulo(
	id int not null auto_increment primary key,
	nombre varchar(100),
	descripcion text,
	precio float,
	cantidad int
);


CREATE TABLE Categoria(
	id int not null auto_increment primary key,
	nombre varchar(100),
	descripcion text
);

CREATE TABLE Venta(
	id int not null auto_increment primary key,
	cliente int not null,
	empleado int not null,
	fecha timestamp,
	total float,
	FOREIGN KEY(cliente) REFERENCES Cliente(id),
	FOREIGN KEY(empleado) REFERENCES Empleado(id)
);

CREATE TABLE Venta_Articulos(
	idVenta int not null,
	idArticulo int not null,
	cantidad int,
	FOREIGN KEY(idVenta) REFERENCES Venta(id),
	FOREIGN KEY(idArticulo) REFERENCES Articulo(id)
);

CREATE TABLE Articulo_Categorias(
	idArticulo int not null,
	idCategoria int not null,
	FOREIGN KEY(idCategoria) REFERENCES Categoria(id),
	FOREIGN KEY(idArticulo) REFERENCES Articulo(id)
);
