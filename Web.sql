SET GLOBAL  max_allowed_packet=100*1024*1024;

Create Database If Not Exists ProlitabWeb;

use ProlitabWeb;

Create Table Archivos (
    IdArchivo    int(10) NOT NULL AUTO_INCREMENT,
    Archivo longblob NOT NULL,
    MimeType varchar(50) NOT NULL,
    PRIMARY KEY (IdArchivo)
);

Create Table Temas(
    IdTema int(10) NOT NULL AUTO_INCREMENT,
    Titulo varchar(150) NOT NULL,
    Descripcion LONGTEXT NOT NULL,
    IdArchivo int(10),
    PRIMARY KEY (IdTema),
    CONSTRAINT fk_Temas_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table Clientes(
    IdCliente int(10) NOT NULL AUTO_INCREMENT,
    NombreCliente varchar(150) NOT NULL,
    IdArchivo int(10),
    PRIMARY KEY (IdCliente),
    CONSTRAINT fk_Clientes_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table Marcas(
    IdMarca int(10) NOT NULL AUTO_INCREMENT,
    NombreMarca varchar(150) NOT NULL,
    IdArchivo int(10),
    PRIMARY KEY (IdMarca),
    CONSTRAINT fk_Marcas_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table TipoProductos(
    IdTProducto int(10) NOT NULL AUTO_INCREMENT,
    Tipo varchar(150) NOT NULL,
    PRIMARY KEY (IdTProducto)
);

Create Table Publicaciones (
    IdPublicacion    int(10) NOT NULL AUTO_INCREMENT,
    CampoKey    varchar(100) NOT NULL,
    Titulo      varchar(300),
    Descripcion LONGTEXT,
    IdArchivo int(10),
    PRIMARY KEY (IdPublicacion),
    CONSTRAINT fk_Publicaciones_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
);

Create Table Roles(
    IdRol   int(10) NOT NULL AUTO_INCREMENT,
    Rol     varchar(50) NOT NULL,
    PRIMARY KEY (IdRol)
);

Create Table Configuraciones(
    CampoKey  varchar(150) NOT NULL,
    Descripcion LONGTEXT NOT NULL
);

Create Table Usuarios(
    IdUsuario   int(10) NOT NULL AUTO_INCREMENT,
    Nombre      varchar(50) NOT NULL,
    Correo      varchar(150) NOT NULL,
    Contra      varchar(20) NOT NULL,
    IdRol       int(10) NOT NULL,
    PRIMARY KEY (IdUsuario),
    CONSTRAINT fk_Usuarios_Roles FOREIGN KEY (IdRol) REFERENCES Roles(IdRol)
);

Create Table Productos(
    IdProducto  int(10) NOT NULL AUTO_INCREMENT,
    NombreProducto  varchar(150) NOT NULL,
    Descripcion     LONGTEXT NOT NULL,
    IdTProducto     int(10),
    IdMarca         int(10),
    IdArchivo int(10),
    PRIMARY KEY (IdProducto),
    CONSTRAINT fk_Productos_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo),
    CONSTRAINT fk_Productos_TipoProductos FOREIGN KEY (IdTProducto) REFERENCES TipoProductos(IdTProducto),
    CONSTRAINT fk_Productos_Marcas FOREIGN KEY (IdMarca) REFERENCES Marcas(IdMarca)
);

INSERT INTO Roles(IdRol,Rol) VALUES(NULL,'Admin');
INSERT INTO Usuarios(IdUsuario,Nombre,Correo,Contra,IdRol) VALUES(NULL,'Admin', '','Prolitab2024', '1');

Create OR REPLACE View view_temas as
SELECT t.IdTema, t.Titulo, t.Descripcion, t.IdArchivo, a.Archivo, a.MimeType as Tipo
FROM Temas as t
LEFT JOIN Archivos as a ON t.IdArchivo = a.IdArchivo;

Create OR REPLACE View view_marcas as
SELECT m.IdMarca, m.NombreMarca, m.IdArchivo, a.Archivo, a.MimeType as Tipo
FROM Marcas as m
LEFT JOIN Archivos as a ON m.IdArchivo = a.IdArchivo;

Create OR REPLACE View view_clientes as
SELECT c.IdCliente, c.NombreCliente, c.IdArchivo, a.Archivo, a.MimeType as Tipo
FROM Clientes as c
LEFT JOIN Archivos as a ON c.IdArchivo = a.IdArchivo;

Create OR REPLACE View view_publicaciones as
SELECT p.IdPublicacion, p.CampoKey as Clave, p.Descripcion as DescripcionPublicacion, 
a.MimeType as TipoArchivoPub, a.Archivo as ArchivoPub, p.IdArchivo, p.Titulo
FROM Publicaciones as p
LEFT JOIN Archivos as a ON p.IdArchivo = a.IdArchivo;

Create OR REPLACE View view_productos as
SELECT  p.IdProducto, p.NombreProducto, p.Descripcion, p.IdArchivo, a.Archivo, a.MimeType as Tipo,
t.IdTProducto, t.Tipo as TipoProducto, m.IdMarca, m.NombreMarca
FROM Productos as p
LEFT JOIN
Archivos as a
ON p.IdArchivo = a.IdArchivo
LEFT JOIN
Marcas as m
ON p.IdMarca = m.IdMarca
LEFT JOIN
TipoProductos as t
ON P.IdTProducto = t.IdTProducto
ORDER BY p.IdProducto DESC;

    -- "php.debug.executablePath": "C:\\xampp\\php\\php.exe",
    -- "php.validate.executablePath": "C:\\xampp\\php\\php.exe"

-- ; zend_extension = xdebug

-- [XDebug]
-- ; xdebug.mode = debug
-- ; xdebug.start_with_request = yes
