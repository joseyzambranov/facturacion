<?php

/*-------------saber si hay session activa--------------*/
session_start();
if(!empty($_SESSION['active'])){
    header('location:sistema/');
}else

{

/*----------login-----------*/
    $alert='';
    if(!empty($_POST)){
        if(empty($_POST['usuario']) || empty($_POST['clave'])){
            $alert="Ingresar usuario y clave";
        }else{

            require_once "conexion.php";

            $user = $_POST['usuario'];
            $pass = $_POST['clave'];

            $query = mysqli_query($conection,"SELECT * FROM  usuario WHERE usuario= '$user' AND clave = '$pass' ");
            $result = mysqli_num_rows($query);
            
            if($result>0){
                $data = mysqli_fetch_array($query);
                
                $_SESSION['active']= true;
                $_SESSION['idUser']= $data['usuario'];
                $_SESSION['nombre']= $data['nombre'];
                $_SESSION['correo']= $data['correo'];
                $_SESSION['usuario']= $data['usuario'];
                $_SESSION['rol']= $data['rol'];
                
                header('location:sistema/');
            }else{
                $alert='El usuario o la clave son incorrectos';
                session_destroy();
            }
        }
        
    }
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema facturacion</title>

    <!---------------------------- UNICONS---------------------------->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!---------------------------- styles css---------------------------->
    <link rel="stylesheet" href="./css/style.css">


</head>
<body>
    <section class="container">
        <form action="" method="post" class="form">
            <h3> 
            Iniciar Sesión
            </h3>
            
            <input class="input" type="text" name="usuario" placeholder="Usuario">
            <input class="input" type="password" name="clave" placeholder="Password">
            <div class="alert"><?php  echo isset($alert) ? $alert:''; ?></div>
            <button class="input input__button" type="submit">
            Ingresar
            <i class="uil uil-signin"></i>
            </button>
            


        </form>
    </section>
</body>
</html>