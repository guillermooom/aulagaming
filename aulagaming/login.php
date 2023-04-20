<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <title>Login - Aula Gaming</title>
 </head>

<body>
<?php
    require("config/config.php");
    require("config/config-login.php");
    $conn = conexion();      
    
?>
    <h1>INICIO SESION</h1>
	<a href="inicio.php">Inicio</a>
    <form id="formu" name="formu" method="post">
            <br>
            Email <input type="text" name="email"  placeholder="Enter email">
            <br><br>
            Contraseña <input type="password" name="password">

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