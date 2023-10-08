<?php
$serverName = "DESKTOP-7V1JAQI\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "Presupuesto",
    "Uid" => "",  // Nombre de usuario
    "PWD" => ""   // Contraseña
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Verificar la conexión
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>


