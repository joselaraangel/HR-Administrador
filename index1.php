<?php
		session_start();
		include_once('php_conexion.php'); 
		
		if(!empty($_POST['usuario']) and !empty($_POST['contra'])){
			$usuario=limpiar($_POST['usuario']);
			$contra=limpiar($_POST['contra']);
			$can=mysql_query("SELECT * FROM usuarios WHERE (usu='".$usuario."' ) and con='".$contra."'");
			if($dato=mysql_fetch_array($can)){
			$_SESSION['username']=$dato['usu'];
 		    $_SESSION['tipo_usu']=$dato['status'];
 				
				///////////////////////////////
				if($_SESSION['tipo_usu']=='b'){
					
						header('location:inicio.php');
					
				}
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Entrar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #0099FF;
	background-image: none;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
	margin-bottom: 10px;
	color: #09F;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
      }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/favicon.png">
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

  <body>
    <br>
    <div class="container">
      <form name="form1" method="post" action="" class="form-signin">
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">
              <div id="apDiv1">
                <li id="fat-menu" class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>Acceder a</a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="loginPanel.php" target="admin"><i class="icon-flag"></i> Panel Administrador</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="registro.php" target="admin"><i class="icon-pencil"></i> Registrarme</a></li>
                  </ul>
                </li>
              </div>
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <a class="brand" href="index.php">iStore</a><a class="brand" href="index.php"></a>
              <div class="nav-collapse collapse"></div>
              <!--/.nav-collapse -->
            </div>
          </div>
        </div>
        <h2 class="form-signin-heading">Bienvenido</h2>
        <p>Acceso para usuarios.</p>
        <?php
		if(isset($_GET['error'])){
		  if ($_GET["error"]==3){
			echo '<div class="alert alert-sucess" align="center"><strong>Usuario registrado con exito</strong></div>';
		  }
	    }
        ?>
        <img src="img/iconkey.png" width="278" height="225">
        <p>Usuario</p>
        <input type="text" name="usuario" class="input-block-level"  autocomplete="off" maxlength="10">
        <p>Contraseña</p>
        <input type="password" name="contra" class="input-block-level"  autocomplete="off" maxlength="10">
        <button class="btn btn-large btn-primary" type="submit">Entrar</button>
        <p>&nbsp;</p>
<?php
		$act="1";
		if(!empty($_POST['usuario']) and !empty($_POST['contra'])){
			$usuario=limpiar($_POST['usuario']);
			$contra=limpiar($_POST['contra']);
			$can=mysql_query("SELECT * FROM usuarios WHERE (usu='".$usuario."' ) and con='".$contra."'");
			if(!$dato=mysql_fetch_array($can)){
				if($act=="1"){
					echo '<div class="alert alert-error" align="center"><strong>Usuario y Contraseña Incorrecta</strong></div>';
				}else{
					$act="0";
				}
			}else{
				if($dato['estado']=='n'){
					echo '<div class="alert alert-error" align="center"><strong>Consulte con el Administrador</strong></div>';
				}
			}
		}else{
			
		}
	?>
      </form>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
  </body>
</html>
