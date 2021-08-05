<?php

/*----------------coneccion a mysqul---------*/

include "../conexion.php";

/*------------------------------REGISTRAR USUARIO--------------------------------*/
if(!empty($_POST))
{
    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';
    }else
    {
        $idusuario=$_POST['idusuario'];
        $nombre=$_POST['nombre'];
        $correo= $_POST['correo'];
        $user= $_POST['usuario'];
        $clave= md5 ($_POST['clave']);
        $rol= $_POST['rol'];
        /*-------------------------VALIDAR SI EXISTE USUARIO O CORREO----------------------------------*/
        $query = mysqli_query($conection,"SELECT * FROM usuario 
                                                    WHERE (usuario = '$user' AND idusuario != $idusuario) 
                                                    OR (correo = '$correo' AND idusuario != $idusuario) ");
        $result = mysqli_fetch_array($query);

        if($result > 0 ){
            $alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
        }else{
            /*---------------------EDITAR USUARIO-------------------------*/
            if(empty($_POST['clave'])){
                $sql_update = mysqli_query($conection,"UPDATE usuario 
                                                        SET nombre = '$nombre', correo = '$correo', usuario='$user', rol = '$rol' 
                                                        WHERE idusuario = $idusuario ");

            }else{
                $sql_update = mysqli_query($conection,"UPDATE usuario 
                                                        SET nombre = '$nombre', correo = '$correo', usuario='$user',clave='$clave', rol = '$rol' 
                                                        WHERE idusuario = $idusuario ");
            }
            if($sql_update){
                $alert='<p class="msg_save">Usuario actualizado correctamente</p>';
            }else{
                $alert='<p class="msg_error">Error al actualizar el usuario.</p>';
            }                                                
        }
    }
}
/*------validar id de lista de usuario------*/
if(empty($_GET['id'])){
    header('location:lista_usuario.php');
}
$iduser = $_GET['id'];
$sql=mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol 
                    FROM usuario u 
                    INNER JOIN rol r 
                    on u.rol = r.idrol 
                    WHERE idusuario= $iduser");

$result_sql=mysqli_num_rows($sql);
if($result_sql==0){
    header('location:lista_usuario.php');
}else{
    $option='';
    while($data=mysqli_fetch_array($sql)){

        $iduser  = $data['idusuario'];
        $nombre  = $data['nombre'];
        $correo  = $data['correo'];
        $usuario = $data['usuario'];
        $idrol   = $data['idrol'];
        $rol     = $data['rol'];

        if($idrol==1){
            $option='<option value="'.$idrol.'"select>'.$rol.'</option>';
        }elseif($idrol==2){
            $option='<option value="'.$idrol.'"select>'.$rol.'</option>';
        }elseif($idrol==3){
            $option='<option value="'.$idrol.'"select>'.$rol.'</option>';
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
                <input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
                <label for="correo">Correo electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $correo; ?>">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave" placeholder="Clave de accéso">
                <label for="rol">Tipo de Usuario</label>

                <?php 
                $query_rol= mysqli_query($conection,"SELECT * FROM rol");
                $result_rol= mysqli_num_rows($query_rol);
                ?>

                <select name="rol" id="rol" class="notitenone">
                    <?php
                        echo $option;
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