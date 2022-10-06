<?php
header("Cache-Control: max-age=1, must-revalidate");
$sort = $_GET["sortBy"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>TMS Penalty Challange- TOP 10</title>
	<style>
		body,
		table,
		tr,
		td,
		div,
		span {
			font: 14px verdana;
		}
	</style>
</head>

<body>
	<?php
	$mysql_host = "host";  
	$mysql_user = "username";
	$mysql_password = "password";
	$mysql_database = "database";

	$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$sql = "SELECT * FROM spel ORDER BY $sort DESC";
	$result = $mysqli->query($sql);

	$i = 1;
	print "TIO I TOPP<p>";
	print '<table bgcolor=#eeeeee width=600>
	<tr>
	<td>Rank</td><td><a href="alla.php?sortBy=namn">Namn</a></td><td><a href="alla.php?sortBy=poang">Poäng</a></td><td><a href="alla.php?sortBy=niva">Nivå</a></td><td><a href="alla.php?sortBy=datum">Datum</a></td></tr>';
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {

			print '<tr bgcolor=#ffffff>';
			print '<td>' . $i . "</td>";
			print '<td>' . $row["namn"] . "</td>";
			print '<td>' . $row["poang"] . "</td>";
			print '<td>' . $row["niva"] . "</td>";
			print '<td>' . $row["datum"] . "</td>";
			print '</tr>';
			$i++;
		}
	} else {
		echo "0 results";
	}
	print '</table>';
	$mysqli->close();

	print "<br>Spelet har spelats " . ($i - 1) . " gånger";
	?>
	<br><br>
	<a href="index.html">Spela!</a>

</body>

</html>