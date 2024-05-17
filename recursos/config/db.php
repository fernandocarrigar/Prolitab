<?php

class Conectar
{

    public $conexion;
    private string $host = "localhost";    //------    ESTA LINEA DEINE EL SERVIDOR  -------//
    private string $user = "root";         //------    ESTA LINEA DEINE EL USUARIO  -------//
    private string $pass = "";             //------    ESTA LINEA DEINE LA CONTRASEÑA  -------//
    private string $dbname = "ProlitabWeb";   //------    ESTA LINEA DEINE LA BASE DATOS  -------//


    private string $UserAdmin = "Admin";
    private string $PassAdmin = "Prolitab2024";

    public function conexionBD()
    {
        $this->comprobarBD();

        $conexion = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        $tablas = $this->obtenerTablas($conexion);
        $this->comprobarTablas($tablas, $conexion);
        $this->comprobarAdmin($conexion);
        // if($conexion->connect_error){
        //     echo "Error en la conexion:" . $conexion->connect_errno . ":" . $conexion->connect_error;
        // } else {
        //     echo "conexion hecha";
        // }

        return $conexion;
    }

    public function cerrarConexion()
    {
        $this->conexion->close();
    }

    public function comprobarBD()
    {
        $Test = new mysqli($this->host, $this->user, $this->pass, "information_schema");
        $Existe = $Test->query(
            "SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME = '" . $this->dbname . "'"
        );

        if ($Existe->num_rows == 0) {
            $Test->query("SET GLOBAL  max_allowed_packet=100*1024*1024;");
            $Test->query("Create Database If Not Exists " . $this->dbname . ";");
        }
        // $Test->query("use " . $this->dbname . ";");
    }

    public function obtenerTablas($conection)
    {
        $result = $conection->query("show tables");
        $this->field = array();
        while ($row = $result->fetch_assoc()) {
            $this->field[] = $row;
        }
        return $this->field;
    }

    public function comprobarTablas($tExistentes, $conection)
    {
        $Tablas = $this->Tablas();
        $Alters = $this->Alters();

        $exist = array();        
        $exist = array_column($tExistentes, "Tables_in_". strtolower($this->dbname) ."");

        $var = "Tables_in_". strtolower($this->dbname) ."";

        for ($i = 0; $i < count($Tablas); $i++) {
            $tab = strtolower($Tablas[$i][0]);
            // $exs = in_array(strtolower($Tablas[$i][0]),$exist);
            if (!in_array($tab, $exist)) {
                $conection->query($Tablas[$i][1]);

                // $var = array_key_exists($tab, $Alters);
                if (array_key_exists($tab, $Alters)) {
                    for ($k = 0; $k < count($Alters); $k++) {
                        if (in_array(strtolower($Alters[$k][0]), $exist)) {
                            try {
                                $conection->query($Alters[$k][1]);
                            } catch (Exception $e) {
                                echo '<script>alert("Alter ya aplicado");</script>';
                            }            
                        }
                    }
                }
            }
        }

        for ($k = 0; $k < count($Alters); $k++) {
            // $variable = in_array(strtolower($Alters[$k][0]), $exist);

            if (in_array(strtolower($Alters[$k][0]), $exist)) {
                try {
                    $conection->query($Alters[$k][1]);
                } catch (Exception $e) {
                    echo '<script>alert("Alter ya aplicado");</script>';
                }
            }
        }

        $exist = array();
    }

    public function comprobarAdmin($conection)
    {
        $Perfil = $conection->query("SELECT * FROM Roles WHERE Rol = '{$this->UserAdmin}';");
        $Usuario = $conection->query("SELECT * FROM Usuarios WHERE Nombre = '{$this->UserAdmin}' AND Contra = '{$this->PassAdmin}';");

        if ($Perfil->num_rows == 0)
            $conection->query("INSERT INTO Roles(IdRol,Rol) VALUES(NULL,'{$this->UserAdmin}');");
        if ($Usuario->num_rows == 0)
            $conection->query("INSERT INTO Usuarios(IdUsuario,Nombre,Correo,Contra,IdRol) VALUES(NULL,'{$this->UserAdmin}', '','{$this->PassAdmin}', '1');");
    }
    public function Tablas()
    {
        $tablas = array();
        $tablas[] = [
            0 => "Archivos",
            1 => "Create Table Archivos (
            IdArchivo    int(10) NOT NULL AUTO_INCREMENT,
            Archivo longblob NOT NULL,
            MimeType varchar(50) NOT NULL,
            PRIMARY KEY (IdArchivo)
        );"
        ];

        $tablas[] = [
            0 => "Temas",
            1 => "Create Table Temas(
                IdTema int(10) NOT NULL AUTO_INCREMENT,
                Titulo varchar(150) NOT NULL,
                Descripcion varchar(350) NOT NULL,
                IdArchivo int(10),
                PRIMARY KEY (IdTema),
                CONSTRAINT fk_Temas_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
            );"
        ];

        $tablas[] = [
            0 => "Clientes",
            1 => "Create Table Clientes(
                IdCliente int(10) NOT NULL AUTO_INCREMENT,
                NombreCliente varchar(150) NOT NULL,
                Descripcion varchar(350) NOT NULL,
                IdArchivo int(10),
                PRIMARY KEY (IdCliente),
                CONSTRAINT fk_Clientes_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
            );"
        ];

        $tablas[] = [
            0 => "Marcas",
            1 => "Create Table Marcas(
                IdMarca int(10) NOT NULL AUTO_INCREMENT,
                NombreMarca varchar(150) NOT NULL,
                Descripcion varchar(350) NOT NULL,
                IdArchivo int(10),
                PRIMARY KEY (IdMarca),
                CONSTRAINT fk_Marcas_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
            );"
        ];

        $tablas[] = [
            0 => "TipoProductos",
            1 => "Create Table TipoProductos(
                IdTProducto int(10) NOT NULL AUTO_INCREMENT,
                Tipo varchar(150) NOT NULL,
                PRIMARY KEY (IdTProducto)
            );"
        ];

        $tablas[] = [
            0 => "Publicaciones",
            1 => "Create Table Publicaciones (
                IdPublicacion    int(10) NOT NULL AUTO_INCREMENT,
                CampoKey    varchar(100) NOT NULL,
                Titulo      varchar(300),
                Descripcion LONGTEXT,
                IdArchivo int(10),
                PRIMARY KEY (IdPublicacion),
                CONSTRAINT fk_Publicaciones_Archivos FOREIGN KEY (IdArchivo) REFERENCES Archivos(IdArchivo)
            );"
        ];

        $tablas[] = [
            0 => "Roles",
            1 => "Create Table Roles(
            IdRol   int(10) NOT NULL AUTO_INCREMENT,
            Rol     varchar(50) NOT NULL,
            PRIMARY KEY (IdRol)
        );"
        ];

        $tablas[] = [
            0 => "Configuraciones",
            1 => "Create Table Configuraciones(
            CampoKey  varchar(100) NOT NULL,
            Descripcion LONGTEXT NOT NULL
        );"
        ];

        $tablas[] = [
            0 => "Usuarios",
            1 => "Create Table Usuarios(
            IdUsuario   int(10) NOT NULL AUTO_INCREMENT,
            Nombre      varchar(50) NOT NULL,
            Correo      varchar(150) NOT NULL,
            Contra      varchar(20) NOT NULL,
            IdRol       int(10) NOT NULL,
            PRIMARY KEY (IdUsuario),
            CONSTRAINT fk_Usuarios_Roles FOREIGN KEY (IdRol) REFERENCES Roles(IdRol)
        );"
        ];

        $tablas[] = [
            0 => "Productos",
            1 => "Create Table Productos(
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
            );"
        ];

        $tablas[] = [
            0 => "view_temas",
            1 => "Create View view_temas as
        SELECT t.IdTema, t.Titulo, t.Descripcion, t.IdArchivo, a.Archivo, a.MimeType as Tipo
        FROM Temas as t
        LEFT JOIN Archivos as a ON t.IdArchivo = a.IdArchivo;"
        ];

        $tablas[] = [
            0 => "view_Publicaciones",
            1 => "Create OR REPLACE View view_publicaciones as
            SELECT p.IdPublicacion, p.CampoKey as Clave, p.Descripcion as DescripcionPublicacion, 
            a.MimeType as TipoArchivoPub, a.Archivo as ArchivoPub, p.IdArchivo, p.Titulo
            FROM Publicaciones as p
            LEFT JOIN Archivos as a ON p.IdArchivo = a.IdArchivo;"
        ];

        $tablas[] = [
            0 => "view_productos",
            1 => "Create OR REPLACE View view_productos as
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
            ORDER BY p.IdProducto DESC;"
        ];

        $tablas[] = [
            0 => "view_marcas",
            1 => "Create OR REPLACE View view_marcas as
            SELECT m.IdMarca, m.NombreMarca, m.IdArchivo, a.Archivo, a.MimeType as Tipo
            FROM Marcas as m
            LEFT JOIN Archivos as a ON m.IdArchivo = a.IdArchivo;"
        ];

        $tablas[] = [
            0 => "view_clientes",
            1 => "Create OR REPLACE View view_clientes as
            SELECT c.IdCliente, c.NombreCliente, c.IdArchivo, a.Archivo, a.MimeType as Tipo
            FROM Clientes as c
            LEFT JOIN Archivos as a ON c.IdArchivo = a.IdArchivo;"
        ];

        return $tablas;
    }

    public function Alters()
    {
        $alters = array();

        $alters[] = [
            0 => "view_productos",
            1 => "Create OR REPLACE View view_productos as
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
            ORDER BY p.IdProducto DESC;"
        ];

        return $alters;
    }
}

$con = new Conectar();
$connect = $con->conexionBD();
//  print_r($con->conexionBD());

?>