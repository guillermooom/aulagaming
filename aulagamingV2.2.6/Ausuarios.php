<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/particle.css">
    <link rel="stylesheet" type="text/css" href="css/formulario.css">
    <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/particles.js"></script>
    <title>Administrar Usuarios - Aula Gaming </title>
    <style>
        ::selection {
            background-color: #9712FF;
        }
        ::-moz-selection {
            background-color: #9712FF;
        }
    </style>
 </head>
 <body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
    require("config/config-Ausuarios.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
    echo "<a href='inicio.php'>Inicio</a>";
?>
    <h1>Administrar Usuarios - AULA GAMING</h1>
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Usuario:</B> ".$nom." ".$ape;
	?>
  <br><br>
  
<?php
  echo "<form id='formu' name='formu' method='post' >
  <input type='submit'  name='submit1' value='Añadir Usuario' >
  </form>";
    $usua = consultaUsuarios($conn);
    echo "Usuarios: <br/><br/>";
    foreach($usua as $dat){
          echo "Nombre: ".$dat["nombre"]." --- Apellido: ".$dat["apellido"]."<br/>".
          "Nivel de permisos: ".$dat["permisos"];
          echo "<form id='formu' name='formu' method='post'><br/>
          <input type='submit'  name='submit2' value='Eliminar Usuario' >
          </form> - <br/><br/> ";
      }
    
      if(!empty($_POST)){
        if (isset($_POST['submit2'])) {
          $nbusu=$dat["email"];
          eliminarUsuario($conn,$nbusu);
          echo "<script>alert('Usuario Eliminado');</script>";
        }elseif (isset($_POST['submit1'])) {
          header("Location: agregarusuario.php");
			    exit();
        }
      }
?>

</body>
</html>