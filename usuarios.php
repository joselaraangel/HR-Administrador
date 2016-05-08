<?php
 		session_start();
		include_once('php_conexion.php');  
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

		
		#paginar
		$maximo=7;
				if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
			$cans=mysql_query("SELECT COUNT(nom)as total FROM usuarios");
			if($dat=mysql_fetch_array($cans)){
				$total=$dat['total']; #inicializo la variable en 0
			}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Informacion de clientes</title>
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
      <script type="text/javascript">
  function validarLetras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; // backspace
	    if (tecla==9) return true; // tab
		if (tecla==32) return true; // espacio
		if (e.ctrlKey && tecla==86) { return true;} //Ctrl v
		if (e.ctrlKey && tecla==67) { return true;} //Ctrl c
		if (e.ctrlKey && tecla==88) { return true;} //Ctrl x
 
		patron = /[a-zA-Z]/; 

		te = String.fromCharCode(tecla); 
		return patron.test(te); // prueba de patron
	}	
</script>
 <script type="text/javascript">
function direccionEmail(theElement, nombre_del_elemento )
{
var evaluar = theElement.value;
var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (evaluar.length == 0 ) return true;
if (filter.test(evaluar))
return true;
else
alert("La dirección de correo es incorrecta");
theElement.focus();
return false;
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
                        	<h3><img src="img/bigstock-Handshake-Icon-58071227.jpg" class="img-circle img-polaroid" width="128" height="128"> 
                        	Modulo de Consulta de Clientes</h3>
                      </div>
                      <div class="span6">
                      	<div align="right">
                          <div class="btn-group">
                            <ul class="dropdown-menu">
                            <li><a href="usuarios.php?status=0">Todos</a></li>
                            </ul>
                        </div>
                        <br><br>
                        <form name="form1" method="post" action="">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-search"></i></span>
                                <input name="bus" type="text" placeholder="Buscar por nombre de usuario" class="input-xlarge" autocomplete="off">
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
				if(!empty($_POST['nom'])){
					$nom=limpiar($_POST['nom']);			
					$ape_pat=limpiar($_POST['ape_pat']);				$ape_mat=limpiar($_POST['ape_mat']);
					$email=limpiar($_POST['email']);                    $status=limpiar($_POST['status']);
					$con=limpiar($_POST['con']);
					
					if(empty($_POST['usu'])){
						$c_alumno = new Proceso_Usuarios($nom,$ape_pat,$ape_mat,$email,$con,'');
						$c_alumno->crear();
						
						$can=mysql_query("SELECT MAX(id)as maximo FROM usuarios");
						if($dato=mysql_fetch_array($can)){
							$nit=$dato['maximo'];
								
						}
						echo '	<div class="alert alert-info" align="center">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>
										Los datos de "'.$nom.'" Registrado con Exito							
									</strong>
								</div>';
								
					}elseif(!empty($_POST['usu'])){
						$nit=$_POST['usu'];
						$b_alumno = new Proceso_Usuarios($nom,$ape_pat,$ape_mat,$email,$con,$status,$nit);
						$b_alumno->actualizar();
												
						
						echo '	<div class="alert alert-info" align="center">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>
										Los datos de "'.$nom.'" Actualizado con Exito							
									</strong>
								</div>';
					}
					
				}
					
			?>
           
        	<table class="table table-bordered table table-hover">
              <tr  class="success">
                
                <td width="20%"><strong>Usuario</strong></td>
                <td width="19%"><center>
                  <strong>Nombre</strong>
                </center></td>
                <td width="14%"><center><strong>Apellidos</strong></center></td>
                <td width="32%"><center>
                  <strong>Correo electrónico</strong>
                </center></td>
                <td width="8%">&nbsp;</td>
              </tr>
              <?php
			  	if(empty($_GET['status'])){
					if(empty($_POST['bus'])){
						$sql="SELECT * FROM usuarios ORDER BY usu LIMIT $inicio, $maximo";
					}else{
						$bus=limpiar($_POST['bus']);
						$sql="SELECT * FROM usuarios WHERE usu LIKE '$bus%' ORDER BY usu LIMIT $inicio, $maximo";
					}
				}else{
					$bus=limpiar($_GET['status']);
					if($bus<>0){
						$sql="SELECT * FROM usuarios WHERE status='$bus' ORDER BY usu LIMIT $inicio, $maximo";
					}else{
						$sql="SELECT * FROM usuarios ORDER BY usu LIMIT $inicio, $maximo";
					}
				}
			  	
			  	$can=mysql_query($sql);
				while($dato=mysql_fetch_array($can)){	
			
			  ?>
                  <tr>
                    <td><i class="icon-user"></i> <?php echo trim($dato['usu']); ?> </td>
                    <td><center><?php echo $dato['nom']; ?></center></td>
                    <td>
                    	<center>
                                <?php echo $dato['ape_pat']."  ".$dato['ape_mat']; ?>
                        </center>
                    </td>
                    <td><center><?php echo $dato['email']; ?></center></td>
                    <td>
                    	<a href="#actualizar<?php echo $dato['usu']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Actualizar Informacion">
                    		<i class="icon-edit"></i>
                        </a>

                    </td>
                  </tr>
                  <!--actualizar alumno-->
                    <div id="actualizar<?php echo $dato['usu']; ?>" 
                    class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form2" method="post" enctype="multipart/form-data" action="">
                    	<input type="hidden" name="id" value="<?php echo $dato['usu']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Modificar datos</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>Nombre</strong><br>
                                    <input type="text" name="nom" autocomplete="off" required value="<?php echo $dato['nom']; ?>" onKeyDown="return validarLetras(event)" maxlength="15"><br>
                                    <strong>Apellido Paterno</strong><br>
                                  <input type="text" name="ape_pat" autocomplete="off" required value="<?php echo $dato['ape_pat']; ?>" onKeyDown="return validarLetras(event)" maxlength="15"><br>
                                   <strong>Apellido Materno</strong><br>
                                  <input type="text" name="ape_mat" autocomplete="off" required value="<?php echo $dato['ape_mat']; ?>" onKeyDown="return validarLetras(event)" maxlength="15"><br>
                                  <strong>correo electrónico</strong><br>
                                  <input type="text" name="email" autocomplete="off" required value="<?php echo $dato['email']; ?>" maxlength="50"><br>
                                  <strong>Usuario</strong><br>
                                  <input type="text" name="usu" autocomplete="off" required value="<?php echo $dato['usu']; ?>" maxlength="10"><br>
                                  <strong>Contraseña</strong><br>
                                  <input type="text" name="con" autocomplete="off" required value="<?php echo $dato['con']; ?>" maxlength="10"><br>
                                  <strong>Status</strong><br>
                                  <input type="text" name="status" autocomplete="off" required value="<?php echo $dato['status']; ?>" onKeyDown="return validarLetras(event)" maxlength="1"><br>
                                    </select>
                                </div>
                                <div class="span6">
                                    <center><button type="submit" class="btn" onClick="return direccionEmail(email,'email' )"><strong><i class="icon-ok"></i> Actualizar datos</strong></button></center>
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
					echo '<div class="alert alert-info" align="center"><strong>No hay usuarios Registrados</strong></div>';
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
          <a class="brand" href="inicioAdministrador.php">istore</a>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="alumnos.php">Anuncios</a></li>
  <li role="presentation"><a href="pedidos.php">Ventas</a></li>
  <li role="presentation" class="active"><a href="usuarios.php">Clientes</a></li>
</ul>
            <div id="apDiv2"> <?php
            	$c=mysql_query("SELECT COUNT(id) as carrito FROM carrito WHERE modelo='2'");
				if($d=mysql_fetch_array($c)){
					$t_carrito=$d['carrito'];
				}
			?>        <br><br>
           <a href="pedidos.php?modelo=2"><button class="btn btn-primary" type="button">
  Pedidos <span class="badge"><?php echo $t_carrito; ?></span>
</button></a>
            </div>
          </div>
          <!--/.nav-collapse -->
        <!--</div>-->
      </div>
    </div>
    <div class="pagination">
        <ul>
        	<?php
			if(empty($_GET['id']) and empty($_POST['bus'])){
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="usuarios.php?pag='.$n.'">'.$n.'</a></li>';	
					}else{
						echo '<li><a href="usuarios.php?pag='.$n.'">'.$n.'</a></li>';	
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
            	    <strong>Nombre</strong><br>
                                    <input type="text" name="nom" autocomplete="off" required value="<?php echo $dato['nom']; ?>"><br>
                                    <strong>Apellido Paterno</strong><br>
                                  <input type="text" name="ape_pat" autocomplete="off" required value="<?php echo $dato['ape_pat']; ?>"><br>
                                   <strong>Apellido Materno</strong><br>
                                  <input type="text" name="ape_mat" autocomplete="off" required value="<?php echo $dato['ape_mat']; ?>"><br>
                                  <strong>correo electronico</strong><br>
                                  <input type="text" name="email" autocomplete="off" required value="<?php echo $dato['email']; ?>"><br>
                                  <strong>Usuario</strong><br>
                                  <input type="text" name="usu" autocomplete="off" required value="<?php echo $dato['usu']; ?>"><br>
                                  <strong>Contraseña</strong><br>
                                  <input type="text" name="con" autocomplete="off" required value="<?php echo $dato['con']; ?>"><br>
                                  <strong>Status</strong><br>
                                  <input type="text" name="status" autocomplete="off" required value="<?php echo $dato['status']; ?>"><br>
                                    </select>
                                    
                                  </div>
            <div class="span6">

                <center><button type="submit" class="btn"><strong><i class="icon-ok"></i> Ingresar datos</strong></button></center>
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