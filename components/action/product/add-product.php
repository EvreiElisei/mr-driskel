<?php
require_once '../core.php';
$name = $_POST['name'] ?? "";
$price = $_POST['price'] ?? "";
$status = $_POST['status'] ?? "";
$tmp_img = $_FILES['img']['tmp_name'] ?? "";
$img_name = $_FILES['img']['name'] ?? "";
$add = "INSERT INTO `products`(`name`, `price`, `img`, `status`)  VALUES ('{$name}','{$price}','{$img_name}','{$status}')";
$add_res = $connect->query($add);
if($add_res->num_rows > 0){
	$_SESSION['addError'] = 'не пашет';
	header("Location: ../../admin_panel.php");
}else{
	move_uploaded_file($tmp_img, "../../../img/uploads/" . $img_name);
	$_SESSION['addError'] = 'товар добавлен';
	header('Location: ../../admin_panel.php');
}