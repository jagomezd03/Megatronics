<?php 
session_start(); 
 
include('conexion.php'); 

$username=$_POST["username"];
$password=trim($_POST["password"]);

$consulta="select * from usuario where doc_usuario=".$username." AND clave=".$password;

$res_consulta=mysqli_query($link,$consulta);
$datos=mysqli_fetch_array($res_consulta, MYSQLI_ASSOC);
if ($datos=""){
  mysqli_free_result($res_consulta);
        echo "<script>alert('El usuario no existe o la clave no corresponde') location.href='../index.html'</script>";
}
else {
	$_SESSION['nom_usuario']=strtoupper($datos['nom_usuario']);
	$_SESSION['apellido_usuario']=strtoupper($datos['apellido_usuario']);
	$_SESSION['doc_usuario']=$datos['doc_usuario'];
	$_SESSION['perfil']=strtoupper($datos['perfil']);
	$_SESSION['sessionid'] = session_id();
	mysqli_free_result($res_consulta);
	if ($_SESSION['perfil']="EMPLEADO"){
		header("Location:../../empleado");
	}
	else{
		header("Location:../../administrador");
	}
	mysqli_close();
}
?>  