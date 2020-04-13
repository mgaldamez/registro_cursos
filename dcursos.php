<?php 
require_once('clases/dcursos.class.php');
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
if(isset($_GET['idCurso2'])){
	$idCurso = $_GET['idCurso'];
	$detById = $userClass->viewCursoById($idCurso);
}else{
	$detById = array('msj'=>false);
}
if(isset($_GET['InputCrsId'])){
	$idCurso = $_GET['InputCrsId'];
	$vDet = $userClass->viewDet($idCurso);
	$end = $userClass->viewEnd($idCurso);
	
	if($end["msj"]==true){
		$dataEnd = $end["data"];
		if($dataEnd[0]["today"]>$dataEnd[0]["crs_fin"]){
			$done =true;
		}else{
			$done = false;
		}
	}
	
}

$result = $menu->impMenu($us,$rol);
//$vDet= $userClass->viewCurso();
$ddlMenuType = $userClass->ddlCursos();
$ddlMenuDepto = $userClass->ddlMenuDepto();

if(isset($_GET['InputCrsDepto']) && isset($_GET['InputCrsId'])){
	$idDepto = $_GET['InputCrsDepto'];
	$idCurso = $_GET['InputCrsId'];
	$ddlMenuEmp = $userClass->ddlMenuEmp($idDepto,$idCurso);
}


if(isset($_GET['guardar']) ){
	$InputCrsId = $_GET['InputCrsId'];
	$InputCrsDepto = $_GET['InputCrsDepto'];
	$InputCrsEmp = $_GET['InputCrsEmp'];
	
		
	$nResult = $userClass->newDet($us, $InputCrsId,$InputCrsEmp);
	
	
	if ($nResult['msj']==true){
		ob_start();
		$goTo = 'dcursos.php?page='.$page.'&type='.$type.'&InputCrsDepto='.$InputCrsDepto.'&InputCrsId='.$InputCrsId.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($nResult['msj']==false){
		ob_start();
		header('location: dcursos.php?page='.$page.'&type='.$type.'&result=false');
		
		ob_end_flush();
	}
	
}elseif (isset($_GET['eliminar'])){
	$idCurso = $_GET['InputCrsId'];
	$idEmp = $_GET['idEmp'];
	$ddet = $userClass->deleteEmpCurso($idCurso,$idEmp);
	
if ($ddet['msj']==true){
		ob_start();
		$goTo = 'dcursos.php?page='.$page.'&type='.$type.'&InputCrsId='.$idCurso.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($ddet['msj']==false){
		ob_start();
		header('location: dcursos.php?page='.$page.'&type='.$type.'&result=false');
		ob_end_flush();
	}
}elseif (isset($_GET['check'])){
	$idCurso = $_GET['InputCrsId'];
	$ddet = $userClass->checkAllEmpCurso($idCurso);
if ($ddet['msj']==true){
		ob_start();
		$goTo = 'dcursos.php?page='.$page.'&type='.$type.'&InputCrsId='.$idCurso.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($ddet['msj']==false){
		ob_start();
		header('location: dcursos.php?page='.$page.'&type='.$type.'&result=false');
		ob_end_flush();
	}
	
	
}elseif (isset($_GET['finCurso'])){
	$idCurso = $_GET['InputCrsId'];
	$idEmp = $_GET['idEmp'];
	$chk = $_GET['checkEmp'];
	$ddet = $userClass->checkEmpCurso($idCurso,$idEmp,$chk);
if ($ddet['msj']==true){
		ob_start();
		$goTo = 'dcursos.php?page='.$page.'&type='.$type.'&InputCrsId='.$idCurso.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($ddet['msj']==false){
		ob_start();
		header('location: dcursos.php?page='.$page.'&type='.$type.'&InputCrsId='.$idCurso.'&result=false');
		ob_end_flush();
	}
	
	
}
?>
<!DOCTYPE html>
<html lang="es">
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
    
     
	 <script type="text/javascript" language="JavaScript">

	 
		
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

		  function fClean(){
				 document.getElementById("InputCrsDepto").value="0";
				 alert('tst');
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
			  }else{
			  	echo $result["data"];
			  }
		  ?>

          </ul>
        </div>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?=$page?></h1>

          <div class="row placeholders">
			  <div class="container">
				  <div class="row">
					  <form class="form-horizontal" role="form" action="<?php echo 'dcursos.php?page='.$page.'&type='.$type; ?>" method="get">
					  <!-- <input type="hidden" value="<?php if(isset($idCurso)){ echo $idCurso; } ?>" name="idCurso"/> -->
					  <input type="hidden" name="type" value="<?php echo $type ?>">
					  <input type="hidden" name="page" value="<?php echo $page ?>">
						  <div class="col-lg-6">
							  <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Seleccionar curso para agregar empleados</strong></div>
							  

							  <div class="form-group">
								  <label for="InputCrsId" class="col-sm-3 control-label">Curso:</label>
								  <div class="input-group col-md-5">
								  <select  name="InputCrsId" id="InputCrsId" class="selectpicker" data-width="400px" onchange="this.form.submit()">
								  <option disabled <?php if($detById['msj']!=true){ echo 'selected'; } ?> >--Selecionar una Opcion--</option>
								    <?php 
				
								     if($ddlMenuType["msj"]==true){
										  $ddl = $ddlMenuType["data"];
										  
										  foreach($ddl as $valor){
										  	if($_GET["InputCrsId"] == $valor['crs_id']){
										  		echo "<option selected  value='".$valor['crs_id']."'>".$valor['crs_nombre']."</option>";
										  	}else{
											  echo "<option value='".$valor['crs_id']."'>".$valor['crs_nombre']."</option>";
										  	}
										  }
									  }
								    ?>
								  </select>
								  </div>
							  </div>
							 
						<?php if(isset($_GET['InputCrsId']) && $done!=true){ ?>
							  <div class="form-group">
								  <label for="InputCrsDepto" class="col-sm-3 control-label">Departamento:</label>
								  <div class="input-group col-md-5">
								  <select name="InputCrsDepto" class="selectpicker" data-width="400px" onchange="this.form.submit()">
								  <option disabled <?php if($detById['msj']!=true){ echo 'selected'; } ?> >--Selecionar una Opcion--</option>
								    <?php 
				
								     if($ddlMenuDepto["msj"]==true){
										  $ddl = $ddlMenuDepto["data"];
										  
										  foreach($ddl as $valor){
										  	if($_GET["InputCrsDepto"] == $valor['dpt_id']){
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
							  
							<?php }?>
							<?php if(isset($_GET['InputCrsDepto'])){ ?>
							  <div class="form-group">
								  <label for="InputCrsEmp" class="col-sm-3 control-label">Empleado:</label>
								  <div class="input-group col-md-5">
								  <select name="InputCrsEmp" class="selectpicker" data-width="400px" >
								  <option disabled <?php if($detById['msj']!=true){ echo 'selected'; }  ?> >--Selecionar una Opcion--</option>
								    <?php 
				
								     if($ddlMenuEmp["msj"]==true){
										  $ddl = $ddlMenuEmp["data"];
										  
										  foreach($ddl as $valor){
										  	if($_GET["InputCrsEmp"] == $valor['emp_id']){
										  		echo "<option selected  value='".$valor['emp_id']."'>".$valor['emp_nombre']."</option>";
										  	}else{
											  echo "<option value='".$valor['emp_id']."'>".$valor['emp_nombre']."</option>";
										  	}
										  }
									  }
								    ?>
								  </select>
								  </div>
							  </div>
							  
							 
						  	<?php 
						  	if($done!=true){
						  	if($action == 'insert'){echo '<input type="submit" name="guardar" id="guardar" value="Agregar A Curso" class="btn btn-info pull-right">';}
						  	}
							 
							}
							if(isset($_GET['InputCrsId'])){
							if($done==true){
								echo '<input type="submit" name="check" id="check" value="Check Empleados" class="btn btn-info pull-right">';
							}
							}
							?>
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
							 
						  <div class="alert alert-danger" id="no_data" style="display:none;">
								  <span class="glyphicon glyphicon-remove"></span><strong> Error! No hay datos disponibles, cambiar parametros.</strong>
							  </div>
							 
						  </div>
						<div class="col-md-10">
						  <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Reporteria</strong></div>
						  <!-- Trigger the modal with a button -->
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generar Reportes</button>
						 
			
						 </div>
						
					  </div>
					  
				  </div>
			  </div>
          </div>

          <h2 class="sub-header">Integrantes de curso</h2>
<?php if(isset($_GET['InputCrsId'])){ ?>
          <div class="table-responsive">
            <table id="CursoTable" class="table table-striped">
              <thead>
                <tr>
                  
                  <th>Nombre</th>
                  <th>Cargo</th>
                  <th>Departamento</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
				<?php 
				  if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  
					  foreach($data as $valor){
						  $check = $valor['fin_check'];
			
				  			echo "<tr>
				                  <td>"; echo $valor['nombre']; echo "</td>
				                  <td>"; echo $valor['emp_cargo']; echo "</td>
								  <td>"; echo $valor['dpt_nombre']; echo "</td>";
				                  if($done!=true){ echo '<td><a alt="Eliminar" href="dcursos.php?page='.$page.'&type='.$type.'&eliminar=delete&InputCrsId='.$valor['curso_id'].'&idEmp='.$valor['emp_id'].'"><img alt="Eliminar" src="images/delete-24.png" /></a>&nbsp;&nbsp;</td></tr>'; } if ($done==true){ echo '<td><a alt="Check Curso" href="dcursos.php?page='.$page.'&type='.$type.'&finCurso=finCurso&InputCrsId='.$valor['curso_id'].'&idEmp='.$valor['emp_id'].'&checkEmp='.$check.'"><img title="'; if ($check!='Y'){echo "Finalizo Curso";}else{ echo "No Finalizo Curso"; } echo'" alt="Check curso" src="'; if ($check!='Y'){echo "images/done-24.png";}else{ echo "images/remove-24.png"; } echo'" /></td>
								  </tr>'; }
					
					  }
				  }else{
				  echo "<tr><td colspan='4'><h3>".$vDet['data']."</h3></td></tr>";
				  }
				?>            
              </tbody>
            </table>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
    
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Generar Reporte</h4>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal" role="form" action="<?php echo 'report/rptCurso.php?page='.$page.'&type='.$type;?>" method="POST" name="reporte">
		<input type="hidden" value="<?php if(isset($detId)){ echo $detId; } ?>" name="detId"/>
		 <div class="form-group">
			  <label for="InputCrsId2" class="col-sm-3 control-label">Curso:</label>
				  <div class="input-group col-md-5 control-label">
				  <select  name="InputCrsId2" id="InputCrsId2" class="selectpicker" data-width="400px" required="required" >
				  <option disabled <?php if($detById['msj']!=true){ echo 'selected'; } ?> >--Selecionar una Opcion--</option>
				    <?php 

				     if($ddlMenuType["msj"]==true){
						  $ddl = $ddlMenuType["data"];
						  
						  foreach($ddl as $valor){
						  	if($_GET["InputCrsId2"] == $valor['crs_id']){
						  		echo "<option selected  value='".$valor['crs_id']."'>".$valor['crs_nombre']."</option>";
						  	}else{
							  echo "<option value='".$valor['crs_id']."'>".$valor['crs_nombre']."</option>";
						  	}
						  }
					  }
				    ?>
				  </select>
				  </div>
		  </div>
		
		
		<button type="submit" class="btn btn-success" >Generar</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
