<?php
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
	if(!empty($_GET['del'])){
		$id=$_GET['del'];
		mysql_query("DELETE FROM carrito WHERE codigo='$id' and usu='$usuario'");
		header('location:inicio.php');
	}
?>
<?php 
	include_once("php_conexion.php");
	if(!empty($_GET['elim'])){
		$id=$_GET['elim'];
		mysql_query("UPDATE carrito set modelo='2' and producto SET estado='n' WHERE id='$id'");
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
                                   #apDiv2 {
	position: absolute;
	width: 200px;
	height: 115px;
	z-index: 1;
	left: 646px;
	top: -41px;
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
<div id="apDiv2">
        	  <?php
            	$c=mysql_query("SELECT COUNT(id) as carrito FROM carrito WHERE modelo='3'");
				if($d=mysql_fetch_array($c)){
					$t_carrito=$d['carrito'];
				}
			?>
        	  <br>
        	  <br>
        	  <a href="mis_pedidos.php">
        	    <button class="btn btn-primary" type="button"> Aprobadas <span class="badge"><?php echo $t_carrito; ?></span> </button>
      	    </a> </div>

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
      	
        <div class="row-fluid">
    		<div class="span8">
			<?php
                $pa=mysql_query("SELECT * FROM producto where estado='s'");	
								
                while($row=mysql_fetch_array($pa)){
            ?>                       
        	<table class="table table-bordered">
            	<tr><td>
                	<div class="row-fluid">
                    	<div class="span4">
                            <center><strong><?php echo $row['nombre']; ?></strong></center><br>
                            <img src="img/producto/<?php echo $row['id']; ?>.jpg" class="img-polaroid">
                        </div>
                      <div class="span4"><br><br><br><br>
                            <strong><?php echo $row['nota']; ?></strong><br><br>
                          <strong>Valor: </strong>$ <?php echo number_format($row['valor'],2,".",","); ?>
                      </div>
                        <div class="span4"><br><br><br><br><br>
                        	<form name="form<?php $row['id']; ?>" method="post" action="inicio.php?elim=<?php echo $row['id']; ?>">
                            	<input type="hidden" name="codigo" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="boton" class="btn btn-primary">
                     </i> <strong>Enviar solicitud de compra</strong>
                                </button>
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
					$pa=mysql_query("SELECT * FROM carrito WHERE codigo='$codigo' and usu='$usuario' and modelo='1'");				
					if($row=mysql_fetch_array($pa)){
						$new_cant=$row['cantidad']+1;
						mysql_query("UPDATE carrito SET cantidad='$new_cant' WHERE codigo='$codigo' and usu='$usuario' ");
					}else{
						$fecha = date('d-m-Y');
						mysql_query("INSERT INTO carrito  (usu, codigo, cantidad, modelo, fecha) VALUES ('$usuario','$codigo','1','1','$fecha') ");
							
					}
				}
			?>
               <div id="sidebar"><br><br><br>
               		<h2 align="center">Solicitudes enviadas</h2>
                    <?php 
			if(!empty($_POST['n_cant'])){
				$n_cant=$_POST['n_cant'];
				$n_codigo=$_POST['codigo'];
				$oProducto=new Consultar_Producto($n_codigo);
				mysql_query("UPDATE carrito SET cantidad='$n_cant' WHERE codigo='$n_codigo' and usu='$usuario'");

			}
		?>
               		<table class="table table-bordered">
               		<tr>
               		  <td><table width="97%" class="table table-bordered"><i class="icon-shopping-cart">
               		    <tr>
               		      <td><table class="table table-bordered table table-hover">
               		        <?php 
								$neto=0;$tneto=0;
								$pa=mysql_query("SELECT * FROM carrito WHERE usu='$usuario' and modelo=2");				
								while($row=mysql_fetch_array($pa)){
									$oProducto=new Consultar_Producto($row['codigo']);
									$neto=$oProducto->consultar('valor')*$row['cantidad'];
									$tneto=$tneto+$neto;
									
							?>
               		        <tr style="font-size:9px">
               		          <td><?php echo $oProducto->consultar('nombre'); ?></td>
               		          <td>
            	<center>
                	<a href="#cant<?php echo $row['codigo']; ?>" role="button" class="btn" data-toggle="modal" title="Editar Cantidad">
						<span class="badge badge-success"><?php echo $row['cantidad']; ?></span>
                    </a>
                </center>
                 <div id="cant<?php echo $row['codigo']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       	<form name="form<?php $row['codigo']; ?>" method="post" action="">
          	<input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
            <div class="modal-header">
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
                </td>
               		          <td>$  <?php echo number_format($neto,2,".",","); ?></td>
               		          <td><a href="inicio.php?del=<?php echo $row['codigo']; ?>" title="Eliminar de la Lista"> <i class="icon-remove"></i> </a></td>
                              <td>
                              </td>
           		            </tr>
               		        <?php }
							?>
               		        <td colspan="4" style="font-size:9px"><div align="right">$<?php echo number_format($tneto,2,".",","); ?></div></td>
               		          <?php 
								$pa=mysql_query("SELECT * FROM carrito WHERE usu='$usuario' and modelo=1");				
								if(!$row=mysql_fetch_array($pa)){
							?>
             		          <tr>
             		            <div class="alert alert-success" align="center"><strong>No hay Productos en el Carrito</strong></div>
           		            </tr>
               		        <?php } ?>
             		        </table></td>
           		        </tr>
           		      </table></td>
               		</tr>
               		</table>
               </div>
            </div>
    	</div>
        
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
                if ($("#sidebar").height() < $(window).height() && $(window).scrollTop() > offset.top) { /* LINEA MODIFICADA PARA NO ANIMAR SI EL SIDEBAR ES MAYOR AL TAMAÑO DE PANTALLA */
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
