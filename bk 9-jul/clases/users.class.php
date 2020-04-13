<?php
require_once ('db.class.php');
require_once ('roles.class.php');
Class Usuario{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Usuario(){
		$this->conn=new Operacion;
	}

	function newUser($user,$usr_identificacion,$usr_nombre,$usr_apellido,$usr_correo,$usr_tel,$usr_tel2,$usr_user,$usr_password,$usr_estado,$usr_rol){
		$usr_nombre=str_replace($this->replace,"",(strip_tags($usr_nombre)));
		$usr_apellido=str_replace($this->replace,"",(strip_tags($usr_apellido)));
		$usr_identificacion=str_replace($this->replace,"",(strip_tags($usr_identificacion)));
		$usr_correo=str_replace($this->replace,"",(strip_tags($usr_correo)));
		$usr_tel=str_replace($this->replace,"",(strip_tags($usr_tel)));
		$usr_tel2=str_replace($this->replace,"",(strip_tags($usr_tel2)));
		$usr_user=str_replace($this->replace,"",(strip_tags($usr_user)));
		$usr_password=str_replace($this->replace,"",(strip_tags($usr_password)));
		$usr_estado=str_replace($this->replace,"",(strip_tags($usr_estado)));
		$usr_rol=str_replace($this->replace,"",(strip_tags($usr_rol)));
		
		$sql="INSERT INTO tb_usuarios (USR_IDENTIFICACION,USR_NOMBRE,USR_APELLIDO,USR_CORREO,USR_TEL,USR_TEL2,USR_USER,USR_PASSWORD,USR_ESTADO,USR_ROL) VALUES ('$usr_identificacion','$usr_nombre','$usr_apellido','$usr_correo','$usr_tel','$usr_tel2','$usr_user',AES_ENCRYPT('$usr_password','uaciOpico2015'),'$usr_estado',$usr_rol)";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function updateUser($user,$usr_identificacion,$usr_nombre,$usr_apellido,$usr_correo,$usr_tel,$usr_tel2,$usr_user,$usr_password,$usr_estado,$usr_creat,$usr_rol,$idUser){
		$usr_nombre=str_replace($this->replace,"",(strip_tags($usr_nombre)));
		$usr_apellido=str_replace($this->replace,"",(strip_tags($usr_apellido)));
		$usr_identificacion=str_replace($this->replace,"",(strip_tags($usr_identificacion)));
		$usr_correo=str_replace($this->replace,"",(strip_tags($usr_correo)));
		$usr_tel=str_replace($this->replace,"",(strip_tags($usr_tel)));
		$usr_tel2=str_replace($this->replace,"",(strip_tags($usr_tel2)));
		$usr_user=str_replace($this->replace,"",(strip_tags($usr_user)));
		$usr_password=str_replace($this->replace,"",(strip_tags($usr_password)));
		$usr_estado=str_replace($this->replace,"",(strip_tags($usr_estado)));
		$usr_creat=str_replace($this->replace,"",(strip_tags($usr_creat)));
		$usr_rol=str_replace($this->replace,"",(strip_tags($usr_rol)));
		
		$sql="update tb_usuarios set USR_IDENTIFICACION = '$usr_identificacion', USR_NOMBRE = '$usr_nombre', USR_APELLIDO = '$usr_apellido',USR_CORREO='$usr_correo',USR_TEL='$usr_tel',USR_TEL2='$usr_tel2',USR_USER='$usr_user',USR_PASSWORD=AES_ENCRYPT('$usr_password','uaciOpico2015'),USR_ESTADO='$usr_estado',USR_ROL=$usr_rol where USR_ID = $idUser";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function deleteUser($idUser){
				
		$sql="delete from tb_usuarios  where user_id =$idUser";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}	
					
	}
	function viewUser(){
		$sql="select 
usr_id,usr_identificacion,usr_nombre,usr_apellido,usr_correo,usr_tel,usr_tel2,usr_user,usr_password,usr_estado,DATE_FORMAT(usr_creat,'%d %b %y') AS usr_creat,usr_rol, rol_nombre
		 from tb_usuarios join tb_rol on tb_usuarios.usr_rol=tb_rol.rol_id";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysql_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
	}
	function viewUserById($idUser){
			$sql="select usr_id,usr_identificacion,usr_nombre,usr_apellido,usr_correo,usr_tel,usr_tel2,usr_user,AES_DECRYPT(usr_password,'uaciOpico2015') usr_password,usr_estado,DATE_FORMAT(usr_creat,'%d %b %y') AS usr_creat,usr_rol from tb_usuarios where usr_id=$idUser";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Usuario seleccionado no existe");
			}
	}
	function ddlRol(){
		$rolClass = new Rol();
		
		return $rolClass->viewRol();
	}
		
}


?>