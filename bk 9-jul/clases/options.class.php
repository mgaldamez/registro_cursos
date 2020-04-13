<?php
require_once ('db.class.php');

Class Option{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Option(){
		$this->conn=new Operacion;
	}
	
	function newOption($user,$nombre,$descripcion,$estado){
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
	function updateOption($user,$nombre,$descripcion,$estado,$idOption){
			$nombre=str_replace($this->replace,"",(strip_tags($nombre)));
			$descripcion=str_replace($this->replace,"",(strip_tags($descripcion)));
			$estado=str_replace($this->replace,"",(strip_tags($estado)));
			
			$sql="update tb_rol set rol_nombre = '$nombre', rol_descripcion = '$descripcion', rol_estado = '$estado' where rol_id =$idOption";
			$rs=$this->conn->execute($sql);
			
			if ($rs) {
				return $valores=array("msj"=>true);
			}else{
				return $valores=array("msj"=>false);
			}		
		}
		function deleteOption($idOption){
					
					$sql="delete from tb_rol  where rol_id =$idOption";
					$rs=$this->conn->execute($sql);
					
					if ($rs) {
						return $valores=array("msj"=>true);
					}else{
						return $valores=array("msj"=>false);
					}	
						
				}
	function viewOption(){
			$sql="select OPC_ID, OPC_LABEL, OPC_ACTION, OPC_ESTADO, OPC_ID_PADRE, OPC_ORDEN, OPC_ORDEN, MENU_TYPE_ID, SUBMENU from tb_opcion";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
			}
		}
	function viewOptionById($idOption){
			$sql="select rol_id, rol_nombre, rol_descripcion, rol_estado from tb_rol where rol_id=$idOption";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Option seleccionado no existe");
			}
		}
		
}


?>