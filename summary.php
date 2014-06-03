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




//visa ämnen
foreach ($pdo->query("SELECT * FROM subjects ORDER BY name") as $row) 
	{
		echo "<div><a href=\"summaries.php?subject_id={$row['id']}\">{$row['name']}</a></div>";
	}
//visa summaries
	echo "<h2>Alla Sammanfattningar:</h2>";
foreach($pdo->query("SELECT * FROM summaries ORDER BY title DESC") as $row)
	{
		echo "<li><a href=\"\">{$row['title']}, Skapare: {$row['user_id']} ({$row['date']})</a></li>";
	}


foreach ($pdo->query("SELECT summaries.*,users.id AS name FROM users 
	JOIN users ON users.users_id=summaries.user_id ORDER BY date") as $row)
{
	echo "<p>{$row['date']} by {$row['user_name']} <br />
		{$row['post']}</p>";
}

foreach ($pdo->query("SELECT posts.*,users.name AS user_name FROM posts 
		JOIN users ON users.id=posts.user_id ORDER BY date") as $row)









 ?>
 <!--visa formulär-->
<div id="container">
<form action="show_summaries.php" method="POST">
	<input type="submit" value="Visa alla Sammanfattningar" />
</form>

<form action="add_user.php" method="POST">
<input type="submit" value="Tillägg användare" />
</form>
</div>
<php

?>
</body>
</html>