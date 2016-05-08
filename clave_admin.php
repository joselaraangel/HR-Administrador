<?php
		session_start();
		include('php_conexion.php');
		if($_SESSION['tipo_usu']=='a'){
		}else{
			header('location:error.php');
		} 
		$usuario=limpiar($_SESSION['username']);
		$sqll=mysql_query("SELECT * FROM administrador WHERE usu='$usuario'");
		if($dato=mysql_fetch_array($sqll)){
			$nombre=$dato['nom'];
			$palabra=explode(" ", $nombre);
			$nomb=$palabra[0];
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cambiar Clave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/bootstrap-affix.js"></script>
    <script src="js/holder/holder.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/application.js"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <style type="text/css">
    #apDiv1 {	position: absolute;
	width: 118px;
	height: 17px;
	z-index: 1;
	left: 1142px;
	top: 3px;
}
    </style>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<div align="center">
<table width="50%" border="0">
<tr>
  <td>
<table border="0" class="table table-bordered">
  <tr class="success">
    <td>
    	<center><strong>
        	<h3><img src="img/30.png" class="img-circle img-polaroid" width="100" height="100"> 
            Cambiar Contraseña</h3>
        </strong></center>
    </td>
  </tr>
  <tr>
    <td>
      <div align="center">
        <form name="form1" method="post" action="">
          <label><strong>Contraseña Actual: </strong></label><input type="password" name="contra" id="contra" required>
          <label><strong>Nueva Contraseña: </strong></label><input type="password" name="c1" id="c1" required>
          <label><strong>Repita Nueva Contraseña: </strong></label><input type="password" name="c2" id="c2" required><br><br>
          <input type="submit" name="button" id="button" class="btn btn-primary" value="Cambiar Contraseña">
          </form>
        <?php 
	if(!empty($_POST['c1']) and !empty($_POST['c2']) and !empty($_POST['contra'])){
		if($_POST['c1']==$_POST['c2']){
			$usuario=limpiar($_SESSION['username']);
			$contra=limpiar($_POST['contra']);
			$can=mysql_query("SELECT * FROM administrador WHERE usu='".$usuario."' and con='".$contra."'");
			if($dato=mysql_fetch_array($can)){
				$cnueva=limpiar($_POST['c2']);
				$sql="Update administrador Set con='$cnueva' Where usu='$usuario'";
				mysql_query($sql);
				echo '<div class="alert alert-info" align="center">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Contraseña!</strong> Actualizada con exito
					</div>';
			}else{
				echo '<div class="alert alert-error">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Contraseña!</strong> Digitada no corresponde a la antigua
					</div>';
			}
		}else{
			echo '<div class="alert alert-error">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Las dos Contraseña!</strong> Digitadas no son iguales
					</div>';
		}
	}
	?>
        </div>
      </td>
    </tr>
</table>
</td></tr>
</table>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <div id="apDiv1">
        <li id="fat-menu" class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Hola! <?php echo $nomb; ?> <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="clave_admin.php" target="admin"><i class="icon-pencil"></i> Cambiar Contraseña </a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="php_cerrar.php"><i class="icon-off"></i> Cerrar Sesion</a></li>
          </ul>
        </li>
      </div>
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="brand" href="inicioAdministrador.php">HR Administrador</a>
      <div class="nav-collapse collapse">
         <ul class="nav nav-tabs">
  <li role="presentation"><a href="personal.php">Personal</a></li> 
  <!--<li role="presentation"><a href="alumnos.php">Anuncios</a></li>
  <li role="presentation"><a href="pedidos.php">Ventas</a></li>
  <li role="presentation"><a href="usuarios.php">Clientes</a></li>-->
</ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
</div>
</body>
</html>