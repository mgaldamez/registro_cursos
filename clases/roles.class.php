<?php
require_once ('db.class.php');

Class Rol{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Rol(){
		$this->conn=new Operacion;
	}
	
	function newRol($user,$nombre,$descripcion,$estado){
		$nombre=str_replace($this->replace,"",(strip_tags($nombre)));
		$descripcion=str_replace($this->replace,"",(strip_tags($descripcion)));
		$estado=str_replace($this->replace,"",(strip_tags($estado)));
		
		$sql="INSERT INTO tb_rol (rol_nombre, rol_descripcion, rol_estado) VALUES ('$nombre', '$descripcion',  '$estado')";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function updateRol($user,$nombre,$descripcion,$estado,$idRol){
			$nombre=str_replace($this->replace,"",(strip_tags($nombre)));
			$descripcion=str_replace($this->replace,"",(strip_tags($descripcion)));
			$estado=str_replace($this->replace,"",(strip_tags($estado)));
			
			$sql="update tb_rol set rol_nombre = '$nombre', rol_descripcion = '$descripcion', rol_estado = '$estado' where rol_id =$idRol";
			$rs=$this->conn->execute($sql);
			
			if ($rs) {
				return $valores=array("msj"=>true);
			}else{
				return $valores=array("msj"=>false);
			}		
		}
		function deleteRol($idRol){
					
					$sql="delete from tb_rol  where rol_id =$idRol";
					$rs=$this->conn->execute($sql);
					
					if ($rs) {
						return $valores=array("msj"=>true);
					}else{
						return $valores=array("msj"=>false);
					}	
						
				}
	function viewRol(){
			$sql="select rol_id, rol_nombre, rol_descripcion, rol_estado from tb_rol";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
			}
		}
	function viewRolById($idRol){
			$sql="select rol_id, rol_nombre, rol_descripcion, rol_estado from tb_rol where rol_id=$idRol";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Rol seleccionado no existe");
			}
		}
		
}


?>