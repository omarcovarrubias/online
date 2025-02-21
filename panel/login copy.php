



<?php
if($_SERVER['REQUEST_METHOD'] ==='POST'){

$nombre_usuario =$_POST['nombre_usuario'];
$clave =$_POST['clave'];
require '../vendor/autoload.php';
    $usuario = new Procedimientos\Usuario;
    $clienteCompra = new Procedimientos\ClienteCompra;
    $resultado = $usuario->login($nombre_usuario,$clave);
    $resultado2= $clienteCompra->login2($nombre_usuario,$clave,$rol_id);
    
    /*$conexion=mysqli_connect("localhost","root","","tienda_online");
    $consulta = "SELECT * FROM usuarios where nombre_usuario='$nombre_usuario' and clave='$clave'";
    $resultado=mysqli_query($conexion,$consulta);
    $filas=mysqli_fetch_array($resultado);

    if($filas['rol_id']==2)
    {
        
        header("location: dashboard.php");
    }else
    {
    if($filas['rol_id']==3)
    {
        header("location: ../index.php");
    }
}
*/
?>

 
 <?php
    if($resultado)
    {
        session_start();
        $_SESSION['usuario_info']= array(
            'nombre_usuario'=>$resultado['nombre_usuario'],
            'estado'=>1
        );
        
        header('Location: dashboard.php');

    }
    else
    {
         header ('Location: index.php');
         echo "<script>alert('Usuario No Registrado');window,history.go(-1);</script>";
 
        }


    }?>