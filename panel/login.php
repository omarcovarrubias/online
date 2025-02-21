<?php

$nombre_usuario=$_POST['nombre_usuario'];
$clave=$_POST['clave'];

$clave2= hash('sha512',$clave);

session_start();
$_SESSION['nombre_usuario']=$nombre_usuario;

$conexion=mysqli_connect("localhost","root","","tienda_online");

$consulta="SELECT*FROM usuarios where nombre_usuario='$nombre_usuario' and clave='$clave2' OR clave='$clave'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);

if($filas['rol_id']==1){ //administrador
    header("Location: ./Usuarios/dashboard.php");

}else
if($filas['rol_id']==3){ //cliente
header("location: ../index.php");
}
else{
    ?>
    <?php    
    
    header("Location: index.php");
     ?>
    
    <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
    <?php
} 
mysqli_free_result($resultado);
mysqli_close($conexion);
