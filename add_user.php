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

<form action="add_user.php" method="POST">
	<legend>Ny användare</legend>
	<label for="name">Namn: </label>
	<input type="text" name="name" /><br/>
	<label for="name">Lösenord: </label>
	<input type="text" name="password" /><br/>
	<input type="submit" value="Lägg till användare" />

</form>
<?php 
if(!empty($_POST))
{
	if($_POST['name'] !=="" && $_POST['password'] !=="");
{
	$name = filter_input(INPUT_POST, 'user_id');
	$password = filter_input(INPUT_POST, 'subject_id');
	$statement = $pdo->prepare("INSERT INTO users (name, password) VALUES (:name, :password");
	$statement->bindParam(":name", $name);
	$statement->bindParam(":password", $password);
	if(!$statement->execute())
				print_r($statement->errorInfo());
}
}

if ($pdo) {
	echo "<ul>";
	foreach($pdo->query("SELECT * FROM users ORDER BY name DESC") as $row)
	{
		echo "<li><a href=\"\">{$row['name']}, Lösenord: {$row['password']}</a></li>";
	}
	echo "</ul>";
}
?>

</body>
</html>
