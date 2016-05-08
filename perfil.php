<?php
 		session_start();
		include_once('php_conexion.php');  
		include_once('Class/class_pedidos.php');
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
		
		
		#paginar
		$maximo=5;
		if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
			$cans=mysql_query("SELECT COUNT(usu)as total FROM carrito where usu='$usuario' ");
			if($dat=mysql_fetch_array($cans)){
				$total=$dat['total']; #inicializo la variable en 0
			}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Perfil</title>
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
    .table.table-bordered.table.table-hover .success td {
	color: #FFFFFF;
}
    #apDiv1 {	position: absolute;
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
	left: 321px;
	top: 53px;
}
    </style>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<div align="center">
    <table width="95%" border="0">
      <tr>
        <td>
       	  <table class="table table-bordered">
              <tr  class="success">
                <td>
                    <div class="row-fluid">
                      <div class="span6">
                        	<h3><img src="img/30.png" class="img-circle img-polaroid" width="100" height="100"> 
                        	Perfil</h3>
                      </div>
                      <div class="span6">
                      	<div align="right">
                       	
                       	<div class="btn-group">
                            <button class="btn" data-toggle="dropdown">
                            	<i class="icon-search"></i> <strong>Ordenar por </strong> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <?php
									$c=mysql_query("SELECT * FROM estado_pedidos");
									while($d=mysql_fetch_array($c)){
										echo '<li><a href="perfil.php?modelo='.$d['id'].'">'.$d['nombre'].'</a></li>';	
									}
							?>
                            <li><a href="perfil.php?modelo=0">Todos</a></li>
                            </ul>
                        </div>
                        <br><br>

                        </div>
                      </div>
                    </div>
                </td>
              </tr>
            </table>

        </td>
      </tr>
      <tr>
        <td>
        	<?php 
				if(!empty($_POST['usu'])){
					$usu=limpiar($_POST['usu']);			
					$codigo=limpiar($_POST['codigo']);				
					$cantidad=limpiar($_POST['cantidad']);
					$modelo=limpiar($_POST['modelo']);
					
					if(empty($_POST['id'])){
						$c_alumno = new Proceso_Alumnos($usu,$codigo,$cantidad,$modelo,'');
						$c_alumno->crear();
						
						$can=mysql_query("SELECT MAX(id)as maximo FROM carrito where usu='$usuario' ");
						if($dato=mysql_fetch_array($can)){
							$nit=$dato['maximo'];
							
						}
						echo '	<div class="alert alert-info" align="center">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>
										El Pedido "'.$usu.'" Registrado con Exito							
									</strong>
								</div>';
								
					}elseif(!empty($_POST['id'])){
						$nit=$_POST['id'];
						$b_alumno = new Proceso_Alumnos($usu,$codigo,$cantidad,$modelo,$nit);
						$b_alumno->actualizar();
												
						
						echo '	<div class="alert alert-info" align="center">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>
										El Pedido de "'.$usu.'" fue Actualizado con Exito							
									</strong>
								</div>';
					}
					
				}
					
			?>
           
        	<table class="table table-bordered table table-hover">
              <tr  class="success">
                
 
                <td width="24%"><center>
                  <strong>Pedido</strong>
                </center></td>
                <td width="24%"><center><strong>Cantidad</strong></center></td>
                <td width="37%"><center>
                  <strong>Status</strong>
                </center></td>
                <td width="8%">&nbsp;</td>
              </tr>
              <?php
			  	if(empty($_GET['modelo'])){
					if(empty($_POST['bus'])){
						$sql="SELECT * FROM carrito where usu='$usuario' ORDER BY usu LIMIT $inicio, $maximo";
					}else{
						$bus=limpiar($_POST['bus']);
						$sql="SELECT * FROM carrito WHERE usu LIKE '$bus%' or codigo='$bus' and usu='$usuario' ORDER BY usu LIMIT $inicio, $maximo";
					}
				}else{
					$bus=limpiar($_GET['modelo']);
					if($bus<>0){
						$sql="SELECT * FROM carrito WHERE modelo='$bus'and usu='$usuario' ORDER BY usu LIMIT $inicio, $maximo";
					}else{
						$sql="SELECT * FROM carrito where usu='$usuario' ORDER BY usu LIMIT $inicio, $maximo";
					}
				}
			  	
			  	$can=mysql_query($sql);
				while($dato=mysql_fetch_array($can)){	
					$salones = new Consultar_Salones($dato['modelo']);
					$productos = new Consultar_Producto($dato['codigo']);
			  ?>
             
              
                  <tr>
                    
                    <td><center><?php echo $productos->consultar('nombre'); ?></center></td>
                    <td>
                    	<center><span class="badge badge-success"><?php echo $dato['cantidad']; ?></span></center>
                    </td>
                    <td><center><?php echo $salones->consultar('nombre'); ?></center></td>
                    <td>
                    	
                    </td>
                  </tr>
                  
                    
              <?php } ?>
            </table>
			<?php 
				$can=mysql_query($sql);
				if(!$dato=mysql_fetch_array($can)){				
					echo '<div class="alert alert-info" align="center"><strong>No hay pedidos registrados con ese status</strong></div>';
				}
			?>
        </td>
      </tr>
    </table>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <div id="apDiv1">
            <li id="fat-menu" class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Hola! <?php echo $nomb; ?> <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="perfil.php" target="admin"><i class="icon-user"></i> Ver perfil </a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="cambiar_clave.php" target="admin"><i class="icon-pencil"></i> Modificar Contraseña </a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="php_cerrar.php"><i class="icon-off"></i> Cerrar Sesion</a></li>
              </ul>
            </li>
          </div>
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a class="brand" href="inicio.php">iStore</a>
      <ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="mis_pedidos.php">Compras</a></li>
</ul>
          <!--<div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="inicio.php">Principal</a></li>
              <li><a href="mis_pedidos.php">Pedidos</a></li>
            </ul>
            
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="pagination">
        <ul>
        	<?php
			if(empty($_GET['modelo']) and empty($_POST['bus'])){
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="perfil.php?pag='.$n.'">'.$n.'</a></li>';	
					}else{
						echo '<li><a href="perfil.php?pag='.$n.'">'.$n.'</a></li>';	
					}
			    }
			}
			?>
        </ul>
    </div>
</div>

</div>
    <div id="apDiv2"> <?php
            	$c=mysql_query("SELECT COUNT(id) as carrito FROM carrito where usu='$usuario' and modelo='3'");
				if($d=mysql_fetch_array($c)){
					$t_carrito=$d['carrito'];
				}
			?>        <strong>Historial de compras</strong><br><br>
        	<strong> Concretadas: </strong><span class="label label-success"><?php echo $t_carrito; ?></span>
            <?php
            	$c=mysql_query("SELECT COUNT(id) as carrito FROM carrito where usu='$usuario' and modelo='4'");
				if($d=mysql_fetch_array($c)){
					$t_carrito=$d['carrito'];
				}
			?>        <br><br>
        	<strong> Canceladas: </strong><span class="label label-success"><?php echo $t_carrito; ?></span>
            </div>
        
</body>
</html>