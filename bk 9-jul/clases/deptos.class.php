<?php
require_once ('db.class.php');
require_once ('roles.class.php');
Class Depto{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Depto(){
		$this->conn=new Operacion;
	}

	function newDepto($user,$dpt_nombre,$dpt_desc){
		$dpt_nombre=str_replace($this->replace,"",(strip_tags($dpt_nombre)));
		$dpt_desc=str_replace($this->replace,"",(strip_tags($dpt_desc)));
		
		
		$sql="INSERT INTO tb_departamentos (dpt_nombre, dpt_desc) VALUES ('$dpt_nombre','$dpt_desc')";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>$rs);
		}		
	}
	function updateDepto($user,$dpt_nombre,$dpt_desc,$dpt_id){
		$dpt_nombre=str_replace($this->replace,"",(strip_tags($dpt_nombre)));
		$dpt_desc=str_replace($this->replace,"",(strip_tags($dpt_desc)));
		
		
		$sql="update tb_departamentos set dpt_nombre= '$dpt_nombre',dpt_desc = '$dpt_desc' where dpt_id = $dpt_id";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function deleteDepto($dpt_id){
				
		$sql="delete from tb_departamentos  where dpt_id =$dpt_id";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}	
					
	}
	function viewDepto(){
		$sql="select dpt_id, dpt_nombre,  dpt_desc from tb_departamentos";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysql_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
	}
	function viewDeptoById($dpt_id){
			$sql="select dpt_id, dpt_nombre,  dpt_desc from tb_departamentos where dpt_id=$dpt_id";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Depto seleccionado no existe");
			}
	}
	

		
}


?>