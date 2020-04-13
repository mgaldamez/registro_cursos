<?php
require_once ('db.class.php');
require_once ('roles.class.php');
Class Curso{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Curso(){
		$this->conn=new Operacion;
	}

	function newDet($user,$crs_id,$emp_id){
		
		
		$sql="insert into tb_part_curso (curso_id,empleado_id,FIN_CHECK) values ($crs_id,$emp_id,'N')";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>$rs,"data"=>$sql);
		}		
	}
	
	function deleteEmpCurso($crs_id,$emp_id){
				
		$sql="delete from tb_part_curso  where curso_id =$crs_id and empleado_id=$emp_id";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}	
					
	}
	function viewDet($crs_id){
		$sql="select curso_id, emp_id,concat(emp_nombre, ' ', emp_apellido) as nombre,emp_cargo, emp_depto, dpt_nombre, fin_check from tb_empleados emp join tb_part_curso on emp.emp_id = empleado_id join tb_departamentos on emp_depto=dpt_id where curso_id=$crs_id";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysqli_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
	}
	function viewEnd($crs_id){
		$sql = "select CURDATE() today, crs_fin from tb_cursos where crs_id=$crs_id";
		$rs=$this->conn->execute($sql);
		$numRows = mysqli_num_rows($rs);	
		if($numRows > 0){
			
			for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
	}
	function viewCursoById($crs_id){
			$sql="select crs_id, crs_nombre, crs_tipo, crs_jornada, crs_ini, crs_fin, crs_patrocinador, crs_status from tb_cursos where crs_id=$crs_id";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Curso seleccionado no existe");
			}
	}
	function ddlCursos(){
			$sql ="SELECT crs_id, crs_nombre from tb_cursos WHERE crs_status='A'";
			$rs=$this->conn->execute($sql);
			$numRows = mysqli_num_rows($rs);
			if($numRows > 0){
					
					for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
					
					return $valores=array("msj"=>true,"data"=>$set);
				}else{
					return $valores=array("msj"=>false,"data"=>"El Tipo seleccionado no existe");
				}
		}
	
function ddlMenuDepto(){
			$sql ="select dpt_id,dpt_nombre from tb_departamentos";
			$rs=$this->conn->execute($sql);
			$numRows = mysqli_num_rows($rs);
			if($numRows > 0){
					
					for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
					
					return $valores=array("msj"=>true,"data"=>$set);
				}else{
					return $valores=array("msj"=>false,"data"=>"El Depto seleccionado no existe");
				}
		}
function ddlMenuEmp($depto_id,$crs_id){
			$sql ="select emp_id, concat(emp_nombre, ' ', emp_apellido) as emp_nombre from tb_empleados where emp_depto=$depto_id and emp_id not in(select empleado_id from tb_part_curso where curso_id=$crs_id)";
			$rs=$this->conn->execute($sql);
			$numRows = mysqli_num_rows($rs);
			if($numRows > 0){
					
					for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
					
					return $valores=array("msj"=>true,"data"=>$set);
				}else{
					return $valores=array("msj"=>false,"data"=>"El Depto seleccionado no existe");
				}
		}
function checkAllEmpCurso($crs_id) {
	$sql="update tb_part_curso set fin_check='Y'  where curso_id =$crs_id";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}
	
}
function checkEmpCurso($crs_id,$emp_id,$chk) {
	if($chk=='Y'){
		$chk='N';
	}else{
		$chk='Y';	
	}
	$sql="update tb_part_curso set fin_check='".$chk."'  where empleado_id=$emp_id and curso_id =$crs_id";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}
	
}
		
}


?>