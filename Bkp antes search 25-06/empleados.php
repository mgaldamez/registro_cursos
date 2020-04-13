<?php 
require_once   ('clases/emp.class.php');
require_once  ('clases/menu.class.php');
require('sesion.php');	
$us = $_SESSION['us'];
$rol = $_SESSION['rol'];
$menu = new Menu();
$userClass = new Usuario();
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
if(isset($_GET['idEmpleado'])){
	$idEmpleado = $_GET['idEmpleado'];
	$detById = $userClass->viewEmpById( $idEmpleado);
}else{
	$detById = array('msj'=>false);
}

$result = $menu->impMenu($us,$rol);
$vDet= $userClass->viewEmp();
$ddlMenuDepto = $userClass->ddlMenuDepto();

if(isset($_POST['guardar']) ){
	$InputEmpNombre = $_POST['InputEmpNombre'];
	$InputEmpApellido = $_POST['InputEmpApellido'];
	$InputEmpFechaNac = $_POST['InputEmpFechaNac'];
	$InputEmpGenero = $_POST['InputEmpGenero'];
	$InputEmpDepto = $_POST['InputEmpDepto'];
	$InputEmpCargo = $_POST['InputEmpCargo'];
	$InputEmpNivelAcad = $_POST['InputEmpNivelAcad'];
	$InputEmpUbicacion = $_POST['InputEmpUbicacion'];
	$InputEmpFechaIng = $_POST['InputEmpFechaIng'];
		
	$nResult = $userClass->newEmp($us, $InputEmpNombre,$InputEmpApellido,$InputEmpFechaNac,$InputEmpDepto,$InputEmpGenero,$InputEmpCargo,$InputEmpNivelAcad,$InputEmpUbicacion,$InputEmpFechaIng);
	
	if ($nResult['msj']==true){
		ob_start();
		$goTo = ' empleados.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($nResult['msj']==false){
		ob_start();
		header('location: empleados.php?page='.$page.'&type='.$type.'&result=false&data='.$nResult['data']);
		echo $nResult['data'];
		ob_end_flush();
	}
}elseif (isset($_POST['actualizar'])){
	$idEmpleado = $_POST['idEmpleado'];
	$InputEmpNombre = $_POST['InputEmpNombre'];
	$InputEmpApellido = $_POST['InputEmpApellido'];
	$InputEmpFechaNac = $_POST['InputEmpFechaNac'];
	$InputEmpGenero = $_POST['InputEmpGenero'];
	$InputEmpDepto = $_POST['InputEmpDepto'];
	$InputEmpCargo = $_POST['InputEmpCargo'];
	$InputEmpNivelAcad = $_POST['InputEmpNivelAcad'];
	$InputEmpUbicacion = $_POST['InputEmpUbicacion'];
	$InputEmpFechaIng = $_POST['InputEmpFechaIng'];
	$uResult = $userClass->updateEmp($us,$InputEmpNombre,$InputEmpApellido,$InputEmpFechaNac,$InputEmpGenero,$InputEmpDepto,$InputEmpCargo,$InputEmpNivelAcad,$InputEmpUbicacion,$InputEmpFechaIng,$idEmpleado);
	
	if ($uResult['msj']==true){
		ob_start();
		$goTo = ' empleados.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($uResult['msj']==false){
		ob_start();
		header('location: empleados.php?page='.$page.'&type='.$type.'&result=false&data='.$uResult['data']);
		ob_end_flush();
	}
}elseif (isset($_POST['eliminar'])){
	$idEmpleado = $_POST['idEmpleado'];
	$ddet = $userClass->deleteEmp($idEmpleado);
if ($ddet['msj']==true){
		ob_start();
		$goTo = 'empleados.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($ddet['msj']==false){
		ob_start();
		header('location: empleados.php?page='.$page.'&type='.$type.'&result=false');
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
					  <form class="form-horizontal" role="form" action="<?php echo 'empleados.php?page='.$page.'&type='.$type;?>" method="post">
					  <input type="hidden" value="<?php if(isset($idEmpleado)){ echo $idEmpleado; } ?>" name="idEmpleado"/>
						  <div class="col-lg-6">
							  <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Campos Obligatorios</strong></div>
							  
							  <div class="form-group">
								  <label for="InputEmpNombre" class="col-sm-3 control-label">Nombre:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputEmpNombre" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['emp_nombre']; }?>" name="InputEmpNombre" placeholder="Ingresar Nombre" maxlength="30" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputEmpApellido" class="col-sm-3 control-label">Apellido:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputEmpApellido" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['emp_apellido']; }?>" name="InputEmpApellido" placeholder="Ingresar Apellido" maxlength="30" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
							    <label for="InputEmpFechaNac" class="col-sm-3 control-label">Fecha Nacimiento:</label>
					                <div class='input-group date form_date col-md-5'  data-date-format="yyyy-mm-dd" data-link-field="InputEmpFechaNac" id='datetimepicker1' data-link-format="yyyy-mm-dd">
					                    <input type='text' name="InputEmpFechaNac" class="form-control" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['emp_fecha_nac']; }?>" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
							  </div>
							  
							  <div class="form-group">
								  <label for="InputEmpGenero" class="col-sm-3 control-label">Genero:</label>
								  <div class="input-group col-md-5">
								  <select name="InputEmpGenero" class="selectpicker" data-width="400px" required>
								  <option value="">--Seleccionar--</option>
								  <option value="F" <?php if($detById['msj']==true){ if($detById['data'][0]['emp_genero']=='F'){ echo 'selected'; } }?>>Femenino</option>
								  <option value="M" <?php if($detById['msj']==true){ if($detById['data'][0]['emp_genero']=='M'){ echo 'selected'; } }?>>Masculino</option>
								  </select>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputEmpDepto" class="col-sm-3 control-label">Departamento:</label>
								  <div class="input-group col-md-5">
								  <select name="InputEmpDepto" class="selectpicker" data-width="400px">
								  <option <?php if($detById['msj']!=true){ echo 'selected'; } ?> >--Selecionar Depto--</option>
								    <?php 
				
								     if($ddlMenuDepto["msj"]==true){
										  $ddl = $ddlMenuDepto["data"];
										  
										  foreach($ddl as $valor){
										  	if($detById['msj']==true && $detById['data'][0]['emp_depto'] == $valor['dpt_id']){
										  		echo "<option selected  value='".$valor['dpt_id']."'>".$valor['dpt_nombre']."</option>";
										  	}else{
											  echo "<option value='".$valor['dpt_id']."'>".$valor['dpt_nombre']."</option>";
										  	}
										  }
									  }
								    ?>
								  </select>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputEmpCargo" class="col-sm-3 control-label">Cargo:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputEmpCargo" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['emp_cargo']; }?>" name="InputEmpCargo" placeholder="Cargo"  required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputEmpNivelAcad" class="col-sm-3 control-label">Nivel Academinco:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputEmpNivelAcad" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['emp_nivel_acad']; }?>" name="InputEmpNivelAcad" placeholder="Nivel Academico"  required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							<div class="form-group">
								  <label for="InputEmpUbicacion" class="col-sm-3 control-label">Ubicacion:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputEmpUbicacion" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['emp_ubicacion']; }?>" name="InputEmpUbicacion" placeholder="Direccion"  required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
							    <label for="InputEmpFechaIng" class="col-sm-3 control-label">Fecha Ingreso:</label>
					                <div class="input-group date form_date2 col-md-5"  data-date-format="yyyy-mm-dd" data-link-field="InputEmpFechaIng"  data-link-format="yyyy-mm-dd">
					                    <input type="text" name="InputEmpFechaIng" class="form-control" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['emp_fecha_ing']; }?>" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
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
            <table class="table table-striped">
              <thead>
                <tr>
                  
                  <th>Nombre</th>
                  <th>Fecha Nac</th>
                  <th>Genero</th>
                  <th>Departamento</th>
                  <th>Cargo</th>
                  <th>Nivel Acad</th>
                  <th>Ubicacion</th>
                  <th>Fecha Ing</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
				<?php 
				  if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  
					  foreach($data as $valor){
					if($valor['emp_genero']=='M'){
						$valor['emp_genero']='Masculino';
					}else{
						$valor['emp_genero']='Femenino';
					}
				  			echo "<tr>
				                  <td>"; echo $valor['emp_nombre']." ".$valor['emp_apellido']; echo "</td>
				                  <td>"; echo $valor['emp_fecha_nac']; echo "</td>
								  <td>"; echo $valor['emp_genero']; echo "</td>
								  <td>"; echo $valor['dpt_nombre']; echo "</td>
								  <td>"; echo $valor['emp_cargo']; echo "</td>
								  <td>"; echo $valor['emp_nivel_acad']; echo "</td>
								  <td>"; echo $valor['emp_ubicacion']; echo "</td>
								  <td>"; echo $valor['emp_fecha_ing']; echo "</td>
								  ";
				                  echo '<td><a alt="Actualizar" href="empleados.php?page='.$page.'&type='.$type.'&action=edit&idEmpleado='.$valor['emp_id'].'"><img alt="Actualizar" src="images/edit-24.png" /></a>&nbsp;&nbsp;<a alt="Eliminar" href="empleados.php?page='.$page.'&type='.$type.'&action=delete&idEmpleado='.$valor['emp_id'].'"><img alt="Eliminar" src="images/delete-24.png" /></a>&nbsp;&nbsp;</td>
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
    
    <script type="text/javascript">
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
