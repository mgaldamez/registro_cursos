<?php
ob_start(); 
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
	//$detById = $userClass->viewEmpById( $idEmpleado);
	$vDet = $userClass->viewDetCur($idEmpleado);
	$EmpName = $userClass->getEmpName($idEmpleado);
}else{
	$vDet = array('msj'=>false);
}



?>
<?php
    if(isset($_POST["report"]) && $_POST["idEmpleado"]>0){
    	$idEmpleado = $_POST["idEmpleado"];
    	$hoy = date("d-M-Y");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=rpt_CursosByEmp_$hoy.xls");
header("Pragma: no-cache");
header("Expires: 0");

$vDet = $userClass->viewDetCur($idEmpleado);
$EmpName = $userClass->getEmpName($idEmpleado);

?>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<table>
<thead>
<tr>
              <td colspan="4">
              <h2>Reporte de Cursos de <?php echo $EmpName['nombre'];?></h2>
              </td>
              </tr>
         
              <tr><td><br></td></tr>
                <tr>
                  <th>Nombre Curso</th>
                  <th>Jornada</th>
                  <th>Fecha inicio</th>
                  <th>Fecha fin</th>
                  <th>Patrocinador</th>     
                  <th>Finalizo Curso</th>
                </tr>
            </thead>
            <tbody>
            <?php 
				  if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  $hoy = strtotime (date("d M Y"));
					  
					  foreach($data as $valor){
					  	if (strtotime ($valor['crs_fin']) < $hoy ) {
					  
					  	
					  	if($valor['fin_check']=='Y'){
					  		$chk = 'Si';
					  	}else{
					  		$chk = 'No';
					  	}
					  	}else{
					  		$chk = "En proceso";
					  	}
					
				  			echo "<tr>
				                  <td>".$valor['crs_nombre']."</td>
				                  <td>"; echo $valor['crs_jornada']; echo "</td>
								  <td>"; echo $valor['crs_ini']; echo "</td>
								  <td>"; echo $valor['crs_fin']; echo "</td>
								  <td>"; echo $valor['pat_nombre']; echo "</td>
								  <td>".$chk."</td>
								  </tr>";
					
					  }
				  }else{
				  	echo "<tr>
				                  <td>".$vDet['data']."</td></tr>";
				  }
				?>      

</tbody>
</table>
</body>
</html>
	
<?php     	
    }else{
    
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
            
            <li><a href="#" onclick="window.close()">Cerrar</a></li>
          </ul>

        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
       
		
        <div class=" col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?=$page?></h1>



          <h3 class="sub-header"> <?php echo $EmpName['nombre']; ?></h3>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  
                  <th>Nombre Curso</th>
                  <th>Jornada</th>
                  <th>Fecha inicio</th>
                  <th>Fecha fin</th>
                  <th>Patrocinador</th>     
                  <th>Finalizo Curso</th>             
                </tr>
              </thead>
              <tbody>
				<?php 
				  if($vDet["msj"]==true){
					  $data = $vDet["data"];
					  $hoy = strtotime (date("d M Y"));
					  
					  foreach($data as $valor){
					  	if (strtotime ($valor['crs_fin']) < $hoy ) {
					  
					  	
					  	if($valor['fin_check']=='Y'){
					  		$chk = 'Si';
					  	}else{
					  		$chk = 'No';
					  	}
					  	}else{
					  		$chk = "En proceso";
					  	}
					
				  			echo "<tr>
				                  <td>".$valor['crs_nombre']."</td>
				                  <td>"; echo $valor['crs_jornada']; echo "</td>
								  <td>"; echo $valor['crs_ini']; echo "</td>
								  <td>"; echo $valor['crs_fin']; echo "</td>
								  <td>"; echo $valor['pat_nombre']; echo "</td>
								  <td>".$chk."</td>
								  </tr>";
					
					  }
				  }else{
				  	echo "<tr>
				                  <td>".$vDet['data']."</td></tr>";
				  }
				?>            
              </tbody>
            </table>
          </div>
          <form class="form-horizontal" role="form" action="<?php echo 'empCurso.php?page='.$page.'&idEmpleado='.$idEmpleado;?>" method="post">
          <input type="hidden" name="idEmpleado" id="idEmpleado" value="<?php echo $idEmpleado; ?>">
          <input type="submit" name="report" id="report" value="Generar Reporte" class="btn btn-info pull-right">
          </form>
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
<?php
    }
 ob_end_flush();
?>