<?php

require_once 'init.php';

if (isset($_POST['username'], $_POST['password'])) {
	$user	= trim($_POST['username']);
	$pass	= md5($_POST['password']);

	if (!empty($user) && !empty($pass)) {
		$sql = $db->prepare("
			SELECT	*
			FROM	todo_users
			WHERE	username = ?
		");

		$sql->execute([
			$user
		]);

		$data = $sql->rowCount() ? $sql->fetch(PDO::FETCH_ASSOC) : [];

		if (empty($data)) {
			$error = "Unregistered user";
		} else {
			if ($user == $data['username'] &&
				$pass == $data['password'])
			{
				$_SESSION['user_id'] = $data['id'];
				header('Location: ../index.php');
			} else {
				$error = "Invalid password";
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple Todo</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="stylesheet" type="text/css" href="../css/default.css">
</head>
<body>
	<div class="list">
		<center>
			<?php echo $error ?><br>
			<a href="../index.php">Try again</a>
		</center>
	</div>

	<div class="footer">
		<span>Simple todo list made by MadnessFreak</span>
		<ul>
			<li><a href="https://github.com/MadnessFreak/SimpleTodo">About</a></li>
			<li><a href="https://github.com/MadnessFreak/SimpleTodo">License</a></li>
			<li><a href="https://github.com/MadnessFreak/SimpleTodo">Readme</a></li>
		</ul>
	</div>
</body>
</html>