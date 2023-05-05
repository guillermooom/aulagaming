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
    <title>Login - Aula Gaming</title>
 </head>

 <body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
    require("config/config-login.php");
    $conn = conexion();      
    
?>
    <a href="inicio.php">Inicio</a>
    <h1>INICIO DE SESIÓN</h1>
	
    <form id="formu" name="formu" method="post">
            <br>
            Email: <input type="text" name="email" size="40" >
            <br><br>
            Contraseña: <input type="password" name="password"><br/><br/>

        <input type="submit"  name="submit" value="Submit" >
    </form>
<?php
if(!empty($_POST)){
    $realizar=true;
    if($_POST["email"]==""){
        echo "<p id='err'>ERROR: No has introducido el email de usuario</p>";
        $realizar=false;
    }
    if($_POST["password"]==""){
        echo "<p id='err'>ERROR: No has introducido la contraseña</p>";
        $realizar=false;
    }
    if($realizar){
        $nb=$_POST["email"];
        if(login($conn,$nb)==$_POST["password"]){
            
            session_start();
            crearSession($_POST["email"]);
            header("Location: inicio.php");
        }else{
            echo "<p id='err'>ERROR: Usuario Incorrecto</p>";
        }
    }
}
?>

</body>
</html>