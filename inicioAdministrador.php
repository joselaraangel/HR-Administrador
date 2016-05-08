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
<?php 
	include_once("php_conexion.php");
	if(!empty($_GET['del'])){
		$id=$_GET['del'];
		mysql_query("DELETE FROM carrito WHERE codigo='$id'");
		header('location:inicio.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Carrito de Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
	padding-top: 60px;
	padding-bottom: 40px;
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
                                   #apDiv1 {
	position: absolute;
	width: 118px;
	height: 17px;
	z-index: 1;
	left: 1142px;
	top: 3px;
}
                                   </style>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <div id="apDiv1">
             <li id="fat-menu" class="dropdown">
              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Hola! <?php echo $nomb; ?> <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="clave_admin.php" target="admin"><i class="icon-pencil"></i> Cambiar Contraseña </a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="php_cerrar.php"><i class="icon-off"></i> Cerrar Sesion</a></li>
              </ul>
            </li>
          </div>
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="inicioAdministrador.php">HR Administrador</a>
            <ul class="nav nav-tabs">
  <li role="presentation"><a href="personal.php">Personal</a></li>          
  <!--<li role="presentation"><a href="alumnos.php">Anuncios</a></li>
  <li role="presentation"><a href="pedidos.php">Ventas</a></li>
  <li role="presentation"><a href="usuarios.php">Clientes</a></li>-->
</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <!--<div class="hero-unit" align="center">
        	<img src="img/icono_producto2.png" width="190" height="190" class="img-polaroid">
      </div>-->

      <!-- Example row of columns -->
      <div class="row">
      	
      </div>
      <div align="center">
      	
        <div class="row-fluid">
    		<div class="span8">
			<?php
                $pa=mysql_query("SELECT * FROM producto where estado='s'");				
                while($row=mysql_fetch_array($pa)){
            ?>                       
        	<table class="table table-bordered">
            	<tr><td><i class="icon-ok"></i>
                	<div class="row-fluid">
                    	<div class="span4">
                            <center><strong><?php echo $row['nombre']; ?></strong></center><br>
                            <img src="img/producto/<?php echo $row['id']; ?>.jpg" class="img-polaroid">
                        </div>
                      <div class="span4"><br><br><br><br>
                            <strong><?php echo $row['nota']; ?></strong><br><br>
                          <strong>Salario: </strong>$ <?php echo number_format($row['valor'],2,".",","); ?>
                        </div>
                        <div class="span4"><br><br><br><br><br>
                        	<form name="form<?php $row['id']; ?>" method="post" action="">
                            	<input type="hidden" name="codigo" value="<?php echo $row['id']; ?>">
                        	</form>
                        </div>
                    </div>
            	</td></tr>
        	</table>
        	<?php } ?>
        	</div>
            <div class="span4">
            <?php
				if(!empty($_POST['codigo'])){
					$codigo=$_POST['codigo'];
					$pa=mysql_query("SELECT * FROM carrito WHERE codigo='$codigo'");				
					if($row=mysql_fetch_array($pa)){
						$new_cant=$row['cantidad']+1;
						mysql_query("UPDATE carrito SET cantidad='$new_cant' WHERE codigo='$codigo'");
					}else{
						$fecha = date('d-m-Y');
						mysql_query("INSERT INTO carrito (usu, codigo, cantidad, fecha) VALUES ('$usuario','$codigo','1','$fecha')");
					}
				}
			?>
               <!--<div id="sidebar"><br><br><br>
               		<h2 align="center">Anuncios Activados</h2>
               		<table class="table table-bordered">
               		<tr>
               		  <td><i class="icon-bullhorn"></i><table class="table table-bordered">
               		    <tr>
               		      <td>Podrás eliminar, modificar o agregar anuncios cuando quieras en el panel</td>
           		        </tr>
           		      </table></td>
               		</tr>
               		</table>
               </div>-->
            </div>
    	</div>
        
      </div>

      <hr>

      <footer>
        <p>&copy;José Lara</p>
      </footer>

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
    <script>
		$(function() {
            var offset = $("#sidebar").offset();
            var topPadding = 15;
            $(window).scroll(function() {
                if ($("#sidebar").height() < $(window).height() && $(window).scrollTop() > offset.top) { /* LINEA MODIFICADA POR ALEX PARA NO ANIMAR SI EL SIDEBAR ES MAYOR AL TAMAÑO DE PANTALLA */
                    $("#sidebar").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    });
                } else {
                    $("#sidebar").stop().animate({
                        marginTop: 0
                    });
                };
            });
        });
	</script>

  </body>
</html>
