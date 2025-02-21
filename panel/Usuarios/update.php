<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM usuarios WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$nombre_usuario=$_POST['nombre_usuario'];
 		$nombres=$_POST['nombres'];
		$apellidos=$_POST['apellidos'];
		$email=$_POST['email'];
		$celular=$_POST['celular'];		
		$id=(int) $_GET['id'];

		if(!empty($nombre_usuario)     && !empty($nombres)&& !empty($apellidos)&& !empty($email) && !empty($celular)){
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE usuarios SET  
					nombre_usuario=:nombre_usuario,
 					nombres=:nombres,
					apellidos=:apellidos,
					email=:email,
					celular=:celular
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre_usuario' =>$nombre_usuario,
 					':nombres' =>$nombres,
					':apellidos' =>$apellidos,
					':email' =>$email,
					':celular' =>$celular,
					':id' =>$id
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
	<title>Editar Usuarios</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="contenedor">
		<h2>MODIFICAR INFORMACION DEL USUARIO</h2>
		<form action="" method="post">
			<div class="form-group">
				
				<input type="text" name="nombre_usuario" value="<?php if($resultado) echo $resultado['nombre_usuario']; ?>"  class="input__text">
 			</div>
			<div class="form-group">
			<input type="text" name="nombres" value="<?php if($resultado) echo $resultado['nombres']; ?>"  class="input__text">
			<input type="text" name="apellidos" value="<?php if($resultado) echo $resultado['apellidos']; ?>"  class="input__text">
			</div>
			<div class="form-group">
			<input type="text" name="email" value="<?php if($resultado) echo $resultado['email']; ?>"  class="input__text">
			</div>
			<div class="form-group">
			<input type="text" name="celular" value="<?php if($resultado) echo $resultado['celular']; ?>"  class="input__text">
			</div>
			<div class="btn__group">
				<a href="dashboard.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
 
</body>
</html>
