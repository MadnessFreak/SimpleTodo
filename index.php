<?php

require_once 'app/init.php';

if (isset($_SESSION['user_id'])) {
	$sql = $db->prepare("
		SELECT	id, name, done
		FROM	todo_items
		WHERE	user_id = ?
	");
	$sql->execute([
		$_SESSION['user_id']
	]);

	$items = $sql->rowCount() ? $sql : [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple Todo</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="stylesheet" type="text/css" href="css/default.css">
</head>
<body>
	<?php if (!isset($_SESSION['user_id'])): ?>
	<div class="list">
		<h1 class="header">Simple Todo</h1>
		<p>Please login using your username and password to view your todo list.</p>

		<form class="login" action="app/login.php" method="post">
			<input type="text" name="username" placeholder="Username" class="input" required>
			<input type="password" name="password" placeholder="Password" class="input" required>
			<input type="submit" value="Login" class="submit">
		</form>
	</div>
	<?php else: ?>
	<div class="list">
		<h1 class="header">Simple Todo</h1>

		<?php if (!empty($items)): ?>
		<ul class="items">
			<?php foreach($items as $item): ?>
				<li>
					<span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name'] ?></span>
					<?php if(!$item['done']): ?>
						<a href="app/mark.php?as=done&item=<?php echo $item['id'] ?>" class="done-button">Mark as done</a>
					<?php else: ?>
						<a href="app/mark.php?as=notdone&item=<?php echo $item['id'] ?>" class="done-button">Mark as unfinished</a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php else: ?>
			<p>You haven't any items yet.</p>
		<?php endif; ?>

		<form class="item-add" action="app/add.php" method="post">
			<input type="text" name="name" placeholder="Type a new item here" class="input" autocomplete="off" required>
			<input type="submit" value="Add" class="submit">
		</form>
	</div>
	<?php endif; ?>

	<div class="footer">
		<span>Simple todo list made by MadnessFreak</span>
		<ul>
			<li><a href="https://github.com/MadnessFreak/SimpleTodo">About</a></li>
			<li><a href="https://github.com/MadnessFreak/SimpleTodo">License</a></li>
			<li><a href="https://github.com/MadnessFreak/SimpleTodo">Readme</a></li>
			<?php if (isset($_SESSION['user_id'])): ?><li><a href="app/logout.php">Logout</a></li><?php endif; ?>
		</ul>
	</div>
</body>
</html>