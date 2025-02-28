<?php
$con = mysqli_connect("localhost", "root", "", "facturacion2");

$id = isset($_POST["idusuario"]) ? $_POST["idusuario"] : '';
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
$correo = isset($_POST["correo"]) ? $_POST["correo"] : '';
$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
$rol = isset($_POST["rol"]) ? $_POST["rol"] : 2;

$buscador = isset($_POST['buscador']) ? $_POST['buscador'] : ''; 

$consultaFiltro = "";
if (!empty($buscador)) {
    $consultaFiltro = " WHERE nombre LIKE '%" . mysqli_real_escape_string($con, $buscador) . "%'";
}

if (isset($_POST["actualizar"])) {
    if (empty($nombre) || empty($correo) || empty($usuario) || empty($rol)) {
        echo "<script>window.alert('Rellena todos los campos para actulizar el registro.')</script>";
    } else {
        echo "<script>window.alert('Registro actualizado correctamente.')</script>";
        $consulta = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', usuario = '$usuario',  rol = $rol WHERE idusuario = '$id'";
        $enviarQuery = mysqli_query($con, $consulta);
    }
}

if (isset($_POST["eliminar"])) {
    if(empty($id)){
        echo"<script>window.alert('Completa el campo id para eliminar un registro.')</script>";
    }else{
    echo "<script>window.alert('Registro eliminado correctamente.')</script>";
    $consulta = "DELETE FROM usuario WHERE idusuario = '$id'";
    $enviarQuery = mysqli_query($con, $consulta);
    }
}

// Paginación
$usuariosPorPagina = 10; // Número de usuarios por página
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $usuariosPorPagina;

$queryTotalUsuarios = "SELECT COUNT(*) as total FROM usuario";
$resultTotal = mysqli_query($con, $queryTotalUsuarios);
$totalUsuarios = mysqli_fetch_assoc($resultTotal)['total'];
$totalPaginas = ceil($totalUsuarios / $usuariosPorPagina);

$queryUsuarios = "SELECT * FROM usuario" .$consultaFiltro. " LIMIT $inicio, $usuariosPorPagina";
$result = mysqli_query($con, $queryUsuarios);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../css/listaUsuarios.css">
</head>
<body>
<header>
    <div class="header">
        <h1>Lista De Usuarios</h1>
        <div class="optionsBar">
            <p>República Dominicana, <?php echo date('Y-M-D'); ?></p>
            <span>|</span>
            <span class="user">Luis Daniel Dilone</span>
            <img class="photouser" src="../img/user.png" alt="Usuario">
            <a href="index.php"><img class="close" src="../img/salir.png" alt="Salir del sistema" title="Salir"></a>
        </div>
    </div>
    <nav>
        <ul>
            <li><a href="home.php">Inicio</a></li>
            <li class="principal">
                <a href="#">Usuarios</a>
                <ul>
                    <li><a href="register.php">Nuevo Usuario</a></li>
                    <li><a href="#">Lista de Usuarios</a></li>
                </ul>
            </li>
            <li class="principal">
                <a href="#">Clientes</a>
                <ul>
                    <li><a href="#">Nuevo Cliente</a></li>
                    <li><a href="#">Lista de Clientes</a></li>
                </ul>
            </li>
            <li class="principal">
                <a href="#">Proveedores</a>
                <ul>
                    <li><a href="#">Nuevo Proveedor</a></li>
                    <li><a href="#">Lista de Proveedores</a></li>
                </ul>
            </li>
            <li class="principal">
                <a href="#">Productos</a>
                <ul>
                    <li><a href="#">Nuevo Producto</a></li>
                    <li><a href="#">Lista de Productos</a></li>
                </ul>
            </li>
            <li class="principal">
                <a href="#">Facturas</a>
                <ul>
                    <li><a href="#">Nuevo Factura</a></li>
                    <li><a href="#">Facturas</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<section>
    <form action="" method="post">
        <div class="buscar">
        <input type="text" name="buscador" placeholder="Filtrar registros por nombre"> <input type="submit" value="Buscar"> 
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['idusuario'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['correo'] . "</td>";
                        echo "<td>" . $row['usuario'] . "</td>";
                        echo "<td>" . $row['rol'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay usuarios registrados</td></tr>";
                }
                ?>
            </tbody>
			<tfooter>
			<tr>
					<th class="grey"><input type="text" name="idusuario" id="idusuario" placeholder="Ingrese el ID"></th>
					<th class="grey"><input type="text" name="nombre" id="nombre" placeholder="Ingrese el Nombre"></th>
					<th class="grey"><input type="email" name="correo" id="correo" placeholder="Ingrese el Email"></th>
					<th class="grey"><input type="text" name="usuario" id="usuario" placeholder="Ingrese el usuario"></th>
					<th class="grey"><select name = "rol">
                    <option value="1" name="1">Administrador</option>
                    <option value="2" name="2">Cajero</option>
				    <option value="3" name="3">Reponedor</option>
					</select></th>
				</tr>
			</tfooter>
        </table>

		<input type="submit" class="button" name="actualizar" value="Actualizar Registro">
		<input type="submit" class="button" name="eliminar" value="Eliminar Registro">

        <div class="pagination">
            <?php
            if ($paginaActual > 1) {
                echo "<a href='?pagina=" . ($paginaActual - 1) . "'>&laquo; Anterior</a>";
            }
            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo "<a href='?pagina=$i' " . ($i == $paginaActual ? "class='active'" : "") . ">$i</a>";
            }
            if ($paginaActual < $totalPaginas) {
                echo "<a href='?pagina=" . ($paginaActual + 1) . "'>Siguiente &raquo;</a>";
            }
            ?>
        </div>
    </form>
</section>
</body>
</html>

