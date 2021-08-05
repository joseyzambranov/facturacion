<?php
include "../conexion.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!----------------------script------------------------------------------>
	<?php include"include/script.php" ?>

	<title>Lista de Usuario</title>
</head>
<body>
	<!-------------------------header--------------------------------->
	<?php include"include/header.php" ?>

	<section id="container">

		<h1>Lista de Usuario</h1>
		<a href="registro_usuario.php" class="btn_new">Crear usuario</a>
		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
			<?php
			$query=mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol 
													FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");

				$result=mysqli_num_rows($query);
				if($result>0){

					while($data = mysqli_fetch_array($query)){
						?>
						<tr>
							<td><?php echo $data['idusuario']?></td>
							<td><?php echo $data['nombre']?></td>
							<td><?php echo $data['correo']?></td>
							<td><?php echo $data['usuario']?></td>
							<td><?php echo $data['rol']?></td>
							<td>
								<a class="link_edit" href="editar_usuario.php?id=<?php echo $data['idusuario']?>">Editar</a>
								|
								<a class="link_delete" href="#">Eliminar</a>
							</td>
						</tr>
						<?php
					}

				}
			?>
		
		</table>
	
	</section>

	<!------------------------footer---------------------------------->
	<?php include"include/footer.php" ?>	

</body>
</html>