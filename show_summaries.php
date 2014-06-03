<DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="stylesheet.css" />
	<title>Elevplattform</title>
</head>
<body>
<?php 

$host = "localhost";
$dbname = "summaries";
$username = "summaries";
$password = "10";
$dsn = "mysql:host=$host;dbname=$dbname";
$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$pdo = new PDO($dsn, $username, $password, $attr);




if ($pdo) {

	echo "<ul>";
	foreach($pdo->query("SELECT * FROM summaries ORDER BY id DESC") as $row)
	{
		echo "<li><a href=\"\">{$row['title']}, av {$row['user_id']} ({$row['content']})</a></li>";
	}
	echo "</ul>";
}


?>
<div id="container">
<form action="add_summary.php" method="POST">
	<input type="submit" value="Skriv Sammanfattning" />
<form>
</div>

</body>
</html>