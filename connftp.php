<?php
session_start();
require('clases/login.class.php');

$log = new Login;
if(isset( $_POST["inputUser"]) && !empty($_POST["inputUser"]) && isset($_POST["inputPassword"]) ){
$usuario = $_POST["inputUser"];
$password = $_POST["inputPassword"];
}else{
		header('Location: index.html?id=error');
}

$result = $log->evlogin($usuario,$password);

if($result["msj"]==true){
		//echo $result["user"];
		if($result["estado"]=='A'){
			$_SESSION['us'] =$result["user"];
			$_SESSION['rol'] =$result["rol"];
			$_SESSION['estado'] =$result["estado"];
			
			header('Location: dashboard.php');
		}else{
			header('Location: index.html?id=inactive');
		}
		
}elseif($result["msj"]==false){
		header('Location: index.html?id=error');
}


?>