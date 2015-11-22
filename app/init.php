<?php

session_start();

$db = new PDO('mysql:dbname=simple_todo;host=localhost;', 'root', '');

/*if (!isset($_SESSION['user_id'])) {
	die('You are not signed in.');
}*/