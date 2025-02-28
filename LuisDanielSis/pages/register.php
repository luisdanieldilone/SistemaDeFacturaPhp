<?php
$conexion = mysqli_connect('localhost','root','','facturacion2');

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] :'';
$correo = isset($_POST['correo']) ? $_POST['correo']: '';
$usuario = isset($_POST['usuario']) ? $_POST['usuario']: '';
$clave = isset($_POST['clave']) ? $_POST['clave']: '';
$rol = isset($_POST['rol']) ? $_POST['rol']: '';

if(isset($_POST['enviar'])){
	echo "<script>window.alert('Datos insertados correctamente');</script>";
    $query = "INSERT INTO usuario(nombre, correo, usuario, clave, rol) VALUES('$nombre', '$correo','$usuario','$clave', $rol)";
    $enviarQuery = mysqli_query($conexion, $query);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/registrar.css">
	<title>Registrar Nuevo Usuario</title>
</head>
<body>
	<header>
		<div class="header">
			<h1>Registrar Nuevo Usuario</h1>
			<div class="optionsBar">
			<p>República Dominicana, <?php $fechaActua= date('Y-M-D'); echo "$fechaActua"?></p>
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
						<li><a href="listaDeUsuarios.php">Lista de Usuarios</a></li>
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
	<section id="formularioDeRegistro">
		<form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre completo" required>
            <label for="correo">Correo Electronico:</label>
            <input type="email" name="correo" id="correo" placeholder="Ingrese su Email" required>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" placeholder="Ingrese un usuario" required>
            <label for="clave">Clave:</label>
            <input type= "password" name="clave" id="clave" placeholder="Ingrese su contraseña" required>
            <label for="rol">Rol: </label>
            <select name = "rol">
                <option value="1" name="1">Administrador</option>
                <option value="2" name="2">Cajero</option>
				<option value="3" name="3">Reponedor</option>
            </select>
            <input type="submit" name="enviar" value="Registrar">
        </form>
	</section>
</body>
</html>