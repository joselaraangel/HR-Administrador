﻿<?php
		session_start();
		include('php_conexion.php'); 
		if($_SESSION['tipo_usu']=='b'){
		}else{
			header('location:error.php');
		}
		$usuario=limpiar($_SESSION['username']);
		$sqll=mysql_query("SELECT * FROM usuarios WHERE usu='$usuario'");
		if($dato=mysql_fetch_array($sqll)){
			$nombre=$dato['nom'];
			$palabra=explode(" ", $nombre);
			$nomb=$palabra[0];
		}
?>

<?php 
	include_once("php_conexion.php");
	if(!empty($_GET['pay'])){
		$id=$_GET['pay'];
		
		mysql_query("UPDATE carrito SET modelo='2' WHERE codigo='$id' and usu='$usuario'");
		header('location:mis_pedidos.php');
	}
		echo '<div class="alert alert-success" align="center">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Aqui podras ver tus solicitudes de compra por un producto una vez que sean Aprobadas. </strong>
					</div>';
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
	width: 120px;
	height: 26px;
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
                <li role="presentation"><a role="menuitem" tabindex="-1" href="perfil.php" target="admin"><i class="icon-user"></i> Ver perfil </a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="cambiar_clave.php" target="admin"><i class="icon-pencil"></i> Modificar Contraseña </a></li>
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
          <a class="brand" href="inicio.php">iStore</a>
           <ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="mis_pedidos.php">Compras</a></li>
</ul>
<!--/.nav-collapse -->
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
      	<?php 
			if(!empty($_POST['n_cant'])){
				$n_cant=$_POST['n_cant'];
				$n_codigo=$_POST['codigo'];
				$oProducto=new Consultar_Producto($n_codigo);
				mysql_query("UPDATE carrito SET cantidad='$n_cant' WHERE codigo='$n_codigo' and usu='$usuario'");
				
				echo '<div class="alert alert-success" align="center">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Cantidad del Producto "'.$oProducto->consultar('nombre').'" Actualizada con Exito</strong>
					</div>';
			}
		?>
      	<table class="table table-bordered">
          <tr class="info">
            <td><strong class="text-info">Articulo</strong></td>
            <td><div align="right"><strong class="text-info">Valor Unitario</strong></div></td>
            <td><center><strong class="text-info">Cantidad</strong></center></td>
            <td><div align="right"><strong class="text-info">Total</strong></div></td>
            <td></td>
          </tr>
          <?php 
		  	$total=0;$neto=0;
		  	$pa=mysql_query("SELECT * FROM carrito WHERE usu='$usuario' and modelo=3");				
            while($row=mysql_fetch_array($pa)){
				$oProducto=new Consultar_Producto($row['codigo']);
				$total=$row['cantidad']*$oProducto->consultar('valor');#cantidad * valor unitario
				$neto=$neto+$total;#acumulamos el neto
		  ?>
          <tr>
            <td>
            	<div align="center">
                     <strong><?php echo $oProducto->consultar('nombre'); ?></strong><br>
                     <img src="img/producto/<?php echo $oProducto->consultar('id'); ?>.jpg" width="200" height="200" class="img-polaroid">
                </div>
            </td>
            <td><br><br><div align="right">$ <?php echo number_format($oProducto->consultar('valor'),2,".",","); ?></div></td>
            <td><br><br>
            	<center>
                	<a href="#cant<?php echo $row['codigo']; ?>" role="button" class="btn" data-toggle="modal" title="Editar Cantidad">
						<span class="badge badge-success"><?php echo $row['cantidad']; ?></span>
                    </a>
                </center>
            </td>
            <td><br><br><div align="right">$ <?php echo number_format($total,2,".",","); ?></div></td>
            <td><br><br>
	            <center>
          
                    <form name="form" method="post" action="mis_pedidos.php?pay=<?php echo $row['codigo']; ?>">
                            	<input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
                                <button type="submit" name="boton" class="btn btn-primary">
                     </i> <strong>Pagar</strong>
                                </button>
                            </form>
                </center>
            </td>
          </tr>
          
        <div id="cant<?php echo $row['codigo']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       	<form name="form<?php $row['codigo']; ?>" method="post" action="">
          	<input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	        <h3 id="myModalLabel">Actualizar Cantidad</h3>
            </div>
            <div class="modal-body">
           	    <div class="row-fluid">
	                <div class="span6">
                    	<img src="img/producto/<?php echo $oProducto->consultar('id'); ?>.jpg" width="200" height="200" class="img-polaroid">
                    </div>
    	            <div class="span6">
                    	<strong><?php echo $oProducto->consultar('nombre'); ?></strong><br>
		                <strong>Cantidad Actual: </strong><?php echo $row['cantidad']; ?><br><br>
                        <strong>Nueva Cantidad</strong><br>
                        <input name="n_cant" value="<?php echo $row['cantidad']; ?>" type="number" autocomplete="off" min="1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
        	    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            	<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
            </div>
            </form>
        </div>
          
          <?php } ?>
          <tr class="info">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><div align="right"><strong>NETO A PAGAR</strong></div></td>
            <td><div align="right"><strong>$ <?php echo number_format($neto,2,".",","); ?></strong></div></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        
      </div>

      <hr>

      <footer>
        <p>&copy;</p>
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
