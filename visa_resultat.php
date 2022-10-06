<?php
header("Cache-Control: max-age=1, must-revalidate");
?>
<html>
<meta charset="UTF-8" />
<!--
//////////////////////////////////////////////////////
// 													//
// 	Copyright Petter karlsson PK-Multimedia 2004	//
//													//
// 	www.pkm.nu										//
//													//
//	webmaster@tokigamasar.st						//
//													//
//////////////////////////////////////////////////////
-->

<head>
	<title>TMS Penalty Challenge</title>
	<LINK rel="StyleSheet" type="text/css" href="../css/default.css">
	<style>
		body,
		table,
		tr,
		td,
		div,
		span {
			font: 10px verdana;
			background-color: white;
		}

		a {
			font-weight: bold;
		}

		body {
			background: url(logga.jpg);
			background-repeat: no-repeat;
		}
	</style>
	<script>
		function tebax() {
			window.location = 'index.html'
		}

		function avbryt() {
			return false
		}
		document.oncontextmenu = avbryt
	</script>
</head>

<body>
	<br><br><br><br><br><br><br><br>
	<?php
	$mysql_host = "host";  
	$mysql_user = "username";
	$mysql_password = "password";
	$mysql_database = "database";

	$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$sql = "SELECT * FROM spel";
	$result = $mysqli->query($sql);
	$i = 1;
	print "<h3>TIO I TOPP</h3>";
	print '<table bgcolor=#999999 width=350 cellpadding=2 cellspacing=1><tr bgcolor=#cccccc><td><b class=blue>Rank</b></td><td><b class=blue>Namn</b></td><td><b class=blue>Poäng</b></td><td><b class=blue>Nivå</b></td></tr>';
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($i < 11) {
				print '<tr bgcolor=#ffffff>';
				print '<td>' . $i . "</td>";
				print '<td>' . $row["namn"] . "</td>";
				print '<td>' . $row["poang"] . "</td>";
				print '<td>' . $row["niva"] . "</td>";
				print '</tr>';
			}
			$i++;
		}
	} else {
		echo "0 results";
	}
	print '</table>';
	$mysqli->close();

	print "<br>Spelet har spelats " . ($i) .  " gånger";
	?>
	<br><br>
	<a href="javascript:tebax()" style="border:1px solid #666666;padding:5px;">Spela!</a>

</body>

</html>