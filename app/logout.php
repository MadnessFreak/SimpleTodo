<?php

require_once 'init.php';

unset($_SESSION['user_id']);
session_destroy();

header('Location: ../index.php');