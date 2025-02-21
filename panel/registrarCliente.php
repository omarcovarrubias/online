<?php
#Salir si alguno de los datos no está presente
 
#Si todo va bien, se ejecuta esta parte del código...

include 'conexion.php';
$Nombres = $_POST["Nombres"];
$Apellidos = $_POST["Apellidos"];
$Email = $_POST["Email"];
$Telefono = $_POST["Telefono"];
$nombre_usuario = $_POST["nombre_usuario"];
$clave = $_POST["clave"];
$clave=  hash('sha512',$clave);

$sentencia = $base_de_datos->prepare("INSERT INTO usuarios(nombre_usuario,clave,estado,nombres,apellidos,email,celular,rol_id) VALUES (?, ?,1, ?,?,?,?,3);");
$resultado = $sentencia->execute([$nombre_usuario,$clave,$Nombres, $Apellidos, $Email, $Telefono]);


 



if($resultado === TRUE){
	header("Location: index.php");
 	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
 