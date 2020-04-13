<?php
require_once ('db.class.php');

Class Detalle{
		
	var $conn;
	var $replace = array("'", "/", "=");
	function Detalle(){
		$this->conn=new Operacion;
	}
	
	function newDetalle($user,$type, $InputVhlId, $InputDate, $InputSolicita, $InputNvale, $InputVVale,	$InputNGalones,	$InputPGalones,
	$InputFactura,$InputVFactura,	$InputUbicacion, $InputObra){
		
		$InputSolicita=str_replace($this->replace,"",(strip_tags($InputSolicita)));
		$InputUbicacion=str_replace($this->replace,"",(strip_tags($InputUbicacion)));
		$InputObra=str_replace($this->replace,"",(strip_tags($InputObra)));
		
		$sql="INSERT INTO tb_detalle_combustible(det_fecha,det_solicitante,det_num_vale,det_valor_vale,det_galones,det_valor_galon,det_factura,det_valor_factura,det_ubicacion,det_obra,vhl_id, type_id) ".
		" VALUES ('$InputDate','$InputSolicita','$InputNvale','$InputVVale','$InputNGalones','$InputPGalones','$InputFactura','$InputVFactura','$InputUbicacion','$InputObra','$InputVhlId','$type')";
		$rs=$this->conn->execute($sql);
		if ($rs) {
			return $valores=array("msj"=>true);
		}else{
			return $valores=array("msj"=>false,"data"=>$sql);
		}		
	}
	function updateDetalle($user,$InputVhlId, $InputDate, $InputSolicita, $InputNvale, $InputVVale,	$InputNGalones,	$InputPGalones,
	$InputFactura,$InputVFactura,	$InputUbicacion, $InputObra, $type, $det_id){
			$InputSolicita=str_replace($this->replace,"",(strip_tags($InputSolicita)));
		$InputUbicacion=str_replace($this->replace,"",(strip_tags($InputUbicacion)));
		$InputObra=str_replace($this->replace,"",(strip_tags($InputObra)));
			
		$sql="UPDATE tb_detalle_combustible SET det_fecha='$InputDate',det_solicitante='$InputSolicita',det_num_vale=$InputNvale,det_valor_vale=$InputVVale,
det_galones=$InputNGalones,det_valor_galon=$InputPGalones, det_factura=$InputFactura,det_valor_factura=$InputVFactura,det_ubicacion='$InputUbicacion',det_obra='$InputObra',vhl_id=$InputVhlId,type_id=$type WHERE det_id=$det_id";
			$rs=$this->conn->execute($sql);
			
			if ($rs) {
				return $valores=array("msj"=>true);
			}else{
				return $valores=array("msj"=>false);
			}		
		}
		function deleteDetalle($det_id,$type){
					
			$sql="delete from tb_detalle_combustible  where det_id =$det_id and type_id=$type";
			$rs=$this->conn->execute($sql);
			
			if ($rs) {
				return $valores=array("msj"=>true);
			}else{
				return $valores=array("msj"=>false);
			}	
				
		}
	function viewDetalle($user,$type){
			$sql="SELECT det_id, det_fecha, det_solicitante, det_num_vale, det_valor_vale, det_galones, det_valor_galon, det_factura, det_valor_factura, det_ubicacion, det_obra, dc.vhl_id, vhl_nombre FROM tb_detalle_combustible dc join tb_vehiculo vhl on dc.vhl_id = vhl.vhl_id join tb_type tp on vhl.vhl_type = tp.type_id where vhl.vhl_type=$type";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}
		}
	function viewDetalleById($type,$det_id){
			$sql="SELECT det_id, det_fecha, det_solicitante, det_num_vale, det_valor_vale, det_galones, det_valor_galon, det_factura, det_valor_factura, det_ubicacion, det_obra, dc.vhl_id, vhl_nombre FROM tb_detalle_combustible dc join tb_vehiculo vhl on dc.vhl_id = vhl.vhl_id join tb_type tp on vhl.vhl_type = tp.type_id where vhl_type=$type and det_id=$det_id";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}
		}
	function viewDetalleByReport($type,$vhl_id ,$fecha_ini, $fecha_fin){
		
			$sql="SELECT det_id, det_fecha, det_solicitante, det_num_vale, det_valor_vale, det_galones, det_valor_galon, det_factura, det_valor_factura, det_ubicacion, det_obra, dc.vhl_id, vhl_nombre FROM tb_detalle_combustible dc join tb_vehiculo vhl on dc.vhl_id = vhl.vhl_id join tb_type tp on vhl.vhl_type = tp.type_id where  vhl.vhl_type=$type and  det_fecha between '$fecha_ini' and '$fecha_fin' ";
			if($vhl_id <> 'ALL'){
				 $sql.=" and vhl.vhl_id=$vhl_id ";
			}
			$sql.='';
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set,"error"=>$sql);
			}else{
				return $valores=array("msj"=>false,"data"=>null,"error"=>$sql);
			}
		}
	function ddlVehiculo($type){
	$sql="select vhl_id, vhl_nombre, vhl_type from tb_vehiculo vhl join tb_type tp on vhl.vhl_type = tp.type_id where type_id=$type";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}
	}
	
	function detVehiculoById($id){
	$sql="select vhl_id, vhl_nombre from tb_vehiculo  where vhl_id=$id";
			$rs=$this->conn->execute($sql);
			
			$numRows = mysqli_num_rows($rs);	
			
			if($numRows > 0){
				
				for ($set = array(); $fila = mysqli_fetch_assoc($rs); $set[] = $fila);
				
				return $valores=array("msj"=>true,"data"=>$set);
			}
	}
		
}


?>