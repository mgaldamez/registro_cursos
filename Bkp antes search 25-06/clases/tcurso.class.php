<?php
require_once ('db.class.php');

Class TipoCursos{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function TipoCursos(){
		$this->conn=new Operacion;
	}

	function newTCurso($user,$tpc_nombre,$tpc_desc){
		$tpc_nombre=str_replace($this->replace,"",(strip_tags($tpc_nombre)));
		$tpc_desc=str_replace($this->replace,"",(strip_tags($tpc_desc)));
		
		
		$sql="INSERT INTO tb_tipo_curso (tpc_nombre,tpc_desc) VALUES ('$tpc_nombre','$tpc_desc')";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function updateTCurso($user,$tpc_nombre,$tpc_desc,$idTCurso){
		$tpc_nombre=str_replace($this->replace,"",(strip_tags($tpc_nombre)));
		$tpc_desc=str_replace($this->replace,"",(strip_tags($tpc_desc)));
		
		$sql="update tb_tipo_curso set tpc_nombre= '$tpc_nombre',tpc_desc = '$tpc_desc' where tpc_id = $idTCurso";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function deleteTCurso($idTCurso){
				
		$sql="delete from tb_tipo_curso  where tpc_id =$idTCurso";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}	
					
	}
	function viewTCurso(){
		$sql="select tpc_id,tpc_nombre,tpc_desc from tb_tipo_curso";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysql_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
	}
	function viewTCursoById($idTCurso){
			$sql="select tpc_id,tpc_nombre,tpc_desc from tb_tipo_curso where tpc_id=$idTCurso";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Tipo de Curso seleccionado no existe");
			}
	}

		
}


?>