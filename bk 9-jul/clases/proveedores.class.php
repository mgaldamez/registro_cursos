<?php
require_once ('db.class.php');

Class Proveedor{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Proveedor(){
		$this->conn=new Operacion;
	}
	
	function newProveedor($user,$page,$nombre,$telefono,$telefono2,$direccion,$apod,$comment,$type){
		$nombre=str_replace($this->replace,"",(strip_tags($nombre)));
		$telefono=str_replace($this->replace,"",(strip_tags($telefono)));
		$telefono2=str_replace($this->replace,"",(strip_tags($telefono2)));
		$direccion=str_replace($this->replace,"",(strip_tags($direccion)));
		$apod=str_replace($this->replace,"",(strip_tags($apod)));
		$comment=str_replace($this->replace,"",(strip_tags($comment)));
		
		$sql="INSERT INTO tb_proveedores (prv_nombre, prv_telefono, prv_telefono2, prv_direccion, prv_apod_legal, prv_comentario, prv_type_id) VALUES ('$nombre', '$telefono', '$telefono2', '$direccion', '$apod', '$comment', $type)";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function updateProveedor($user,$prv_id,$nombre,$telefono,$telefono2,$direccion,$apod,$comment,$type){
			$nombre=str_replace($this->replace,"",(strip_tags($nombre)));
			$telefono=str_replace($this->replace,"",(strip_tags($telefono)));
			$telefono2=str_replace($this->replace,"",(strip_tags($telefono2)));
			$direccion=str_replace($this->replace,"",(strip_tags($direccion)));
			$apod=str_replace($this->replace,"",(strip_tags($apod)));
			$comment=str_replace($this->replace,"",(strip_tags($comment)));
			
			$sql="update tb_proveedores set prv_nombre = '$nombre', prv_telefono = '$telefono', prv_telefono2 = '$telefono2', prv_direccion = '$direccion', prv_apod_legal = '$apod', prv_comentario = '$comment' where prv_id =$prv_id and prv_type_id=$type";
			$rs=$this->conn->execute($sql);
			
			if ($rs) {
				return $valores=array("msj"=>true);
			}else{
				return $valores=array("msj"=>false);
			}		
		}
		function deleteProveedor($prv_id,$type){
					
					$sql="delete from tb_proveedores  where prv_id =$prv_id and prv_type_id=$type";
					$rs=$this->conn->execute($sql);
					
					if ($rs) {
						return $valores=array("msj"=>true);
					}else{
						return $valores=array("msj"=>false);
					}	
						
				}
	function viewProveedor($user,$type){
			$sql="select prv_id, prv_nombre, prv_telefono, prv_telefono2, prv_apod_legal, prv_direccion, prv_comentario from tb_proveedores where prv_type_id=$type";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}
		}
	function viewProveedorById($type,$prv_id){
			$sql="select prv_id, prv_nombre, prv_telefono, prv_telefono2, prv_apod_legal, prv_direccion, prv_comentario from tb_proveedores where prv_type_id=$type and prv_id=$prv_id";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}
		}
		
}


?>