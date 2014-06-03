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
		<select name="user_id">
			<?php
				foreach ($pdo->query("SELECT * FROM users ORDER BY name") as $row)
				{
					echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
				}
			?> </select> </br>
	</p>
	<p>	<label for="subject_id">Ämne: </label>
		<select name="subject_id">
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
		<input type="text" name="content" />
	</p>
		<input type="submit" value="Tillägg" />
</form>
</div>
<?php
// har något postats? isf skriv till databasen


if(!empty($_POST))
{
	if($_POST['user_id'] !=="" && $_POST['subject_id'] !=="" && $_POST['title'] !=="" && $_POST['content'] !=="");
{
	$user_id = filter_input(INPUT_POST, 'user_id');
	$subject_id = filter_input(INPUT_POST, 'subject_id');
	$title = filter_input(INPUT_POST, 'title');
	$content = filter_input(INPUT_POST, 'content');
	$statement = $pdo->prepare("INSERT INTO summaries (user_id, date, subject_id,  title, content) VALUES (:user_id, NOW(), :subject_id,  :title, :content)");
	$statement->bindParam(":user_id", $user_id);
	$statement->bindParam(":subject_id", $subject_id);
	$statement->bindParam(":title", $title);
	$statement->bindParam(":content", $content);
	if(!$statement->execute())
				print_r($statement->errorInfo());
}
}



?>

</body>
</html>