<?php
    session_start();
    $conexion = mysqli_connect("localhost", "root", "", "facturacion2");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
        $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

        // Consulta para verificar credenciales
        $query = "SELECT * FROM usuario WHERE usuario = '$usuario' AND clave = '$clave'";
        $resultado = mysqli_query($conexion, $query);
        
        if (mysqli_num_rows($resultado) > 0) {
              // Guardar datos en la sesión
            $row = mysqli_fetch_assoc($resultado);
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['rol'] = $row['rol'];
             // Usuario válido → Redirige a otra página
            header("Location: pages/home.php");
            exit();
        } else {
            // Usuario incorrecto → Muestra alerta con JavaScript
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Estilos.css">
    <title>Iniciar Sesion en FactuSmart</title>
</head>
<body>
    <form  method = "post">
        <h2>FactuSmart</h2>
        <label for="usuario">Usuario </label>
        <input type="text" name="usuario" class="input" placeholder="Ingresar Usuario" required>
        <label for="clave">Contraseña </label>
        <input type="password" name="clave" class="input" placeholder="Ingrese su contraseña" id="asd" required>
        <input type="submit" class="button" value="Ingresar al sistema">
    </form>
    
</body>
</html>
