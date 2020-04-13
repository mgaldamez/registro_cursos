<?php
require_once ('db.class.php');
require_once ('roles.class.php');
Class Usuario{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Usuario(){
		$this->conn=new Operacion;
	}

	function newEmp($user,$emp_nombre,$emp_apellido,$emp_fecha_nac,$emp_depto,$emp_genero,$emp_cargo,$emp_nivel_acad,$emp_ubicacion,$emp_fecha_ing){
		$emp_nombre=str_replace($this->replace,"",(strip_tags($emp_nombre)));
		$emp_apellido=str_replace($this->replace,"",(strip_tags($emp_apellido)));
		$usr_identificacion=str_replace($this->replace,"",(strip_tags($usr_identificacion)));
		$emp_fecha_nac=str_replace($this->replace,"",(strip_tags($emp_fecha_nac)));
		$emp_depto=str_replace($this->replace,"",(strip_tags($emp_depto)));
		$emp_genero=str_replace($this->replace,"",(strip_tags($emp_genero)));
		$emp_cargo=str_replace($this->replace,"",(strip_tags($emp_cargo)));
		$emp_nivel_acad=str_replace($this->replace,"",(strip_tags($emp_nivel_acad)));
		$emp_ubicacion=str_replace($this->replace,"",(strip_tags($emp_ubicacion)));
		$emp_fecha_ing=str_replace($this->replace,"",(strip_tags($emp_fecha_ing)));
		
		$sql="INSERT INTO tb_empleados (emp_nombre,emp_apellido,emp_fecha_nac,emp_genero,emp_depto,emp_cargo,emp_nivel_acad,emp_ubicacion,emp_fecha_ing) VALUES ('$emp_nombre','$emp_apellido','$emp_fecha_nac', '$emp_genero', '$emp_depto', '$emp_cargo','$emp_nivel_acad','$emp_ubicacion','$emp_fecha_ing')";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function updateEmp($user,$emp_nombre,$emp_apellido,$emp_fecha_nac,$emp_genero,$emp_depto,$emp_cargo,$emp_nivel_acad,$emp_ubicacion,$emp_fecha_ing,$idUser){
		$emp_nombre=str_replace($this->replace,"",(strip_tags($emp_nombre)));
		$emp_apellido=str_replace($this->replace,"",(strip_tags($emp_apellido)));
		$usr_identificacion=str_replace($this->replace,"",(strip_tags($usr_identificacion)));
		$emp_fecha_nac=str_replace($this->replace,"",(strip_tags($emp_fecha_nac)));
		$emp_genero=str_replace($this->replace,"",(strip_tags($emp_genero)));
		$emp_depto=str_replace($this->replace,"",(strip_tags($emp_depto)));
		$emp_cargo=str_replace($this->replace,"",(strip_tags($emp_cargo)));
		$emp_nivel_acad=str_replace($this->replace,"",(strip_tags($emp_nivel_acad)));
		$emp_ubicacion=str_replace($this->replace,"",(strip_tags($emp_ubicacion)));
		$emp_fecha_ing=str_replace($this->replace,"",(strip_tags($emp_fecha_ing)));
		
		$sql="update tb_empleados set emp_nombre= '$emp_nombre',emp_apellido = '$emp_apellido',emp_fecha_nac='$emp_fecha_nac',emp_genero='$emp_genero',emp_cargo='$emp_cargo',emp_nivel_acad='$emp_nivel_acad',emp_ubicacion='$emp_ubicacion',emp_fecha_ing='$emp_fecha_ing',emp_depto='$emp_depto' where emp_id = $idUser";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}		
	}
	function deleteEmp($idUser){
				
		$sql="delete from tb_empleados  where emp_id =$idUser";
		$rs=$this->conn->execute($sql);
		
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false);
		}	
					
	}
	function viewEmp(){
		$sql="select emp_id,emp_nombre,emp_apellido, emp_depto, dpt_nombre,DATE_FORMAT(emp_fecha_nac,'%d %b %y') AS emp_fecha_nac,emp_genero,emp_cargo,emp_nivel_acad,emp_ubicacion,DATE_FORMAT(emp_fecha_ing,'%d %b %y') AS emp_fecha_ing from tb_empleados emp left join tb_departamentos dpt on emp.emp_depto = dpt.dpt_id";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysql_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
	}
	function viewEmpById($idUser){
			$sql="select emp_id,emp_nombre,emp_apellido, emp_depto, dpt_nombre, emp_fecha_nac,emp_genero,emp_cargo,emp_nivel_acad,emp_ubicacion, emp_fecha_ing from tb_empleados emp left join tb_departamentos dpt on emp.emp_depto = dpt.dpt_id where emp_id=$idUser";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysql_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Usuario seleccionado no existe");
			}
	}
	
	function ddlMenuDepto(){
	$sql ="select dpt_id,dpt_nombre from tb_departamentos";
			$rs=$this->conn->execute($sql);
			$numRows = mysql_num_rows($rs);
			if($numRows > 0){
					
					for ($set = array(); $fila = mysql_fetch_assoc($rs); $set[] = $fila);
					
					return $valores=array("msj"=>true,"data"=>$set);
				}else{
					return $valores=array("msj"=>false,"data"=>"El Tipo seleccionado no existe");
				}
	}

		
}


?>