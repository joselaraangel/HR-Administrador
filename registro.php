
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
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
<script type="text/javascript">
  function validarLetras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; // backspace
	if (tecla==9) return true; // tab
		if (tecla==32) return true; // espacio
		if (e.ctrlKey && tecla==86) { return true;} //Ctrl v
		if (e.ctrlKey && tecla==67) { return true;} //Ctrl c
		if (e.ctrlKey && tecla==88) { return true;} //Ctrl x    
 
		patron = /[a-zA-Z]/; //patron
 
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
<script>
$(document).ready(function() {
    $('#emailForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            }
        }
    });
});
</script>
  </head>

  <body>
    <br>
    <div class="container">
      <form name="form1" method="post" action="validacion.php" class="form-signin">
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">
              <div id="apDiv1">
                <li id="fat-menu" class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>Acceder a</a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php" target="admin"><i class="icon-on"></i> Iniciar sesion</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="loginPanel.php" target="admin"><i class="icon-flag"></i> Panel Administrador</a></li>
                    
                  </ul>
                </li>
              </div>
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <a class="brand" href="registro.php">iStore</a><a class="brand" href="index.php"></a>
              <div class="nav-collapse collapse"></div>
              <!--/.nav-collapse -->
            </div>
          </div>
        </div>
        <h2 class="form-signin-heading">Registro        
        </h2>
        <p>*Nombre</p>
        <input type="text" name="nom" class="input-block-level"  autocomplete="off" onKeyDown="return validarLetras(event)" maxlength="15" required="required">
<p>*Apellido Paterno</p>
<p>
      <input type="text" name="ape_pat" class="input-block-level"  autocomplete="off" onkeydown="return validarLetras(event)" maxlength="15" required="required">
        </p>
        <p>*Apellido Materno</p>
        <input type="text" name="ape_mat" class="input-block-level"  autocomplete="off" onkeydown="return validarLetras(event)" maxlength="15" required="required">
        <p>*Correo electrónico</p>
        <input type="text" name="email" class="input-block-level"  autocomplete="off" onkeydown="return validarEmail(event)" maxlength="50" required="required" placeholder="ejemplo@correo.com.mx">
        <p>*Usuario</p>
        <input type="text" name="usu" class="input-block-level"  autocomplete="off" maxlength="10" required="required">
        <p>*Contraseña</p>
        <input type="password" name="con" class="input-block-level"  autocomplete="off" maxlength="10" required="required">
        <p>*Repetir Contraseña</p>
        <input type="password" name="con2" class="input-block-level"  autocomplete="off" maxlength="10" required="required">
        </p>
        <p>(*) Obligatorio</p>
        <button class="btn btn-large btn-primary" type="submit" onClick="return direccionEmail(email,'email' )">Enviar</button>
        <p>&nbsp;</p>
     <br><?php
     if(isset($_GET['error'])){
        if($_GET['error']==1){
            
			echo '<div class="alert alert-error" align="center"><strong>las contraseñas no coinciden</strong></div>';
			
        }
		else if($_GET['error']==2){
			echo '<div class="alert alert-error" align="center"><strong>el usuario ya existe</strong></div>';
		}
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
  <script type="text/javascript">
