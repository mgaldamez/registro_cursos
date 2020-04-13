<?php
ob_start();
date_default_timezone_set('America/El_Salvador');
$hoy = date("d-M-Y");

if(isset($_POST['InputCrsId2'])){
require_once('../clases/rptDcursos.class.php');
$rptClass = new RptCurso();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=rpt_Curso_$hoy.xls");
header("Pragma: no-cache");
header("Expires: 0");
$idCurso = $_POST['InputCrsId2'];
$detCurso = $rptClass->viewCursoById($idCurso);
$vDet = $rptClass->viewDet($idCurso);
if($detCurso["msj"]==true){
  $data = $detCurso["data"];
  

$nombreCurso= $data[0]['crs_nombre'];
$jornadaCurso= $data[0]['crs_jornada'];
$fIniCurso= $data[0]['crs_ini'];
$fFinCurso= $data[0]['crs_fin'];
$PatCurso= $data[0]['pat_nombre'];
$ponente= $data[0]['crs_ponente'];
  }


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<table>
<thead>
<tr>
              <td colspan="4">
              <h2>Reporte para Curso <b>"<?php echo $nombreCurso; ?>"</b></h2>
              </td>
              </tr>
              <tr>
              	<td><b>Jornadas:</b> <?php echo $jornadaCurso; ?><br>
					<b>Fecha Inicio:</b> <?php echo $fIniCurso;?><br>
					<b>Fecha Fin:</b> <?php echo $fFinCurso;?> <br>
					<b>Patrocinador:</b> <?php echo $PatCurso;?> <br>        	
					<b>Ponente:</b> <?php echo $ponente;?> <br>        	
              	</td>
              </tr>
              <tr><td><br></td></tr>
                <tr>
                  <th>Nombre</th>
                  <th>Genero</th>
                  <th>Cargo</th>
                  <th>Departamento</th>
                <th>Finalizo Curso</th>
                </tr>
            </thead>
            <tbody>
            <?php 
if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  
					  foreach($data as $valor){
					  	if($valor['fin_check']=='Y'){
					  		
							$chk="Si";
					  	}else{
					  		$chk="No";
					  	}
					  if($valor['emp_genero']=='F'){
					  		   $gen = 'Femenino';
					  	}else{ $gen = 'Masculino'; }
				  			echo "<tr>
				                  <td>"; echo $valor['nombre']; echo "</td>
				                   <td>".$gen."</td>
				                  <td>"; echo $valor['emp_cargo']; echo "</td>
								  <td>"; echo $valor['dpt_nombre']; echo "</td>
								  <td>".$chk."</td>
				                </tr>";
					
					  }
}
            
            
            ?>  

</tbody>
</table>
</html>

<?php 

}else{
	header("location: ../dashboard.php");
}
  ob_end_flush();

?>
