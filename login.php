<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aula Gaming</title>
 </head>

<body>
<?php
    require("login-funciones.php");
    $conn = conexion();
    setcookie("PHPSESSID","",time()-3600,"/");       
    
?>
    <h1>RESERVA ORDENADOR AULA GAMING</h1>
		
    <form id="formu" name="formu" method="post">
        
            Email <input type="text" name="email"  placeholder="Enter email">
       
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
            crearSession($_POST["password"]);
            header("Location: inicio.php");
        }else{
            echo "<p id='err'>ERROR: Usuario Incorrecto</p>";
        }
    }
}
?>

</body>
</html>