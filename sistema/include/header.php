<?php

/*-------------saber si hay session activa--------------*/
session_start();
if(empty($_SESSION['active'])){
    header('location:../');
}
?>
<header>
		<div class="header">
			
			<h1>Sistema Facturación</h1>
			<div class="optionsBar">
				<p>Peru - Lima, <?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['usuario'] ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<!----------------------nav---------------------------------->
        <?php include "include/nav.php" ?>
	</header>