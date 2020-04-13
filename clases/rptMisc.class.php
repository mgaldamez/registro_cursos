<?php
require_once ('db.class.php');
require_once ('roles.class.php');
Class RptMisc{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function RptMisc(){
		$this->conn=new Operacion;
	}

	function viewTotEmpByUb($fechaIni,$fechaFin){
			$sql="select dpt_nombre AS UBICACION,count(emp_id) as TOT_EMP from tb_departamentos dp join tb_empleados em on dp.dpt_id=em.emp_depto join tb_part_curso pc on pc.empleado_id= em.emp_id join tb_cursos c on c.crs_id = pc.CURSO_ID where ( c.crs_ini between '$fechaIni' and '$fechaFin') or (c.crs_fin between '$fechaIni' and '$fechaFin') group by dpt_nombre";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Curso seleccionado no existe");
			}
	}
	
	function viewTotCurByEmp($fechaIni,$fechaFin){
			$sql="select emp_nombre, emp_apellido, emp_cargo, emp_genero , dpt_nombre,count(*) as tot_con ,(select count(*) from tb_part_curso c where c.FIN_CHECK='Y' and c.EMPLEADO_ID=e.emp_id) as tot_crs from tb_empleados e join tb_part_curso pc on e.emp_id = pc.empleado_id  join tb_cursos c on c.crs_id = pc.curso_id join tb_departamentos d on e.emp_depto= d.dpt_id  where ( c.crs_ini between '$fechaIni' and '$fechaFin') or (c.crs_fin between '$fechaIni' and '$fechaFin')  group by  emp_nombre, emp_apellido,dpt_nombre,emp_cargo";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}else{
				return $valores=array("msj"=>false,"data"=>"El Curso seleccionado no existe");
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
		/*Funciones reporte Estadistico*/
		function viewCrsByStatus(){
			$sql = "select 'Finalizados' status, count(*) total  from tb_cursos where crs_fin < sysdate() union all
select 'En proceso', count(*) total  from tb_cursos where  sysdate() between crs_ini and crs_fin union all
select 'Sin comenzar', count(*) total  from tb_cursos where crs_ini >= sysdate()";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysqli_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
			
		}
		
function viewTotEmpByCrs(){
			$sql="select crs_nombre, count(*) total_emp,  DATE_FORMAT(crs_ini,'%d %b %Y') AS crs_ini, DATE_FORMAT(crs_fin,'%d %b %Y') AS crs_fin from tb_part_curso join tb_cursos on crs_id = curso_id group by CURSO_ID";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysqli_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
			
		}
		
function viewTotEmpByCrsByGen(){
			$sql="select crs_nombre,emp_genero, count(*) total_emp from tb_part_curso join tb_cursos on crs_id = curso_id join tb_empleados on emp_id = EMPLEADO_ID group by CURSO_ID, emp_genero";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysqli_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}else{
			return $valores=array("msj"=>false,"data"=>"No hay Datos que mostrar");
		}
			
		}
		
		

		
}


?>