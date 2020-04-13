<?php 
class Conexion{
	var $conect;
		
	function conectar() {
		if(!($con=mysqli_connect('localhost','userdb','userdb'))){
			echo"<h1> Error al conectar a la base de datos</h1>";	
			exit();
		}
		if(!(mysqli_select_db($con,'db_sys_cursos'))){
			echo"<h1> Error al conectar a la base de datos</h1>";	
			exit();
		}
		
		return $this->conect=$con;
	}
	
	function desconectar()
	{
		mysqli_close($this->conect);
	}

}
class Operacion{
	
	 	var $conn;
 	function __construct(){
 		$this->conn=new Conexion;
 	}
	function execute($sql)
	{
		$link=$this->conn->conectar();
		if($link==true)
		{
			return mysqli_query($link,$sql);
			
		}
		$this->conn->desconectar();
	}
}



?>
