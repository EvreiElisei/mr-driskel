<?php
require_once '../core.php';
$old_name = $_POST['old-name'];
$new_name = $_POST['new-name'];
$new_price = $_POST['new-price'];
$new_status = $_POST['new-status'];
$tmp_img = $_FILES['new-img']['tmp_name'];
$new_img = $new_name . ".jpg";
$update = "UPDATE `products` SET `name` = '{$new_name}', `price` = '{$new_price}', `img` = '{$new_img}', `status` = '{$new_status}' WHERE `name` = '{$old_name}'";
$update_res = $connect->query($update);
if($update_res->num_rows > 0){
$_SESSION['updateError'] = 'не пашет';
	header("Location: ../../admin_panel.php");
}else{
	unlink("../../../img/uploads/" . $old_name . ".jpg");
	move_uploaded_file($tmp_img, "../../../img/uploads/" . $new_img);
	$_SESSION['updateError'] = 'товар обновлен';
	header('Location: ../../admin_panel.php');
}