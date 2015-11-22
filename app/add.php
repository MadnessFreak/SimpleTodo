<?php

require_once 'init.php';

if (isset($_POST['name'])) {
	$name = trim($_POST['name']);

	if (!empty($name)) {
		$sql = $db->prepare("
			INSERT INTO	todo_items
						(user_id, name, created)
			VALUES		
						(?, ?, NOW())
		");

		$sql->execute([
			$_SESSION['user_id'],
			$name
		]);
	}
}

header('Location: ../index.php');