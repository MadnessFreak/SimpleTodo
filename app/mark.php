<?php

require_once 'init.php';

if (isset($_GET['as'], $_GET['item'])) {
	$as		= $_GET['as'];
	$item	= $_GET['item'];
	$done	= $as == 'done' ? 1 : 0;

	if ($as == 'done' || $as == 'notdone') {
		$sql = $db->prepare("
			UPDATE	todo_items
			SET		done = ?
			WHERE	id = ? AND 
					user_id = ?
		");

		$sql->execute([
			$done,
			$item,
			$_SESSION['user_id']
		]);
	}
}

header('Location: ../index.php');