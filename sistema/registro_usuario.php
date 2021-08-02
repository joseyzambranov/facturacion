<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!----------------------script------------------------------------------>
	<?php include"include/script.php"; ?>

	<title>Registro Usuario</title>
</head>
<body>
	<!-------------------------header--------------------------------->
	<?php include"include/header.php" ?>

	<section id="container">
        <div class="form__register">

            <h1>Registro Usuario</h1>
            <hr>
            <div class="alert"></div>

            <form>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
                <label for="correo">Correo electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo electrónico">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave" placeholder="Clave de accéso">
                <label for="rol">Tipo de Usuario</label>
                <select name="rol" id="rol">
                    <option value="1">Administrador</option>
                    <option value="2">Supervisor</option>
                    <option value="3">Vendedor</option>
                </select>
                <input type="submit" value="Crear usuario" class="btn_save">
            </form>
            
        </div>
		
	</section>

	<!------------------------footer---------------------------------->
	<?php include"include/footer.php" ?>	

</body>
</html>