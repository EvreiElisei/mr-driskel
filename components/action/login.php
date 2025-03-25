<?php
require_once 'core.php';
$email = $_POST['email'];
$password = $_POST['pass'];
$check = "SELECT `role` FROM `users` WHERE `email` = '{$email}' AND `password` = '{$password}'";
$check_res = $connect->query($check);

if ($check_res->num_rows > 0) {
	$row = $check_res->fetch_assoc();
	if ($row['role'] == 'admin') {
		header('Location: ../admin_panel.php');
		$_SESSION['admin_Logged_in'] = true;
		exit;
	}
	header('Location: ../../index.php');
	exit;
} else {
	$_SESSION['logError'] = "Неверный логин или пароль";
	header("Location: ../../index.php");
	exit;
}
