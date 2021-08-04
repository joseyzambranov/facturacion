<?php

/*----------------coneccion a mysqul---------*/

include "../conexion.php";

/*------------------------------REGISTRAR USUARIO--------------------------------*/
if(!empty($_POST))
{
    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) ||
    empty($_POST['rol']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';
    }else
    {
    
        $nombre=$_POST['nombre'];
        $correo= $_POST['correo'];
        $user= $_POST['usuario'];
        $clave= md5 ($_POST['clave']);
        $rol= $_POST['rol'];
        /*-------------------------VALIDAR SI EXISTE USUARIO O CORREO----------------------------------*/
        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$correo' ");
        $result = mysqli_fetch_array($query);

        if($result > 0 ){
            $alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
        }else{
            /*---------------------REGISTRAR USUARIO-------------------------*/
            $query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol)
                                                            VALUES('$nombre','$correo','$user','$clave','$rol')");

            if($query_insert){
                $alert='<p class="msg_save">Usuario registrado correctamente</p>';
            }else{
                $alert='<p class="msg_error">Error al crear el usuario.</p>';
            }                                                
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!----------------------script------------------------------------------>
	<?php include"include/script.php"; ?>

	<title>Actualizar Usuario</title>
</head>
<body>
	<!-------------------------header--------------------------------->
	<?php include"include/header.php" ?>

	<section id="container">
        <div class="form__register">

            <h1>Actualizar Usuario</h1>
            <hr>
            <div class="alert"> <?php  echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
                <label for="correo">Correo electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo electrónico">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave" placeholder="Clave de accéso">
                <label for="rol">Tipo de Usuario</label>

                <?php 
                $query_rol= mysqli_query($conection,"SELECT * FROM rol");
                $result_rol= mysqli_num_rows($query_rol);
                ?>

                <select name="rol" id="rol">
                    <?php
                        if($result_rol>0)
                        {
                            while ($rol=mysqli_fetch_array($query_rol)){

                    ?>
                            <option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol'] ?></option>
                    <?php
                            }
                        }

                    ?>
                </select>
                <input type="submit" value="Actualizar usuario" class="btn_save">
            </form>
            
        </div>
		
	</section>

	<!------------------------footer---------------------------------->
	<?php include"include/footer.php" ?>	

</body>
</html>