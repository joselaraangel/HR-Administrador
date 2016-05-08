<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('Class/funciones.php'); 
		include_once('Class/class_alumnos.php');
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
		
		if(!empty($_GET['estado'])){
			$codigo=limpiar($_GET['estado']);
			$cans=mysql_query("SELECT * FROM producto WHERE estado='s'");
			if($dat=mysql_fetch_array($cans)){
				$xSQL="Update producto Set estado='n' Where id='$id'";
				mysql_query($xSQL);
				header('location:personal.php');
			}else{
				$xSQL="Update producto Set estado='s' Where id='$id'";
				mysql_query($xSQL);
				header('location:personal.php');
			}
		}
		
		#paginar
		$maximo=7;
		if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
			$cans=mysql_query("SELECT COUNT(nombre)as total FROM producto");
			if($dat=mysql_fetch_array($cans)){
				$total=$dat['total']; #inicializo la variable en 0
			}

?>
<?php 
	if(!empty($_GET['del'])){
		$id=$_GET['del'];
		mysql_query("DELETE FROM producto WHERE id=$id");
		header('location:personal.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Panel</title>
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
     <script type="text/javascript">
	function validarNumeros(e) { // 1
		tecla = (document.all) ? e.keyCode : e.which; // 2
		if (tecla==8) return true; // backspace
		if (tecla==9) return true; // tab
		if (tecla==109) return true; // menos
    if (tecla==110) return true; // punto
		if (tecla==189) return true; // guion
		if (e.ctrlKey && tecla==86) { return true}; //Ctrl v
		if (e.ctrlKey && tecla==67) { return true}; //Ctrl c
		if (e.ctrlKey && tecla==88) { return true}; //Ctrl x
		if (tecla>=96 && tecla<=105) { return true;} //numpad
 
		patron = /[0-9]/; // patron
 
		te = String.fromCharCode(tecla); 
		return patron.test(te); // prueba
	}
</script>

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
	left: 646px;
	top: -41px;
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
                        	<h3><img src="img/preferences-logo.png" class="img-circle img-polaroid" width="125" height="125"> 
                        	Administrador de Personal</h3>
                      </div>
                      <div class="span6">
                      	<div align="right">
                       	<a href="#nuevo" role="button" class="btn" data-toggle="modal">
                            	<strong><i class="icon-pencil"></i> Ingresar Nuevo</strong>
                        </a>
                        <div class="btn-group">
                            <button class="btn" data-toggle="dropdown">
                            	<i class="icon-search"></i> <strong>Consultar por Puestos</strong> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <?php
									$c=mysql_query("SELECT * FROM proveedor WHERE estado='s'");
									while($d=mysql_fetch_array($c)){
										echo '<li><a href="personal.php?modelo='.$d['id'].'">'.$d['nombre'].'</a></li>';	
									}
							?>
                            <li><a href="personal.php?modelo=0">Todos</a></li>
                            </ul>
                        </div>
                        <br><br>
                        <form name="form1" method="post" action="">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-search"></i></span>
                                <input name="bus" type="text" placeholder="Buscar por nombre" class="input-xlarge" autocomplete="off" class="typeahead">
                            </div>
                        </form>
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
				if(!empty($_POST['nombre'])){
					$nombre=limpiar($_POST['nombre']);			
					$valor=limpiar($_POST['valor']);
					$folio=limpiar($_POST['nota']);
					$modelo=limpiar($_POST['modelo']);
					
					if(empty($_POST['id'])){
						$c_alumno = new Proceso_Alumnos($nombre,$valor,$folio,$modelo,'s','');
						$c_alumno->crear();
						
						$can=mysql_query("SELECT MAX(id)as maximo FROM producto");
						if($dato=mysql_fetch_array($can)){
							$nit=$dato['maximo'];
							//subir la imagen del articulo
							$nameimagen = $_FILES['imagen']['name'];
							$tmpimagen = $_FILES['imagen']['tmp_name'];
							$extimagen = pathinfo($nameimagen);
							$urlnueva = "img/producto/".$nit.".jpg";			
							if(is_uploaded_file($tmpimagen)){
								copy($tmpimagen,$urlnueva);	
							}
						}
						echo '	<div class="alert alert-info" align="center">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>
										El Producto "'.$nombre.'"fue Registrado con Exito							
									</strong>
								</div>';
								
					}elseif(!empty($_POST['id'])){
						$nit=$_POST['id'];
						$b_alumno = new Proceso_Alumnos($nombre,$valor,$folio,$modelo,'s',$nit);
						$b_alumno->actualizar();
												
						//subir la imagen del articulo
						$nameimagen = $_FILES['imagen']['name'];
						$tmpimagen = $_FILES['imagen']['tmp_name'];
						$extimagen = pathinfo($nameimagen);
						$urlnueva = "img/producto/".$nit.".jpg";			
						if(is_uploaded_file($tmpimagen)){
							copy($tmpimagen,$urlnueva);	
						}
						echo '	<div class="alert alert-info" align="center">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>
										El Empleado "'.$nombre.'" Actualizado con Exito							
									</strong>
								</div>';
					}
					
				}
					
			?>
           
        	<table class="table table-bordered table table-hover">
              <tr  class="success">
                
                <td width="20%"><strong>Empleado</strong></td>
                <td width="19%"><center>
                  <strong>Salario</strong>
                </center></td>
                <td width="14%"><center><strong>Estado</strong></center></td>
                <td width="32%"><center>
                  <strong>Puesto</strong>
                </center></td>
                <td width="8%">&nbsp;</td>
              </tr>
              <?php
			  	if(empty($_GET['modelo'])){
					if(empty($_POST['bus'])){
						$sql="SELECT * FROM producto WHERE estado='s' ORDER BY nombre LIMIT $inicio, $maximo";
					}else{
						$bus=limpiar($_POST['bus']);
						$sql="SELECT * FROM producto WHERE nombre LIKE '$bus%' and estado='s' ORDER BY nombre LIMIT $inicio, $maximo";
					}
				}else{
					$bus=limpiar($_GET['modelo']);
					if($bus<>0){
						$sql="SELECT * FROM producto WHERE modelo='$bus' and estado='s' ORDER BY nombre LIMIT $inicio, $maximo";
					}else{
						$sql="SELECT * FROM producto WHERE estado='s' ORDER BY nombre LIMIT $inicio, $maximo";
					}
				}
			  	
			  	$can=mysql_query($sql);
				while($dato=mysql_fetch_array($can)){	
					$salones = new Consultar_Salones($dato['modelo']);
			  ?>
                  <tr>
                    <td><i class="icon-user"></i> <?php echo trim($dato['nombre']); ?></td>
                    <td><center>$<?php echo number_format($dato['valor'],2,".",","); ?></center></td>
                    <td>
                    	<center>
                        <a href="personal.php?estado=<?php echo $dato['id']; ?>" title="Cambiar Estado">
							<?php echo estado($dato['estado']); ?>
                        </a>
                        </center>
                    </td>
                    <td><center><?php echo $salones->consultar('nombre'); ?></center></td>
                    <td>
                    	<a href="#actualizar<?php echo $dato['id']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Actualizar Informacion">
                    		<i class="icon-edit"></i>
                        </a>
                        <a href="personal.php?del=<?php echo $dato['id']; ?>" class="btn btn-mini" title="Eliminar de la Lista">
        	        	<i class="icon-remove"></i>
            	    </a>
                    </td>
                  </tr>
                  <!--actualizar alumno-->
                    <div id="actualizar<?php echo $dato['id']; ?>" 
                    class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form2" method="post" enctype="multipart/form-data" action="">
                    	<input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Actualizar Producto</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>Nombre producto</strong><br>
                                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $dato['nombre']; ?>" maxlength="25" required="required"><br>
                                    
                                    <strong>proveedor</strong><br>
                                    <select name="modelo">
                                    	<?php
											$c=mysql_query("SELECT * FROM proveedor WHERE estado='s'");
											while($d=mysql_fetch_array($c)){
												if($d['id']==$dato['modelo']){	
													echo '<option value="'.$d['id'].'" selected>'.$d['nombre'].'</option>';
												}else{
													echo '<option value="'.$d['id'].'">'.$d['nombre'].'</option>';
												}
											}
										?>
                                        
                                    </select>
                                    <strong>Fotografía</strong><br>
                                    <input type="file" name="imagen" id="imagen">
                                </div>
                                <div class="span6">
                                    
                                    <strong>$</strong><br>
                                    <input type="text" name="valor" autocomplete="off" value="<?php echo $dato['valor']; ?>" onkeydown="return validarNumeros(event)" maxlength="7" required><br>
                                    <strong>Nota</strong><br>
                                    <input type="text" name="nota" autocomplete="off" value="<?php echo $dato['nota']; ?>" maxlength="40"><br><br>
                                    <center><button type="submit" class="btn"><strong><i class="icon-ok"></i> Actualizar Producto</strong></button></center>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><strong><i class="icon-remove"></i> Cerrar</strong></button>
                        </div>
                        </form>
                    </div>
                    
              <?php } ?>
            </table>
			<?php 
				$can=mysql_query($sql);
				if(!$dato=mysql_fetch_array($can)){				
					echo '<div class="alert alert-info" align="center"><strong>No hay Productos Registrados</strong></div>';
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
                <li role="presentation"><a role="menuitem" tabindex="-1" href="clave_admin.php" target="admin"><i class="icon-pencil"></i> Cambiar Contraseña </a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="php_cerrar.php"><i class="icon-off"></i> Cerrar Sesion</a></li>
              </ul>
            </li>
          </div>
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a class="brand" href="inicioAdministrador.php">HR Administrador</a>
          <ul class="nav nav-tabs">
    <li role="presentation" class="active"><a href="personal.php">Panel</a></li>
  <!--<li role="presentation"><a href="alumnos.php">Anuncios</a></li>
  <li role="presentation"><a href="pedidos.php">Ventas</a></li>
  <li role="presentation"><a href="usuarios.php">Clientes</a></li>-->
</ul>
            

          </div>
          <!--/.nav-collapse -->
        <!--</div>-->
      </div>
    </div>
    <div class="pagination">
        <ul>
        	<?php
			if(empty($_GET['modelo']) and empty($_POST['bus'])){
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="personal.php?pag='.$n.'">'.$n.'</a></li>';	
					}else{
						echo '<li><a href="personal.php?pag='.$n.'">'.$n.'</a></li>';	
					}
				}
				
			}
			?>
        </ul>
    </div>
</div>
<!--crear nuevo alumno-->
<div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form name="form2" method="post" enctype="multipart/form-data" action="">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Ingresar Nuevo</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
        	<div class="span6">
            	<strong>Nombre producto</strong><br>
            	<input type="text" name="nombre" autocomplete="off" required maxlength="25" required="required"><br>
              
                <strong>proveedor</strong><br>
                <select name="modelo">
                	<?php
						$c=mysql_query("SELECT * FROM proveedor WHERE estado='s'");
						while($d=mysql_fetch_array($c)){
							echo '<option value="'.$d['id'].'">'.$d['nombre'].'</option>';
						}
					?>
                </select>
                <strong>Fotografía</strong><br>
                <input type="file" name="imagen" id="imagen">
            </div>
            <div class="span6">
                <strong>$</strong><br>
              <input type="text" name="valor" autocomplete="off" onkeydown="return validarNumeros(event)" maxlength="7" required><br>
                <strong>Nota</strong><br>
                <input type="text" name="nota" autocomplete="off" maxlength="40"><br><br>
                <center><button type="submit" class="btn"><strong><i class="icon-ok"></i> Ingresar Producto</strong></button></center>
            </div>
		</div>
	</div>
  	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><strong><i class="icon-remove"></i> Cerrar</strong></button>
	</div>
    </form>
</div>
</body>
</html>