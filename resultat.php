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

<?php

header("Location: ./alla.php?sortBy=poang");
//exit();

$ipadress = $_SERVER['REMOTE_ADDR'];
$today = date("Y-m-d H:i:s");
if (!empty($_GET['namn'])) {
	$namn = $_GET['namn'];
	$points = $_GET['points'];
	$level = $_GET['level'];

	$mysql_host = "host";  
	$mysql_user = "username";
	$mysql_password = "password";
	$mysql_database = "database";

	$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$sql = "INSERT INTO spel (namn, poang, niva, datum, ip)
    VALUES ('$namn', '$points','$level','$today','$ipadress')";

	if ($mysqli->query($sql) === TRUE) {
		echo "New record created successfully";

	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error;
	}


	mysqli_close($mysqli);
}

?>

<html>

<head>
	<title>Untitled</title>
</head>

<body>



</body>

</html>