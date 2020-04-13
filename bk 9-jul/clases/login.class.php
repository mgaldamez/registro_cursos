<?php
require('db.class.php');
class Login{
	var $conn;
	function Login(){
		$this->conn=new Operacion;
	}
	function evlogin($user,$password)
	{
		$replace = array("'", "/", "=");
		$usen=str_replace($replace,"",(strip_tags($user)));
		$pen=str_replace($replace,"",(strip_tags($password)));
		$sql="SELECT usr_user,AES_DECRYPT(usr_password,'uaciOpico2015') usr_password,usr_rol,usr_estado FROM tb_usuarios WHERE usr_user='$usen'";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysql_num_rows($rs);
		
		if($numRows > 0){
			
			while($fila = mysql_fetch_array($rs))
			{
				//echo $fila[2];
				if($usen==$fila['usr_user'] && $pen==$fila['usr_password']){
					return  $valores=array("msj"=>true,"user"=>$fila['usr_user'],"rol"=>$fila['usr_rol'],"estado"=>$fila['usr_estado']);
					}else{
						

					return $valores=array("msj"=>false);
				}	
				
				
			}
		}
		$this->conn->conn->desconectar();
	}
		
}



?>