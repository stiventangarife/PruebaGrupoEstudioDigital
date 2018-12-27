CREATE DATABASE facturacion;

use facturacion;

CREATE TABLE productos(
	idProducto int(15) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	nombre varchar(150) NOT NULL,
	descripcion varchar(150) NOT NULL,
	valor int(30) NOT NULL
);

CREATE TABLE clientes(
	idCliente int(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre varchar(30) NOT NULL,
	documento varchar(12) NOT NULL
);

CREATE TABLE ventas(
	idVenta int(15) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	consecutivo varchar(150) NOT NULL,
	idCliente int(15) NOT NULL, 
	fecha date NOT NULL,
	hora date NOT NULL,
	subtotal int(30) NOT NULL,
	descuento int(15) NOT NULL, 
	iva int(15) NOT NULL,
	totalNeto int(30) NOT NULL,
	FOREIGN KEY (idCliente) REFERENCES clientes(idCliente)
);

CREATE TABLE detalleVenta(
	idDetalleVenta int(15) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	idVenta int(15) NOT NULL,
	idProducto int(15) NOT NULL,
	descripcion varchar(150) NOT NULL, 
	valor int(30) NOT NULL,
	descuento int(15) NOT NULL,
	iva int(15) NOT NULL,
	total int(30) NOT NULL,
	FOREIGN KEY (idVenta) REFERENCES ventas(idVenta),
	FOREIGN KEY (idProducto) REFERENCES productos(idProducto)
); 

INSERT INTO `clientes` (`idCliente`, `nombre`, `documento`) VALUES
(1, 'Stiven', '1017267761');

INSERT INTO `productos` (`idProducto`, `nombre`, `descripcion`, `valor`) VALUES
(1, 'Coca-Cola', 'Bebida', 2000),
(2, 'Salchicha', 'Carne fria', 3500);