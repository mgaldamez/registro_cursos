<?php
require_once ('db.class.php');

Class Menu{
		
	var $conn;
	function Menu(){
		$this->conn=new Operacion;
	}
	
	function impMenu($user,$rol){
		$sql="SELECT opc_label,o.opc_id,OPC_ACTION, opc_orden, opc_action, o.opc_id FROM  tb_opcion as o inner join tb_opcion_x_rol as xr on o.opc_id = xr.opc_id  where xr.rol_id=$rol order by OPC_ID_PADRE";
		$rs=$this->conn->execute($sql);
		
		$numRows = mysqli_num_rows($rs);	
		
		if($numRows > 0){
			
			for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
			
			return $valores=array("msj"=>true,"data"=>$set);
		}
	}
		
}


?>