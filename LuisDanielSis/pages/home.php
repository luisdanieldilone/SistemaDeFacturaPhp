<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Sisteme Ventas</title>
</head>
<body>
	<header>
		<div class="header">
			<h1>Sistema Facturación</h1>
			<div class="optionsBar">
				<p>República Dominicana, <?php $fechaActua= date('Y-M-D'); echo "$fechaActua"?></p>
				<span>|</span>
				<span class="user">Luis Daniel Dilone </span>
				<img class="photouser" src="../img/user.png" alt="Usuario">
				<a href="index.php"><img class="close" src="../img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php session_start();?>

		<nav>
			<ul>
				<li><a href="#">Inicio</a></li>
				<?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
					<li class="principal">
						<a href="#">Usuarios</a>
						<ul>
							<li><a href="register.php">Nuevo Usuario</a></li>
							<li><a href="listaDeUsuarios.php">Lista de Usuarios</a></li>
						</ul>
					</li>
				<?php endif; ?>

				<?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2)): ?>
					<li class="principal">
						<a href="#">Clientes</a>
						<ul>
							<li><a href="#">Nuevo Cliente</a></li>
							<li><a href="#">Lista de Clientes</a></li>
						</ul>
					</li>
				<?php endif; ?>

				<?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3)): ?>
					<li class="principal">
						<a href="#">Proveedores</a>
						<ul>
							<li><a href="#">Nuevo Proveedor</a></li>
							<li><a href="#">Lista de Proveedores</a></li>
						</ul>
					</li>
				<?php endif; ?>

				<!-- Visible para Administradores (1) y Reponedores (3) -->
				<?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3)): ?>
					<li class="principal">
						<a href="#">Productos</a>
						<ul>
							<li><a href="#">Nuevo Producto</a></li>
							<li><a href="#">Lista de Productos</a></li>
						</ul>
					</li>
				<?php endif; ?>

				<?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2)): ?>
					<li class="principal">
						<a href="#">Facturas</a>
						<ul>
							<li><a href="#">Nueva Factura</a></li>
							<li><a href="#">Facturas</a></li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
		</nav>

	</header>
	<section id="container">
		<h1>Bienvenido al sistema</h1>
	</section>
</body>
</html>