
##

Instalación:

Clonar el repositorio de la siguiente ruta:

Una vez descargado:
1.  En el archivo .env en la línea 41 (PRE_CONNECTION=pre_sqlsrv)
se debe configurar:

PRE_HOST=10.5.0.90
PRE_PORT=1436
#PRE_DATABASE=root
PRE_DATABASE=PruebasDesarrollador
PRE_USERNAME=root
PRE_PASSWORD='123456'

2. Se crea la base de datos en sql server con el siguiente script:

CREATE DATABASE PruebasDesarrollador ON
(NAME = Pruebas_Desarrollador,
    FILENAME = 'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\Pruebas_Desarrollador.mdf',
    SIZE = 10,
    MAXSIZE = 50,
    FILEGROWTH = 5)
LOG ON
(NAME = Pruebas_Desarrollador_log,
    FILENAME = 'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\Pruebas_Desarrollador.ldf',
    SIZE = 5 MB,
    MAXSIZE = 25 MB,
    FILEGROWTH = 5 MB);
GO

3.  Crear la tabla de usuarios:
CREATE TABLE tbl_users (
ID_Usuario int identity(1,1) primary key,
Nombres varchar(255),
email varchar(250),
password_1 varchar(250),
password_2 varchar(250)
)

4.  Configuración archivo database.php:

Ruta: config/database.php

línea 18 se debe configurar tipo de base de datos:
'default' => env('DB_CONNECTION', 'sqlsrv'),

en la línea 81 a 90:
    'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('PRE_HOST'), 
            'port' => env('PRE_PORT'),
            'database' => env('PRE_DATABASE'),
            'username' => env('PRE_USERNAME'),
            'password' => env('PRE_PASSWORD'),
            'charset' => 'utf8',
            'prefix' => '',
            'characterset' => 'utf8',
        ],


