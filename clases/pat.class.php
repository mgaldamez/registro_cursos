<?php
require_once ('db.class.php');

Class Patrocinadores{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Patrocinadores(){
		$this->conn=new Operacion;
	}

	function newPat($user,$pat_nombre,$pat_desc){
		$pat_nombre=str_replace($this->replace,"",(strip_tags($pat_nombre)));
		$pat_desc=str_replace($this->replace,"",(strip_tags($pat_desc)));
		
		
		$sql="INSERT INTO tb_patrocinadores (pat_nombre,pat_desc) VALUES ('$pat_nombre','$pat_desc')";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function updatePat($user,$pat_nombre,$pat_desc,$idPat){
		$pat_nombre=str_replace($this->replace,"",(strip_tags($pat_nombre)));
		$pat_desc=str_replace($this->replace,"",(strip_tags($pat_desc)));
		
		$sql="update tb_patrocinadores set pat_nombre= '$pat_nombre',pat_desc = '$pat_desc' where pat_id = $idPat";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function deletePat($idPat){
				
		$sql="delete from tb_patrocinadores  where pat_id =$idPat";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}	
					
	}
	function viewPat(){
		$sql="select pat_id,pat_nombre,pat_desc from tb_patrocinadores";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysqli_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
	}
	function viewPatById($idPat){
			$sql="select pat_id,pat_nombre,pat_desc from tb_patrocinadores where pat_id=$idPat";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Patrocinador seleccionado no existe");
			}
	}

		
}


?>