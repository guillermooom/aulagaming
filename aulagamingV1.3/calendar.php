<!DOCTYPE html>
<html>
<head>
	<title>Calendario</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" type="image/png" href="img/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="text/css" href="css/calendar.css">
    <link rel="stylesheet" type="text/css" href="css/particle.css">
    <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/particles.js"></script>
</head>
<body onload="iniciarParticulas()">
<div id="particles-js"></div>

<?php
function mesESP($mes){
	$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	return $nombreMes;
}
?>
	<?php
		
		// Establecer la zona horaria
		date_default_timezone_set("Europe/Madrid");
		// Obtener el año actual
		$year = date("Y");
		echo "<h1>$year</h1>";
		// Recorrer los meses del año
		for ($month = 1; $month <= 12; $month++) {
			// Imprimir el título del mes
			$monthName = date("F", mktime(0, 0, 0, $month, 1, $year));
			
			echo "<h2>".mesESP($monthName)."</h2>";
			// Imprimir la tabla del mes
			echo "<form id='formu' name='formu' method='post' >";
			echo "<table>";
			// Imprimir la fila de los días de la semana
			echo "<tr>";
			echo "<th>Lunes</th>";
			echo "<th>Martes</th>";
			echo "<th>Miércoles</th>";
			echo "<th>Jueves</th>";
			echo "<th>Viernes</th>";
			echo "<th>Sábado</th>";
			echo "<th>Domingo</th>";
			echo "</tr>";
			// Obtener el primer día del mes
			$firstDay = date("N", mktime(0, 0, 0, $month, 1, $year));
			// Obtener el número de días del mes
			$numDays = date("t", mktime(0, 0, 0, $month, 1, $year));
			// Imprimir las filas con los días del mes
			$currentDay = 1;
			for ($row = 1; $row <= 6; $row++) {
				echo "<tr>";
				for ($col = 1; $col <= 7; $col++) {
					if ($row == 1 && $col < $firstDay) {
						echo "<td></td>";
					} else if ($currentDay > $numDays) {
						$row++;
					} else {
						//FESTIVOS
						if($col>5 || ($monthName=="September" && $currentDay < 8) || ($monthName=="October" && ($currentDay==12 || $currentDay ==31)) ||
						 ($monthName=="November" && $currentDay==1) ||($monthName=="December" && (($currentDay>4 && $currentDay<9)||($currentDay>23)))
						 ||($monthName=="January" && $currentDay<8)||($monthName=="February" && $currentDay>24) || ($monthName=="March" && ($currentDay==20 || $currentDay==31))
						 ||($monthName=="April" && $currentDay<11) || ($monthName=="May" && $currentDay<3) ||($monthName=="June" && $currentDay>13)||($monthName=="July") || ($monthName=="August"))
						 {
							echo "<td style=color:red >".$currentDay."</td>";
							$currentDay++;
						}else{
							echo "<input type='hidden'  name='fecha' value='$year'>";
							echo "<input type='hidden'  name='month' value='$month'>";
							echo "<td><input type='submit'  name='submit' value='$currentDay'></td>";
							$currentDay++;
						}
					}
				}
				echo "</tr>";
			}
			echo "</table>";
		echo "</form>";
		if(!empty($_POST)){
			// Asignar valores a las variables
  			 $dia = $_POST["submit"];
			 $mes = $_POST["month"];
  			 $anio = $_POST["fecha"];
  
  			// Crear la cookie
  			setcookie("reserva", "$dia-$mes-$anio", time() + 3600); // Expira en 1 hora
			
			//Redirige a la página de seleccionar un pc.
			header("Location: reserva.php");
		}
		}
	?>
</body>
</html>
