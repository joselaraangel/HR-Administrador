<?php
     /*require('php_conexion.php');*/
	 
     
    if($_POST['con'] != $_POST['con2']){
        header("Location: registro.php?error=1");
    }
  
         $conexion=mysqli_connect("localhost","root","","carrito");
         $consulta='insert into usuarios values("'.$_POST['nom'].'","'.$_POST['ape_pat'].'","'.$_POST['ape_mat'].'","'.$_POST['email'].'","'.$_POST['usu'].'","'.$_POST['con'].'","b" );';
              
             $validacion = mysqli_query($conexion,$consulta);
     
            
            if(!$validacion){
                echo "Error al ingresar registro";
			  header("Location: registro.php?error=2");
                }
            else{
                echo "usuario registrado con exito";
				header("Location: index.php?error=3");
                }
	 
?>