



<?php

// Definir variables
$email = '';
$contrasena = '';
// Incluir la configuración para obtener la conexión a la base de datos
include_once('../config/config.php');

// include_once('../config/config.php');
// Verificar si se está enviando el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Validar los datos (puedes agregar más validaciones según necesites)

    // Consultar la base de datos para el usuario con el email dado
    $sql = "SELECT * FROM Usuarios WHERE Email='$email'";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $result = sqlsrv_query($conn, $sql, $params, $options);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row_count = sqlsrv_num_rows($result);
    if ($row_count === 1) {
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        if (password_verify($contrasena, $row['Contraseña'])) {
            echo "Inicio de sesión exitoso.";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    // Liberar el resultado
    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="post">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>


