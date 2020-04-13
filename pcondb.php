<html> 
<head>
    <title>Ejemplo de conexión a base de datos MySQL</title>
</head> 

<body>

<?php

// Dirección o IP del servidor MySQL
$host = "localhost";

// Puerto del servidor MySQL
$puerto = "3306";

// Nombre de usuario del servidor MySQL
$usuario = "userdb";

// Contraseña del usuario
$contrasena = "userdb";

// Nombre de la base de datos
$baseDeDatos ="db_sys_cursos";

// Nombre de la tabla a trabajar
$tabla = "tb_cursos";

function Conectarse()
{
    global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla;

    if (!($link = mysqli_connect($host.":".$puerto, $usuario, $contrasena))) 
    { 
    echo "Error conectando a la base de datos.<br>"; 
    exit(); 
    }
    else
    {
    echo "Listo, estamos conectados.<br>";
    }
    if (!mysqli_select_db($link, $baseDeDatos)) 
    { 
    echo "Error seleccionando la base de datos.<br>"; 
    exit(); 
    }
    else
    {
    echo "Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
    }
return $link; 
} 

$link = Conectarse(); 


mysql_close($link);

?>

</body> 
</html>