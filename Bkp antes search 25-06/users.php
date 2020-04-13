<?php 
require_once   ('clases/users.class.php');
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
if(isset($_GET['idUser'])){
	$idUser = $_GET['idUser'];
	$detById = $userClass->viewUserById( $idUser);
}else{
	$detById = array('msj'=>false);
}

$result = $menu->impMenu($us,$rol);
$vDet= $userClass->viewUser();
$ddlRol = $userClass->ddlRol();

if(isset($_POST['guardar']) ){
	$InputUsrIdentificacion = $_POST['InputUsrIdentificacion'];
	$InputUsrNombre = $_POST['InputUsrNombre'];
	$InputUsrApellido = $_POST['InputUsrApellido'];
	$InputUsrCorreo = $_POST['InputUsrCorreo'];
	$InputUsrTel = $_POST['InputUsrTel'];
	$InputUsrTel2 = $_POST['InputUsrTel2'];
	$InputUsrUser = $_POST['InputUsrUser'];
	$InputUsrPasswd = $_POST['InputUsrPasswd'];
	$InputUsrEstado = $_POST['InputUsrEstado'];
	$InputUsrRol = $_POST['InputUsrRol'];
		
	$nResult = $userClass->newUser($us, $InputUsrIdentificacion,$InputUsrNombre,$InputUsrApellido,$InputUsrCorreo,$InputUsrTel,$InputUsrTel2,$InputUsrUser,$InputUsrPasswd,$InputUsrEstado,$InputUsrRol);
	
	if ($nResult['msj']==true){
		ob_start();
		$goTo = ' users.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($nResult['msj']==false){
		ob_start();
		header('location: users.php?page='.$page.'&type='.$type.'&result=false&data='.$nResult['data']);
		echo $nResult['data'];
		ob_end_flush();
	}
}elseif (isset($_POST['actualizar'])){
	$idUser = $_POST['idUser'];
	$InputUsrIdentificacion = $_POST['InputUsrIdentificacion'];
	$InputUsrNombre = $_POST['InputUsrNombre'];
	$InputUsrApellido = $_POST['InputUsrApellido'];
	$InputUsrCorreo = $_POST['InputUsrCorreo'];
	$InputUsrTel = $_POST['InputUsrTel'];
	$InputUsrTel2 = $_POST['InputUsrTel2'];
	$InputUsrUser = $_POST['InputUsrUser'];
	$InputUsrPasswd = $_POST['InputUsrPasswd'];
	$InputUsrEstado = $_POST['InputUsrEstado'];
	$InputUsrRol = $_POST['InputUsrRol'];
	$uResult = $userClass->updateUser($us,$InputUsrIdentificacion,$InputUsrNombre,$InputUsrApellido,$InputUsrCorreo,$InputUsrTel,$InputUsrTel2,$InputUsrUser,$InputUsrPasswd,$InputUsrEstado,$usr_creat,$InputUsrRol,$idUser);
	
	if ($uResult['msj']==true){
		ob_start();
		$goTo = ' users.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($uResult['msj']==false){
		ob_start();
		header('location: users.php?page='.$page.'&type='.$type.'&result=false&data='.$uResult['data']);
		ob_end_flush();
	}
}elseif (isset($_POST['eliminar'])){
	$idUser = $_POST['idUser'];
	$ddet = $userClass->deleteRol($idUser);
if ($ddet['msj']==true){
		ob_start();
		$goTo = 'users.php?page='.$page.'&type='.$type.'&result=true';
		header(sprintf('location: %s',$goTo));
		ob_end_flush();
	}else if($ddet['msj']==false){
		ob_start();
		header('location: users.php?page='.$page.'&type='.$type.'&result=false');
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
    <meta name="description" content="UACI System">
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
					  <form class="form-horizontal" role="form" action="<?php echo 'users.php?page='.$page.'&type='.$type;?>" method="post">
					  <input type="hidden" value="<?php if(isset($idUser)){ echo $idUser; } ?>" name="idUser"/>
						  <div class="col-lg-6">
							  <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Campos Obligatorios</strong></div>
							  
							  <div class="form-group">
								  <label for="InputUsrIdentificacion" class="col-sm-3 control-label">Identificacion:</label>
								  <div class="input-group col-sm-8">
									  <input type="text" class="form-control" id="InputUsrIdentificacion" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_identificacion']; }?>" name="InputUsrIdentificacion" placeholder="Ingresar Identificacion(DUI/NIT)" maxlength="20" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrNombre" class="col-sm-3 control-label">Nombre:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputUsrNombre" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_nombre']; }?>" name="InputUsrNombre" placeholder="Ingresar Nombre" maxlength="30" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrApellido" class="col-sm-3 control-label">Apellido:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputUsrApellido" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_apellido']; }?>" name="InputUsrApellido" placeholder="Ingresar Apellido" maxlength="30" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrCorreo" class="col-sm-3 control-label">Correo:</label>
								  <div class="input-group col-sm-9">
									  <input type="email" class="form-control" id="InputUsrCorreo" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_correo']; }?>" name="InputUsrCorreo" placeholder="Ingresar Correo" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrTel" class="col-sm-3 control-label">Telefono:</label>
								  <div class="input-group col-sm-9">
									  <input type="number" class="form-control" id="InputUsrTel" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_tel']; }?>" name="InputUsrTel" placeholder="Ingresar Telefono" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrTel2" class="col-sm-3 control-label">Telefono2:</label>
								  <div class="input-group col-sm-9">
									  <input type="number" class="form-control" id="InputUsrTel2" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_tel2']; }?>" name="InputUsrTel2" placeholder="Ingresar Telefono2" >
									
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrUser" class="col-sm-3 control-label">Usuario:</label>
								  <div class="input-group col-sm-9">
									  <input type="text" class="form-control" id="InputUsrUser" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_user']; }?>" name="InputUsrUser" placeholder="Ingresar Usuario"  required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrPasswd" class="col-sm-3 control-label">Contrase&ntilde;a:</label>
								  <div class="input-group col-sm-9">
									  <input type="password" class="form-control" id="InputUsrPasswd" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['usr_password']; } ?>" name="InputUsrPasswd" placeholder="Password"  required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>  
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrEstado" class="col-sm-3 control-label">Estado:</label>
								  <div class="input-group col-md-5">
								  <select name="InputUsrEstado" class="selectpicker" data-width="400px" required>
								  <option value="">--Seleccionar--</option>
								  <option value="A" <?php if($detById['msj']==true){ if($detById['data'][0]['usr_estado']=='A'){ echo 'selected'; } }else{ echo "selected"; }?>>Activo</option>
								  <option value="I" <?php if($detById['msj']==true){ if($detById['data'][0]['usr_estado']=='I'){ echo 'selected'; } }?>>Inactivo</option>
								  </select>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="InputUsrRol" class="col-sm-3 control-label">Rol:</label>
								  <div class="input-group col-md-5">
								  <select name="InputUsrRol" class="selectpicker" data-width="400px" required>
								  <option  value='' >--Seleccionar--</option>
								    <?php 
				
								     if($ddlRol["msj"]==true){
										  $ddl = $ddlRol["data"];
										  
										  foreach($ddl as $valor){
											 if($valor['rol_estado']=='A'){ 
										  	if($detById['msj']==true && ($detById['data'][0]['usr_rol'] == $valor['rol_id']) ) {
										  		echo "<option selected value='".$valor['rol_id']."'>".$valor['rol_nombre']."</option>";
										  	}else{
											  echo "<option value='".$valor['rol_id']."'>".$valor['rol_nombre']."</option>";
										  	}
										  }
										  }
									  }
								    ?>
								  </select>
									 <!--   <input type="text" class="form-control" id="InputVehiculo" value="<?php if($detById['msj']==true){ echo $detById['data'][0]['prv_telefono2']; }?>" name="InputVehiculo" placeholder="Ingresar Nombre" required>-->
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
                  <th>Dui</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                  <th>Rol</th>
                  <th>Creacion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
				<?php 
				  if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  
					  foreach($data as $valor){
					  $estat =str_replace(array('A','I'),array('Activo','Inactivo'),$valor['usr_estado']);
				  			echo "<tr>
				                  <td>"; echo $valor['usr_identificacion']; echo "</td>
				                  <td>"; echo $valor['usr_nombre']." ".$valor['usr_apellido']; echo "</td>
				                  <td>"; echo $valor['usr_correo']; echo "</td>
								  <td>"; echo $valor['usr_tel']; echo "</td>
								  <td>"; echo $valor['usr_user']; echo "</td>
								  <td>"; echo  $estat."</td>
								  <td>"; echo $valor['rol_nombre']; echo "</td>
								  <td>"; echo $valor['usr_creat']; echo "</td>
								  ";
				                  echo '<td><a alt="Actualizar" href="users.php?page='.$page.'&type='.$type.'&action=edit&idUser='.$valor['usr_id'].'"><img alt="Actualizar" src="images/edit-24.png" /></a>&nbsp;&nbsp;<a alt="Eliminar" href="users.php?page='.$page.'&type='.$type.'&action=delete&idUser='.$valor['usr_id'].'"><img alt="Eliminar" src="images/delete-24.png" /></a>&nbsp;&nbsp;</td>
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

		  
		  $('.selectpicker').selectpicker({
		    
		  });
        </script>
  </body>
</html>
