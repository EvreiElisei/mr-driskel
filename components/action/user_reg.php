<?php
require_once 'core.php';
$connect = getDatebaseConnection();
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$check = "SELECT `email` FROM `users` WHERE `email` = '{$email}'";
$check_res = $connect->query($check);
if ($check_res->num_rows > 0) {
  //'Под этой почтой уже зерегистрирован пользователь';
  echo 'emailIsUsed';
  exit;
} else {
  $registration = "INSERT INTO `users`(`name`,`email`,`password`) VALUES ('{$login}','{$email}','{$password}')";
  $registration_res = $connect->query($registration);
  if ($connect->affected_rows > 0) echo 'success';
}
