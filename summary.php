<DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="stylesheet.css" />
	<title>Elevplattform</title>
</head>
<body>
<p>Hello there</p>

<?php
echo "<p>Hello there</p>";
//visa alla subjects
//add summary
// värden för pdo
$host = "localhost";
$dbname = "summaries";
$username = "summaries";
$password = "10";
// gör pdo

$dsn = "mysql:host=$host;dbname=$dbname";
$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

$pdo = new PDO($dsn, $username, $password, $attr);

if($pdo)
{
   echo "<pre>";
   foreach($pdo->query("SELECT * FROM users") as $row)
   {
      print_r($row);
   }
}
//visa formulär
?>
<div>
	<form action="summary.php" method="POST">
		Ny sammanfattning: <input type="text" name="ämnen"><br>
		Nytt ämne: <input type="checkbox" name="ämne">
		<input type="submit" name="Submit" method="POST">
	<form>
</div>
<php

?>
</body>
</html>