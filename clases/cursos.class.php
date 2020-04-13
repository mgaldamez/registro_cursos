<?php
require_once ('db.class.php');
require_once ('roles.class.php');
Class Curso{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Curso(){
		$this->conn=new Operacion;
	}

	function newCurso($user,$crs_nombre,$crs_tipo,$crs_jornada,$crs_ini,$crs_fin,$crs_patrocinador,$crs_status,$crs_ponente,$crs_det_gasto,$crs_form_pago,$crs_num_doc){
		$crs_nombre=str_replace($this->replace,"",(strip_tags($crs_nombre)));
		$crs_tipo=str_replace($this->replace,"",(strip_tags($crs_tipo)));
		$crs_jornada=str_replace($this->replace,"",(strip_tags($crs_jornada)));
		$crs_ini=str_replace($this->replace,"",(strip_tags($crs_ini)));
		$crs_fin=str_replace($this->replace,"",(strip_tags($crs_fin)));
		$crs_patrocinador=str_replace($this->replace,"",(strip_tags($crs_patrocinador)));
		$crs_status=str_replace($this->replace,"",(strip_tags($crs_status)));
		$crs_ponente=str_replace($this->replace,"",(strip_tags($crs_ponente)));
		$crs_form_pago=str_replace($this->replace,"",(strip_tags($crs_form_pago)));
		$crs_num_doc=str_replace($this->replace,"",(strip_tags($crs_num_doc)));
		
		
		$sql="INSERT INTO tb_cursos (crs_nombre, crs_tipo, crs_jornada, crs_ini, crs_fin, crs_patrocinador, crs_status,crs_ponente,crs_det_gasto,crs_form_pago,crs_num_doc) VALUES ('$crs_nombre','$crs_tipo','$crs_jornada','$crs_ini','$crs_fin','$crs_patrocinador','$crs_status','$crs_ponente','$crs_det_gasto','$crs_form_pago','$crs_num_doc')";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>$rs);
		}		
	}
	function updateCurso($user,$crs_nombre,$crs_tipo,$crs_jornada,$crs_ini,$crs_fin,$crs_patrocinador,$crs_status,$crs_ponente,$crs_det_gasto,$crs_form_pago,$crs_num_doc,$crs_id){
		$crs_nombre=str_replace($this->replace,"",(strip_tags($crs_nombre)));
		$crs_tipo=str_replace($this->replace,"",(strip_tags($crs_tipo)));
		$usr_identificacion=str_replace($this->replace,"",(strip_tags($usr_identificacion)));
		$crs_jornada=str_replace($this->replace,"",(strip_tags($crs_jornada)));
		$crs_ini=str_replace($this->replace,"",(strip_tags($crs_ini)));
		$crs_fin=str_replace($this->replace,"",(strip_tags($crs_fin)));
		$crs_patrocinador=str_replace($this->replace,"",(strip_tags($crs_patrocinador)));
		$crs_status=str_replace($this->replace,"",(strip_tags($crs_status)));
		$crs_ponente=str_replace($this->replace,"",(strip_tags($crs_ponente)));
		$crs_form_pago=str_replace($this->replace,"",(strip_tags($crs_form_pago)));
		$crs_num_doc=str_replace($this->replace,"",(strip_tags($crs_num_doc)));
		
		$sql="update tb_cursos set crs_nombre= '$crs_nombre',crs_tipo = '$crs_tipo',crs_jornada='$crs_jornada',crs_ini='$crs_ini',crs_fin='$crs_fin',crs_patrocinador='$crs_patrocinador',crs_status='$crs_status',crs_ponente='$crs_ponente',crs_det_gasto=$crs_det_gasto,crs_form_pago='$crs_form_pago',crs_num_doc='$crs_num_doc' where crs_id = $crs_id";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function deleteCurso($crs_id){
				
		$sql="delete from tb_cursos  where crs_id =$crs_id";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}	
					
	}
	function viewCurso(){
		$sql="select crs_id, crs_nombre,crs_ponente,crs_det_gasto,crs_form_pago,crs_num_doc, tc.tpc_nombre as crs_tipo, crs_jornada, DATE_FORMAT(crs_ini,'%d %b %y') AS crs_ini, DATE_FORMAT(crs_fin,'%d %b %y') AS crs_fin, p.pat_nombre as crs_patrocinador, crs_status from tb_cursos c join tb_patrocinadores p on c.crs_patrocinador = p.pat_id join tb_tipo_curso tc  on c.crs_tipo = tc.tpc_id";
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
			$sql="select crs_id, crs_nombre, crs_ponente,crs_det_gasto,crs_form_pago,crs_num_doc, crs_tipo, crs_jornada, crs_ini, crs_fin, crs_patrocinador, crs_status from tb_cursos where crs_id=$crs_id";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Curso seleccionado no existe");
			}
	}
	function viewDetCur($crs_id) {
		$sql="select emp_id,concat(emp_nombre, ' ', emp_apellido) as nombre,emp_cargo, emp_depto, dpt_nombre, DATE_FORMAT(emp_fecha_nac,'%d %b %Y') AS emp_fecha_nac,emp_ubicacion from tb_empleados emp join tb_part_curso on emp.emp_id = empleado_id join tb_departamentos on emp_depto=dpt_id where curso_id=$crs_id";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Curso seleccionado no posee Empleados");
			}
	}
	
function getCrsName($crs_id) {
		$sql = "select crs_nombre as nombre from tb_cursos where crs_id=$crs_id";
		$rs=$this->conn->execute($sql);
		$result = mysqli_fetch_assoc($rs);
		return $result;
	}
	function ddlMenuType(){
			$sql ="select tpc_id,tpc_nombre from tb_tipo_curso";
			$rs=$this->conn->execute($sql);
			$numRows = mysqli_num_rows($rs);
			if($numRows > 0){
					
					for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
					
					return $valores=array("msj"=>true,"data"=>$set);
				}else{
					return $valores=array("msj"=>false,"data"=>"El Tipo seleccionado no existe");
				}
		}
	function ddlMenuPat(){
			$sql ="select pat_id,pat_nombre from tb_patrocinadores";
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