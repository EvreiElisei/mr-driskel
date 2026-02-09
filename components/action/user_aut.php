<?php
require_once 'core.php';
$connect = getDatebaseConnection();
$password = $_POST['password'];
$email = $_POST['email'];
$check = "SELECT * FROM `users` WHERE `password` = '$password' AND `email` = '$email'";
$check_res = $connect->query($check);

if ($check_res->num_rows > 0) {
  $row = $check_res->fetch_assoc();
  $user = [
    'isFound' => true,
    'isAdmin' => $row['role_id'] == "1" ? true : false,
    'id' => $row['id'],
    'name' => $row['name'],
    'email' => $row['email'],
    'role_id' => $row['role_id'],
  ];
  echo json_encode($user);
  exit;
} else {
  $user = [
    'isFound' => false
  ];
  echo json_encode($user);
  // $_SESSION['logError'] = "Неверный или пароль";
  // header("Location: ../../index.php");
  exit;
}
