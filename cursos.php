<?php 
require_once('clases/cursos.class.php');
require_once('clases/menu.class.php');
require('sesion.php');	
$us = $_SESSION['us'];
$rol = $_SESSION['rol'];
$menu = new Menu();
$userClass = new Curso(); 
if(isset($_GET['page'])){
	$page =$_GET['page'];
}else{
	$page='UACI';
}
if(isset($_GET['type'])){
	$type = $_GET['type'];
}
if(isset($_GET['action'])){
	if($_GET['action']!='report'){
		$action = $_GET['action'];
	}else{
		$action = 'insert';
	}
}else{
	$action = 'insert';
}
if(isset($_GET['idCurso'])){
	$idCurso = $_GET['idCurso'];
	$detById = $userClass->viewCursoById($idCurso);
}else{
	$detById = array('msj'=>false);
}

$result = $menu->impMenu($us,$rol);
$vDet= $userClass->viewCurso();
$ddlMenuType = $userClass->ddlMenuType();
$ddlMenuPat = $userClass->ddlMenuPat();

if(isset($_POST['guardar']) ){
	$InputCrsNombre = $_POST['InputCrsNombre'];
	$InputCrsTipo = $_POST['InputCrsTipo'];
	$InputCrsJornada = $_POST['InputCrsJornada'];
	$InputCrsIni = $_POST['InputCrsIni'];
	$InputCrsFin = $_POST['InputCrsFin'];
	$InputCrsPat = $_POST['InputCrsPat'];
	$InputCrsStat = $_POST['InputCrsStat'];
	$InputCrsPonente = $_POST['InputCrsPonente'];
	$InputCrsDGasto = $_POST['InputCrsDGasto'];
	$InputCrsFPago = $_POST['InputCrsFPago'];
	$InputCrsDocumento = $_POST['InputCrsDocumento'];
	
	$nResult = $userClass->newCurso($us, $InputCrsNombre,$InputCrsTipo,$InputCrsJornada,$InputCrsIni,$InputCrsFin,$InputCrsPat,$InputCrsStat,$InputCrsPonente,$InputCrsDGasto,$InputCrsFPago,$InputCrsDocumento);
	
	
	if ($nResult['msj']==true){
		ob_start();
		$goTo = ' cursos.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($nResult['msj']==false){
		ob_start();
		header('location: cursos.php?page='.$page.'&type='.$type.'&result=false&data='.$nResult['data']);
		echo $nResult['data'];
		ob_end_flush();
	}
	
}elseif (isset($_POST['actualizar'])){
	$idCurso = $_POST['idCurso'];
	$InputCrsNombre = $_POST['InputCrsNombre'];
	$InputCrsTipo = $_POST['InputCrsTipo'];
	$InputCrsJornada = $_POST['InputCrsJornada'];
	$InputCrsIni = $_POST['InputCrsIni'];
	$InputCrsFin = $_POST['InputCrsFin'];
	$InputCrsPat = $_POST['InputCrsPat'];
	$InputCrsStat = $_POST['InputCrsStat'];
	$InputCrsPonente = $_POST['InputCrsPonente'];
	$InputCrsDGasto = $_POST['InputCrsDGasto'];
	$InputCrsFPago = $_POST['InputCrsFPago'];
	$InputCrsDocumento = $_POST['InputCrsDocumento'];
	$uResult = $userClass->updateCurso($us,$InputCrsNombre,$InputCrsTipo,$InputCrsJornada,$InputCrsIni,$InputCrsFin,$InputCrsPat,$InputCrsStat,$InputCrsPonente,$InputCrsDGasto,$InputCrsFPago,$InputCrsDocumento,$idCurso);
	
	if ($uResult['msj']==true){
		ob_start();
		$goTo = ' cursos.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($uResult['msj']==false){
		ob_start();
		header('location: cursos.php?page='.$page.'&type='.$type.'&result=false&data='.$uResult['data']);
		ob_end_flush();
	}
}elseif (isset($_POST['eliminar'])){
	$idCurso = $_POST['idCurso'];
	$ddet = $userClass->deleteCurso($idCurso);
if ($ddet['msj']==true){
		ob_start();
		$goTo = 'cursos.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($ddet['msj']==false){
		ob_start();
		header('location: cursos.php?page='.$page.'&type='.$type.'&result=false');
		ob_end_flush();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Cursos System">
    <meta name="author" content="Marvin Galdamez">
    <link rel="icon" href="../../favicon.ico">

    <title><?=$page?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
<link href="css/bootstrap-select.min.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
     <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
    
     
	 <script type="text/javascript">
		
		 function getUrlParameter(sParam)
		 {
			 var sPageURL = window.location.search.substring(1);
			 var sURLVariables = sPageURL.split('&');
			 for (var i = 0; i < sURLVariables.length; i++) 
			 {
				 var sParameterName = sURLVariables[i].split('=');
				 if (sParameterName[0] == sParam) 
				 {
					 return sParameterName[1];
				 }
			 }
		 }  
		 
		 $( document ).ready(function() {
		 
			 var a = getUrlParameter('result');
			 
			 if(a){
				if(a=='true'){
				 $( "#true" ).slideToggle( "slow", function() {
					 // Animation complete.
					 $( "#true" ).slideUp(800).delay( 800 );
				 }).delay(2500);
				 }else if(a=='false'){
					 
					 $( "#false" ).slideToggle( "slow", function() {
						 // Animation complete.
						 $( "#falsee" ).slideUp(800).delay( 800 );
					 }).delay(2500);
					 } 
			}
		 });
		
		
		</script>
		
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Bienvenido <?php echo $us; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            
            <li><a href="logout.php">Cerrar Sesion</a></li>
          </ul>

        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
		  <?php 
			  if($result["msj"]==true){
				  $data = $result["data"];
				  
				  foreach($data as $valor){
					  if($valor['opc_orden']==0){
							echo '<li class="active"><a href="#">';echo $valor['opc_label']; echo '<span class="sr-only">(current)</span></a></li>' ;
						}else{
							echo '<li><a href="'; echo $valor['opc_action']; echo "?page=".$valor['opc_label']."&type="; echo $valor['opc_id']; echo '">'; echo $valor['opc_label']; echo '</a></li>';	
						}
				  }
			  }
		  ?>

          </ul>
        </div>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?=$page?></h1>

          <div class="row placeholders">
			  <div class="container">
				  <div class="row">
					  <form class="form-horizontal" role="form" action="<?php echo 'cursos.php?page='.$page.'&type='.$type;?>" method="post">
					  <input type="hidden" value="<?php if(isset($idCurso)){ echo $idCurso; } ?>" name="idCurso"/>
						  <div class="col-lg-6">
							  <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Campos Obligatorios</strong></div>
							  
							  <div class="form-group">
								  <label for="InputCrsNombre" class="col-sm-3 control-label">Nombre:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputCrsNombre" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_nombre']; }?>" name="InputCrsNombre" placeholder="Nombre del curso"  required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>

							  <div class="form-group">
								  <label for="InputCrsTipo" class="col-sm-3 control-label">Tipo:</label>
								  <div class="input-group col-md-5">
								  <select name="InputCrsTipo" class="selectpicker" data-width="400px">
								  <option <?php if($detById['msj']!=true){ echo 'selected'; } ?> >--Selecionar una Opcion--</option>
								    <?php 
				
								     if($ddlMenuType["msj"]==true){
										  $ddl = $ddlMenuType["data"];
										  
										  foreach($ddl as $valor){
										  	if($detById['msj']==true && $detById['data'][0]['crs_tipo'] == $valor['tpc_id']){
										  		echo "<option selected  value='".$valor['tpc_id']."'>".$valor['tpc_nombre']."</option>";
										  	}else{
											  echo "<option value='".$valor['tpc_id']."'>".$valor['tpc_nombre']."</option>";
										  	}
										  }
									  }
								    ?>
								  </select>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputCrsJornada" class="col-sm-3 control-label">Jornadas:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputCrsJornada" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_jornada']; }?>" name="InputCrsJornada" placeholder="Jornadas" maxlength="30" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputCrsPonente" class="col-sm-3 control-label">Ponente:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputCrsPonente" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_ponente']; }?>" name="InputCrsPonente" placeholder="Ponente" maxlength="120" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputCrsDGasto" class="col-sm-3 control-label">Det. Gasto:</label>
								  <div class="input-group col-sm-9">
									  <input type="number" step="any" class="form-control" id="InputCrsDGasto" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_det_gasto']; }?>" name="InputCrsDGasto" placeholder="Detalle de Gasto"  required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputCrsFPago" class="col-sm-3 control-label">Forma de pago:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputCrsFPago" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_form_pago']; }?>" name="InputCrsFPago" placeholder="Forma de pago" maxlength="50" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputCrsDocumento" class="col-sm-3 control-label">Nro de Documento:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputCrsDocumento" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_num_doc']; }?>" name="InputCrsDocumento" placeholder="Nro de Documento" maxlength="80" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
							    <label for="InputCrsIni" class="col-sm-3 control-label">Fecha Inicio:</label>
					                <div class='input-group date form_date col-md-5'  data-date-format="yyyy-mm-dd" data-link-field="InputCrsIni" id='datetimepicker1' data-link-format="yyyy-mm-dd">
					                    <input type='text' name="InputCrsIni" class="form-control" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_ini']; }?>" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
							  </div>
							  <div class="form-group">
							    <label for="InputCrsFin" class="col-sm-3 control-label">Fecha Fin:</label>
					                <div class="input-group date form_date2 col-md-5"  data-date-format="yyyy-mm-dd" data-link-field="InputCrsFin"  data-link-format="yyyy-mm-dd">
					                    <input type="text" name="InputCrsFin" class="form-control" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['crs_fin']; }?>" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
							  </div>


							  <div class="form-group">
								  <label for="InputCrsPat" class="col-sm-3 control-label">Patrocinador:</label>
								  <div class="input-group col-md-5">
								  <select name="InputCrsPat" class="selectpicker" data-width="400px">
								  <option <?php if($detById['msj']!=true){ echo 'selected'; } ?> >--Selecionar una Opcion--</option>
								    <?php 
				
								     if($ddlMenuPat["msj"]==true){
										  $ddl = $ddlMenuPat["data"];
										  
										  foreach($ddl as $valor){
										  	if($detById['msj']==true && $detById['data'][0]['crs_patrocinador'] == $valor['pat_id']){
										  		echo "<option selected  value='".$valor['pat_id']."'>".$valor['pat_nombre']."</option>";
										  	}else{
											  echo "<option value='".$valor['pat_id']."'>".$valor['pat_nombre']."</option>";
										  	}
										  }
									  }
								    ?>
								  </select>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputCrsStat" class="col-sm-3 control-label">Estado:</label>
								  <div class="input-group col-md-5">
								  <select name="InputCrsStat" class="selectpicker" data-width="400px" required>
								  <option value="">--Seleccionar--</option>
								  <option value="A" <?php if($detById['msj']==true){ if($detById['data'][0]['crs_status']=='A'){ echo 'selected'; } }?>>Activo</option>
								  <option value="I" <?php if($detById['msj']==true){ if($detById['data'][0]['crs_status']=='I'){ echo 'selected'; } }?>>Inactivo</option>
								  </select>
								  </div>
							  </div>

							  
							  <?php if($action == 'delete'){echo '<input type="submit" name="eliminar" id="eliminar" value="Eliminar" class="btn btn-info pull-right">&nbsp;';} ?>
							  
							  <?php if($action == 'edit'){echo '<input type="submit" name="actualizar" id="actualizar" value="Actualizar" class="btn btn-info pull-right" >&nbsp;';} ?>
							  
						  	  <?php if($action == 'insert'){echo '<input type="submit" name="guardar" id="guardar" value="Guardar" class="btn btn-info pull-right">';} ?>
						  </div>
						  
					  </form>
					  <div class="col-lg-5 col-md-push-1">
						  <div class="col-md-10">
							  <div class="alert alert-success" id="true" style="display:none;">
								  <strong><span class="glyphicon glyphicon-ok"></span> Success! Cambios Guardados Exitosamente.</strong>
							  </div>
							  <div class="alert alert-danger" id="false" style="display:none;">
								  <span class="glyphicon glyphicon-remove"></span><strong> Error! Ocurrio un error, intente nuevamente.</strong>
							  </div>
							 
						  </div>
						
					  </div>
					  
				  </div>
			  </div>
          </div>

          <h2 class="sub-header">Detalle</h2>

          <div class="table-responsive">
            <table id="CursoTable" class="table table-striped">
              <thead>
                <tr>
                  
                  <th style="width:185px">Nombre</th>
                  <th>Tipo</th>
                  <th>Jornadas</th>
                  <th>Ponente</th>
                  <th>Gasto</th>
                  <th>Forma de Pago</th>
                  <th>Nro Documento</th>
                  <th style="width:75px">Fecha Ini</th>
                  <th style="width:75px">Fecha Fin</th>
                  <th>Patrocinador</th>
                  <th>Estado</th>
                  <th style="width:85px">Acciones</th>
                </tr>
              </thead>
              <tbody>
				<?php 
				  if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  
					  foreach($data as $valor){
					if($valor['crs_status']=='A'){
						$valor['crs_status']='Activo';
					}else{
						$valor['crs_status']='Inactivo';
					}
				  			echo "<tr>
				                  <td>"; echo $valor['crs_nombre']; echo "</td>
				                  <td>"; echo $valor['crs_tipo']; echo "</td>
								  <td>"; echo $valor['crs_jornada']; echo "</td>
								  <td>"; echo $valor['crs_ponente']; echo "</td>
								  <td>"; echo $valor['crs_det_gasto']; echo "</td>
								  <td>"; echo $valor['crs_form_pago']; echo "</td>
								  <td>"; echo $valor['crs_num_doc']; echo "</td>
								  <td>"; echo $valor['crs_ini']; echo "</td>
								  <td>"; echo $valor['crs_fin']; echo "</td>
								  <td>"; echo $valor['crs_patrocinador']; echo "</td>
								  <td>"; echo $valor['crs_status']; echo "</td>
								  ";
				                  echo '<td><a alt="Actualizar" href="cursos.php?page='.$page.'&type='.$type.'&action=edit&idCurso='.$valor['crs_id'].'"><img alt="Actualizar" src="images/edit-24.png" /></a>&nbsp;&nbsp;<a alt="Eliminar" href="cursos.php?page='.$page.'&type='.$type.'&action=delete&idCurso='.$valor['crs_id'].'"><img alt="Eliminar" src="images/delete-24.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a  target="_blank" onClick="'; echo "window.open(this.href, this.target, 'width=950 ,height=650'); return false;"; echo '" alt="Detalle" href="CursoEmp.php?page=Empleados&idCurso='.$valor['crs_id'].'"><img alt="Detalle" src="images/report-24.png" /></a>&nbsp;&nbsp;</td>
				                </tr>';
					
					  }
				  }
				?>            
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js" ></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.es.js"></script>    
    <script type="text/javascript" src="js/bootstrap-select.min.js" ></script>  
    
    <script type="text/javascript" src="js/jquery.dataTables.js" ></script>   
<script type="text/javascript" src="js/dataTables.bootstrap.js" ></script>     
    
    <script type="text/javascript">
    $(document).ready(function() {
        $('#CursoTable').DataTable(
        		{
        			  "scrollX": true
        			}
                );
    } );
    
		$('.form_date').datetimepicker({
			language:  'es',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			minView: 2
	    });

		$('.form_date2').datetimepicker({
			language:  'es',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			minView: 2
	    });

		  
		  $('.selectpicker').selectpicker({
		    
		  });
        </script>
  </body>
</html>
