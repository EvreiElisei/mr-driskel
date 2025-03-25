<?php
require_once 'core.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pass'];
$repeat_password = $_POST['repeat-pass'];

if($password !== $repeat_password){
	$_SESSION['regError'] = 'Пароли не совпадают';
	header("Location: ../../index.php");
}else{
	$check = "SELECT `email` FROM `users` WHERE `email` = '{$email}'";
	$check_res = $connect->query($check);
	if($check_res->num_rows > 0){
		$_SESSION['regError'] = 'Под этой почтой уже зерегистрирован пользователь';
		header('Location: ../../index.php');
		exit;
	}else{
		$registration = "INSERT INTO `users`(`name`,`email`,`password`) VALUES ('{$name}','{$email}','{$password}')";
		$registration_res = $connect->query($registration);
		if($registration_res->num_rows > 0){
			$_SESSION['regError'] = 'не пашет';
			header("Location: ../../index.php");
		}else{
			$_SESSION['regError'] = 'успешная регистрация';
			header("Location: ../../index.php");
		}
	}
}