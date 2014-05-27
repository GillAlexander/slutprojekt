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
?> 

<div id="container">
<form action="add_summary.php" method="POST">
		<legend>Skriv Sammanfattning</legend>

	<p>	<label for="user_id">Användare:</label>
		<select name="users">
			<?php
				foreach ($pdo->query("SELECT * FROM users ORDER BY name") as $row)
				{
					echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
				}
			?> </select> </br>
	</p>
	<p>	<label for="subject_id">Ämne: </label>
		<select name="subjects">
			<?php
				foreach ($pdo->query("SELECT * FROM subjects ORDER BY name") as $row)
				{
					echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
				}
			?>
		</select></br>
	</p>
	<p>	<label for="title" >Rubrik: </label>
		<input type="text" name="title" /></br>
	</p>
	<p>	<label for="content">Sammanfattning: </label>
		<input type="text" name="post" />
	</p>
		<input type="submit" value="Tillägg" />
<form>
<?php
// har något postats? isf skriv till databasen
if (!empty($_POST)) {
	$_POST = null;
	$user_id = filter_input(INPUT_POST, 'user_id');
	$content = filter_input(INPUT_POST, 'content');
	$subject_id = filter_input(INPUT_POST, 'subject_id');
	$title = filter_input(INPUT_POST, 'title');

	$statement = $pdo-> prepare("INSERT INTO summary (date, user_id, subject_id, title, content,) VALUES (NOW(), :user_id, :subject_id, :title, :content)");
	$statement->bindParam(":user_id", $user_id);
	$statement->bindParam(":subject_id", $subject_id);
	$statement->bindParam(":title", $title);
	$statement->bindParam(":content", $content);
	$statement->execute();




	echo "<ul>";
	foreach($pdo->query("SELECT * FROM summaries ORDER BY id DESC") as $row)
	{
		echo "<li><a href=\"\">{$row['title']}, av {$row['user_id']} ({$row['content']})</a></li>";
	}
	echo "</ul>";
}

?>
</div>
</body>
</html>