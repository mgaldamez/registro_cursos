<?php
ob_start();
date_default_timezone_set('America/El_Salvador');
$hoy = date("d-M-Y");
$page=$_GET['page'];
$type=$_GET['type'];
if(isset($_GET['rptname'])){
require_once('../clases/rptMisc.class.php');
$rptClass = new RptMisc();
$i = $_GET['rptname'];

switch ($i) {
	
case "rpt01":
if(isset($_GET['InputCrsIni']) && isset($_GET['InputCrsFin'])){


header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=rpt_tot_Emp_Curso_$hoy.xls");
header("Pragma: no-cache");
header("Expires: 0");
$fechaIni = $_GET['InputCrsIni'];
$fechaFin = $_GET['InputCrsFin'];

$vDet = $rptClass->viewTotEmpByUb($fechaIni,$fechaFin);
//$vDet = $rptClass->viewDet($idCurso);



?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<table>
<thead>
<tr>
              <td colspan="4">
              <h2>Reporte Total de empleados que asistieron a Cursos </h2>
              </td>
              </tr>
 <tr>
 <td>Fecha Inicio: <?php echo $fechaIni; ?></td>
 <td>Fecha Fin: <?php echo $fechaFin; ?></td>
 </tr>            
              <tr><td><br></td></tr>
                <tr>
                  <th>Ubicacion</th>
                  <th>Total de empleados</th>
                  
                </tr>
            </thead>
            <tbody>
            <?php 
if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  
					  foreach($data as $valor){
				  			echo "<tr>
				                  <td>"; echo $valor['UBICACION']; echo "</td>
				                  <td>"; echo $valor['TOT_EMP']; echo "</td>
				                </tr>";
					
					  }
}
            
            
            ?>  

</tbody>
</table>
</html>

<?php 

}else{
	header("location: ../rptMisc.php?page=".$page."&type=".$type);
}
break;
case "rpt02":
if(isset($_GET['InputCrsIni']) && isset($_GET['InputCrsFin'])){


header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=rpt_tot_CursoByEmp_$hoy.xls");
header("Pragma: no-cache");
header("Expires: 0");
$fechaIni = $_GET['InputCrsIni'];
$fechaFin = $_GET['InputCrsFin'];

$vDet = $rptClass->viewTotCurByEmp($fechaIni,$fechaFin);
//$vDet = $rptClass->viewDet($idCurso);



?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<table>
<thead>
<tr>
              <td colspan="4">
              <h2>Reporte Total de Cursos por empleado</h2>
              </td>
              </tr>
 <tr>
 <td>Fecha Inicio: <?php echo $fechaIni; ?></td>
 <td>Fecha Fin: <?php echo $fechaFin; ?></td>
 </tr>            
              <tr><td><br></td></tr>
                <tr>
                  <th>Nombre</th>
                  <th>Genero</th>
                  <th>Cargo</th>
                  <th>Ubicacion</th>
                  <th>Cursos Convocados</th>
                  <th>Cursos Finalizados</th>
                </tr>
            </thead>
            <tbody>
            <?php 
if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  
					  foreach($data as $valor){
					
					  	if($valor['emp_genero']=='F'){
					  		   $gen = 'Femenino';
					  	}else{ $gen = 'Masculino'; }
				  			echo "<tr>
				  			      <td>"; echo $valor['emp_nombre']." ".$valor['emp_apellido']; echo "</td>
				                  <td>".$gen."</td>
				                  <td>"; echo $valor['emp_cargo']; echo "</td>
				                  <td>"; echo $valor['dpt_nombre']; echo "</td>
				                  <td>"; echo $valor['tot_con']; echo "</td>
				                  <td>"; echo $valor['tot_crs']; echo "</td>
				                </tr>";
					
					  }
}
            
            
            ?>  

</tbody>
</table>
</html>

<?php 

}else{
	header("location: ../rptMisc.php?page=".$page."&type=".$type);
}
	
	break;
case "rpt03":
	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=rpt_Estadistico_$hoy.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	
	$vDet = $rptClass->viewCrsByStatus();
	$vDet2 = $rptClass->viewTotEmpByCrs();
	$vDet3 = $rptClass->viewTotEmpByCrsByGen();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<table>
	<thead>
		<tr>
			<td colspan="4">
			<h2>Reporte Estadistico de Cursos</h2>
			</td>
		</tr>

		<tr>
			<td><br>
			</td>
		</tr>
		<tr>
			<td colspan="4">
			<h2>Total de Cursos Agrupados por Status</h2>
			</td>
		</tr>
		<tr>
			<th>Status</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
            <?php 
            if($vDet["msj"]==true){
            	$data = $vDet["data"];
            		
            	foreach($data as $valor){

            		echo "<tr>
				                  <td>".$valor['status']."</td>
				                  <td>".$valor['total']."</td>
				                  
				         </tr>";
            			
            	}
            }
            
            
            ?>  

</tbody>
<thead align="right">
		<tr>
			<td><br>
			</td>
		</tr>
		<tr>
			<td colspan="4">
			<h2>Total de Empleados por Curso</h2>
			</td>
		</tr>
		<tr>
			<th>Nombre Curso</th>
			<th>Status</th>
			<th>Total Emp</th>
		</tr>
	</thead>
	<tbody>
	<?php 
            if($vDet2["msj"]==true){
            	$data = $vDet2["data"];
            	$hoy2 = strtotime (date("d M Y"));
            	foreach($data as $valor){
            		if (strtotime ($valor['crs_fin']) < $hoy2 ) {
            			$status ="Finalizado";
            		}elseif($hoy2 >= strtotime ($valor['crs_ini']) &&   $hoy2 <= strtotime ($valor['crs_fin'])) {
            			$status = "En proceso";
            		}else{
            		$status ="Sin Comenzar";
            		}

            		echo "<tr>
				                  <td>".$valor['crs_nombre']."</td>
				                 
				                  <td>".$status."</td>
				                  <td>".$valor['total_emp']."</td>
				                  
				         </tr>";
            			
            	}
            }else{
            echo $vDet2["msj"];
            }
            
            
            ?> 
	</tbody>
	<thead>
		<tr>
			<td><br>
			</td>
		</tr>
		<tr>
			<td colspan="4">
			<h2>Total de Empleados por Curso y Genero</h2>
			</td>
		</tr>
		<tr>
			<th>Nombre Curso</th>
			<th>Genero</th>
			<th>Total Emp</th>
		</tr>
	</thead>
		<tbody>
	<?php 
            if($vDet3["msj"]==true){
            	$data = $vDet3["data"];
            	
            	foreach($data as $valor){
            		if ($valor['emp_genero']=='F' ) {
            			$genero ="Femenino";
            		}else{
            		$genero ="Masculino";
            		}

            		echo "<tr>
				                  <td>".$valor['crs_nombre']."</td>
				                 
				                  <td>".$genero."</td>
				                  <td>".$valor['total_emp']."</td>
				                  
				         </tr>";
            			
            	}
            }else{
            echo $vDet2["msj"];
            }
            
            
            ?> 
	</tbody>
</table>
</html>
<?php		
	
break;
}

}else{
	header("location: ../rptMisc.php?page=".$page."&type=".$type);
}
  ob_end_flush();

?>
