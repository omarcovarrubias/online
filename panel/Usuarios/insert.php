<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombre_usuario=$_POST['nombre_usuario'];
		$clave=$_POST['clave'];
		$nombres=$_POST['nombres'];
		$apellidos=$_POST['apellidos'];
		$email=$_POST['email'];
		$celular=$_POST['celular'];		
		$rol_id=1;
		

		if(!empty($nombre_usuario)  && !empty($clave) && !empty($nombres)&& !empty($apellidos)&& !empty($email) && !empty($celular)){
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO usuarios(nombre_usuario,clave,nombres,apellidos,email,celular,rol_id) VALUES(:nombre_usuario,:clave,:nombres,:apellidos,:email,:celular,:rol_id)');
				$consulta_insert->execute(array(
					':nombre_usuario' =>$nombre_usuario,
					':clave' =>$clave,
					':nombres' =>$nombres,
					':apellidos' =>$apellidos,
					':email' =>$email,
					':celular' =>$celular,
					':rol_id'=>$rol_id

				));
				header('Location: dashboard.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Usuario</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>AGREGAR UN NUEVO EMPLEADO</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre_usuario" placeholder="Usuario" class="input__text">
				<input type="text" name="clave" placeholder="Contraseña" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="nombres" placeholder="Nombres" class="input__text">
				<input type="text" name="apellidos" placeholder="Apellidos" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="email" placeholder="Correo electrónico" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="celular" placeholder="Numero celular" class="input__text">
			</div>
			<div class="btn__group">
				<a href="dashboard.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
