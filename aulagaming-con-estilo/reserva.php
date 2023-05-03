<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <title>Consulta Reservas - Aula Gaming </title>
 </head>
<style>
    .checkeable input {
  display: none;
}
.checkeable img {
  width: 100px;
  border: 5px solid transparent;
}
.checkeable input {
  display: none;
}
.checkeable input:checked  + img {
  content:url("img/pc-select.png");
}
</style>
<body>
<?php
    error_reporting(0);
    require("config/config.php");
    require("config/config-reserva.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
?>
    <a href="inicio.php">Inicio</a>
    <h1>RESERVAR ORDENADOR</h1>
 
  <br><br>
      <h3>Seleccione un PC</h3>

      <form name=formu method="post">
        <table>
          <tr>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="1"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>

            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="2"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
          
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="3"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>

            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="4"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>

            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="5"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
          </tr>

          <tr>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="10"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>

            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="9"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
          
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="8"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>

            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="7"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>

            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="6"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
          </tr>
      </table>
      <br><br>
      Turno: 
      <select name="turno">
        <option value="mañana">Mañana</option>
        <option value="tarde">Tarde</option>
      </select>
      <br><br>
      <input type="submit"  name="submit" value="Consultar" >
    <form>

<?php
if(!empty($_POST)){
  $turno=$_POST["turno"];
  $pc=$_POST["cap"];
  if($pc==""){
    echo "<p id='err'>ERROR: No has seleccionado ningun PC</p>";
    $realiza=false;
  }else{
    echo $pc;
  }
  if($realiza)
    echo $turno;
}

?>
</body>
</html>