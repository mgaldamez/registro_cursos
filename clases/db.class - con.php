<?php 
class Conexion{
	var $conect;
		
	function conectar() {
		if(!($con=mysql_connect('localhost','rreesvco_cursos','Cur$0$2016'))){
			echo"<h1> Error al conectar a la base de datos</h1>";	
			exit();
		}
		if(!(mysql_select_db('rreesvco_sys_cursos'))){
			echo"<h1> Error al conectar a la base de datos</h1>";	
			exit();
		}
		
		return $this->conect=$con;
	}
	
	function desconectar()
	{
		mysql_close($this->conect);
	}

}
class Operacion{
	
	 	var $conn;
 	function Operacion(){
 		$this->conn=new Conexion;
 	}
	function execute($sql)
	{
		$link=$this->conn->conectar();
		if($link==true)
		{
			return mysql_query($sql,$link);
			
		}
		$this->conn->desconectar();
	}
}



?>
